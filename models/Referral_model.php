<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Referral_model extends CI_Model
{

    private $_limit;
    private $_pageNumber;
    private $_offset;


    /**
     * This function is used to get the referral listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function refSourceListingCount()
    {
        $this->db->select('BaseTbl.referralSourceId, BaseTbl.companyName, BaseTbl.firstName, BaseTbl.createdDtm, BaseTbl.license,amp_users.name as TerritorymanagerName');
        $this->db->from('amp_referral_source as BaseTbl');        
        $this->db->where('BaseTbl.isDeleted', 0);

        $access_level = $this->session->userdata['role'];
        $logged_in_user_id = $this->session->userdata['userId'];

        //Add logic for Terratory manager.
        if($access_level==5){
            $this->db->where('(BaseTbl.territoryManagerId='.$logged_in_user_id.')');
        }
        
        $this->db->join('amp_users', 'BaseTbl.territoryManagerId = amp_users.userId', 'left');
        $this->db->order_by('BaseTbl.referralSourceId', 'DESC');
        $query = $this->db->get();
        $this->db->limit($this->_pageNumber, $this->_offset);
        return $query->num_rows();
    }


    /**
     * This function is used to get the referral listing 
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function refSourceListing()
    {
        $this->db->select('BaseTbl.referralSourceId, BaseTbl.companyName, BaseTbl.firstName, BaseTbl.createdDtm, BaseTbl.license,amp_users.name as TerritorymanagerName');
        $this->db->from('amp_referral_source as BaseTbl');        
        $this->db->where('BaseTbl.isDeleted', 0);

        $access_level = $this->session->userdata['role'];
        $logged_in_user_id = $this->session->userdata['userId'];

        //Add logic for Terratory manager.
        if($access_level==5){
            $this->db->where('(BaseTbl.territoryManagerId='.$logged_in_user_id.')');
        }

        $this->db->join('amp_users', 'BaseTbl.territoryManagerId = amp_users.userId', 'left');
        $this->db->order_by('BaseTbl.referralSourceId', 'DESC');
        $this->db->limit($this->_pageNumber, $this->_offset);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }


    /**
     * This function is used to get the communication listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function commListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.communicationId, BaseTbl.title,BaseTbl.data');
        $this->db->from('amp_communications as BaseTbl');
        $this->db->join('amp_leads as Lead', 'Lead.leadId = BaseTbl.leadId','left');
        $this->db->join('amp_opt_ins as opt', 'opt.optInId = Lead.optInId', 'left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.title  LIKE '%".$searchText."%'
                            OR  BaseTbl.data  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->order_by('BaseTbl.communicationId', 'DESC');
        $query = $this->db->get();
        return $query->num_rows();        
    }
    
    /**
     * This function is used to get the communication listing 
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function commListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.communicationId, BaseTbl.title,BaseTbl.data');
        $this->db->from('amp_communications as BaseTbl');
        $this->db->join('amp_leads as Lead', 'Lead.leadId = BaseTbl.leadId','left');
        $this->db->join('amp_opt_ins as opt', 'opt.optInId = Lead.optInId', 'left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.title  LIKE '%".$searchText."%'
                            OR  BaseTbl.data  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->order_by('BaseTbl.communicationId', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }


    /**
     * This function is used to add new referral to system
     * @return number $insert_id : This is last inserted id
     */
    function addRefSource($refSourceInfo)
    {
        $this->db->trans_start();
        $this->db->insert('amp_referral_source', $refSourceInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }


    function addrefFile($insertValuesSQL,$result,$fileType){
        $this->db->set('name', $insertValuesSQL);
        $this->db->set('type', $fileType);
        $this->db->insert('amp_ref_files',array('referralSourceId'=>$result,'createdDtm'=> date('Y-m-d H:i:s')));
        //echo $this->db->last_query();die;
        return true;
    }

    /**
     * This function is used to add new referral option to system
     * @return number $insert_id : This is last inserted id
     */
    function addreferraloptionData($optionDataInfo)
    {
        $this->db->trans_start();
        $this->db->insert('amp_ref_opt_ins', $optionDataInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }


    /**
     * This function is used to delete the referral information
     * @param number $leadId : This is Source id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteSource($referralSourceId, $refSourceInfo)
    {
        $this->db->where('referralSourceId', $referralSourceId);
        $this->db->update('amp_referral_source', $refSourceInfo);
        
        return $this->db->affected_rows();
    }


     /**
     * This function used to get referral information by id
     * @param number $referralId : This is referral id
     * @return array $result : This is user information
     */
    function getrefSourceInfo($referralSourceId)
    {
        $this->db->select('*');
        $this->db->from('amp_referral_source');
        $this->db->where('isDeleted', 0);
        $this->db->where('referralSourceId', $referralSourceId);
        $query = $this->db->get();
        
        return $query->row();
    }


     /**
     * This function used to task info by referral id added by ram
     * @param number $referralId : This is referral id
     * @return array $result : This is user information
     */
    function getRefTaskInfo($referralSourceId){
        $this->db->select('*');
        $this->db->from('amp_tasks');
        $this->db->where('referralSourceId', $referralSourceId);
        $this->db->where('taskType', '2');
        $query = $this->db->get();        
        $result = $query->result();        
        return $result;
    }

     /**
     * This function used to task info by referral id added by ram
     * @param number $referralId : This is referral id
     * @return array $result : This is user information
     */
    function getRefExpenseInfo($referralSourceId)
    {
        // $this->db->select('*');
        // $this->db->from('amp_ref_expense');
        // $this->db->where('referralSourceId', $referralSourceId);
        // $this->db->group_by('expenseRandomId'); 
        // $query = $this->db->get();        
        // $result = $query->result();        
        // return $result;

        $this->db->select('expenseRandomId,expenseDate,expenseAmount,expenseDescription,GROUP_CONCAT(referralSourceIdAnother SEPARATOR ",") as referralSourceIdAnother ');
        $this->db->from('amp_ref_expense');
        $this->db->where('referralSourceId', $referralSourceId);
        $this->db->group_by('expenseRandomId'); 
        $query = $this->db->get(); 
        $result = $query->result();        
        return $result;
    }

   /**
     * This function used to task info by referral id added by ram
     * @param number $referralId : This is referral id
     * @return array $result : This is user information
     */
    function getRefExpenseInfo1($referralSourceId)
    {
        $this->db->select('*');
        $this->db->from('amp_referral_source');
        $this->db->where('referralSourceId', $referralSourceId);
        $query = $this->db->get();        
        $result = $query->result();        
        return $result;
    }
	


    /**
     * This function used to get communication information by id
     * @param number $referralId : This is referral id
     * @return array $result : This is user information
     */
    function getCommunication($referralSourceId)
    {
        $this->db->select('*');
        $this->db->from('amp_communications');
        $this->db->where('communicationId', $referralSourceId);
        $this->db->where('communicationsFrom', 1);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    /**
     * This function used to get Files information by id
     * @param number $referralId : This is referral id
     * @return array $result : This is user information
     */
    function getFiles($referralSourceId)
    {
        $this->db->select('fileId,name,type,createdDtm');
        $this->db->from('amp_ref_files');
        $this->db->where('referralSourceId', $referralSourceId);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }


    /**
     * This function used to get option information by id
     * @param number $referralId : This is referral id
     * @return array $result : This is user information
     */
    function getOptionData($referralSourceId)
    {
        $this->db->select('BaseTbl.sms,BaseTbl.calls,BaseTbl.email');
        $this->db->from('amp_ref_opt_ins as BaseTbl');
        $this->db->where('referralSourceId', $referralSourceId);
        $query = $this->db->get();
        $result = $query->result_array();        
        return $result;
    }

    /**
     * This function is used to update the option data information
     * @param array $referralInfo : This is referral updated information
     * @param number $referralId : This is referral id
     */
    function editoptionData($optionDataInfo, $referralSourceId)
    {
        $this->db->where('referralSourceId', $referralSourceId);
        $this->db->update('amp_ref_opt_ins', $optionDataInfo);
        
        return TRUE;
    }

    function deletefile($referralSourceId)
    {
        $this->db->where('referralSourceId', $referralSourceId);
       $this->db->delete('amp_ref_files');
    }

    function editfile($referralSourceId,$insertValuesSQL,$fileType){
        $h= $insertValuesSQL;
        $this->db->set('referralSourceId', $referralSourceId);
        $this->db->set('type', $fileType);
        $this->db->set('createdDtm', date('Y-m-d H:i:s'));
        //$this->db->where('isDeleted', 0);
        $this->db->insert('amp_ref_files',array('name'=>$h));
        // /echo $this->db->last_query();die;
        return TRUE;
    }

     /**
     * This function is used to update the referral information
     * @param array $referralInfo : This is referral updated information
     * @param number $referralId : This is referral id
     */
    function editReferralSource($referralSourceInfo, $referralSourceId)
    {
        $this->db->where('referralSourceId', $referralSourceId);
        $this->db->update('amp_referral_source', $referralSourceInfo);
        
        return TRUE;
    } 
            
    /**
     * This function is used to delete the image
     * @param number $imageId : This is imageId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteImage($imageId)
    {        
        $this->db->where('fileId', $imageId);
        $this->db->delete('amp_ref_files');        
        return true;
    } 

    /**
     * This function is used to delete the task
     * @param number $imageId : This is taskId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteRefTask($randomNum,$referralSourceId)
    {        
        $this->db->where('taskRandomId', $randomNum);
        $this->db->where('referralSourceId', $referralSourceId);
        $this->db->where('taskType', '2');
        $this->db->delete('amp_ref_tasks');        
        return true;
    }

    /**
     * This function is used to delete the task
     * @param number $imageId : This is taskId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteRefExpense($randomNum,$referralSourceId)
    {        
        $this->db->where('expenseRandomId', $randomNum);
        $this->db->where('referralSourceId', $referralSourceId);
        $this->db->delete('amp_ref_expense');        
        return true;
    }
    


    function getTerritoryManagerIdByreferralSourceId($referralSourceId){         
        $sql = "SELECT territoryManagerId
                FROM amp_referral_source
                WHERE isDeleted=0 AND referralSourceId = ".$referralSourceId;
        $result = $this->db->query($sql)->result_array();
        if(isset($result[0]['territoryManagerId']) && !empty($result[0]['territoryManagerId'])){
            return $result[0]['territoryManagerId'];
        }
    }    

     /**
     * This function used to get Referral Source Ofterritory Manager
     * @return array $result : This is user information
     */
    function getReferralSourceOfterritoryMngr($territoryManagerId,$referralSourceId)
    {
        $this->db->select('*');
        $this->db->from('amp_referral_source');
        $this->db->where('isDeleted', 0);
        $this->db->where('referralSourceId !=', $referralSourceId);
        $this->db->where('territoryManagerId', $territoryManagerId);
        $query = $this->db->get();        
        $result = $query->result();        
        return $result;
    }

    function getVisithistory($referralSourceId)
    {
        $this->db->select('amp_visithistory.*, amp_users.name as userName');
        $this->db->from('amp_visithistory');
        $this->db->join('amp_users', 'amp_visithistory.UserID = amp_users.userId', 'left');
        $this->db->where('referralSourceId', $referralSourceId);
        $this->db->order_by('amp_visithistory.startDateTime', 'DESC');
        $query = $this->db->get();        
        $result = $query->result();        
        return $result;
    }
}

  