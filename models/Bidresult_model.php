<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Bidresult_model extends CI_Model
{

    private $_limit;
    private $_pageNumber;
    private $_offset;

    private $_job_name;
    private $_unit_cost;
    private $_market_type;
    private $_building_type;

    private $_scope;
    private $_material_needs;

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


    public function setJobName($job_name) {

        $this->_job_name = $job_name;
    }

    public function setCompanyName($company_name) {
        $this->_company_name = $company_name;
    }

    public function setUnitCostSign($unit_cost_sign) {
        $this->_unit_cost_sign = $unit_cost_sign;
    }

    public function setUnitCostValue($unit_cost_value) {
        $this->_unit_cost_value = $unit_cost_value;
    }

    public function setMarketType($market_type) {
        $this->_market_type = $market_type;
    }

    public function setBuildingType($building_type) {
        $this->_building_type = $building_type;
    }

    public function setAllScope($scope_all) {
        $this->_all_scope = $scope_all;
    }

    public function setScopeAbatement($scope_abatement) {
        $this->_scope_abatement = $scope_abatement;
    }

    public function setScopeIntDemolition($scope_interior_demolition) {
        $this->_scope_interior_demolition = $scope_interior_demolition;
    }

    public function setScopeSiteDemolition($scope_site_demolition) {
        $this->_scope_site_demolition = $scope_site_demolition;
    }

    public function setScopeEarthwork($scope_earthwork) {
        $this->_scope_earthwork = $scope_earthwork;
    }

    public function setScopeOther($scope_other) {
        $this->_scope_other = $scope_other;
    }


    public function setProjectType($project_type) {
        $this->_project_type = $project_type;
    }
    public function setMaterialNeeds($material_needs) {
        $this->_material_needs = $material_needs;
    }
    
    /**
     * This function is used to get the Contact listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function bidResultListing()
    {
        
        // $this->db->select('BaseTbl.*');
        // $this->db->from('amp_bid as BaseTbl');    

        $this->db->select('p.projectId,p.projectName,p.scope,p.marketType,p.buildingType,p.buildingSf,p.materialNeeds,BaseTbl.*');
        //$this->db->from('amp_bid as BaseTbl');
        $this->db->from('amp_projects as p');
        //$this->db->from('amp_projects as p');
        $this->db->join('amp_bid as BaseTbl', 'p.projectId = BaseTbl.projectId');


        //Call helper function to manage user level access.
        $user_level_where_condition = manage_user_level_condition();     
        
        if(!empty($user_level_where_condition)){
            $this->db->where($user_level_where_condition);
        }
        $this->db->where('p.isDeleted', 0);
        $this->db->order_by('BaseTbl.id', 'DESC');
        
        $this->db->limit($this->_pageNumber, $this->_offset);
        $query = $this->db->get();

        //echo $this->db->last_query();
        $result = $query->result();  
        return $result;
    }
            
    
    // get Orders List
    public function getOrders() {  

        $this->db->select('p.projectId,p.projectName,p.scope,p.marketType,p.buildingType,p.buildingSf,p.materialNeeds,BaseTbl.*');
        $this->db->from('amp_projects as p');
        $this->db->join('amp_bid as BaseTbl', 'p.projectId = BaseTbl.projectId');
               
        if(!empty($this->_job_name)){
            $this->db->like('p.projectName', $this->_job_name);
        }

        if(!empty($this->_company_name)){
            $this->db->like('BaseTbl.companyName', $this->_company_name);
        }

        

        if(!empty($this->_market_type)){
            $this->db->like('p.marketType', $this->_market_type);
        }

        if(!empty($this->_building_type)){
            $this->db->like('p.buildingType', $this->_building_type);
        }

        if(!empty($this->_all_scope)){
            $this->db->like('p.scope', $this->_all_scope);
        }

        if(!empty($this->_scope_abatement)){
            $this->db->like('p.scope', $this->_scope_abatement);
        }

        if(!empty($this->_scope_interior_demolition)){
            $this->db->like('p.scope', $this->_scope_interior_demolition);
        }

        if(!empty($this->_scope_site_demolition)){
            $this->db->like('p.scope', $this->_scope_site_demolition);
        }

        if(!empty($this->_scope_earthwork)){
            $this->db->like('p.scope', $this->_scope_earthwork);
        }

        if(!empty($this->_scope_other)){
            $this->db->like('p.scope', $this->_scope_other);
        }

        if(!empty($this->_unit_cost_sign)){
            $this->db->where('BaseTbl.unitCost'.$this->_unit_cost_sign , (int)$this->_unit_cost_value);//$this->db->like('b.unitCost', $this->_unit_cost);
        }

        if(!empty($this->_material_needs[0])){
            $materialArray = $this->_material_needs;
            $this->db->group_start();
            foreach($materialArray as $value)
            {
                $this->db->where("find_in_set('$value', `p`.`materialNeeds`)");
            }
            $this->db->group_end();
        }

        $this->db->order_by('BaseTbl.id', 'DESC');
        
        $user_level_where_condition = manage_user_level_condition();     

        if(!empty($user_level_where_condition)){
            $this->db->where($user_level_where_condition);
        }
        $this->db->where('p.isDeleted', 0);
        $query = $this->db->get();  
       //echo $this->db->last_query();die;      
        return $query->result_array();
    }


    
    public function getBidResultById($bidId) {
        // $where = array('id' => $bidId);
        // $this->db->where($where);
        // $this->db->delete('amp_bid');
        // return $this->db->affected_rows();

        $this->db->select('p.projectId,p.projectName,p.scope,p.marketType,p.buildingType,p.buildingSf,p.materialNeeds,BaseTbl.*');
        //$this->db->from('amp_bid as BaseTbl');
        $this->db->from('amp_projects as p');
        //$this->db->from('amp_projects as p');
        $this->db->join('amp_bid as BaseTbl', 'p.projectId = BaseTbl.projectId');

        //Call helper function to manage user level access.
        $user_level_where_condition = manage_user_level_condition();     
        
        if(!empty($user_level_where_condition)){
            $this->db->where($user_level_where_condition);
        }
        $this->db->where('p.isDeleted', 0);
        $this->db->where('BaseTbl.id', $bidId);
        $query = $this->db->get();

        
        $result = $query->result();  
        return $result;
    }
    
    public function deleteBid($where) {
       
        $this->db->where($where);
        $this->db->delete('amp_bid');
        return $this->db->affected_rows();
    }

    
   
   /**
     * This function is used to update the contact information
     * @param array $contactInfo : This is contact updated information
     * @param number $contactId : This is contact id
     */
    function editBidReuslts($bidInfo,$bidId)
    {
        $this->db->where('id', $bidId);
        $this->db->update('amp_bid', $bidInfo);
        
        return TRUE;
    }
     

}

