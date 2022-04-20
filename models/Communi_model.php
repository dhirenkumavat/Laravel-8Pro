<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Communi_model extends CI_Model
{

    private $_limit;
    private $_pageNumber;
    private $_offset;

    /**
     * This function is used to get the communication listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function commListingCount()
    {
        $this->db->select('BaseTbl.communicationId, BaseTbl.type, BaseTbl.froms, BaseTbl.to,BaseTbl.createdDtm');
        $this->db->from('amp_communications as BaseTbl');
        $this->db->join('amp_leads as Lead', 'Lead.leadId = BaseTbl.leadId','left');
        $this->db->join('amp_opt_ins as opt', 'opt.optInId = Lead.optInId', 'left');
        
        $this->db->order_by('BaseTbl.communicationId', 'DESC');
        $query = $this->db->get();
        return $query->num_rows();        
    }
    

    // setter getter function
        public function setLimit($limit) {
            $this->_limit = $limit;
        }
 
        public function setPageNumber($pageNumber) {
            $this->_pageNumber = $pageNumber;
        }
 
        public function setOffset($offset) {
            $this->_offset = $offset;
        }


        /** 
        *
        *
        **/

        function getCallLogData($start=null,$end=null){
            $extension = $this->session->userdata['extension'];
            if(empty($start)){
                $start = '2019-01-01 00:00:00';
            }
            if(empty($end)){
                $end = date("Y-m-d H:i:s");
            }

            $post_data="start=".$start."&end=".$end."&userid=".$extension;
            

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, CALL_LOG_URL);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));   
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            $result = curl_exec($ch);
            return json_decode($result);
            //print_r($result);die;

        }


    /**
     * This function is used to get the communication listing 
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function commListing()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('amp_communications as BaseTbl');
        $this->db->join('amp_leads as Lead', 'Lead.leadId = BaseTbl.leadId','left');
        $this->db->join('amp_opt_ins as opt', 'opt.optInId = Lead.optInId', 'left');
         
        $this->db->order_by('BaseTbl.communicationId', 'DESC');
        $this->db->limit($this->_pageNumber, $this->_offset);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
            
    

    /**
     * This function is used to get the searched communication data
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function getsearchedData($startDate,$endDate)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('amp_communications as BaseTbl');
        //$this->db->join('amp_opt_ins as opt', 'opt.optInId = Lead.optInId', 'left');
        //$this->db->where('createdDtm >=', date("Y-m-d", strtotime($startDate)));
        //$this->db->where('createdDtm <=', date("Y-m-d", strtotime($endDate)));

        if($startDate!='' && $endDate!=''){
            $this->db->where('DATE_FORMAT(createdDtm, "%Y-%m-%d") >=', date("Y-m-d", strtotime($startDate)));
            $this->db->where('DATE_FORMAT(createdDtm, "%Y-%m-%d") <=', date("Y-m-d", strtotime($endDate)));
        }

        $this->db->order_by('BaseTbl.communicationId', 'DESC');
        $query = $this->db->get();
        return $query->result_array();       
    }

    /**
     * This function is used to add new communication
     * @return number $insert_id : This is last inserted id
     */
    function addCommunication($communicationInfo)
    {
        $this->db->trans_start();
        $this->db->insert('amp_communications', $communicationInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    


    function getLeadDetails($leadId){         
        $sql = "SELECT phoneNo1 FROM amp_projects WHERE projectId = ".$leadId;
        return $result = $this->db->query($sql)->result_array();
    }

    function getContactDetail($projectId){         
        $this->db->select('BaseTbl.*');
        $this->db->from('amp_contact as BaseTbl');
        $this->db->join('amp_project_contact as apc','apc.contactId = BaseTbl.id');
        $this->db->where('apc.projectId', $projectId);
        $this->db->where('apc.is_primary', 1);

        // $user_level_where_condition = manage_user_level_condition();     
        // if(!empty($user_level_where_condition)){
        //     $this->db->where($user_level_where_condition);
        // }
        
        $query = $this->db->get();    
        $result = $query->result_array();        
        return $result;
    }



    function getAllLeadIdsofUser($userID){         
        $this->db->select('projectId');
        $this->db->from('amp_projects');
        $this->db->where('userID', $userID);
        $this->db->where('isDeleted', 0);
        $query  = $this->db->get();    
        $result = $query->result_array();     
        $ids = '';   
        if(isset($result) && !empty($result)){
            foreach($result as $leadIds){
                if($ids == ''){
                    $ids.=$leadIds['projectId'];
                }else{
                    $ids.=",".$leadIds['projectId'];
                }
            }
        }
        return $ids;
    }
}

  