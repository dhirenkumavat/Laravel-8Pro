<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Setting_model extends CI_Model
{
    /**
     * This function is used to get the setting listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function stageListCount($searchText = '')
    {
        $this->db->select('BaseTbl.stageId, BaseTbl.stageName, BaseTbl.color, BaseTbl.stageOrder');
        $this->db->from('amp_stages as BaseTbl');
        //$this->db->join('amp_users as User', 'User.userId = BaseTbl.sales_rep','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.stageName  LIKE '%".$searchText."%'
                            OR  BaseTbl.color  LIKE '%".$searchText."%'
                            OR  BaseTbl.stageOrder  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        //$this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.stageOrder', 'ASC');
        $this->db->order_by('BaseTbl.updatedDtm', 'DESC');
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    
    /**
     * This function is used to get the stage listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function stageList($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.stageId, BaseTbl.stageName, BaseTbl.color, BaseTbl.stageOrder');
        $this->db->from('amp_stages as BaseTbl');
        //$this->db->join('amp_users as User', 'User.userId = BaseTbl.sales_rep','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.stageName  LIKE '%".$searchText."%'
                            OR  BaseTbl.color  LIKE '%".$searchText."%'
                            OR  BaseTbl.stageOrder  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.stageOrder', 'ASC');
        $this->db->order_by('BaseTbl.updatedDtm', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $result = $query->result();        
        return $result;
    }


    /**
     * This function is used to get the tag listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function tagList($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.id, BaseTbl.tagName,BaseTbl.tagOrder');
        $this->db->from('amp_tags as BaseTbl');
        //$this->db->join('amp_users as User', 'User.userId = BaseTbl.sales_rep','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.tagName  LIKE '%".$searchText."%'
                            OR  BaseTbl.tagOrder  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.tagOrder', 'ASC');
        $this->db->order_by('BaseTbl.updatedDtm', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $result = $query->result();        
        return $result;
    }

    /**
     * This function is used to get the tag listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function jobtypeList($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.id, BaseTbl.jobType,BaseTbl.color');
        $this->db->from('amp_jobtype as BaseTbl');
      
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.jobType  LIKE '%".$searchText."%)";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $result = $query->result();        
        return $result;
    }

    /**
     * This function is used to get the tag listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function tagCount()
    {
        $this->db->select('BaseTbl.id, BaseTbl.tagName,BaseTbl.tagOrder');
        $this->db->from('amp_tags as BaseTbl');
        //$this->db->join('amp_users as User', 'User.userId = BaseTbl.sales_rep','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.tagName  LIKE '%".$searchText."%'
                            OR  BaseTbl.tagOrder  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.tagOrder', 'ASC');
        $this->db->order_by('BaseTbl.updatedDtm', 'DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->num_rows();
    }


    /**
     * This function is used to get the selling listing
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function sellingList($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.sellingId,BaseTbl.ownership,BaseTbl.policyExpiration,BaseTbl.businessOwner,BaseTbl.sellingOrder');
        $this->db->from('amp_cross_selling as BaseTbl');
        //$this->db->join('amp_users as User', 'User.userId = BaseTbl.sales_rep','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.ownership  LIKE '%".$searchText."%'
                            OR  BaseTbl.sellingOrder  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.sellingOrder', 'ASC');
        $this->db->order_by('BaseTbl.updatedDtm', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $result = $query->result();        
        return $result;
    }


    /**
     * This function is used to get the selling listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function sellingCount()
    {
        $this->db->select('BaseTbl.sellingId,BaseTbl.ownership,BaseTbl.policyExpiration,BaseTbl.businessOwner,BaseTbl.sellingOrder');
        $this->db->from('amp_cross_selling as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.sellingOrder', 'ASC');
        $this->db->order_by('BaseTbl.updatedDtm', 'DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->num_rows();
    }



    /**
     * This function is used to get the referral listing
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function referralList($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.referralId, BaseTbl.referralName,BaseTbl.referralOrder');
        $this->db->from('amp_referral_type as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.referralName  LIKE '%".$searchText."%'
                            OR  BaseTbl.referralOrder  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.referralOrder', 'ASC');
        $this->db->order_by('BaseTbl.updatedDtm', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }


    /**
     * This function is used to get the referral listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function refTypeCount()
    {
        $this->db->select('BaseTbl.referralId, BaseTbl.referralName,BaseTbl.referralOrder');
        $this->db->from('amp_referral_type as BaseTbl');
        
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.referralOrder', 'ASC');
        $this->db->order_by('BaseTbl.updatedDtm', 'DESC');
        $query = $this->db->get();
        return $query->num_rows();
    }
            
    /**
     * This function is used to add new stage to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewStage($stageInfo)
    {
        $this->db->trans_start();
        $this->db->insert('amp_stages', $stageInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }


    /**
     * This function is used to add new selling to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewSelling($sellingInfo)
    {
        $this->db->trans_start();
        $this->db->insert('amp_cross_selling', $sellingInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }


    /**
     * This function is used to add new tag to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewTag($tagInfo)
    {
        $this->db->trans_start();
        $this->db->insert('amp_tags', $tagInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    /**
     * This function is used to add new job type to system
     * @return number $insert_id : This is last inserted id
     */
    function addJobType($jobTypeInfo)
    {
        $this->db->trans_start();
        $this->db->insert('amp_jobtype', $jobTypeInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    /**
     * This function is used to add new referral to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewRef($refInfo)
    {
        $this->db->trans_start();
        $this->db->insert('amp_referral_type', $refInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * This function used to get stage information by id
     * @param number $stageId : This is stage id
     * @return array $result : This is stage information
     */
    function getStageInfo($stageId)
    {
        $this->db->select('stageId,stageName, color, stageOrder');
        $this->db->from('amp_stages');
        $this->db->where('isDeleted', 0);
		$this->db->where('stageId', $stageId);
        $query = $this->db->get();
        
        return $query->row();
    }


    /**
     * This function used to get tag information by id
     * @param number $tagId : This is tag id
     * @return array $result : This is tag information
     */
    function getTagInfo($tagId)
    {
        $this->db->select('id,tagName, tagOrder');
        $this->db->from('amp_tags');
        $this->db->where('isDeleted', 0);
        $this->db->where('id', $tagId);
        $query = $this->db->get();
        
        return $query->row();
    }

    /**
     * This function used to get Job Type information by id
     * @param number $jobTypeId : This is Job type id
     * @return array $result : This is Job Type information
     */
    function getJobTypeInfo($jobTypeId)
    {
        $this->db->select('id,jobType,color');
        $this->db->from('amp_jobtype');
        $this->db->where('isDeleted', 0);
        $this->db->where('id', $jobTypeId);
        $query = $this->db->get();
        
        return $query->row();
    }


    /**
     * This function used to get selling information by id
     * @param number $sellingId : This is selling id
     * @return array $result : This is selling information
     */
    function getSellingInfo($sellingId)
    {
        $this->db->select('sellingId,ownership, policyExpiration,businessOwner,sellingOrder');
        $this->db->from('amp_cross_selling');
        $this->db->where('isDeleted', 0);
        $this->db->where('sellingId', $sellingId);
        $query = $this->db->get();
        
        return $query->row();
    }


    /**
     * This function used to get ref information by id
     * @param number $refId : This is ref id
     * @return array $result : This is ref information
     */
    function getRefInfo($refId)
    {
        $this->db->select('referralId,referralName, referralOrder');
        $this->db->from('amp_referral_type');
        $this->db->where('isDeleted', 0);
        $this->db->where('referralId', $refId);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    
    /**
     * This function is used to update the stage information
     * @param array $stageInfo : This is stage updated information
     * @param number $stageId : This is stage id
     */
    function editStage($stageInfo, $stageId)
    {
        $this->db->where('stageId', $stageId);
        $this->db->update('amp_stages', $stageInfo);
        
        return TRUE;
    }


    /**
     * This function is used to update the tag information
     * @param array $tagInfo : This is tag updated information
     * @param number $tagId : This is tag id
     */
    function editTag($tagInfo, $tagId)
    {
        $this->db->where('id', $tagId);
        $this->db->update('amp_tags', $tagInfo);
        
        return TRUE;
    }


    /**
     * This function is used to update the Job type information
     * @param array $JobTypeInfo : This is Job Type updated information
     * @param number $JobTypeId : This is Job Type id
     */
    function editSaveJobType($jobTypeInfo, $jobTypeId)
    {
        $this->db->where('id', $jobTypeId);
        $this->db->update('amp_jobtype', $jobTypeInfo);
        
        return TRUE;
    }


    /**
     * This function is used to update the selling information
     * @param array $sellingInfo : This is selling updated information
     * @param number $sellingId : This is selling id
     */
    function editSelling($sellingInfo, $sellingId)
    {
        $this->db->where('sellingId', $sellingId);
        $this->db->update('amp_cross_selling', $sellingInfo);
        return TRUE;
    }


    /**
     * This function is used to update the ref information
     * @param array $refInfo : This is ref updated information
     * @param number $refId : This is ref id
     */
    function editRef($refnfo, $refId)
    {
        $this->db->where('referralId', $refId);
        $this->db->update('amp_referral_type', $refnfo);
        
        return TRUE;
    }
    
    
    
    /**
     * This function is used to delete the stage information
     * @param number $stageId : This is stage id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteStage($stageId, $stageInfo)
    {
        $this->db->where('stageId', $stageId);
        $this->db->update('amp_stages', $stageInfo);
        return $this->db->affected_rows();
    } 


    /**
     * This function is used to delete the tag information
     * @param number $tagId : This is tag id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteTag($tagId, $tagInfo)
    {
        $this->db->where('id', $tagId);
        $this->db->update('amp_tags', $tagInfo);
        return $this->db->affected_rows();
    } 

    /**
     * This function is used to delete the Job Type information
     * @param number $jobTypeId : This is job id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteJobType($jobTypeId, $jobTypeInfo)
    {
        $this->db->where('id', $jobTypeId);
        $this->db->update('amp_jobtype', $jobTypeInfo);
        return $this->db->affected_rows();
    }


    /**
     * This function is used to delete the selling information
     * @param number $sellingId : This is selling id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteSelling($sellingId, $sellingInfo)
    {
        $this->db->where('sellingId', $sellingId);
        $this->db->update('amp_cross_selling', $sellingInfo);
        return $this->db->affected_rows();
    } 


    /**
     * This function is used to delete the ref information
     * @param number $refId : This is ref id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteRef($refId, $refInfo)
    {
        $this->db->where('referralId', $refId);
        $this->db->update('amp_referral_type', $refInfo);
        return $this->db->affected_rows();
    } 



    /**
     * This function is used to update the stage information
     * @param number $leadId : This is stage id
     * @return boolean $result : TRUE / FALSE
     */
    function upOrder($stageId, $upstageInfo)
    {
        $this->db->where('stageId', $stageId);
        $this->db->update('amp_stages', $upstageInfo);
        return $this->db->affected_rows();
    } 


    function newupOrder($order, $upstageInfo)
    {
        $this->db->where('stageOrder', $order);
        $this->db->update('amp_stages', $upstageInfo);
        return $this->db->affected_rows();
    }   


    /**
     * This function is used to update the tag information
     * @param number $tagId : This is tag id
     * @return boolean $result : TRUE / FALSE
     */
    function upTagOrder($tagId, $uptagInfo)
    {
        $this->db->where('id', $tagId);
        $this->db->update('amp_tags', $uptagInfo);
        return $this->db->affected_rows();

    }


    /**
     * This function is used to update the tag information
     * @param number $tagId : This is tag id
     * @return boolean $result : TRUE / FALSE
     */
    function newupTagOrder($order, $uptagInfo)
    {
        $this->db->where('tagOrder', $order);
        $this->db->update('amp_tags', $uptagInfo);
        return $this->db->affected_rows();

    }

    /**
     * This function is used to update the selling information
     * @param number $sellingId : This is selling id
     * @return boolean $result : TRUE / FALSE
     */
    function upSellingOrder($sellingId, $upsellingInfo)
    {
        $this->db->where('sellingId', $sellingId);
        $this->db->update('amp_cross_selling', $upsellingInfo);
        return $this->db->affected_rows();
        

    }


     /**
     * This function is used to update the selling information
     * @param number $sellingId : This is selling id
     * @return boolean $result : TRUE / FALSE
     */
    function newupSellingOrder($order, $upsellingInfo)
    {
        $this->db->where('sellingOrder', $order);
        $this->db->update('amp_cross_selling', $upsellingInfo);
        return $this->db->affected_rows();
        

    }



    /**
     * This function is used to update the ref information
     * @param number $refId : This is ref id
     * @return boolean $result : TRUE / FALSE
     */
    function upReferralOrder($refId, $uprefInfo)
    {
        $this->db->where('referralId', $refId);
        $this->db->update('amp_referral_type', $uprefInfo);
        return $this->db->affected_rows();

    }


     /**
     * This function is used to update the ref information
     * @param number $refId : This is ref id
     * @return boolean $result : TRUE / FALSE
     */
    function newupReferralOrder($order, $uprefInfo)
    {
        $this->db->where('referralOrder', $order);
        $this->db->update('amp_referral_type', $uprefInfo);
        return $this->db->affected_rows();

    }

    /**
     * This function is used to check whether order is already exist or not.
     *
     * @param {number} $sellingId : This is sellingId id
     *
     * @return {mixed} $result : This is searched result
     */
    public function checkOrderExists($sellingOrder, $sellingId = 0)
    {
        $this->db->select('sellingOrder');
        $this->db->from('amp_cross_selling');
        $this->db->where('sellingOrder', $sellingOrder);
        $this->db->where('isDeleted', 0);
        if ($sellingId != 0) {
            $this->db->where('sellingId !=', $sellingId);
        }
        $query = $this->db->get();

        return $query->result();
    } 

    public function currentOrder()    {
        $this->db->select_max('stageOrder');
        $this->db->from('amp_stages');
        $query=$this->db->get();
        $result = $query->row_array();        
        return $result;
    }    

    public function currentRefOrder()    {
        $this->db->select_max('referralOrder');
        $this->db->from('amp_referral_type');
        $query=$this->db->get();
        $result = $query->row_array();        
        return $result;
    }

    public function currentTagOrder()    {
        $this->db->select_max('tagOrder');
        $this->db->from('amp_tags');
        $query=$this->db->get();
        $result = $query->row_array();        
        return $result;
    }

    public function currentSellingOrder()    {
        $this->db->select_max('sellingOrder');
        $this->db->from('amp_cross_selling');
        $query=$this->db->get();
        $result = $query->row_array();        
        return $result;
    }

    public function insertSMTP($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    // get data with where condition
    public function select_where($table, $field) {
        $this->db->where($field);
        $query = $this->db->get($table);
        return $query->row_array();
    }

        /**
     * This function is used to check whether email id is already exist or not.
     *
     * @param {string} $email  : This is email id
     * @param {number} $userId : This is user id
     *
     * @return {mixed} $result : This is searched result
     */
    public function checkEmailExists($email, $userId = 0)
    {
        $this->db->select('userid,email');
        $this->db->from('amp_users');
        $this->db->where('email', $email);
        $this->db->where('isDeleted', 0);
        if ($userId != 0) {
            $this->db->where('userId !=', $userId);
        }
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * This function is used to add new user to system.
     *
     * @return number $insert_id : This is last inserted id
     */
    public function addNewUser($userInfo){
        $this->db->trans_start();
        $this->db->insert('amp_users', $userInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

     public function getLatLong($address){

        //https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBSy4oTrksxRZyycZlC08uDYgtzdZ03SuQ&address=
        $geo = @file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyB7_NfvBxKc8FpOZgAlRLlW0SApkVbidb4&address='.urlencode($address).'&sensor=false');
        $geo = json_decode($geo, true); // Convert the JSON to an array
        //print_r($geo);die;
        
        if (isset($geo['results'][0]['geometry']['location']['lat'])) {
          $latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
          $longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
          $return = $latitude."@".$longitude;    
          return $return ;
        }
        else {        
            return "22.719568@75.858727";
        }

        /*
        $address = str_replace(" ", "+", $address);
        $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
        $json = json_decode($json);
        print_r($json);die;
        $lat  = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
        $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
        return $lat."#".$long;
        */    
    }
}

  