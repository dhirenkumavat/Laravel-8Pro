<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Project_model extends CI_Model
{

    private $_limit;
    private $_pageNumber;
    private $_offset;
    /**
     * This function is used to get the lead listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function leadListingCount($stageId = null)
    {
        $this->db->select('BaseTbl.projectId');
        $this->db->from('amp_projects as BaseTbl');
        $this->db->join('amp_users as User', 'User.userId = BaseTbl.sales','left');
        //$this->db->join('amp_roles as Stage', 'Stage.roleId = BaseTbl.stageId','left');
        $this->db->join('amp_stages as Stage', 'Stage.stageId = BaseTbl.stageId','left');
        
        $this->db->where('BaseTbl.isDeleted', 0);

        if (!empty($stageId)) {
            $this->db->where('Stage.stageId', $stageId);
        }

        $user_level_where_condition = manage_user_level_condition();     

        if(!empty($user_level_where_condition)){
            $this->db->where($user_level_where_condition);
        }

        $this->db->order_by('BaseTbl.projectId', 'DESC');
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
    function leadListing($stageId = null)
    {
        
        $this->db->select('BaseTbl.projectId,BaseTbl.is_priority,BaseTbl.projectName,BaseTbl.scope,BaseTbl.dueDate,BaseTbl.jobWalkTime,BaseTbl.address,BaseTbl.estimator,BaseTbl.mainContact, BaseTbl.createdDtm, BaseTbl.salesRepId, BaseTbl.stageId, BaseTbl.bid_price,BaseTbl.contract,BaseTbl.company,User.name,Stage.stageName,BaseTbl.phoneNo1,BaseTbl.email,BaseTbl.updatedDtm,BaseTbl.filesystem_id,BaseTbl.notes,jobtype.jobType,jobtype.color');
        $this->db->from('amp_projects as BaseTbl');
        $this->db->join('amp_users as User', 'User.userId = BaseTbl.sales','left');
        $this->db->join('amp_stages as Stage', 'Stage.stageId = BaseTbl.stageId','left');
        $this->db->join('amp_jobtype as jobtype', 'jobtype.id = BaseTbl.jobtypeid','left');
       
        $this->db->where('BaseTbl.isDeleted', 0);

        //testing
        //$this->db->where_in('BaseTbl.projectId', array(939,350));

        if (!empty($stageId)) {
        	$this->db->where('Stage.stageId', $stageId);
        }

        //Call helper function to manage user level access.

        $user_level_where_condition = manage_user_level_condition();     

        if(!empty($user_level_where_condition)){
            $this->db->where($user_level_where_condition);
        }

        $this->db->order_by('BaseTbl.projectId', 'DESC');
        $this->db->limit($this->_pageNumber, $this->_offset);
        $query = $this->db->get();

        //echo $this->db->last_query();die;
        
        $result = $query->result();        
        return $result;
    }


    function getProjByStage($stageId = null){
        $this->db->select('BaseTbl.projectId,BaseTbl.projectName');
        $this->db->from('amp_projects as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);

        if (!empty($stageId)) {
            $this->db->where('BaseTbl.stageId', $stageId);
        }

        //Call helper function to manage user level access.

        $user_level_where_condition = manage_user_level_condition();     

        if(!empty($user_level_where_condition)){
            $this->db->where($user_level_where_condition);
        }
        

        $this->db->order_by('BaseTbl.projectId', 'DESC');
        $query = $this->db->get();

        //echo $this->db->last_query();die;
        
        $result = $query->result();        
        return $result;
    }
            
    /**
     * This function is used to add new lead to system
     * @return number $insert_id : This is last inserted id
     */
     function addNewProject($leadInfo)
    {
        $this->db->trans_start();
        $this->db->insert('amp_projects', $leadInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }


    /**
     * This function is used to add new lead to system
     * @return number $insert_id : This is last inserted id
     */
     function insertBid($bidArray)
    {
        $this->db->trans_start();
        $this->db->insert('amp_bid', $bidArray);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    /**
     * This function is used to add new lead to system
     * @return number $insert_id : This is last inserted id
     */
     function insertDuplicateBid($bidArray)
    {
        $this->db->trans_start();
        for($i=0;$i<=count($bidArray)-1;$i++){
            $this->db->insert('amp_bid', $bidArray[$i]);
            $insert_id = $this->db->insert_id();
        }
        $this->db->trans_complete();
        return $insert_id;
    }


    function updateBids($projectId,$bidArray, $userId,$bidRandomIDVal,$buildingSf){
        
        for($i=0;$i<=count($bidArray)-1;$i++){
            $this->db->where('id', $bidArray[$i]);
            $this->db->where('userId' , $userId);
            $this->db->where('projectId' , '0');
            $this->db->where('bidRandomId ' , $bidRandomIDVal);
            if($buildingSf > 0 || $buildingSf !=""){

                $this->db->set("unitCost", $buildingSf, FALSE); 
            }
            $this->db->set("projectId", $projectId);
            $this->db->update('amp_bid');
            
        }
        return TRUE;
    }

    function getBid($userId,$bidRandomIDVal,$isUpdate)
    {
        if($bidRandomIDVal != ""){
            $this->db->select('*');
            $this->db->where('userId' , $userId);
            if($isUpdate == 0){
                $this->db->where('projectId' , '0');
            }
            $this->db->where('bidRandomId' , $bidRandomIDVal);
            $this->db->from('amp_bid');
            $this->db->order_by("bidPrice", "asc");
            $query = $this->db->get();        
            $result = $query->result();        
            return $result;
        }
        return false;
    }

    function getBidByProjectId($userId,$projectId)
    {
        if($projectId != ""){
            $this->db->select('*');
            $this->db->where('userId' , $userId);
            $this->db->where('projectId' , $projectId);
            //$this->db->where('bidRandomId' , $bidRandomIDVal);
            $this->db->from('amp_bid');
            $this->db->order_by("bidPrice", "asc");
            $query = $this->db->get();        
            $result = $query->result();        
            return $result;
        }
        return false;
    }

    /**
     * This function is used to add options to system
     * @return number $insert_id : This is last inserted id
     */
    function addOptions($optionInData,$result)
    {
        $this->db->trans_start();
        $optionData = array('projectId'=>$result);

        $finaloptionData=array_merge($optionInData,$optionData);
        $this->db->insert('amp_opt_ins', $finaloptionData);
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * This function used to get lead information by id
     * @param number $projectId : This is lead id
     * @return array $result : This is user information
     */
    function getLeadInfo($projectId)
    {
        // $this->db->select('projectId,is_priority,projectName,contract,budget,scope,wages,sales,admin,estimator,estimator_email,clientName,dueDate,dueTime,jobWalkTime,estStartDate,rfiDeadline,bidForm,bid_price,reports,mainContact,firstName, lastName, email, phoneNo1,phoneNo2, notes,salesRepId,stageId,region,address,city,state,zip,tagId,jobtypeid,reftypeId,referralSourceId,DL,dob,businessOwner,ownership,policyExpiration,brokerFee,countryId,IID,filesystem_id,createdDtm,marketType,buildingType,materialNeeds,buildingSf,company,latitude,longitude');
        $this->db->select('*');
        $this->db->from('amp_projects');
        $this->db->where('isDeleted', 0);
        $this->db->where('projectId', $projectId);
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
     * @param number $projectId : This is lead id
     * @return array $result : This is user information
     */
    function getCommunication($projectId)
    {
        $this->db->select('*');
        $this->db->from('amp_communications');
        $this->db->where('projectId', $projectId);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }


    /**
     * This function used to get Files information by id
     * @param number $projectId : This is lead id
     * @return array $result : This is user information
     */
    function getFiles($projectId)
    {
        $this->db->select('fileId,name,type,createdDtm');
        $this->db->from('amp_files');
        $this->db->where('projectId', $projectId);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }


    /**
     * This function used to get history information by id
     * @param number $projectId : This is lead id
     * @return array $result : This is user information
     */
    function getHistory($projectId)
    {
        $this->db->select('BaseTbl.stageId,BaseTbl.createdDtm,stage.stageName');
        $this->db->from('amp_lead_stage_history as BaseTbl');
        $this->db->join('amp_stages as stage', 'stage.stageId = BaseTbl.stageId','left');
        $this->db->where('projectId', $projectId);
        $this->db->order_by('BaseTbl.createdDtm', 'DESC');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }


    /**
     * This function used to get option information by id
     * @param number $projectId : This is lead id
     * @return array $result : This is user information
     */
    function getOption($projectId)
    {
        $this->db->select('BaseTbl.sms,BaseTbl.calls,BaseTbl.email');
        $this->db->from('amp_opt_ins as BaseTbl');
        $this->db->where('projectId', $projectId);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
    
    
    /**
     * This function is used to update the lead information
     * @param array $leadInfo : This is lead updated information
     * @param number $projectId : This is lead id
     */
    function editLead($leadInfo, $projectId)
    {
        $this->db->where('projectId', $projectId);
        $this->db->update('amp_projects', $leadInfo);
        return TRUE;
    }
    
    
    
    /**
     * This function is used to delete the lead information
     * @param number $projectId : This is lead id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteProject($projectId, $projectInfo)
    {
        $this->db->where('projectId', $projectId);
        $this->db->update('amp_projects', $projectInfo);

        /*Delete task of this Lead*/
        //$this->db->where('projectId', $projectId);
        //$this->db->delete('amp_tasks'); 
        
        return $this->db->affected_rows();
    }


    /**
     * This function is used to delete the lead information
     * @param number $projectId : This is lead id
     * @return boolean $result : TRUE / FALSE
     */
    function change_leadstage($projectId, $lead_stageInfo)
    {
        $this->db->where('projectId', $projectId);
        $this->db->update('amp_projects', $lead_stageInfo);
        //echo $this->db->last_query();die;
        return $this->db->affected_rows();
    }


    /**
     * This function used to get Stages information
     * @return array $result : This is user information
     */
    function getStages()
    {
        $this->db->select('stageId,stageName,  stageOrder');
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
     * This function used to get Job Type information
     * @return array $result : This is user information
     */
    function getJobTypes()
    {
        $this->db->select('id,jobType,color');
        $this->db->from('amp_jobtype');
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
    function getprojectId()
    {
        $this->db->select('projectId');
        $this->db->from('amp_projects');
        $this->db->where('isDeleted', 0);
        $user_level_where_condition = manage_user_level_condition();     

        if(!empty($user_level_where_condition)){
            $this->db->where($user_level_where_condition);
        }
        $query = $this->db->get();        
        $result=$query->result_array();
        $arr = array_map (function($value){
            return $value['projectId'];
        } , $result);
         return $arr;
    }


     /**
     * This function used to task info by lead id added by ram
     * @param number $projectId : This is lead id
     * @return array $result : This is user information
     */
    function getTaskInfo($projectId)
    {
        $this->db->select('*');
        $this->db->from('amp_tasks as BaseTbl');
        $this->db->where('BaseTbl.projectId', $projectId);
        $user_level_where_condition = manage_user_level_condition();     

        if(!empty($user_level_where_condition)){
            $this->db->where($user_level_where_condition);
        }
        $query = $this->db->get();        
        $result = $query->result();        
        return $result;
    }

     /**
     * This function used to contact info by lead id added by ram
     * @param number $projectId : This is lead id
     * @return array $result : This is user information
     */
    function getContactInfo($projectId)
    {
        $this->db->select('BaseTbl.*,cl.address,cl.client_name,pc.projectId,pc.is_primary');
        $this->db->from('amp_contact as BaseTbl');
        $this->db->join('amp_clients as cl', 'cl.id = BaseTbl.clientId','left');
        $this->db->join('amp_project_contact as pc', 'pc.contactId = BaseTbl.id','left');
        $this->db->where('pc.projectId', $projectId);
        

        // $user_level_where_condition = manage_user_level_condition();     
        // if(!empty($user_level_where_condition)){
        //     $this->db->where($user_level_where_condition);
        // }


        $query = $this->db->get();    
        //echo $this->db->last_query();die;    
        $result = $query->result();        
        return $result;
    }

     /**
     * This function used to client info by lead id added by ram
     * @param number $projectId : This is lead id
     * @return array $result : This is user information
     */
    function getClientInfo($projectId)
    {
        $this->db->select('BaseTbl.*,pc.clientId,pc.projectId');
        $this->db->from('amp_clients as BaseTbl');
        $this->db->join('amp_project_clients as pc', 'pc.clientId = BaseTbl.id');
        $this->db->where('pc.projectId', $projectId);


        // $user_level_where_condition = manage_user_level_condition();     
        // if(!empty($user_level_where_condition)){
        //     $this->db->where($user_level_where_condition);
        // }

        $query = $this->db->get();        
        $result = $query->result();        
        return $result;
    }

    /**
     * This function used to client Contact by Contact Id
     * @param number $clientid : This is client id
     * @return array $result : This is user information
     */
    function getClientContact($clientid)
    {
        $this->db->select('BaseTbl.id,BaseTbl.contact_name');
        $this->db->from('amp_contact as BaseTbl');
        $this->db->where('BaseTbl.clientId', $clientid);

        $query = $this->db->get();        
        $result = $query->result();        
        return $result;
    }

    /**
     * This function used to client address by client Id
     * @param number $clientid : This is client id
     * @return array $result : This is user information
     */
    function getClientAddress($clientID)
    {
        $this->db->select('address');
        $this->db->from('amp_clients');
        $this->db->where('id', $clientID);

        $query = $this->db->get();        
        $result = $query->result();        
        return $result;
    }


    /**
     * This function used to Contact by Contact Id
     * @param number $contactid : This is contact id
     * @return array $result : This is user information
     */
    function getContactDtl($contactid)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('amp_contact as BaseTbl');
        $this->db->where('BaseTbl.id', $contactid);

        $query = $this->db->get();        
        $result = $query->result();        
        return $result;
    }

    public function removeProjectContact($projectId,$contactRandomId){

        $this->db->select('id');
        $this->db->from('amp_contact');
        $this->db->where('contactRandomId', $contactRandomId);
        $query = $this->db->get(); 
        $ret = $query->row();
        if($ret){
            $contactId = $ret->id;
        }else{
            $contactId = 0;
        }
        
        if($contactId > 0){
            $this->db->where('projectId', $projectId);
            $this->db->where('contactId', $contactId);
            $result = $this->db->delete('amp_project_contact');

            return $result;
        }else{
            return true;
        }
        
    }

    public function removeProjectClient($projectId,$clientID){
        $this->db->where('projectId', $projectId);
        $this->db->where('clientId', $clientID);
        $result = $this->db->delete('amp_project_clients');
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

    function addfile($insertValuesSQL,$result,$fileType,$fileSize){
        $this->db->set('name', $insertValuesSQL);
        $this->db->set('type', $fileType);
        $this->db->set('size', $fileSize);
        $this->db->insert('amp_files',array('projectId'=>$result,'createdDtm'=> date('Y-m-d H:i:s')));
        //echo $this->db->last_query();die;
        return true;
    }

    function deletefile($projectId){
        $this->db->where('projectId', $projectId);
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
     * @param number $projectId : This is lead id
     * @return array $result : This is user information
     */
    function getOptionData($projectId)
    {
        $this->db->select('BaseTbl.sms,BaseTbl.calls,BaseTbl.email,BaseTbl.other');
        $this->db->from('amp_opt_ins as BaseTbl');
        $this->db->where('projectId', $projectId);
        $query = $this->db->get();
        $result = $query->result_array();        
        return $result;
    }

    /**
     * This function is used to update the option data information
     * @param array $leadInfo : This is lead updated information
     * @param number $projectId : This is lead id
     */
    function editoptionData($optionDataInfo, $projectId)
    {
        $this->db->where('projectId', $projectId);
        $this->db->update('amp_opt_ins', $optionDataInfo);
        if($this->db->affected_rows()==0){
            $optionDataInfo['projectId'] = $projectId;
            $this->db->insert('amp_opt_ins',$optionDataInfo);
        }        
        return TRUE;
    }

    function editfile($projectId,$insertValuesSQL,$fileType,$fileSize=null){
        $h= $insertValuesSQL;        
        $this->db->set('projectId', $projectId);
        $this->db->set('type', $fileType);
        if($fileSize != null){
            $this->db->set('size', $fileSize);
        }
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
    function leadstageListing($lead_id,$projectName,$phone_no,$email,$sales_rep,$stageId,$filesystem_id)
    {
        $this->db->select('BaseTbl.projectId,BaseTbl.phoneNo1,BaseTbl.phoneNo2,BaseTbl.email, BaseTbl.projectName, BaseTbl.createdDtm, BaseTbl.salesRepId, BaseTbl.stageId,User.name,Stage.stageName,ac.contact_phone,apc.is_primary');
        $this->db->from('amp_projects as BaseTbl');
        $this->db->join('amp_users as User', 'User.userId = BaseTbl.sales','left');
        $this->db->join('amp_stages as Stage', 'Stage.stageId = BaseTbl.stageId','left');

        $this->db->join('(select * from `amp_project_contact` ORDER BY `is_primary` DESC ) as apc', 'apc.projectId = BaseTbl.projectId','left');
        $this->db->join('amp_contact as ac', 'ac.id = apc.contactId','left');

        $user_level_where_condition = manage_user_level_condition();     
        if(!empty($user_level_where_condition)){
            $this->db->where($user_level_where_condition);
        }

        if(!empty($lead_id)) {
            $likeCriteria = "(BaseTbl.projectId  LIKE '%".$lead_id."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($projectName)) {
            $likeCriteria = "(BaseTbl.projectName  LIKE '%".$projectName."%')";
            $this->db->where($likeCriteria);
        }
        
        if(!empty($phone_no)) {
            //$likeCriteria = "(BaseTbl.phoneNo1  LIKE '%".$phone_no."%')";
            $likeCriteria = "(ac.contact_phone  LIKE '%".$phone_no."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($email)) {
            //$likeCriteria = "(BaseTbl.email  LIKE '%".$email."%')";
            $likeCriteria = "(ac.contact_email  LIKE '%".$email."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($sales_rep)) {
            $likeCriteria = "(BaseTbl.sales  LIKE '%".$sales_rep."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($stageId)) {
            $likeCriteria = "(BaseTbl.stageId  LIKE '%".$stageId."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filesystem_id)) {
            $likeCriteria = "(BaseTbl.filesystem_id  LIKE '%".$filesystem_id."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.stageId !=', "");
        $this->db->group_by('BaseTbl.projectId'); 
        $this->db->order_by('BaseTbl.projectId', 'DESC');
        
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
    function leadstageListingArray($lead_id,$projectName,$phone_no,$email,$sales_rep,$stageId,$filesystem_id)
    {
        $this->db->select('BaseTbl.projectId,BaseTbl.phoneNo1,BaseTbl.phoneNo2,BaseTbl.email, BaseTbl.projectName, BaseTbl.createdDtm, BaseTbl.salesRepId, BaseTbl.stageId,User.name,Stage.stageName');
        $this->db->from('amp_projects as BaseTbl');
        $this->db->join('amp_users as User', 'User.userId = BaseTbl.sales','left');
        $this->db->join('amp_stages as Stage', 'Stage.stageId = BaseTbl.stageId','left');
        if(!empty($lead_id)) {
            $likeCriteria = "(BaseTbl.projectId  LIKE '%".$lead_id."%')";
            $this->db->where($likeCriteria);
        }
        // if(!empty($first_name)) {
        //     $likeCriteria = "(BaseTbl.firstName  LIKE '%".$first_name."%')";
        //     $this->db->where($likeCriteria);
        // }
        if(!empty($projectName)) {
            $likeCriteria = "(BaseTbl.projectName  LIKE '%".$projectName."%')";
            $this->db->where($likeCriteria);
        }
        // if(!empty($last_name)) {
        //     $likeCriteria = "(BaseTbl.lastName  LIKE '%".$last_name."%')";
        //     $this->db->where($likeCriteria);
        // }
        if(!empty($phone_no)) {
            $likeCriteria = "(BaseTbl.phoneNo1  LIKE '%".$phone_no."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($email)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$email."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($sales_rep)) {
            $likeCriteria = "(BaseTbl.sales  LIKE '%".$sales_rep."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($stageId)) {
            $likeCriteria = "(BaseTbl.stageId  LIKE '%".$stageId."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filesystem_id)) {
            $likeCriteria = "(BaseTbl.filesystem_id  LIKE '%".$filesystem_id."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.projectId', 'DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $result = $query->result_array();        
        return $result;
    }


    /**
     * This function used to  first stage lead count
     * @param number $projectId : This is lead id
     * @return array $result : This is user information
     */
    function getfirstStage()
    {
        $this->db->select('count(projectId) as stage_first');
        $this->db->from('amp_projects');
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
        $this->db->select('count(projectId) as stage_second');
        $this->db->from('amp_projects');
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
        $this->db->select('count(projectId) as stage_third');
        $this->db->from('amp_projects');
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
        $this->db->select('count(projectId) as stage_fourth');
        $this->db->from('amp_projects');
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
        $this->db->select('stageId,count(projectId) as stage_count');
        $this->db->from('amp_projects as BaseTbl');
        $this->db->where('stageId', $stageId);
        $this->db->where('BaseTbl.isDeleted', 0);

        $user_level_where_condition = manage_user_level_condition('dashboard_stage_count');     

        if(!empty($user_level_where_condition)){
            $this->db->where($user_level_where_condition);
        }

        $this->db->where_in('amp_users.roleId', $_SESSION['roleAccess']);
        $this->db->join('amp_users', 'amp_users.userId = BaseTbl.sales', 'left');
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
        $this->db->select('count(projectId) as new_lead');
        $this->db->from('amp_projects');
        $this->db->where('createdDtm >=', $todayDate);
        $this->db->where('createdDtm <=', $tomorrowDate);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();    
        $result = $query->row_array();        
        return $result;
        */
        $todayDate  = date('Y-m-d');
        $this->db->select('count(projectId) as new_lead');
        $this->db->from('amp_projects');
        $this->db->where('DATE_FORMAT(amp_projects.createdDtm, "%Y-%m-%d") =', $todayDate);
        $this->db->where('amp_projects.isDeleted', 0);
        $this->db->where_in('amp_users.roleId', $_SESSION['roleAccess']);
        $this->db->join('amp_users', 'amp_users.userId = amp_projects.sales', 'left');
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
        $this->db->select('count(projectId) as weekCount');
        $this->db->from('amp_projects');
        //$this->db->where('createdDtm', 4);
        $this->db->where('amp_projects.createdDtm >=', $startDate);
        $this->db->where('amp_projects.createdDtm <=', $todayDate);
        $this->db->where('amp_projects.isDeleted', 0);
        $this->db->where_in('amp_users.roleId', $_SESSION['roleAccess']);
        $this->db->join('amp_users', 'amp_users.userId = amp_projects.sales', 'left');
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
        $this->db->join('amp_projects as Lead', 'Lead.projectId = amp_files.projectId','left');
        $this->db->join('amp_users', 'amp_users.userId = Lead.sales', 'left');
        $this->db->where_in('amp_users.roleId', $_SESSION['roleAccess']);
        $this->db->where('amp_files.createdDtm >=', $startDate);
        $this->db->where('amp_files.createdDtm <=', $todayDate);
        $query = $this->db->get();    
        $result1 = $query->row_array();    


        /*$this->db->select('count(amp_ref_files.fileId) as weekfileCount2');
        $this->db->from('amp_ref_files');
        $this->db->join('amp_projects as Lead', 'Lead.projectId = amp_ref_files.referralSourceId','left');
        $this->db->join('amp_users', 'amp_users.userId = Lead.salesRepId', 'left');
        $this->db->where_in('amp_users.roleId', $_SESSION['roleAccess']);
        $this->db->where('amp_ref_files.createdDtm >=', $startDate);
        $this->db->where('amp_ref_files.createdDtm <=', $todayDate);
        $query = $this->db->get();    
        $result2 = $query->row_array();    

        $query = $result1['weekfileCount1']+$result2['weekfileCount2'];*/
        $query = $result1['weekfileCount1'];
        return $query;
    }


    /**
     * This function used to get monthly
     */
    function getmonthCount()
    {   
        $sql = "SELECT count(projectId) as monthCount
                FROM amp_projects left join amp_users on amp_users.userId = amp_projects.sales 
                WHERE MONTH(amp_projects.createdDtm) = MONTH(CURRENT_DATE())
                AND YEAR(amp_projects.createdDtm) = YEAR(CURRENT_DATE()) and amp_users.roleId in ".$_SESSION['roleAccessStr'];
        return $this->db->query($sql)->row_array();
    }


    /**
     * This function used to get monthly
     */
    function getfilemonthCount()
    {         
        /*$sql = "SELECT count(amp_ref_files.fileId) as filemonthCount1
                FROM amp_ref_files left join amp_projects on amp_projects.projectId = amp_ref_files.referralSourceId 
                left join amp_users on amp_users.userId = amp_projects.salesRepId 
                WHERE MONTH(amp_ref_files.createdDtm) = MONTH(CURRENT_DATE()) 
                AND YEAR(amp_ref_files.createdDtm) = YEAR(CURRENT_DATE()) and amp_users.roleId in ".$_SESSION['roleAccessStr'];
                
        $result1 =  $this->db->query($sql)->row_array();*/


         $sql2 = "SELECT count(amp_files.fileId) as filemonthCount2
                FROM amp_files left join amp_projects on amp_projects.projectId = amp_files.projectId 
                left join amp_users on amp_users.userId = amp_projects.sales 
                WHERE MONTH(amp_files.createdDtm) = MONTH(CURRENT_DATE()) 
                AND YEAR(amp_files.createdDtm) = YEAR(CURRENT_DATE()) and amp_users.roleId in ".$_SESSION['roleAccessStr'];
        $result2 =  $this->db->query($sql2)->row_array();
        //$result = $result1['filemonthCount1']+$result2['filemonthCount2'];
        $result = $result2['filemonthCount2'];
        return $result;

    }


    /**
     * This function used to get yearly
     */
    function getyearCount()
    {   
        $sql = "SELECT count(projectId) as yearCount
                FROM amp_projects left join amp_users on amp_users.userId = amp_projects.sales                 
                where YEAR(amp_projects.createdDtm) = YEAR(CURRENT_DATE()) and amp_users.roleId in ".$_SESSION['roleAccessStr'];
        return $this->db->query($sql)->row_array();
    }


    /**
     * This function used to get yearly
     */
    function getfileyearCount()
    {   
        /*$sql = "SELECT count(amp_ref_files.fileId) as yearCount1
                FROM amp_ref_files  left join amp_projects on amp_projects.projectId = amp_ref_files.referralSourceId 
                left join amp_users on amp_users.userId = amp_projects.salesRepId 
                WHERE YEAR(amp_ref_files.createdDtm) = YEAR(CURRENT_DATE()) and amp_users.roleId in ".$_SESSION['roleAccessStr'];
        $result1 = $this->db->query($sql)->row_array();*/


        $sql1 = "SELECT count(amp_files.fileId) as yearCount2
                FROM amp_files left join amp_projects on amp_projects.projectId = amp_files.projectId 
                left join amp_users on amp_users.userId = amp_projects.sales 
                WHERE YEAR(amp_files.createdDtm) = YEAR(CURRENT_DATE()) and amp_users.roleId in ".$_SESSION['roleAccessStr'];
        $result2 = $this->db->query($sql1)->row_array();
        //$result = $result1['yearCount1']+$result2['yearCount2'];
        $result = $result2['yearCount2'];
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
        $this->db->join('amp_projects as Lead', 'Lead.projectId = amp_files.projectId','left');
        $this->db->join('amp_users', 'amp_users.userId = Lead.sales', 'left');
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
        $this->db->join('amp_projects as Lead', 'Lead.projectId = amp_ref_files.referralSourceId','left');
        $this->db->join('amp_users', 'amp_users.userId = Lead.sales', 'left');
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
        $this->db->select('File.fileId,File.projectId,File.name,File.type,File.createdDtm');
        $this->db->from('amp_files as File');
        $this->db->join('amp_projects as Lead', 'Lead.projectId = File.projectId','left');
        $this->db->join('amp_users', 'amp_users.userId = Lead.sales', 'left');
        $this->db->where_in('amp_users.roleId', $_SESSION['roleAccess']);
        $this->db->limit(10);
        $query = $this->db->get();    
        $result1 = $query->result_array();        
        

        /*$this->db->select('Rfile.fileId,Rfile.referralSourceId,Rfile.name,Rfile.type,Rfile.createdDtm');
        $this->db->from('amp_ref_files as Rfile');
        $this->db->join('amp_projects as Lead', 'Lead.projectId = Rfile.referralSourceId','left');
        $this->db->join('amp_users', 'amp_users.userId = Lead.salesRepId', 'left');
        $this->db->where_in('amp_users.roleId', $_SESSION['roleAccess']);
        $this->db->limit(10);
        $query = $this->db->get();    
        $result2 = $query->result_array();*/  

        //$res = array_merge($result1, $result2); 
        //return $res;
        return $result1;

    }

    /**
     * This function used to get Files information by id
     * @param number $projectId : This is lead id
     * @return array $result : This is user information
     */
    function getfilesData($id)
    {
        $this->db->select('File.fileId,File.projectId,File.name,File.type,File.createdDtm');
        $this->db->from('amp_files as File');
        $this->db->join('amp_projects as Lead', 'Lead.projectId = File.projectId','left');
        $this->db->join('amp_users', 'amp_users.userId = Lead.sales', 'left');
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
        $this->db->join('amp_projects as Lead', 'Lead.tagId = amp_tags.id','left');
        $this->db->join('amp_users', 'amp_users.userId = Lead.sales', 'left');
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


        /*$sql = "select type, count(type) as count from (
                    select type from amp_files union all
                    select type from amp_ref_files 
                ) x group by type";*/
        $sql = "select type, count(type) as count from (
                    select type from amp_files 
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
        $this->db->join('amp_projects as Lead', 'Lead.projectId = BaseTbl.projectId','left');
        $this->db->join('amp_users', 'amp_users.userId = Lead.sales', 'left');
        $this->db->where('DATE_FORMAT(BaseTbl.createdDtm, "%Y-%m-%d") =', $todayDate);
        $this->db->where('BaseTbl.taskStatus', 0);
        $this->db->where_in('amp_users.roleId', $_SESSION['roleAccess']);

        $user_level_where_condition = manage_user_level_condition('dashboard_pending_tasks');     

        if(!empty($user_level_where_condition)){
            $this->db->where($user_level_where_condition);
        }

        $query = $this->db->get(); 
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
        $this->db->join('amp_projects as Lead', 'Lead.projectId = BaseTbl.projectId','left');
        $this->db->join('amp_users', 'amp_users.userId = Lead.sales', 'left');
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
        $result = $query->row_array();        
        return $result;
    }

     /**
     * This function used to get monthly pending task
     */
    function getpendingTaskMonth()
    {         
        $sql = "SELECT count(BaseTbl.taskId) as monthCount
                FROM amp_tasks as BaseTbl left join amp_projects as Lead on Lead.projectId = BaseTbl.projectId 
                left join amp_users on amp_users.userId = Lead.sales 
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
                FROM amp_tasks as BaseTbl left join amp_projects as Lead on Lead.projectId = BaseTbl.projectId 
                left join amp_users on amp_users.userId = Lead.sales
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
        $this->db->join('amp_projects as Lead', 'Lead.projectId = amp_tasks.projectId','left');
        $this->db->join('amp_users', 'amp_users.userId = Lead.sales', 'left');
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
        $this->db->join('amp_projects as Lead', 'Lead.projectId = amp_tasks.projectId','left');
        $this->db->join('amp_users', 'amp_users.userId = Lead.sales', 'left');
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
                FROM amp_tasks left join amp_projects as Lead on Lead.projectId = amp_tasks.projectId 
                left join amp_users on amp_users.userId = Lead.sales 
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
                FROM amp_tasks left join amp_projects as Lead on Lead.projectId = amp_tasks.projectId 
                left join amp_users on amp_users.userId = Lead.sales
                WHERE YEAR(amp_tasks.createdDtm) = YEAR(CURRENT_DATE()) and amp_users.roleId in ".$_SESSION['roleAccessStr']." 
                AND amp_tasks.taskStatus = '1'";
        return $this->db->query($sql)->row_array();
    }

    /**
     * This function is used to update task status
     * @param number $projectId : This is task id
     * @return boolean $result : TRUE / FALSE
     */
    function updateTaskStatus($taskupdateInfo, $task,$projectId)
    {
        $newtask = trim($task, "'");
        $this->db->where('taskRandomId', $newtask);
        $this->db->where('projectId', $projectId);
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
     * This function used to check client and contact relation
     */
    function checkClientContact($clientId,$contactRandomId)
    {
        $this->db->select('id');
        $this->db->from('amp_contact');
        $this->db->where('contactRandomId', $contactRandomId);
        $this->db->where('clientId', $clientId);
        $query = $this->db->get();    
        $result = $query->result_array();        
        return $result;
    }

    /**
     * This function used to get completed count in week
     */
    function checkProjectContact($projectId,$contactId)
    {
        $this->db->select('id');
        $this->db->from('amp_project_contact');
        $this->db->where('contactId', $contactId);
        $this->db->where('projectId', $projectId);
        $query = $this->db->get();    
        $result = $query->result_array();        
        return $result;
    }

    /**
     * This function used to get completed count in week
     */
    function checkClientStatus($projectId,$clientId)
    {
        $this->db->select('id');
        $this->db->from('amp_project_clients');
        $this->db->where('clientId', $clientId);
        $this->db->where('projectId', $projectId);
        $query = $this->db->get();    
        $result = $query->result_array();        
        return $result;
    }

    /**
     * This function check client name is exist
     */
    function checkClientExist($clientName,$client_id)
    {
        $this->db->select('id');
        $this->db->from('amp_clients');
        if($client_id){
            $this->db->where_not_in('id', $client_id);
            $this->db->where('client_name', $clientName);
        }else{
            $this->db->where('client_name', $clientName);
        }
        echo $this->db->last_query();
        $query = $this->db->get();    
        $result = $query->result_array();        
        return $result;
    }

    /**
     * This function used to get completed count in week
     */
    function checkTaskStatus($projectId,$taskRandomId)
    {
        $this->db->select('taskId');
        $this->db->from('amp_tasks');
        $this->db->where('taskRandomId', $taskRandomId);
        $this->db->where('projectId', $projectId);
        $query = $this->db->get();    
        //echo $this->db->last_query() ;die;
        $result = $query->result_array();        
        return $result;
    }

    /**
     * This function used to save client
     */
    function insertClient($insertClientData){
        $this->db->insert('amp_clients',$insertClientData);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }


    /**
     * This function is used to update task status
     * @param number $projectId : This is task id
     * @return boolean $result : TRUE / FALSE
     */
    function updateTask($insertData, $task,$projectId)
    {
        $newtask = trim($task, "'");
        $this->db->where('taskRandomId', $newtask);
        $this->db->where('projectId', $projectId);
        $this->db->update('amp_tasks', $insertData);
        //echo $this->db->last_query();die;
        return $this->db->affected_rows();
    }

    /**
     * This function is used to update contact status
     * @param number $projectId : This is project id
     * @return boolean $result : TRUE / FALSE
     */
    function updateContact($updateContactData,$contactRandomId,$clientId)
    {
        $this->db->where('contactRandomId', $contactRandomId);
        $this->db->where('clientId', $clientId);
        $this->db->update('amp_contact', $updateContactData);
        $updated_status = $this->db->affected_rows();
        if($updated_status){
            $this->db->select('id');
            $this->db->from('amp_contact');
            $this->db->where('contactRandomId', $contactRandomId);
            $this->db->where('clientId', $clientId);
            $query = $this->db->get(); 
            $ret = $query->row();
            $contactId = $ret->id;
        }else{
            $contactId = 0; 
        }
        return $contactId;
    }

    /**
     * This function is used to update project contact is preimary status
     * @param number $projectId : This is project id
     * @return boolean $result : TRUE / FALSE
     */
    function updateProjectContact($updateProjectContact,$projectId,$contactid)
    {
        $this->db->where('projectId', $projectId);
        $this->db->where('contactId', $contactid);
        $this->db->update('amp_project_contact', $updateProjectContact);
        $updated_status = $this->db->affected_rows();
    
        return $updated_status;
    }

    /**
     * This function is used to update client status
     * @param number $projectId : This is project id
     * @return boolean $result : TRUE / FALSE
     */
    function updateClient($updateClientData,$clientRandomId,$projectId)
    {
        $this->db->where('clientRandomId', $clientRandomId);
        $this->db->where('projectId', $projectId);
        $this->db->update('amp_project_clients', $updateClientData);
        return $this->db->affected_rows();
    }

    /**
     * This function used to check lead history
     */
    function checkleadHistory($projectId,$stage)
    {
        $this->db->select('projectId');
        $this->db->from('amp_projects');
        $this->db->where('projectId', $projectId);
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
    function deleteTask($randomNum,$projectId)
    {        
        $this->db->where('taskRandomId', $randomNum);
        $this->db->where('projectId', $projectId);
        $this->db->delete('amp_tasks');        
        return true;
    }

    /**
     * This function is used to delete the contact
     * @param number $imageId : This is taskId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteContact($randomNum,$projectId,$contactId)
    {        
        $this->db->where('contactRandomId', $randomNum);
        $this->db->where('projectId', $projectId);
        $this->db->where('id', $contactId);
        $this->db->delete('amp_project_contact');        
        return true;
    }

    /**
     * This function is used to delete the Client
     * @param number $imageId : This is taskId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteClient($randomNum,$projectId,$clientId)
    {        
        $this->db->where('clientRandomId', $randomNum);
        $this->db->where('projectId', $projectId);
        $this->db->where('id', $clientId);
        $this->db->delete('amp_project_clients');        
        return true;
    }
    

     /**
     * This function used to get monthly phone Data
     */
    function getLeadReffrelCounts($referralSourceId,$stageId){         
        $sql = "SELECT count(projectId) as totalLeads
                FROM amp_projects
                WHERE referralSourceId = ".$referralSourceId." AND stageId = ".$stageId;
        $result = $this->db->query($sql)->result_array();
        return $result[0]['totalLeads'];
    }

    /**
     * This function used to get monthly phone Data
     */
    function getLeadReffrelBrokerFessSum($referralSourceId){         
        $sql = "SELECT sum(brokerFee) as brokerFeeTotal
                FROM amp_projects
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
    function checkLeadTaskSatatus($projectId){         
        $sql = "SELECT taskId
                FROM amp_tasks
                WHERE taskStatus = 0 AND projectId = ".$projectId;
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


    function getLeadName($projectId){         
        $sql = "SELECT firstName,lastName
                FROM amp_projects
                WHERE projectId = ".$projectId;
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

    function getLeadEmail($projectId){         
        $sql    = "SELECT email FROM amp_projects WHERE projectId = ".$projectId;
        $result = $this->db->query($sql)->result_array();
        return $result[0]['email'];
    }

    function getAllprojectIdsofUser($userID){         
        $this->db->select('projectId');
        $this->db->from('amp_projects');
        $this->db->where('userID', $userID);
        $query  = $this->db->get();    
        $result = $query->result_array();     
        $ids = '';   
        if(isset($result) && !empty($result)){
            foreach($result as $projectIds){
                if($ids == ''){
                    $ids.=$projectIds['projectId'];
                }else{
                    $ids.=",".$projectIds['projectId'];
                }
            }
        }
        return $ids;
    }

    /**
     * This function used to get history information by id
     * @param number $projectId : This is lead id
     * @return array $result : This is user information
     */
    function getNotesHistory($projectId)
    {
        $this->db->select('BaseTbl.id,BaseTbl.projectId,BaseTbl.createdDtm,BaseTbl.notes');
        $this->db->from('amp_notes_history as BaseTbl');
        $this->db->where('projectId', $projectId);
        $this->db->order_by('BaseTbl.createdDtm', 'DESC');
        $query = $this->db->get();
        $result = $query->result_array();        
        return $result;
    }

    /**
     * This function used to get history information by id
     * @param number $projectId : This is lead id
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

    /**
     * This function used for user count
     */
    function getUserCount()
    {
        $this->db->select('count(userId) as user_count');
        $this->db->from('amp_users as BaseTbl');
        $this->db->where('BaseTbl.roleID !=', 1);
        $this->db->where('BaseTbl.isDeleted', 0);

        $user_level_where_condition = manage_user_level_condition('dashboard_stage_count');     

        if(!empty($user_level_where_condition)){
            $this->db->where($user_level_where_condition);
        }

        $query = $this->db->get();  
        //echo $this->db->last_query(); die;    
        $result = $query->row_array();        
        return $result;
    }
    /**
     * This function used for project count
     */
    function getProjectCount()
    {
        $this->db->select('count(projectId) as project_count');
        $this->db->from('amp_projects as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);

        $user_level_where_condition = manage_user_level_condition('dashboard_stage_count');     

        if(!empty($user_level_where_condition)){
            $this->db->where($user_level_where_condition);
        }

        $query = $this->db->get();  
        //echo $this->db->last_query(); die;    
        $result = $query->row_array();        
        return $result;
    }

    /**
     * This function used for project count of current month.
     */
    function getProjectCountMonth()
    {
        $this->db->select('count(projectId) as project_count');
        $this->db->from('amp_projects as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);

        $user_level_where_condition = manage_user_level_condition('dashboard_stage_count');     

        if(!empty($user_level_where_condition)){
            $this->db->where($user_level_where_condition);
        }

        $query = $this->db->get();  
        //echo $this->db->last_query(); die;    
        $result = $query->row_array();        
        return $result;
    }

    /**
     * This function used for project count of current Year.
     */
    function getProjectCountYear()
    {
        $this->db->select('count(projectId) as project_count');
        $this->db->from('amp_projects as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);

        $user_level_where_condition = manage_user_level_condition('dashboard_stage_count');     

        if(!empty($user_level_where_condition)){
            $this->db->where($user_level_where_condition);
        }

        $query = $this->db->get();  
        //echo $this->db->last_query(); die;    
        $result = $query->row_array();        
        return $result;
    }

    /**
     * This function used for return files size sum
     */
    function getfileSize()
    {
        $this->db->select_sum('size');
        $this->db->from('amp_files');
        $this->db->join('amp_projects', 'amp_projects.projectId = amp_files.projectId');
        $this->db->where('amp_projects.isDeleted', 0);
        
        //$user_level_where_condition = manage_user_level_condition('dashboard_stage_count');     

        //if(!empty($user_level_where_condition)){
            //$this->db->where($user_level_where_condition);
        //}

        $query = $this->db->get();  
        $result = $query->row_array();
        if($result['size']/1024<1024){$size = round($result['size']/1024)." KB";}
        elseif($result['size']/(1024*1024)<1024){$size = round($result['size']/(1024*1024))." MB";}
        else{$size = round($result['size']/(1024*1024*1024))." GB";}
        return $size;
    }

    function getAllLeadIdsofUser($userID){         
        $this->db->select('projectId');
        $this->db->from('amp_projects');
        $this->db->where('userID', $userID);
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


    function check_unique_project_name($id = '', $prj_name) {
        $this->db->where('projectName', $prj_name);
        $this->db->where('isDeleted', 0);

        if($id) {
            $this->db->where_not_in('projectId', $id);
        }
        //$this->db->get('amp_projects')->num_rows();
        //echo $this->db->last_query();die;
        return $this->db->get('amp_projects')->num_rows();
    }

    function check_unique_file_id($id = '', $filesystem_id) {
        $this->db->where('filesystem_id', $filesystem_id);
        $this->db->where('isDeleted', 0);
        if($id) {
            $this->db->where_not_in('projectId', $id);
        }
        return $this->db->get('amp_projects')->num_rows();
    }

    function getClientsInfo()
    {
        
        $this->db->select('BaseTbl.*');
        $this->db->from('amp_clients as BaseTbl');       

        //Call helper function to manage user level access.
        $user_level_where_condition = manage_user_level_condition();     

        if(!empty($user_level_where_condition)){
            $this->db->where($user_level_where_condition);
        }

        $this->db->order_by('BaseTbl.id', 'DESC');
        
        $query = $this->db->get();

        //echo $this->db->last_query();die;
        
        $result = $query->result();        
        return $result;
    }


    public function next_project($projectId){
        $sql="select projectId from amp_projects where projectId = (select projectId from amp_projects where projectId > $projectId and isDeleted = 0 ORDER BY projectId ASC LIMIT 1) ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function previous_project($projectId){ 
        $sql="select projectId from amp_projects where projectId = (select projectId from amp_projects where projectId < $projectId and isDeleted = 0 ORDER BY projectId DESC LIMIT 1)";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function saveState($userId,$state,$name){ 
        $sql="select id from amp_datatables_states where userId=".$userId." AND name='".$name."'";
        $query = $this->db->query($sql);
        $res = $query->row_array();
        if(!empty($res)){
            $this->db->where('name', "$name");
            $this->db->where('userId' , $userId);
            $this->db->set("state", json_encode($state)); 
            $this->db->update('amp_datatables_states');
        }else{
            $this->db->trans_start();
            $this->db->insert('amp_datatables_states', array('userId'=>$userId,'name' => "$name", 'state' => json_encode($state)));
            
            $insert_id = $this->db->insert_id();
            
            $this->db->trans_complete();
        }
        
        // $sql = 'INSERT INTO amp_datatables_states (userId, name, state)
        //     VALUES (?, ?, ?)
        //     ON DUPLICATE KEY UPDATE
        //         state=VALUES(state)';

        //     $query = $this->db->query($sql, array( $userId, 
        //                                $name, 
        //                                json_encode($state), 
        //                               ));
        //     echo $this->db->last_query();die;
    }


    public function getState($userId,$name){
        $this->db->select('*');
        $this->db->where(array('userId'=>$userId,'name'=>$name));
        $this->db->from('amp_datatables_states');
        $query = $this->db->get();        
        $result = $query->result(); 
         //echo $this->db->last_query();die;       
        return $result;
    }

}

