<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Lead_model extends CI_Model
{

    private $_limit;
    private $_pageNumber;
    private $_offset;
    /**
     * This function is used to get the lead listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function leadListingCount()
    {
        $this->db->select('BaseTbl.leadId');
        $this->db->from('amp_leads as BaseTbl');
        $this->db->join('amp_users as User', 'User.userId = BaseTbl.salesRepId','left');
        $this->db->join('amp_stages as Stage', 'Stage.stageId = BaseTbl.stageId','left');
        
        $this->db->where('BaseTbl.isDeleted', 0);

        $user_level_where_condition = manage_user_level_condition();     

        if(!empty($user_level_where_condition)){
            $this->db->where($user_level_where_condition);
        }

        $this->db->order_by('BaseTbl.leadId', 'DESC');
        $query = $this->db->get();
        $this->db->limit($this->_pageNumber, $this->_offset);
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
     * This function is used to get the lead listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function leadListing()
    {

        
        
        $this->db->select('BaseTbl.leadId, BaseTbl.firstName, BaseTbl.lastName, BaseTbl.createdDtm, BaseTbl.salesRepId, BaseTbl.stageId,User.name,Stage.stageName,BaseTbl.phoneNo1,BaseTbl.email,BaseTbl.updatedDtm');
        $this->db->from('amp_leads as BaseTbl');
        $this->db->join('amp_users as User', 'User.userId = BaseTbl.salesRepId','left');
        $this->db->join('amp_stages as Stage', 'Stage.stageId = BaseTbl.stageId','left');
       
        $this->db->where('BaseTbl.isDeleted', 0);

        //Call helper function to manage user level access.

        $user_level_where_condition = manage_user_level_condition();     

        if(!empty($user_level_where_condition)){
            $this->db->where($user_level_where_condition);
        }
        
        

        $this->db->order_by('BaseTbl.leadId', 'DESC');
        $this->db->limit($this->_pageNumber, $this->_offset);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
            
    /**
     * This function is used to add new lead to system
     * @return number $insert_id : This is last inserted id
     */
     function addNewLead($leadInfo)
    {
        $this->db->trans_start();
        $this->db->insert('amp_leads', $leadInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }


    /**
     * This function is used to add options to system
     * @return number $insert_id : This is last inserted id
     */
    function addOptions($optionInData,$result)
    {
        $this->db->trans_start();
        $optionData = array('leadId'=>$result);

        $finaloptionData=array_merge($optionInData,$optionData);
        $this->db->insert('amp_opt_ins', $finaloptionData);
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * This function used to get lead information by id
     * @param number $leadId : This is lead id
     * @return array $result : This is user information
     */
    function getLeadInfo($leadId)
    {
        $this->db->select('leadId,firstName, lastName, email, phoneNo1,phoneNo2, notes,salesRepId,stageId,region,address,city,state,zip,tagId,reftypeId,referralSourceId,DL,dob,businessOwner,ownership,policyExpiration,brokerFee,countryId,IID');
        $this->db->from('amp_leads');
        $this->db->where('isDeleted', 0);
        $this->db->where('leadId', $leadId);
        $query = $this->db->get();
        
        return $query->row();
    }


     /**
     * This function used to get all country
     * @return array $result : This is user information
     */
    function getCountry()
    {
        $this->db->select('id,name,nicename');
        $this->db->from('amp_country');
        $query = $this->db->get();        
        $result = $query->result();        
        return $result;
    }


    /**
     * This function used to get communication information by id
     * @param number $leadId : This is lead id
     * @return array $result : This is user information
     */
    function getCommunication($leadId)
    {
        $this->db->select('*');
        $this->db->from('amp_communications');
        $this->db->where('leadId', $leadId);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }


    /**
     * This function used to get Files information by id
     * @param number $leadId : This is lead id
     * @return array $result : This is user information
     */
    function getFiles($leadId)
    {
        $this->db->select('fileId,name,type,createdDtm');
        $this->db->from('amp_files');
        $this->db->where('leadId', $leadId);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }


    /**
     * This function used to get history information by id
     * @param number $leadId : This is lead id
     * @return array $result : This is user information
     */
    function getHistory($leadId)
    {
        $this->db->select('BaseTbl.stageId,BaseTbl.createdDtm,stage.stageName');
        $this->db->from('amp_lead_stage_history as BaseTbl');
        $this->db->join('amp_stages as stage', 'stage.stageId = BaseTbl.stageId','left');
        $this->db->where('leadId', $leadId);
        $this->db->order_by('BaseTbl.createdDtm', 'DESC');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }


    /**
     * This function used to get option information by id
     * @param number $leadId : This is lead id
     * @return array $result : This is user information
     */
    function getOption($leadId)
    {
        $this->db->select('BaseTbl.sms,BaseTbl.calls,BaseTbl.email');
        $this->db->from('amp_opt_ins as BaseTbl');
        $this->db->where('leadId', $leadId);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
    
    
    /**
     * This function is used to update the lead information
     * @param array $leadInfo : This is lead updated information
     * @param number $leadId : This is lead id
     */
    function editLead($leadInfo, $leadId)
    {
        $this->db->where('leadId', $leadId);
        $this->db->update('amp_leads', $leadInfo);
        
        return TRUE;
    }
    
    
    
    /**
     * This function is used to delete the lead information
     * @param number $leadId : This is lead id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteLead($leadId, $leadInfo)
    {
        $this->db->where('leadId', $leadId);
        $this->db->update('amp_leads', $leadInfo);

        /*Delete task of this Lead*/
        $this->db->where('leadId', $leadId);
        $this->db->delete('amp_tasks'); 
        
        return $this->db->affected_rows();
    }


    /**
     * This function is used to delete the lead information
     * @param number $leadId : This is lead id
     * @return boolean $result : TRUE / FALSE
     */
    function change_leadstage($leadId, $lead_stageInfo)
    {
        $this->db->where('leadId', $leadId);
        $this->db->update('amp_leads', $lead_stageInfo);
        //echo $this->db->last_query();die;
        return $this->db->affected_rows();
    }


    /**
     * This function used to get Stages information
     * @return array $result : This is user information
     */
    function getStages()
    {
        $this->db->select('stageId,stageName, color, stageOrder');
        $this->db->from('amp_stages');
        $this->db->where('isDeleted', 0);
        $this->db->order_by('amp_stages.stageOrder', 'ASC');
        $query = $this->db->get();        
        $result = $query->result();        
        return $result;
    }

    /**
     * This function used to get Tags information
     * @return array $result : This is user information
     */
    function getTags()
    {
        $this->db->select('id,tagName,tagOrder');
        $this->db->from('amp_tags');
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();        
        $result = $query->result();        
        return $result;
    }


    /**
     * This function used to get referral information
     * @return array $result : This is user information
     */
    function getrefType()
    {
        $this->db->select('referralId,referralName,referralOrder');
        $this->db->from('amp_referral_type');
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();        
        $result = $query->result();        
        return $result;
    }

    /**
     * This function used to get selling information
     * @return array $result : This is user information
     */
    function getSelling()
    {
        $this->db->select('sellingId,ownership,policyExpiration,businessOwner,sellingOrder');
        $this->db->from('amp_cross_selling');
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();        
        $result = $query->result();        
        return $result;
    }


    /**
     * This function is used to add new task to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewTask($taskInfo)
    {
        
        $this->db->trans_start();
        $this->db->insert('amp_tasks', $taskInfo);

        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    /**
     * This function used to get Lead id information
     * @return array $result : This is user information
     */
    function getLeadId()
    {
        $this->db->select('leadId');
        $this->db->from('amp_leads');
        $this->db->where('isDeleted', 0);
        $user_level_where_condition = manage_user_level_condition();     

        if(!empty($user_level_where_condition)){
            $this->db->where($user_level_where_condition);
        }
        $query = $this->db->get();        
        $result=$query->result_array();
        $arr = array_map (function($value){
            return $value['leadId'];
        } , $result);
         return $arr;
    }


     /**
     * This function used to task info by lead id added by ram
     * @param number $leadId : This is lead id
     * @return array $result : This is user information
     */
    function getTaskInfo($leadId)
    {
        $this->db->select('*');
        $this->db->from('amp_tasks as BaseTbl');
        $this->db->where('BaseTbl.leadId', $leadId);
        $user_level_where_condition = manage_user_level_condition();     

        if(!empty($user_level_where_condition)){
            $this->db->where($user_level_where_condition);
        }
        $query = $this->db->get();        
        $result = $query->result();        
        return $result;
    }

    /**
     * This function used to get referral source information
     * @return array $result : This is user information
     */
    function getrefSources()
    {
        $this->db->select('referralSourceId,companyName,firstName');
        $this->db->from('amp_referral_source');
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();        
        $result = $query->result();        
        return $result;
    }

    function addfile($insertValuesSQL,$result,$fileType){
        $this->db->set('name', $insertValuesSQL);
        $this->db->set('type', $fileType);
        $this->db->insert('amp_files',array('leadId'=>$result,'createdDtm'=> date('Y-m-d H:i:s')));
        //echo $this->db->last_query();die;
        return true;
    }

    function deletefile($leadId){
        $this->db->where('leadId', $leadId);
        $this->db->delete('amp_files');
    }

    /**
     * This function is used to add new option to system
     * @return number $insert_id : This is last inserted id
     */
    function addoptionData($optionDataInfo)
    {
        $this->db->trans_start();
        $this->db->insert('amp_opt_ins', $optionDataInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    /**
     * This function used to get option information by id
     * @param number $leadId : This is lead id
     * @return array $result : This is user information
     */
    function getOptionData($leadId)
    {
        $this->db->select('BaseTbl.sms,BaseTbl.calls,BaseTbl.email');
        $this->db->from('amp_opt_ins as BaseTbl');
        $this->db->where('leadId', $leadId);
        $query = $this->db->get();
        $result = $query->result_array();        
        return $result;
    }

    /**
     * This function is used to update the option data information
     * @param array $leadInfo : This is lead updated information
     * @param number $leadId : This is lead id
     */
    function editoptionData($optionDataInfo, $leadId)
    {
        $this->db->where('leadId', $leadId);
        $this->db->update('amp_opt_ins', $optionDataInfo);
        if($this->db->affected_rows()==0){
            $optionDataInfo['leadId'] = $leadId;
            $this->db->insert('amp_opt_ins',$optionDataInfo);
        }        
        return TRUE;
    }

    function editfile($leadId,$insertValuesSQL,$fileType){
        $h= $insertValuesSQL;        
        $this->db->set('leadId', $leadId);
        $this->db->set('type', $fileType);
        $this->db->set('createdDtm', date('Y-m-d H:i:s'));
        //$this->db->where('isDeleted', 0);
        $this->db->insert('amp_files',array('name'=>$h));   
        return TRUE;
    } 

    /**
     * This function is used to get the lead listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function leadstageListing($lead_id,$first_name,$last_name,$phone_no,$email,$sales_rep,$stageId)
    {
        $this->db->select('BaseTbl.leadId,BaseTbl.phoneNo1,BaseTbl.phoneNo2,BaseTbl.email, BaseTbl.firstName, BaseTbl.lastName, BaseTbl.createdDtm, BaseTbl.salesRepId, BaseTbl.stageId,User.name,Stage.stageName');
        $this->db->from('amp_leads as BaseTbl');
        $this->db->join('amp_users as User', 'User.userId = BaseTbl.salesRepId','left');
        $this->db->join('amp_stages as Stage', 'Stage.stageId = BaseTbl.stageId','left');
        if(!empty($lead_id)) {
            $likeCriteria = "(BaseTbl.leadId  LIKE '%".$lead_id."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($first_name)) {
            $likeCriteria = "(BaseTbl.firstName  LIKE '%".$first_name."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($last_name)) {
            $likeCriteria = "(BaseTbl.lastName  LIKE '%".$last_name."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($phone_no)) {
            $likeCriteria = "(BaseTbl.phoneNo1  LIKE '%".$phone_no."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($email)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$email."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($sales_rep)) {
            $likeCriteria = "(BaseTbl.salesRepId  LIKE '%".$sales_rep."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($stageId)) {
            $likeCriteria = "(BaseTbl.stageId  LIKE '%".$stageId."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.leadId', 'DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $result = $query->result();        
        return $result;        
    }


     /**
     * This function is used to get the lead listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function leadstageListingArray($lead_id,$first_name,$last_name,$phone_no,$email,$sales_rep,$stageId)
    {
        $this->db->select('BaseTbl.leadId,BaseTbl.phoneNo1,BaseTbl.phoneNo2,BaseTbl.email, BaseTbl.firstName, BaseTbl.lastName, BaseTbl.createdDtm, BaseTbl.salesRepId, BaseTbl.stageId,User.name,Stage.stageName');
        $this->db->from('amp_leads as BaseTbl');
        $this->db->join('amp_users as User', 'User.userId = BaseTbl.salesRepId','left');
        $this->db->join('amp_stages as Stage', 'Stage.stageId = BaseTbl.stageId','left');
        if(!empty($lead_id)) {
            $likeCriteria = "(BaseTbl.leadId  LIKE '%".$lead_id."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($first_name)) {
            $likeCriteria = "(BaseTbl.firstName  LIKE '%".$first_name."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($last_name)) {
            $likeCriteria = "(BaseTbl.lastName  LIKE '%".$last_name."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($phone_no)) {
            $likeCriteria = "(BaseTbl.phoneNo1  LIKE '%".$phone_no."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($email)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$email."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($sales_rep)) {
            $likeCriteria = "(BaseTbl.salesRepId  LIKE '%".$sales_rep."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($stageId)) {
            $likeCriteria = "(BaseTbl.stageId  LIKE '%".$stageId."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.leadId', 'DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $result = $query->result_array();        
        return $result;
    }


    /**
     * This function used to  first stage lead count
     * @param number $leadId : This is lead id
     * @return array $result : This is user information
     */
    function getfirstStage()
    {
        $this->db->select('count(leadId) as stage_first');
        $this->db->from('amp_leads');
        $this->db->where('stageId', 1);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();   
        //echo $this->db->last_query()     ;die;
        $result = $query->row_array();        
        return $result;
    }

    /**
     * This function used for  second stage lead count
     */
    function getsecondStage()
    {
        $this->db->select('count(leadId) as stage_second');
        $this->db->from('amp_leads');
        $this->db->where('stageId', 2);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();        
        $result = $query->row_array();        
        return $result;
    }

    /**
     * This function used for  third stage lead count
     */
    function getthirdStage()
    {
        $this->db->select('count(leadId) as stage_third');
        $this->db->from('amp_leads');
        $this->db->where('stageId', 3);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();        
        $result = $query->row_array();        
        return $result;
    }


    /**
     * This function used for  fourth stage lead count
     */
    function getfourthStage()
    {
        $this->db->select('count(leadId) as stage_fourth');
        $this->db->from('amp_leads');
        $this->db->where('stageId', 4);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();     
        $result = $query->row_array();        
        return $result;
    }

    /**
     * This function used for  fourth stage lead count
     */
    function getStageCount($stageId)
    {
        $this->db->select('stageId,count(leadId) as stage_count');
        $this->db->from('amp_leads as BaseTbl');
        $this->db->where('stageId', $stageId);
        $this->db->where('BaseTbl.isDeleted', 0);

        $user_level_where_condition = manage_user_level_condition('dashboard_stage_count');     

        if(!empty($user_level_where_condition)){
            $this->db->where($user_level_where_condition);
        }

        $this->db->where_in('amp_users.roleId', $_SESSION['roleAccess']);
        $this->db->join('amp_users', 'amp_users.userId = BaseTbl.salesRepId', 'left');
        $query = $this->db->get();  
        //echo $this->db->last_query(); die;    
        $result = $query->row_array();        
        return $result;
    }


    /**
     * This function used to get new lead
     */
    function getnewlead()
    {
        /*
        $todayDate = date('Y-m-d 00:00:00');
        $datetime = new DateTime('tomorrow');
        $tomorrowDate =  $datetime->format('Y-m-d H:i:s');
        $this->db->select('count(leadId) as new_lead');
        $this->db->from('amp_leads');
        $this->db->where('createdDtm >=', $todayDate);
        $this->db->where('createdDtm <=', $tomorrowDate);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();    
        $result = $query->row_array();        
        return $result;
        */
        $todayDate  = date('Y-m-d');
        $this->db->select('count(leadId) as new_lead');
        $this->db->from('amp_leads');
        $this->db->where('DATE_FORMAT(amp_leads.createdDtm, "%Y-%m-%d") =', $todayDate);
        $this->db->where('amp_leads.isDeleted', 0);
        $this->db->where_in('amp_users.roleId', $_SESSION['roleAccess']);
        $this->db->join('amp_users', 'amp_users.userId = amp_leads.salesRepId', 'left');
        $query = $this->db->get();    
        $result = $query->row_array();        
        return $result;
    }

    /**
     * This function used to get new lead
     */
    function getweekCount()
    {
        $date = strtotime("-7 day");
        $startDate =  date('Y-m-d', $date);
        $todayDate = date('Y-m-d');
        $this->db->select('count(leadId) as weekCount');
        $this->db->from('amp_leads');
        //$this->db->where('createdDtm', 4);
        $this->db->where('amp_leads.createdDtm >=', $startDate);
        $this->db->where('amp_leads.createdDtm <=', $todayDate);
        $this->db->where('amp_leads.isDeleted', 0);
        $this->db->where_in('amp_users.roleId', $_SESSION['roleAccess']);
        $this->db->join('amp_users', 'amp_users.userId = amp_leads.salesRepId', 'left');
        $query = $this->db->get();    
        //echo $this->db->last_query() ;die;
        $result = $query->row_array();        
        return $result;
    }


    /**
     * This function used to get new file count by weeek
     */
    function getfileweekCount()
    {
        $date = strtotime("-7 day");
        $startDate =  date('Y-m-d', $date);
        $todayDate = date('Y-m-d');
        $this->db->select('count(amp_files.fileId) as weekfileCount1');
        $this->db->from('amp_files');
        $this->db->join('amp_leads as Lead', 'Lead.leadId = amp_files.leadId','left');
        $this->db->join('amp_users', 'amp_users.userId = Lead.salesRepId', 'left');
        $this->db->where_in('amp_users.roleId', $_SESSION['roleAccess']);
        $this->db->where('amp_files.createdDtm >=', $startDate);
        $this->db->where('amp_files.createdDtm <=', $todayDate);
        $query = $this->db->get();    
        //echo $this->db->last_query() ;die;
        $result1 = $query->row_array();    


        $this->db->select('count(amp_ref_files.fileId) as weekfileCount2');
        $this->db->from('amp_ref_files');
        $this->db->join('amp_leads as Lead', 'Lead.leadId = amp_ref_files.referralSourceId','left');
        $this->db->join('amp_users', 'amp_users.userId = Lead.salesRepId', 'left');
        $this->db->where_in('amp_users.roleId', $_SESSION['roleAccess']);
        $this->db->where('amp_ref_files.createdDtm >=', $startDate);
        $this->db->where('amp_ref_files.createdDtm <=', $todayDate);
        $query = $this->db->get();    
        //echo $this->db->last_query() ;die;
        $result2 = $query->row_array();    

        $query = $result1['weekfileCount1']+$result2['weekfileCount2'];
        return $query;
    }


    /**
     * This function used to get monthly
     */
    function getmonthCount()
    {   
        $sql = "SELECT count(leadId) as monthCount
                FROM amp_leads left join amp_users on amp_users.userId = amp_leads.salesRepId 
                WHERE MONTH(amp_leads.createdDtm) = MONTH(CURRENT_DATE())
                AND YEAR(amp_leads.createdDtm) = YEAR(CURRENT_DATE()) and amp_users.roleId in ".$_SESSION['roleAccessStr'];
        return $this->db->query($sql)->row_array();
    }


    /**
     * This function used to get monthly
     */
    function getfilemonthCount()
    {         
        $sql = "SELECT count(amp_ref_files.fileId) as filemonthCount1
                FROM amp_ref_files left join amp_leads on amp_leads.leadId = amp_ref_files.referralSourceId 
                left join amp_users on amp_users.userId = amp_leads.salesRepId 
                WHERE MONTH(amp_ref_files.createdDtm) = MONTH(CURRENT_DATE()) 
                AND YEAR(amp_ref_files.createdDtm) = YEAR(CURRENT_DATE()) and amp_users.roleId in ".$_SESSION['roleAccessStr'];
                
        $result1 =  $this->db->query($sql)->row_array();


         $sql2 = "SELECT count(amp_files.fileId) as filemonthCount2
                FROM amp_files left join amp_leads on amp_leads.leadId = amp_files.leadId 
                left join amp_users on amp_users.userId = amp_leads.salesRepId 
                WHERE MONTH(amp_files.createdDtm) = MONTH(CURRENT_DATE()) 
                AND YEAR(amp_files.createdDtm) = YEAR(CURRENT_DATE()) and amp_users.roleId in ".$_SESSION['roleAccessStr'];
        $result2 =  $this->db->query($sql2)->row_array();
        $result = $result1['filemonthCount1']+$result2['filemonthCount2'];
        return $result;

    }


    /**
     * This function used to get yearly
     */
    function getyearCount()
    {   
        $sql = "SELECT count(leadId) as yearCount
                FROM amp_leads left join amp_users on amp_users.userId = amp_leads.salesRepId                 
                where YEAR(amp_leads.createdDtm) = YEAR(CURRENT_DATE()) and amp_users.roleId in ".$_SESSION['roleAccessStr'];
        return $this->db->query($sql)->row_array();
    }


    /**
     * This function used to get yearly
     */
    function getfileyearCount()
    {   
        $sql = "SELECT count(amp_ref_files.fileId) as yearCount1
                FROM amp_ref_files  left join amp_leads on amp_leads.leadId = amp_ref_files.referralSourceId 
                left join amp_users on amp_users.userId = amp_leads.salesRepId 
                WHERE YEAR(amp_ref_files.createdDtm) = YEAR(CURRENT_DATE()) and amp_users.roleId in ".$_SESSION['roleAccessStr'];
        $result1 = $this->db->query($sql)->row_array();


        $sql1 = "SELECT count(amp_files.fileId) as yearCount2
                FROM amp_files left join amp_leads on amp_leads.leadId = amp_files.leadId 
                left join amp_users on amp_users.userId = amp_leads.salesRepId 
                WHERE YEAR(amp_files.createdDtm) = YEAR(CURRENT_DATE()) and amp_users.roleId in ".$_SESSION['roleAccessStr'];
        $result2 = $this->db->query($sql1)->row_array();
        $result = $result1['yearCount1']+$result2['yearCount2'];
        return $result;
    }



    /**
     * This function used to get new files today
     */
    function getnewfile()
    {
        /*
        $todayDate = date('Y-m-d 00:00:00');
        $datetime = new DateTime('tomorrow');
        $tomorrowDate =  $datetime->format('Y-m-d H:i:s');
        $this->db->select('count(fileId) as new_file');
        $this->db->from('amp_files');
        $this->db->where('createdDtm >=', $todayDate);
        $this->db->where('createdDtm <=', $tomorrowDate);
        $query = $this->db->get();    
        //echo $this->db->last_query() ;die;
        $result = $query->row_array();        
        return $result;
        */

        $todayDate = date('Y-m-d');
        $this->db->select('count(fileId) as new_file');
        $this->db->from('amp_files');
        $this->db->join('amp_leads as Lead', 'Lead.leadId = amp_files.leadId','left');
        $this->db->join('amp_users', 'amp_users.userId = Lead.salesRepId', 'left');
        $this->db->where_in('amp_users.roleId', $_SESSION['roleAccess']);
        $this->db->where('DATE_FORMAT(amp_files.createdDtm, "%Y-%m-%d") =', $todayDate);
        $query = $this->db->get();    
        //echo $this->db->last_query() ;die;
        $result = $query->row_array();        
        return $result;
    }

    /**
     * This function used to get new ref files today
     */
    function getReffile()
    {
        $todayDate = date('Y-m-d 00:00:00');
        $datetime = new DateTime('tomorrow');
        $tomorrowDate =  $datetime->format('Y-m-d H:i:s');
        $this->db->select('count(amp_ref_files.fileId) as newref_file');
        $this->db->from('amp_ref_files');
        $this->db->join('amp_leads as Lead', 'Lead.leadId = amp_ref_files.referralSourceId','left');
        $this->db->join('amp_users', 'amp_users.userId = Lead.salesRepId', 'left');
        $this->db->where_in('amp_users.roleId', $_SESSION['roleAccess']);
        $this->db->where('amp_ref_files.createdDtm >=', $todayDate);
        $this->db->where('amp_ref_files.createdDtm <=', $tomorrowDate);
        $query = $this->db->get();    
        //echo $this->db->last_query() ;die;
        $result = $query->row_array();        
        return $result;
    }


    /**
     * This function used to get file data
     */
    function getfileData()
    {   
        $this->db->select('File.fileId,File.leadId,File.name,File.type,File.createdDtm');
        $this->db->from('amp_files as File');
        $this->db->join('amp_leads as Lead', 'Lead.leadId = File.leadId','left');
        $this->db->join('amp_users', 'amp_users.userId = Lead.salesRepId', 'left');
        $this->db->where_in('amp_users.roleId', $_SESSION['roleAccess']);
        $this->db->limit(10);
        $query = $this->db->get();    
        // echo $this->db->last_query() ;die;
        $result1 = $query->result_array();        
        

        $this->db->select('Rfile.fileId,Rfile.referralSourceId,Rfile.name,Rfile.type,Rfile.createdDtm');
        $this->db->from('amp_ref_files as Rfile');
        $this->db->join('amp_leads as Lead', 'Lead.leadId = Rfile.referralSourceId','left');
        $this->db->join('amp_users', 'amp_users.userId = Lead.salesRepId', 'left');
        $this->db->where_in('amp_users.roleId', $_SESSION['roleAccess']);
        $this->db->limit(10);
        $query = $this->db->get();    
        // echo $this->db->last_query() ;die;
        $result2 = $query->result_array();  

        $res = array_merge($result1, $result2); 
        return $res;

    }

    /**
     * This function used to get Files information by id
     * @param number $leadId : This is lead id
     * @return array $result : This is user information
     */
    function getfilesData($id)
    {
        $this->db->select('File.fileId,File.leadId,File.name,File.type,File.createdDtm');
        $this->db->from('amp_files as File');
        $this->db->join('amp_leads as Lead', 'Lead.leadId = File.leadId','left');
        $this->db->join('amp_users', 'amp_users.userId = Lead.salesRepId', 'left');
        $this->db->where_in('amp_users.roleId', $_SESSION['roleAccess']);
        $this->db->where('fileId', $id);
        $query = $this->db->get();        
        $result = $query->row_array();        
        return $result;
    }


     /**
     * This function used to get tag data
     */
    function gettagData()
    {   
        $this->db->select('tagName,count(Lead.tagId) as quantity');
        $this->db->from('amp_tags');
        $this->db->join('amp_leads as Lead', 'Lead.tagId = amp_tags.id','left');
        $this->db->join('amp_users', 'amp_users.userId = Lead.salesRepId', 'left');
        $this->db->where_in('amp_users.roleId', $_SESSION['roleAccess']);
        $this->db->group_by('Lead.tagId'); 
        $this->db->limit(10);
        $query = $this->db->get();    
        //echo $this->db->last_query() ;die;
        $result = $query->result_array();        
        return $result;
    }

     /**
     * This function used to get email data
     */
    function getemailData()
    {   
        $todayDate = date('Y-m-d 00:00:00');
        $datetime = new DateTime('tomorrow');
        $tomorrowDate =  $datetime->format('Y-m-d H:i:s');
        $this->db->select('BaseTbl.salesRepId,User.name,count(BaseTbl.salesRepId) as emailCount');
        $this->db->from('amp_emails as BaseTbl');
        $this->db->join('amp_users as User', 'User.userId = BaseTbl.salesRepId','left');
        $this->db->where('BaseTbl.createdDtm >=', $todayDate);
        $this->db->where('BaseTbl.createdDtm <=', $tomorrowDate);
        $this->db->where('User.roleId >=', $_SESSION['role']);
        $this->db->group_by('User.userId'); 
        $this->db->limit(10);
        $query = $this->db->get();    
        $result = $query->result_array();        
        return $result;
    }

    /**
     * This function used to get monthly email Data
     */
    function getemailDataMonthly()
    {         
        $sql = "SELECT BaseTbl.salesRepId,User.name,count(BaseTbl.salesRepId) as emailCountmonthly
                FROM amp_emails as BaseTbl 
                LEFT JOIN amp_users as User on User.userId = BaseTbl.salesRepId
                WHERE MONTH(BaseTbl.createdDtm) = MONTH(CURRENT_DATE())
                AND YEAR(BaseTbl.createdDtm) = YEAR(CURRENT_DATE()) and User.roleId >= ".$_SESSION['role']." 
                GROUP By User.userId
                ";
        return $this->db->query($sql)->result_array();


    }

    /**
     * This function used to get Today email count
     */
    function getemailDataToday()
    {
        /*
        $todayDate = date('Y-m-d 00:00:00');
        $datetime = new DateTime('tomorrow');
        $tomorrowDate =  $datetime->format('Y-m-d H:i:s');
        $this->db->select('count(id) as emailTodayCount');
        $this->db->from('amp_emails');
        $this->db->where('createdDtm >=', $todayDate);
        $this->db->where('createdDtm <=', $tomorrowDate);
        $query = $this->db->get();    
        $result = $query->row_array();        
        return $result;
        */


        $todayDate = date('Y-m-d');
        $this->db->select('count(id) as emailTodayCount');
        $this->db->from('amp_emails');
        $this->db->where('DATE_FORMAT(amp_emails.createdDtm, "%Y-%m-%d") =', $todayDate);
        $this->db->where_in('amp_users.roleId', $_SESSION['roleAccess']);
        $this->db->join('amp_users', 'amp_users.userId = amp_emails.salesRepId', 'left');
        $query = $this->db->get();    
        $result = $query->row_array();        
        return $result;
    }

    /**
     * This function used to get email data weekly
     */
    function getemailDataWeekly()
    {
        $date = strtotime("-7 day");
        $startDate =  date('Y-m-d', $date);
        $todayDate = date('Y-m-d');
        $this->db->select('count(id) as emailWeeklyCount');
        $this->db->from('amp_emails');
        $this->db->where('amp_emails.createdDtm >=', $startDate);
        $this->db->where('amp_emails.createdDtm <=', $todayDate);
        $this->db->where_in('amp_users.roleId', $_SESSION['roleAccess']);
        $this->db->join('amp_users', 'amp_users.userId = amp_emails.salesRepId', 'left');
        $query = $this->db->get();    
        $result = $query->row_array();        
        return $result;
    }


    /**
     * This function used to get monthly
     */
    function getemailMonthlyCount()
    {         
        $sql = "SELECT count(id) as emailMonthlyCount
                FROM amp_emails left join amp_users on amp_users.userId = amp_emails.salesRepId 
                WHERE MONTH(amp_emails.createdDtm) = MONTH(CURRENT_DATE())
                AND YEAR(amp_emails.createdDtm) = YEAR(CURRENT_DATE()) and amp_users.roleId >= ". $_SESSION['role'];
        return $this->db->query($sql)->row_array();
    }

    /**
     * This function used to get yearly
     */
    function getemailYearlyCount()
    {   
        $sql = "SELECT count(id) as emailYearlyCount
                FROM amp_emails left join amp_users on amp_users.userId = amp_emails.salesRepId 
                where YEAR(amp_emails.createdDtm) = YEAR(CURRENT_DATE()) and amp_users.roleId >= ". $_SESSION['role'];
        return $this->db->query($sql)->row_array();
    }


     /**
     * This function used to get file type  data
     */
    function getfiletypeData()
    {   
        // $this->db->select('amp_files.type,count(amp_files.type) as count1');
        // $this->db->from('amp_files');
        // $this->db->group_by('amp_files.type'); 
        // //$this->db->limit(10);
        // $query1 = $this->db->get_compiled_select();


        // $this->db->select('amp_ref_files.type,count(amp_ref_files.type) as count2');
        // $this->db->from('amp_ref_files');
        // $this->db->group_by('amp_ref_files.type'); 
        // $query2 = $this->db->get_compiled_select();

        // $query = $this->db->query($query1 . ' UNION All ' . $query2);
        // echo $this->db->last_query();die;
        // $result = $query->result_array();        
        // return $result;


        $sql = "select type, count(type) as count from (
                    select type from amp_files union all
                    select type from amp_ref_files 
                ) x group by type";
        return $this->db->query($sql)->result();
    }

    /**
     * This function used to get pending task today
     */
    function getpendingTaskToday()
    {
        /*
        $todayDate = date('Y-m-d 00:00:00');
        $datetime = new DateTime('tomorrow');
        $tomorrowDate =  $datetime->format('Y-m-d H:i:s');
        $this->db->select('count(taskId) as pending_task');
        $this->db->from('amp_tasks');
        $this->db->where('createdDtm >=', $todayDate);
        $this->db->where('createdDtm <=', $tomorrowDate);
        $this->db->where('taskStatus', 0);
        $query = $this->db->get();    
        $result = $query->row_array();        
        return $result;
        */

        $todayDate = date('Y-m-d');
        $this->db->select('count(BaseTbl.taskId) as pending_task');
        $this->db->from('amp_tasks as BaseTbl');
        $this->db->join('amp_leads as Lead', 'Lead.leadId = BaseTbl.leadId','left');
        $this->db->join('amp_users', 'amp_users.userId = Lead.salesRepId', 'left');
        $this->db->where('DATE_FORMAT(BaseTbl.createdDtm, "%Y-%m-%d") =', $todayDate);
        $this->db->where('BaseTbl.taskStatus', 0);
        $this->db->where_in('amp_users.roleId', $_SESSION['roleAccess']);

        $user_level_where_condition = manage_user_level_condition('dashboard_pending_tasks');     

        if(!empty($user_level_where_condition)){
            $this->db->where($user_level_where_condition);
        }


        $query = $this->db->get(); 
        //echo $this->db->last_query(); die;     
        $result = $query->row_array();        
        return $result;
    }

    /**
     * This function used to get pending count in week
     */
    function getpendingTaskWeek()
    {
        $date = strtotime("-7 day");
        $startDate =  date('Y-m-d', $date);
        $todayDate = date('Y-m-d');
        $this->db->select('count(BaseTbl.taskId) as weekCount');
        $this->db->from('amp_tasks as BaseTbl');
        $this->db->join('amp_leads as Lead', 'Lead.leadId = BaseTbl.leadId','left');
        $this->db->join('amp_users', 'amp_users.userId = Lead.salesRepId', 'left');
        $this->db->where_in('amp_users.roleId', $_SESSION['roleAccess']);
        //$this->db->where('createdDtm', 4);
        $this->db->where('BaseTbl.createdDtm >=', $startDate);
        $this->db->where('BaseTbl.createdDtm <=', $todayDate);
        $this->db->where('BaseTbl.taskStatus', 0);

        $user_level_where_condition = manage_user_level_condition('dashboard_pending_tasks');     

        if(!empty($user_level_where_condition)){
            $this->db->where($user_level_where_condition);
        }


        $query = $this->db->get();    
        //echo $this->db->last_query() ;die;
        $result = $query->row_array();        
        return $result;
    }

     /**
     * This function used to get monthly pending task
     */
    function getpendingTaskMonth()
    {         
        $sql = "SELECT count(BaseTbl.taskId) as monthCount
                FROM amp_tasks as BaseTbl left join amp_leads as Lead on Lead.leadId = BaseTbl.leadId 
                left join amp_users on amp_users.userId = Lead.salesRepId 
                WHERE MONTH(BaseTbl.createdDtm) = MONTH(CURRENT_DATE()) and amp_users.roleId in ".$_SESSION['roleAccessStr']." 
                AND YEAR(BaseTbl.createdDtm) = YEAR(CURRENT_DATE())
                AND BaseTbl.taskStatus = '0'";

        $user_level_where_condition = manage_user_level_condition('dashboard_pending_tasks');     

        if(!empty($user_level_where_condition)){
            $sql .= ' AND '.$user_level_where_condition;
        }
        return $this->db->query($sql)->row_array();


    }

    /**
     * This function used to get yearly pending task
     */
    function getpendingTaskYear()
    {   
        $sql = "SELECT count(BaseTbl.taskId) as yearCount
                FROM amp_tasks as BaseTbl left join amp_leads as Lead on Lead.leadId = BaseTbl.leadId 
                left join amp_users on amp_users.userId = Lead.salesRepId 
                WHERE YEAR(BaseTbl.createdDtm) = YEAR(CURRENT_DATE()) and amp_users.roleId in ".$_SESSION['roleAccessStr']." 
                AND BaseTbl.taskStatus = '0'";

        $user_level_where_condition = manage_user_level_condition('dashboard_pending_tasks');     

        if(!empty($user_level_where_condition)){
            $sql .= ' AND '.$user_level_where_condition;
        }
        return $this->db->query($sql)->row_array();
    }

     /**
     * This function used to get completed task today
     */
    function getcompletedTaskToday()
    {
        $todayDate = date('Y-m-d 00:00:00');
        $datetime = new DateTime('tomorrow');
        $tomorrowDate =  $datetime->format('Y-m-d H:i:s');
        $this->db->select('count(amp_tasks.taskId) as complete_task');
        $this->db->from('amp_tasks');
        $this->db->join('amp_leads as Lead', 'Lead.leadId = amp_tasks.leadId','left');
        $this->db->join('amp_users', 'amp_users.userId = Lead.salesRepId', 'left');
        $this->db->where_in('amp_users.roleId', $_SESSION['roleAccess']);
        $this->db->where('amp_tasks.createdDtm >=', $todayDate);
        $this->db->where('amp_tasks.createdDtm <=', $tomorrowDate);
        $this->db->where('amp_tasks.taskStatus', 1);
        $query = $this->db->get();    
        //echo $this->db->last_query() ;die;
        $result = $query->row_array();        
        return $result;
    }

    /**
     * This function used to get completed count in week
     */
    function getcompletedTaskWeek()
    {
        $date = strtotime("-7 day");
        $startDate =  date('Y-m-d', $date);
        $todayDate = date('Y-m-d');
        $this->db->select('count(amp_tasks.taskId) as weekCount');
        $this->db->from('amp_tasks');
        $this->db->join('amp_leads as Lead', 'Lead.leadId = amp_tasks.leadId','left');
        $this->db->join('amp_users', 'amp_users.userId = Lead.salesRepId', 'left');
        $this->db->where_in('amp_users.roleId', $_SESSION['roleAccess']);
        //$this->db->where('createdDtm', 4);
        $this->db->where('amp_tasks.createdDtm >=', $startDate);
        $this->db->where('amp_tasks.createdDtm <=', $todayDate);
        $this->db->where('amp_tasks.taskStatus', 1);
        $query = $this->db->get();    
        //echo $this->db->last_query() ;die;
        $result = $query->row_array();        
        return $result;
    }

    /**
     * This function used to get monthly completed task
     */
    function getcompletedTaskMonth()
    {         
        $sql = "SELECT count(amp_tasks.taskId) as monthCount
                FROM amp_tasks left join amp_leads as Lead on Lead.leadId = amp_tasks.leadId 
                left join amp_users on amp_users.userId = Lead.salesRepId 
                WHERE MONTH(amp_tasks.createdDtm) = MONTH(CURRENT_DATE()) and amp_users.roleId in ".$_SESSION['roleAccessStr']." 
                AND YEAR(amp_tasks.createdDtm) = YEAR(CURRENT_DATE())
                AND taskStatus = '1'";
        return $this->db->query($sql)->row_array();


    }

    /**
     * This function used to get yearly completed task
     */
    function getcompletedTaskYear()
    {   
        $sql = "SELECT count(amp_tasks.taskId) as yearCount
                FROM amp_tasks left join amp_leads as Lead on Lead.leadId = amp_tasks.leadId 
                left join amp_users on amp_users.userId = Lead.salesRepId 
                WHERE YEAR(amp_tasks.createdDtm) = YEAR(CURRENT_DATE()) and amp_users.roleId in ".$_SESSION['roleAccessStr']." 
                AND amp_tasks.taskStatus = '1'";
        return $this->db->query($sql)->row_array();
    }

    /**
     * This function is used to update task status
     * @param number $leadId : This is task id
     * @return boolean $result : TRUE / FALSE
     */
    function updateTaskStatus($taskupdateInfo, $task,$leadId)
    {
        $newtask = trim($task, "'");
        $this->db->where('taskRandomId', $newtask);
        $this->db->where('leadId', $leadId);
        $this->db->update('amp_tasks', $taskupdateInfo);
        //echo $this->db->last_query();die;
        return $this->db->affected_rows();
    }

    /**
     * This function is used to add new option to system
     * @return number $insert_id : This is last inserted id
     */
    function addStageHistory($history)
    {
        $this->db->trans_start();
        $this->db->insert('amp_lead_stage_history', $history);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    /**
     * This function is used to delete the image
     * @param number $imageId : This is imageId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteImage($imageId)
    {        
        $this->db->where('fileId', $imageId);
        $this->db->delete('amp_files');        
        return true;
    }

    /**
     * This function used to get Today phone count
     */
    function getphoneDataToday()
    {   
        /*
        $todayDate = date('Y-m-d 00:00:00');
        $datetime = new DateTime('tomorrow');
        $tomorrowDate =  $datetime->format('Y-m-d H:i:s');
        $this->db->select('count(id) as phoneTodayCount');
        $this->db->from('amp_calls');
        $this->db->where('createdDtm >=', $todayDate);
        $this->db->where('createdDtm <=', $tomorrowDate);
        $query = $this->db->get();    
        $result = $query->row_array();        
        return $result;
        */

        $todayDate = date('Y-m-d');
        $this->db->select('count(id) as phoneTodayCount');
        $this->db->from('amp_calls');
        $this->db->where('DATE_FORMAT(amp_calls.createdDtm, "%Y-%m-%d") =', $todayDate);
        $this->db->where_in('amp_users.roleId', $_SESSION['roleAccess']);
        $this->db->join('amp_users', 'amp_users.userId = amp_calls.salesRepId', 'left');
        $query = $this->db->get();    
        $result = $query->row_array();        
        return $result;
    }

    /**
     * This function used to get phone data weekly
     */
    function getphoneDataWeekly()
    {
        $date = strtotime("-7 day");
        $startDate =  date('Y-m-d', $date);
        $todayDate = date('Y-m-d');
        $this->db->select('count(id) as phoneWeeklyCount');
        $this->db->from('amp_calls');
        $this->db->where('amp_calls.createdDtm >=', $startDate);
        $this->db->where('amp_calls.createdDtm <=', $todayDate);
        $this->db->where_in('amp_users.roleId', $_SESSION['roleAccess']);
        $this->db->join('amp_users', 'amp_users.userId = amp_calls.salesRepId', 'left');
        $query = $this->db->get();    
        $result = $query->row_array();        
        return $result;
    }

    /**
     * This function used to get monthly
     */
    function getphoneMonthlyCount()
    {         
        $sql = "SELECT count(id) as phoneMonthlyCount
                FROM amp_calls left join amp_users on amp_users.userId = amp_calls.salesRepId 
                WHERE MONTH(amp_calls.createdDtm) = MONTH(CURRENT_DATE())
                AND YEAR(amp_calls.createdDtm) = YEAR(CURRENT_DATE()) and amp_users.roleId >=". $_SESSION['role'];
        return $this->db->query($sql)->row_array();
    }

    /**
     * This function used to get yearly
     */
    function getphoneyearlyCount()
    {   
        $sql = "SELECT count(id) as phoneYearlyCount 
                FROM amp_calls left join amp_users on amp_users.userId = amp_calls.salesRepId 
                WHERE YEAR(amp_calls.createdDtm) = YEAR(CURRENT_DATE()) and amp_users.roleId >=". $_SESSION['role'];
        return $this->db->query($sql)->row_array();
    }

    /**
     * This function used to get phone data
     */
    function getphoneData()
    {   
        $todayDate = date('Y-m-d 00:00:00');
        $datetime = new DateTime('tomorrow');
        $tomorrowDate =  $datetime->format('Y-m-d H:i:s');
        $this->db->select('BaseTbl.salesRepId,User.name,count(BaseTbl.salesRepId) as phoneCount');
        $this->db->from('amp_calls as BaseTbl');
        $this->db->join('amp_users as User', 'User.userId = BaseTbl.salesRepId','left');
        $this->db->where('BaseTbl.createdDtm >=', $todayDate);
        $this->db->where('BaseTbl.createdDtm <=', $tomorrowDate);
        $this->db->where('User.roleId >=', $_SESSION['role']);
        $this->db->group_by('User.userId'); 
        $this->db->limit(10);
        $query = $this->db->get();    
        $result = $query->result_array();        
        return $result;
    }

    /**
     * This function used to get monthly phone Data
     */
    function getphoneDataMonthly()
    {         
        $sql = "SELECT BaseTbl.salesRepId,User.name,count(BaseTbl.salesRepId) as phonemonthly
                FROM amp_calls as BaseTbl 
                LEFT JOIN amp_users as User on User.userId = BaseTbl.salesRepId
                WHERE MONTH(BaseTbl.createdDtm) = MONTH(CURRENT_DATE())
                AND YEAR(BaseTbl.createdDtm) = YEAR(CURRENT_DATE()) and User.roleId >=". $_SESSION['role']." 
                GROUP By User.userId
                ";
        return $this->db->query($sql)->result_array();
    }


    /**
     * This function used to get completed count in week
     */
    function checkTaskStatus($leadId,$taskRandomId)
    {
        $this->db->select('taskId');
        $this->db->from('amp_tasks');
        $this->db->where('taskRandomId', $taskRandomId);
        $this->db->where('leadId', $leadId);
        $query = $this->db->get();    
        //echo $this->db->last_query() ;die;
        $result = $query->result_array();        
        return $result;
    }


    /**
     * This function is used to update task status
     * @param number $leadId : This is task id
     * @return boolean $result : TRUE / FALSE
     */
    function updateTask($insertData, $task,$leadId)
    {
        $newtask = trim($task, "'");
        $this->db->where('taskRandomId', $newtask);
        $this->db->where('leadId', $leadId);
        $this->db->update('amp_tasks', $insertData);
        //echo $this->db->last_query();die;
        return $this->db->affected_rows();
    }

    /**
     * This function used to check lead history
     */
    function checkleadHistory($leadId,$stage)
    {
        $this->db->select('leadId');
        $this->db->from('amp_leads');
        $this->db->where('leadId', $leadId);
        $this->db->where('stageId', $stage);
        $query = $this->db->get();    
        $result = $query->result_array();        
        return $result;
    }

    /**
     * This function is used to delete the task
     * @param number $imageId : This is taskId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteTask($randomNum,$leadID)
    {        
        $this->db->where('taskRandomId', $randomNum);
        $this->db->where('leadId', $leadID);
        $this->db->delete('amp_tasks');        
        return true;
    }
    

     /**
     * This function used to get monthly phone Data
     */
    function getLeadReffrelCounts($referralSourceId,$stageId){         
        $sql = "SELECT count(leadId) as totalLeads
                FROM amp_leads
                WHERE referralSourceId = ".$referralSourceId." AND stageId = ".$stageId;
        $result = $this->db->query($sql)->result_array();
        return $result[0]['totalLeads'];
    }

    /**
     * This function used to get monthly phone Data
     */
    function getLeadReffrelBrokerFessSum($referralSourceId){         
        $sql = "SELECT sum(brokerFee) as brokerFeeTotal
                FROM amp_leads
                WHERE referralSourceId = ".$referralSourceId;
        $result = $this->db->query($sql)->result_array();
        if($result[0]['brokerFeeTotal']>0){
            return $result[0]['brokerFeeTotal'];
        }else{
            return 0;
        }
    }


    /**
     * This function used to get Email Templates
     * @return array $result : This is user information
     */
    function getEmailTemplates()
    {
        $this->db->select('*');
        $this->db->from('amp_email_templates');
        $query = $this->db->get();        
        $result = $query->result();        
        return $result;
    }

    /**
     * This function used to get check Lead Task Satatus
     */
    function checkLeadTaskSatatus($leadId){         
        $sql = "SELECT taskId
                FROM amp_tasks
                WHERE taskStatus = 0 AND leadId = ".$leadId;
        $result = $this->db->query($sql)->result_array();
	if(!empty($result))
	        return $result[0]['taskId'];
	return false;
    }


     /**
     * This function used to get User Extension
     */
    function getUserExtension($userId){         
        $sql = "SELECT name,extension
                FROM amp_users
                WHERE userId = ".$userId;
        $result = $this->db->query($sql)->result_array();
        return $result[0]['name'].'~'.$result[0]['extension'];
    }


    function getLeadName($leadId){         
        $sql = "SELECT firstName,lastName
                FROM amp_leads
                WHERE leadId = ".$leadId;
        $result = $this->db->query($sql)->result_array();
        return $result[0]['firstName'].' '.$result[0]['lastName'];
    }


    function getReferralSourceName($referralSourceId){         
        $sql = "SELECT firstName,lastName
                FROM amp_referral_source
                WHERE referralSourceId = ".$referralSourceId;
        $result = $this->db->query($sql)->result_array();
        return $result[0]['firstName'].' '.$result[0]['lastName'];
    }

    function getCommunicationDetails($communicationId){
        $this->db->select('*');
        $this->db->from('amp_communications');
        $this->db->where('communicationId', $communicationId);
        $query = $this->db->get();        
        $result = $query->result();        
        return $result;
    }

    function checkCallAPIEnable(){
        $sqlCallKey         = "SELECT * FROM amp_setting WHERE id = 1";
        $resultCallKey      = $this->db->query($sqlCallKey)->result_array();
        return $resultCallKey[0]['phonecall_enable'];
    }

    function getLeadEmail($leadid){         
        $sql    = "SELECT email FROM amp_leads WHERE leadId = ".$leadid;
        $result = $this->db->query($sql)->result_array();
        return $result[0]['email'];
    }

    function getAllLeadIdsofUser($userID){         
        $this->db->select('leadId');
        $this->db->from('amp_leads');
        $this->db->where('userID', $userID);
        $query  = $this->db->get();    
        $result = $query->result_array();     
        $ids = '';   
        if(isset($result) && !empty($result)){
            foreach($result as $leadIds){
                if($ids == ''){
                    $ids.=$leadIds['leadId'];
                }else{
                    $ids.=",".$leadIds['leadId'];
                }
            }
        }
        return $ids;
    }

    /**
     * This function used to get history information by id
     * @param number $leadId : This is lead id
     * @return array $result : This is user information
     */
    function getNotesHistory($leadId)
    {
        $this->db->select('BaseTbl.id,BaseTbl.leadId,BaseTbl.createdDtm,BaseTbl.notes');
        $this->db->from('amp_notes_history as BaseTbl');
        $this->db->where('leadId', $leadId);
        $this->db->order_by('BaseTbl.createdDtm', 'DESC');
        $query = $this->db->get();
        $result = $query->result_array();        
        return $result;
    }

    /**
     * This function used to get history information by id
     * @param number $leadId : This is lead id
     * @return array $result : This is user information
     */
    function getNoteHistory($referralSourceId)
    {
        $this->db->select('BaseTbl.id,BaseTbl.referralId,BaseTbl.createdDtm,BaseTbl.notes');
        $this->db->from('amp_notes_history as BaseTbl');
        $this->db->where('referralId', $referralSourceId);
        $this->db->order_by('BaseTbl.createdDtm', 'DESC');
        $query = $this->db->get();
        $result = $query->result_array();        
        return $result;
    }

    /**
     * This function is used to add notes History
     * @return number $insert_id : This is last inserted id
     */
    function addNotesHistory($noteshistory)
    {
        $this->db->trans_start();
        $this->db->insert('amp_notes_history', $noteshistory);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
}

