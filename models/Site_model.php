<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Site Model
 *
 * @author TechArise Team
 *
 * @email  info@techarise.com
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site_model extends CI_Model {

    private $lead_id;
    private $_project_name;
    private $_first_name;
    private $_last_name;
    private $_phone_no;
    private $_email;
    private $_sales_rep;
    private $_stageId;

    private $_list_id;
    private $_list_name;
    private $_list_sales_rep;

    private $_ref_id;
    private $_ref_name;

    private $_username;
    private $_phone;
    private $_useremail;
    private $_role;

    private $_bid_oprt;
    private $_bid_price;

    private $_tagId;
    private $_filesystem_id;
    private $_estimator;
    private $_sales;
    private $_admin;
    private $_jobTypeId;
    private $_client_mame;
    private $_notes;
    private $_buisness_type;
    private $_uri_method;
    private $_county;

    public function setCountyMethod($county) {
        $this->_county = $county;
    }

    public function setUriMethod($uri_method) {
        $this->_uri_method = $uri_method;
    }

    public function setLeadID($lead_id) {
        $this->_lead_id = $lead_id;
    }
    public function setProjectName($project_name) {
        $this->_project_name = $project_name;
    }
    public function setFirstName($first_name) {
        $this->_first_name = $first_name;
    }
    public function setLastName($last_name) {
        $this->_last_name = $last_name;
    }
    public function settFirstName($tfirst_name) {
        $this->_tfirst_name = $tfirst_name;
    }
    public function settLastName($tlast_name) {
        $this->_tlast_name = $last_name;
    }
    public function setPhoneNo($phone_no) {
        $this->_phone_no = $phone_no;
    } 
    public function setEmail($email) {
        $this->_email = $email;
    }
    public function setSalesRep($sales_rep) {
        $this->_sales_rep = $sales_rep;
    }
    public function setStage($stageId) {
        $this->_stageId = $stageId;
    }  

    public function setDOB($dob) {
        $this->_dob = $dob;
    }
    public function setType($type) {
        $this->_type = $type;
    }
    public function setListID($list_id) {
        $this->_list_id = $list_id;
    }
    public function setListName($list_name) {
        $this->_list_name = $list_name;
    }
    public function setListSalesRep($list_sales_rep) {
        $this->_list_sales_rep = $list_sales_rep;
    }  

    public function setRefID($ref_id) {
        $this->_ref_id = $ref_id;
    }
    public function setReferralName($ref_name) {
        $this->_ref_name = $ref_name;
    }
    public function setTerritoryManager($territory_manager) {
        $this->_territory_manager = $territory_manager;
    }

    public function setName($username) {
        $this->_username = $username;
    }
    public function setPhone($phone) {
        $this->_phone = $phone;
    }

    public function setUserEmail($useremail) {
        $this->_useremail = $useremail;
    }

    public function setUserRole($role) {
        $this->_role = $role;
    }

    public function setScopeAll($scope_all){
        $this->_scope_all = $scope_all;
    }

    public function setScopeAbatement($scope_abatement){
        $this->_scope_abatement = $scope_abatement;
    }

    public function setScopeIntDemolition($scope_interior_demolition){
        $this->_scope_interior_demolition = $scope_interior_demolition;
    }

    public function setScopeSiteDemolition($scope_site_demolition){
        $this->_scope_site_demolition = $scope_site_demolition;
    }

    public function setScopeEarthwork($scope_earthwork){
        $this->_scope_earthwork = $scope_earthwork;
    }

    public function setScopeOther($scope_other){
        $this->_scope_other = $scope_other;
    }

    public function setBidOpertor($bid_oprt){
        $this->_bid_oprt = $bid_oprt;
    }

    public function setBidPrice($bid_price){
        $this->_bid_price = $bid_price;
    }

    public function settagId($tagId){
        $this->_tagId = $tagId;
    }
    public function setFilesystemId($filesystem_id){
        $this->_filesystem_id = $filesystem_id;
    }
    public function setEstimator($estimator){
        $this->_estimator = $estimator;
    }
    public function setSales($sales){
        $this->_sales = $sales;
    }
    public function setAdmin($admin){
        $this->_admin = $admin;
    }
    public function setjobTypeId($jobTypeId){
        $this->_jobTypeId = $jobTypeId;
    }
    public function setClientName($client_name){
        $this->_client_mame = $client_name;
    }
    public function setNotes($notes){
        $this->_notes = $notes;
    }
    public function setBuisnessType($buisness_type){
        $this->_buisness_type = $buisness_type;
    }
    

    
    // get Orders List
    public function getOrders() {     

        $this->db->select('BaseTbl.projectId,BaseTbl.is_priority,BaseTbl.userID,BaseTbl.sales,BaseTbl.projectName,BaseTbl.scope,BaseTbl.dueDate,BaseTbl.estStartDate,BaseTbl.rom,BaseTbl.dueTime,BaseTbl.contract ,BaseTbl.jobWalkTime,BaseTbl.address,BaseTbl.estimator,BaseTbl.bid_price,BaseTbl.mainContact,BaseTbl.scope, BaseTbl.createdDtm, BaseTbl.salesRepId, BaseTbl.stageId,BaseTbl.bid_price,BaseTbl.notes,User.name,Stage.stageName,BaseTbl.phoneNo1,BaseTbl.email,BaseTbl.filesystem_id,BaseTbl.company,jobtype.jobType,jobtype.color,acl.buisness_type ,acl.client_name as client_company,ac.contact_name,ac.contact_phone,ac.contact_phone,acounty.county');
        $this->db->from('amp_projects as BaseTbl');
        $this->db->join('amp_users as User', 'User.userId = BaseTbl.sales','left');
        $this->db->join('amp_stages as Stage', 'Stage.stageId = BaseTbl.stageId','left');
        $this->db->join('amp_jobtype as jobtype', 'jobtype.id = BaseTbl.jobtypeid','left');
        $this->db->join('amp_project_clients as apcl', 'apcl.projectId = BaseTbl.projectId','left');
        $this->db->join('amp_clients as acl', 'acl.id = apcl.clientId','left');
        $this->db->join('amp_project_contact as apc', 'apc.projectId = BaseTbl.projectId','left');
        $this->db->join('amp_contact as ac', 'ac.id = apc.contactId','left');
        $this->db->join('amp_county as acounty', 'acounty.id = BaseTbl.countyid','left');
               
        if(!empty($this->_lead_id)){
            $this->db->where('BaseTbl.projectId', $this->_lead_id);
        }
        if(!empty($this->_project_name)){            
            $this->db->like('BaseTbl.projectName', $this->_project_name, 'both');
        }          
        if(!empty($this->_first_name)){            
            $this->db->like('BaseTbl.firstName', $this->_first_name, 'both');
        }
        if(!empty($this->_last_name)){            
            $this->db->like('BaseTbl.lastName', $this->_last_name, 'both');
        }
        if(!empty($this->_phone_no)){            
            // $this->db->like('BaseTbl.phoneNo1', $this->_phone_no);
            $this->db->like('ac.contact_phone', $this->_phone_no);
        }
        if(!empty($this->_email)){            
            // $this->db->like('BaseTbl.email', $this->_email);
            $this->db->like('ac.contact_email', $this->_email);
        } 
        if(!empty($this->_sales_rep)){            
            $this->db->like('User.userId', $this->_sales_rep);
        } 
        // if(!empty($this->_stageId)){            
        //     $this->db->like('BaseTbl.stageId', $this->_stageId);
        // } 
        if(!empty($this->_dob)){                
            $this->db->like('BaseTbl.dob', $this->_dob);            
        }
        if(!empty($this->_notes)){                
            $this->db->like('BaseTbl.notes', $this->_notes);            
        }

        if(!empty($this->_buisness_type)){            
            // $this->db->like('BaseTbl.email', $this->_email);
            $this->db->like('acl.buisness_type', $this->_buisness_type);
        } 

        if(!empty($this->_bid_price)){ 
            $bid_price = str_replace( '$', '',str_replace( ',', '', $this->_bid_price));
            if($this->_bid_oprt == "greater"){
                $this->db->where('BaseTbl.bid_price >',  (int)$bid_price);   
            }elseif($this->_bid_oprt == "less"){
                $this->db->where('BaseTbl.bid_price <',  (int)$bid_price);   
            }elseif($this->_bid_oprt == "greater_equal"){
                $this->db->where('BaseTbl.bid_price >=',  (int)$bid_price);   
            }else{
                $this->db->where('BaseTbl.bid_price <=',  (int)$bid_price);   
            }     
        }

        if(!empty($this->_tagId)){                
            $this->db->where('BaseTbl.tagId', $this->_tagId);            
        }
        if(!empty($this->_filesystem_id)){                
            $this->db->like('BaseTbl.filesystem_id', $this->_filesystem_id);           
        }

        /*if(!empty($this->_estimator)){                
            $this->db->where('BaseTbl.estimator', $this->_estimator);           
        }*/
        if(!empty($this->_estimator[0])){
            $estimatorArray = $this->_estimator;
            $this->db->group_start();
            foreach($estimatorArray as $value)
            {
                $this->db->where("find_in_set('$value', `BaseTbl`.`estimator`)");
            }
            $this->db->group_end();
        }


        if(!empty($this->_sales)){         
            $this->db->where('BaseTbl.sales',$this->_sales);       
            //$this->db->like('BaseTbl.sales', $this->_sales);           
        }
        if(!empty($this->_admin)){                
            $this->db->where('BaseTbl.admin', $this->_admin);           
        }
        if(!empty($this->_jobTypeId)){                
            $this->db->where('BaseTbl.jobtypeid', $this->_jobTypeId);           
        }
        if(!empty($this->_client_mame)){                
            $this->db->like('acl.client_name', $this->_client_mame);           
        }

        if(!empty($this->_county)){                
            $this->db->like('BaseTbl.countyid', $this->_county);           
        }

        if(!empty($this->_scope_all) || !empty($this->_scope_abatement) || !empty($this->_scope_interior_demolition) || !empty($this->_scope_site_demolition) || !empty($this->_scope_earthwork) || !empty($this->_scope_other)){
            $this->db->group_start();
             if(!empty($this->_scope_all)){                
                //$this->db->like('BaseTbl.scope', $this->_scope);
                $this->db->where("(FIND_IN_SET('abatement', BaseTbl.scope) OR FIND_IN_SET('interior_demolition', BaseTbl.scope) OR FIND_IN_SET('site_demolition', BaseTbl.scope) OR FIND_IN_SET('earthwork', BaseTbl.scope) OR FIND_IN_SET('other', BaseTbl.scope))");         
            }  

            if(!empty($this->_scope_abatement)){                
                $this->db->or_where("FIND_IN_SET('abatement', BaseTbl.scope)");         
            } 

            if(!empty($this->_scope_interior_demolition)){                
                $this->db->or_where("FIND_IN_SET('interior_demolition', BaseTbl.scope)");         
            }

            if(!empty($this->_scope_site_demolition)){                
                $this->db->or_where("FIND_IN_SET('site_demolition', BaseTbl.scope)");         
            }

            if(!empty($this->_scope_earthwork)){                
                $this->db->or_where("FIND_IN_SET('earthwork', BaseTbl.scope)");         
            } 

            if(!empty($this->_scope_other)){                
                $this->db->or_where("FIND_IN_SET('other', BaseTbl.scope)");         
            }

            $this->db->group_end();
        }

        $this->db->group_by('BaseTbl.projectId'); 
        $this->db->order_by('BaseTbl.projectId', 'DESC');
        if(!empty($this->_stageId)){        
            $this->db->where('BaseTbl.stageId', $this->_stageId);    
            //$this->db->like('BaseTbl.stageId', $this->_stageId);
        } 
        $this->db->where('BaseTbl.isDeleted', 0);
        $method = $this->router->fetch_method();
        $user_level_where_condition = manage_user_level_condition();
        if(!empty($user_level_where_condition) && ($this->_uri_method == 'projectListing' || $this->_uri_method == 'prospectsProjectListing')){
            $this->db->where($user_level_where_condition);
        }

        $query = $this->db->get();  
        //echo $this->db->last_query();die;      
        return $query->result_array();
    }



    // get Orders List
    public function getLeadsId() {        
        $this->db->select('BaseTbl.projectId');
        $this->db->from('amp_projects as BaseTbl');
        $this->db->join('amp_users as User', 'User.userId = BaseTbl.sales','left');
        $this->db->join('amp_stages as Stage', 'Stage.stageId = BaseTbl.stageId','left');
               
        if(!empty($this->_lead_id)){
            $this->db->where('BaseTbl.projectId', $this->_lead_id);
        }
        if(!empty($this->_project_name)){            
            $this->db->like('BaseTbl.projectName', $this->_project_name, 'both');
        }
        if(!empty($this->_last_name)){            
            $this->db->like('BaseTbl.lastName', $this->_last_name, 'both');
        }
        if(!empty($this->_phone_no)){            
            $this->db->like('BaseTbl.phoneNo1', $this->_phone_no);
        }
        if(!empty($this->_email)){            
            $this->db->like('BaseTbl.email', $this->_email);
        } 
        if(!empty($this->_sales_rep)){            
            $this->db->like('BaseTbl.sales', $this->_sales_rep);
        }
        // if(!empty($this->_stageId)){            
        //     $this->db->like('BaseTbl.stageId', $this->_stageId);
        // }       
        $this->db->order_by('BaseTbl.projectId', 'DESC');
        $this->db->where('BaseTbl.isDeleted', 0);
        if(!empty($this->_stageId)){        
            $this->db->where('BaseTbl.stageId', $this->_stageId);    
            //$this->db->like('BaseTbl.stageId', $this->_stageId);
        } 
         $user_level_where_condition = manage_user_level_condition();     

        if(!empty($user_level_where_condition)){
            $this->db->where($user_level_where_condition);
        }

        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }


    // get List Data
    public function getLists() {        
        $this->db->select('BaseTbl.listId, BaseTbl.listName,User.name');
        $this->db->from('amp_lists as BaseTbl');
        $this->db->join('amp_users as User', 'User.userId = BaseTbl.salesRepId','left');
               
        if(!empty($this->_list_id)){
            $this->db->where('BaseTbl.listId', $this->_list_id);
        }        
        if(!empty($this->_list_name)){            
            $this->db->like('BaseTbl.listName', $this->_list_name, 'both');
        }
        if(!empty($this->_list_sales_rep)){            
            $this->db->like('BaseTbl.salesRepId', $this->_list_sales_rep, 'both');
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.listId', 'DESC');  
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }


     // get eferral Data
    public function getReferral() {        
        $this->db->select('BaseTbl.referralSourceId, BaseTbl.companyName, BaseTbl.firstName, BaseTbl.createdDtm, BaseTbl.license,amp_users.name as TerritorymanagerName');
        $this->db->from('amp_referral_source as BaseTbl');
               
        if(!empty($this->_ref_id)){
            $this->db->where('BaseTbl.referralSourceId', $this->_ref_id);
        }        
        if(!empty($this->_ref_name)){            
            $this->db->like('BaseTbl.companyName', $this->_ref_name, 'both');
        }
        if(!empty($this->_territory_manager)){            
            $this->db->like('BaseTbl.territoryManagerId', $this->_territory_manager, 'both');
        }
        if(!empty($this->_dob)){            
            $this->db->like('BaseTbl.birthDay', $this->_dob);
        }
        
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->join('amp_users', 'BaseTbl.territoryManagerId = amp_users.userId', 'left');
        $this->db->order_by('BaseTbl.referralSourceId', 'DESC');  
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }
    // get Orders List
    public function getsheetInfo() {     

        $this->db->select('BaseTbl.projectId,BaseTbl.is_priority,BaseTbl.userID,BaseTbl.sales,BaseTbl.projectName,BaseTbl.scope,BaseTbl.dueDate,BaseTbl.contract ,BaseTbl.jobWalkTime,BaseTbl.address,BaseTbl.estimator,BaseTbl.bid_price,BaseTbl.mainContact,BaseTbl.scope, BaseTbl.createdDtm, BaseTbl.salesRepId, BaseTbl.stageId,BaseTbl.bid_price,BaseTbl.notes,User.name,Stage.stageName,BaseTbl.phoneNo1,BaseTbl.email,BaseTbl.filesystem_id,BaseTbl.company,BaseTbl.ownership,BaseTbl.businessOwner,jobtype.jobType,jobtype.color,acl.buisness_type');
        $this->db->from('amp_projects as BaseTbl');
        $this->db->join('amp_users as User', 'User.userId = BaseTbl.sales','left');
        $this->db->join('amp_stages as Stage', 'Stage.stageId = BaseTbl.stageId','left');
        $this->db->join('amp_jobtype as jobtype', 'jobtype.id = BaseTbl.jobtypeid','left');
        $this->db->join('amp_project_clients as apcl', 'apcl.projectId = BaseTbl.projectId','left');
        $this->db->join('amp_clients as acl', 'acl.id = apcl.clientId','left');
        $this->db->join('amp_project_contact as apc', 'apc.projectId = BaseTbl.projectId','left');
        $this->db->join('amp_contact as ac', 'ac.id = apc.contactId','left');
               
        if(!empty($this->_lead_id)){
            $this->db->where('BaseTbl.projectId', $this->_lead_id);
        }
        if(!empty($this->_project_name)){            
            $this->db->like('BaseTbl.projectName', $this->_project_name, 'both');
        }          
        if(!empty($this->_first_name)){            
            $this->db->like('BaseTbl.firstName', $this->_first_name, 'both');
        }
        if(!empty($this->_last_name)){            
            $this->db->like('BaseTbl.lastName', $this->_last_name, 'both');
        }
        if(!empty($this->_phone_no)){            
            // $this->db->like('BaseTbl.phoneNo1', $this->_phone_no);
            $this->db->like('ac.contact_phone', $this->_phone_no);
        }
        if(!empty($this->_email)){            
            // $this->db->like('BaseTbl.email', $this->_email);
            $this->db->like('ac.contact_email', $this->_email);
        } 
        if(!empty($this->_sales_rep)){            
            $this->db->like('User.userId', $this->_sales_rep);
        } 
        // if(!empty($this->_stageId)){            
        //     $this->db->like('BaseTbl.stageId', $this->_stageId);
        // } 
        if(!empty($this->_dob)){                
            $this->db->like('BaseTbl.dob', $this->_dob);            
        }
        if(!empty($this->_notes)){                
            $this->db->like('BaseTbl.notes', $this->_notes);            
        }

        if(!empty($this->_buisness_type)){            
            // $this->db->like('BaseTbl.email', $this->_email);
            $this->db->like('acl.buisness_type', $this->_buisness_type);
        } 

        if(!empty($this->_bid_price)){ 
            $bid_price = str_replace( '$', '',str_replace( ',', '', $this->_bid_price));
            if($this->_bid_oprt == "greater"){
                $this->db->where('BaseTbl.bid_price >',  (int)$bid_price);   
            }elseif($this->_bid_oprt == "less"){
                $this->db->where('BaseTbl.bid_price <',  (int)$bid_price);   
            }elseif($this->_bid_oprt == "greater_equal"){
                $this->db->where('BaseTbl.bid_price >=',  (int)$bid_price);   
            }else{
                $this->db->where('BaseTbl.bid_price <=',  (int)$bid_price);   
            }     
        }

        if(!empty($this->_tagId)){                
            $this->db->where('BaseTbl.tagId', $this->_tagId);            
        }
        if(!empty($this->_filesystem_id)){                
            $this->db->like('BaseTbl.filesystem_id', $this->_filesystem_id);           
        }

        /*if(!empty($this->_estimator)){                
            $this->db->where('BaseTbl.estimator', $this->_estimator);           
        }*/
        if(!empty($this->_estimator[0])){
            $estimatorArray = $this->_estimator;
            $this->db->group_start();
            foreach($estimatorArray as $value)
            {
                $this->db->where("find_in_set('$value', `BaseTbl`.`estimator`)");
            }
            $this->db->group_end();
        }


        if(!empty($this->_sales)){                
            $this->db->like('BaseTbl.sales', $this->_sales);           
        }
        if(!empty($this->_admin)){                
            $this->db->where('BaseTbl.admin', $this->_admin);           
        }
        if(!empty($this->_jobTypeId)){                
            $this->db->where('BaseTbl.jobtypeid', $this->_jobTypeId);           
        }
        if(!empty($this->_client_mame)){                
            $this->db->like('acl.client_name', $this->_client_mame);           
        }

        if(!empty($this->_scope_all) || !empty($this->_scope_abatement) || !empty($this->_scope_interior_demolition) || !empty($this->_scope_site_demolition) || !empty($this->_scope_earthwork) || !empty($this->_scope_other)){
            $this->db->group_start();
             if(!empty($this->_scope_all)){                
                //$this->db->like('BaseTbl.scope', $this->_scope);
                $this->db->where("(FIND_IN_SET('abatement', BaseTbl.scope) OR FIND_IN_SET('interior_demolition', BaseTbl.scope) OR FIND_IN_SET('site_demolition', BaseTbl.scope) OR FIND_IN_SET('earthwork', BaseTbl.scope) OR FIND_IN_SET('other', BaseTbl.scope))");         
            }  

            if(!empty($this->_scope_abatement)){                
                $this->db->or_where("FIND_IN_SET('abatement', BaseTbl.scope)");         
            } 

            if(!empty($this->_scope_interior_demolition)){                
                $this->db->or_where("FIND_IN_SET('interior_demolition', BaseTbl.scope)");         
            }

            if(!empty($this->_scope_site_demolition)){                
                $this->db->or_where("FIND_IN_SET('site_demolition', BaseTbl.scope)");         
            }

            if(!empty($this->_scope_earthwork)){                
                $this->db->or_where("FIND_IN_SET('earthwork', BaseTbl.scope)");         
            } 

            if(!empty($this->_scope_other)){                
                $this->db->or_where("FIND_IN_SET('other', BaseTbl.scope)");         
            }

            $this->db->group_end();
        }

        $this->db->group_by('BaseTbl.projectId'); 
        $this->db->order_by('BaseTbl.projectId', 'DESC');
        if(!empty($this->_stageId)){        
            $this->db->where('BaseTbl.stageId', $this->_stageId);    
            //$this->db->like('BaseTbl.stageId', $this->_stageId);
        } 
        $this->db->where('BaseTbl.isDeleted', 0);
        $method = $this->router->fetch_method();
        $user_level_where_condition = manage_user_level_condition();     

        if(!empty($user_level_where_condition) && ($this->_uri_method == 'projectListing' || $this->_uri_method == 'prospectsProjectListing')){
            $this->db->where($user_level_where_condition);
        }

        $query = $this->db->get();  
        //echo $this->db->last_query();die;      
        return $query->result_array();
    }

    public function getsheetInfoOld() {   
    

        $this->db->select('BaseTbl.projectId, BaseTbl.projectName,BaseTbl.estimator,BaseTbl.scope , BaseTbl.firstName, BaseTbl.lastName, BaseTbl.createdDtm, BaseTbl.salesRepId, BaseTbl.stageId,User.name,Stage.stageName,BaseTbl.phoneNo1,BaseTbl.email,BaseTbl.dob,BaseTbl.address,BaseTbl.DL,BaseTbl.brokerFee,BaseTbl.notes,BaseTbl.policyExpiration,BaseTbl.ownership,BaseTbl.businessOwner');        
        $this->db->from('amp_projects as BaseTbl');
        $this->db->join('amp_users as User', 'User.userId = BaseTbl.sales','left');
        $this->db->join('amp_stages as Stage', 'Stage.stageId = BaseTbl.stageId','left');
               
        if(!empty($this->_lead_id)){
            $this->db->where('BaseTbl.projectId', $this->_lead_id);
        }        
        if(!empty($this->_first_name)){            
            $this->db->like('BaseTbl.firstName', $this->_first_name, 'both');
        }
        if(!empty($this->_last_name)){            
            $this->db->like('BaseTbl.lastName', $this->_last_name, 'both');
        }
        if(!empty($this->_phone_no)){            
            $this->db->like('BaseTbl.phoneNo1', $this->_phone_no);
        }
        if(!empty($this->_email)){            
            $this->db->like('BaseTbl.email', $this->_email);
        } 

        if(!empty($this->_project_name)){            
            $this->db->like('BaseTbl.projectName', $this->_project_name, 'both');
        } 

        if(!empty($this->_estimator[0])){
            $estimatorArray = $this->_estimator;
            $this->db->group_start();
            foreach($estimatorArray as $value)
            {
                $this->db->where("find_in_set('$value', `BaseTbl`.`estimator`)");
            }
            $this->db->group_end();
        }

        if(!empty($this->_sales_rep)){            
            $this->db->like('BaseTbl.sales', $this->_sales_rep);
        }
        if(!empty($this->_stageId)){            
            $this->db->like('BaseTbl.stageId', $this->_stageId);
        }       
        if(!empty($this->_scope_all) || !empty($this->_scope_abatement) || !empty($this->_scope_interior_demolition) || !empty($this->_scope_site_demolition) || !empty($this->_scope_earthwork) || !empty($this->_scope_other)){
            $this->db->group_start();
             if(!empty($this->_scope_all)){                
                //$this->db->like('BaseTbl.scope', $this->_scope);
                $this->db->where("(FIND_IN_SET('abatement', BaseTbl.scope) OR FIND_IN_SET('interior_demolition', BaseTbl.scope) OR FIND_IN_SET('site_demolition', BaseTbl.scope) OR FIND_IN_SET('earthwork', BaseTbl.scope) OR FIND_IN_SET('other', BaseTbl.scope))");         
            }  

            if(!empty($this->_scope_abatement)){                
                $this->db->or_where("FIND_IN_SET('abatement', BaseTbl.scope)");         
            } 

            if(!empty($this->_scope_interior_demolition)){                
                $this->db->or_where("FIND_IN_SET('interior_demolition', BaseTbl.scope)");         
            }

            if(!empty($this->_scope_site_demolition)){                
                $this->db->or_where("FIND_IN_SET('site_demolition', BaseTbl.scope)");         
            }

            if(!empty($this->_scope_earthwork)){                
                $this->db->or_where("FIND_IN_SET('earthwork', BaseTbl.scope)");         
            } 

            if(!empty($this->_scope_other)){                
                $this->db->or_where("FIND_IN_SET('other', BaseTbl.scope)");         
            }

            $this->db->group_end();
        }
        $this->db->order_by('BaseTbl.projectId', 'DESC');
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }

    /**
     * This function is used to get the communication listing 
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function getcommuniList()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('amp_communications as BaseTbl');
        $this->db->join('amp_projects as Lead', 'Lead.projectId = BaseTbl.projectId','left');
        $this->db->join('amp_users as User', 'User.userId = Lead.sales','left');
        

        if(!empty($this->_lead_id)){
            $this->db->where('Lead.projectId', $this->_lead_id);
        }        
        if(!empty($this->_first_name)){            
            $this->db->like('BaseTbl.froms', $this->_first_name, 'both');
        }
        if(!empty($this->_last_name)){            
            $this->db->like('BaseTbl.froms', $this->_last_name, 'both');
        }
        if(!empty($this->_tfirst_name)){            
            $this->db->like('Lead.firstName', $this->_tfirst_name, 'both');
        }
        if(!empty($this->_tlast_name)){            
            $this->db->like('Lead.lastName', $this->_tlast_name, 'both');
        }
        if(!empty($this->_phone_no)){            
            $this->db->like('Lead.phoneNo1', $this->_phone_no);
        }
        if(!empty($this->_email)){            
            $this->db->like('Lead.email', $this->_email);
        } 
        if(!empty($this->_sales_rep)){            
            $this->db->like('User.userId', $this->_sales_rep);
        }
        if(!empty($this->_stageId)){            
            $this->db->like('Lead.stageId', $this->_stageId);
        }

        if(!empty($this->_type)){  
            if($this->_type == 3)          
                $this->db->where('BaseTbl.type', 0);
            else 
                $this->db->like('BaseTbl.type', $this->_type);
        } 

        $this->db->order_by('BaseTbl.communicationId', 'DESC');
        $query = $this->db->get();
        return $query->result_array();      
    }


    /**
     * This function is used to get the communication listing 
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function getexcelsheetInfo()
    {
        $this->db->select('BaseTbl.communicationId, BaseTbl.type,BaseTbl.data,,BaseTbl.froms,,BaseTbl.to,BaseTbl.createdDtm');
        $this->db->from('amp_communications as BaseTbl');
        $this->db->join('amp_projects as Lead', 'Lead.projectId = BaseTbl.projectId','left');
        $this->db->join('amp_users as User', 'User.userId = Lead.sales','left');
        

        if(!empty($this->_lead_id)){
            $this->db->where('Lead.projectId', $this->_lead_id);
        }        
        if(!empty($this->_first_name)){            
            $this->db->like('Lead.firstName', $this->_first_name, 'both');
        }
        if(!empty($this->_last_name)){            
            $this->db->like('Lead.lastName', $this->_last_name, 'both');
        }
        if(!empty($this->_phone_no)){            
            $this->db->like('Lead.phoneNo1', $this->_phone_no);
        }
        if(!empty($this->_email)){            
            $this->db->like('Lead.email', $this->_email);
        } 
        if(!empty($this->_sales_rep)){            
            $this->db->like('User.userId', $this->_sales_rep);
        }
        if(!empty($this->_stageId)){            
            $this->db->like('Lead.stageId', $this->_stageId);
        } 

        $this->db->order_by('BaseTbl.communicationId', 'DESC');
        $query = $this->db->get();
        return $query->result_array();      
    }


    // get Orders List
    public function getuserList() {     

        $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.createdDtm, Role.role');
        $this->db->from('amp_users as BaseTbl');
        $this->db->join('amp_roles as Role', 'Role.roleId = BaseTbl.roleId', 'left');
               
        if(!empty($this->_username)){
            $this->db->like('BaseTbl.name', $this->_username);
        }        
        if(!empty($this->_phone)){            
            $this->db->like('BaseTbl.mobile', $this->_phone);
        }
        if(!empty($this->_useremail)){            
            $this->db->like('BaseTbl.email', $this->_useremail);
        }
        if(!empty($this->_role)){            
            $this->db->like('BaseTbl.roleId', $this->_role);
        }
            
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.roleId !=', 1);
        $this->db->order_by('BaseTbl.userId', 'DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }


     public function checkLeadSMSOption($leadId){
        $this->db->select('optInId');
        $this->db->from('amp_opt_ins');
        $this->db->where('projectId', $leadId);
        $this->db->where('sms', 'sms');
        $query = $this->db->get();
        return $query->num_rows();
    }
}
?>