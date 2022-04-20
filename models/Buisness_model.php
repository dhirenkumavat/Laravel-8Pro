<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Buisness_model extends CI_Model
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


    public function setClientName($client_name) {

        $this->_client_name = $client_name;
    }

    public function setBuisnessType($buisness_type) {
        $this->_buisness_type= $buisness_type;
    }

    
    /**
     * This function is used to get the Contact listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function buisnessListing()
    {
        
        // $this->db->select('BaseTbl.*');
        // $this->db->from('amp_bid as BaseTbl');    

        $this->db->select('BaseTbl.*');
        $this->db->from('amp_clients as BaseTbl');
        //$this->db->from('amp_projects as p');
        //$this->db->join('amp_projects as p', 'BaseTbl.projectId = p.projectId');


        //Call helper function to manage user level access.
        $user_level_where_condition = manage_user_level_condition();     
        
        // if(!empty($user_level_where_condition)){
        //     $this->db->where($user_level_where_condition);
        // }

        $this->db->order_by('BaseTbl.id', 'DESC');
        
        $this->db->limit($this->_pageNumber, $this->_offset);
        $query = $this->db->get();

        
        $result = $query->result();  
        return $result;
    }
            
    
    // get Orders List
    public function getOrders() {  

        $this->db->select('BaseTbl.*');
        $this->db->from('amp_clients as BaseTbl');

        if(!empty($this->_client_name)){
            $this->db->like('BaseTbl.client_name', $this->_client_name);
        }

        if(!empty($this->_buisness_type)){
            $this->db->like('BaseTbl.buisness_type', $this->_buisness_type);
        }

        

        $this->db->order_by('BaseTbl.id', 'DESC');
        
        $user_level_where_condition = manage_user_level_condition();     

        // if(!empty($user_level_where_condition)){
        //     $this->db->where($user_level_where_condition);
        // }

        $query = $this->db->get();  
       //echo $this->db->last_query();die;      
        return $query->result_array();
    }


    
    
    public function deleteBuisness($buisnessId) {

        $this->db->select('BaseTbl.*');
        $this->db->from('amp_clients as BaseTbl');
        //$this->db->from('amp_project_clients as p');
        $this->db->join('amp_project_clients as p', 'BaseTbl.id = p.clientId');
        $this->db->where(array('BaseTbl.id'=>$buisnessId));
        //Call helper function to manage user level access.
        // $user_level_where_condition = manage_user_level_condition();     
        
        // if(!empty($user_level_where_condition)){
        //     $this->db->where($user_level_where_condition);
        // }

        //$this->db->order_by('BaseTbl.id', 'DESC');
        
        //$this->db->limit($this->_pageNumber, $this->_offset);
        $query = $this->db->get();

        
        $result = $query->result();  
        //echo $this->db->last_query();die;
        
        if(!empty($result)){
            return 0;
        }else{
            $this->db->where(array('id'=>$buisnessId));
            $this->db->delete('amp_clients');
            //echo $this->db->last_query();die;
            return $this->db->affected_rows();
        }
    }

    /**
     * This function used to get contact information by id
     * @param number $contactid : This is contact id
     * @return array $result : This is user information
     */
    function getBuisnessInfo($buisnesstId)
    {
        $this->db->select('*');
        $this->db->from('amp_clients');
        $this->db->where('id', $buisnesstId);
        $query = $this->db->get();
        
        return $query->row();
    }

    /**
     * This function is used to update the contact information
     * @param array $contactInfo : This is contact updated information
     * @param number $contactId : This is contact id
     */
    function editBuisness($buisnessInfo,$buisnessId)
    {
        $this->db->where('id', $buisnessId);
        $this->db->update('amp_clients', $buisnessInfo);
        
        return TRUE;
    }
    

}

