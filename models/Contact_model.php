<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Contact_model extends CI_Model
{

    private $_limit;
    private $_pageNumber;
    private $_offset;

    private $_contact_name;
    private $_business_name;
    private $_contact_phone;
    private $_contact_email;

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


    public function setContactName($contact_name) {
        $this->_contact_name = $contact_name;
    }

    public function setBusinessName($business_name) {
        $this->_business_name = $business_name;
    }

    public function setContactPhone($contact_phone) {
        $this->_contact_phone = $contact_phone;
    }

    public function setContactEmail($contact_email) {
        $this->_contact_email = $contact_email;
    }

    public function setAssignedTo($assigned_to) {
        $this->_assigned_to = $assigned_to;
    }

    public function setContactNotes($notes) {
        $this->_contact_notes = $notes;
    }

    public function setBuisnessType($buisness_type) {
        $this->_buisness_type = $buisness_type;
    }
    
    /**
     * This function is used to get the Contact listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function contactListing()
    {
        
        $this->db->select('BaseTbl.id as contactId ,BaseTbl.contact_name,BaseTbl.contact_phone,BaseTbl.contact_email,BaseTbl.assigned_to,BaseTbl.comment,Cl.client_name,Cl.buisness_type,Cl.address,Cl.phone_no,Cl.created_at');
        $this->db->from('amp_contact as BaseTbl');
        $this->db->join('amp_clients as Cl', 'Cl.id = BaseTbl.clientId', 'left');      

        //Call helper function to manage user level access.
        $user_level_where_condition = manage_user_level_condition();     

        // if(!empty($user_level_where_condition)){
        //     $this->db->where($user_level_where_condition);
        // }

        $this->db->order_by('BaseTbl.id', 'DESC');
        
        $this->db->limit($this->_pageNumber, $this->_offset);
        $query = $this->db->get();

        //echo $this->db->last_query();die;
        
        $result = $query->result();        
        return $result;
    }
            
    
    // get Orders List
    public function getOrders() {        
        // $this->db->select('BaseTbl.*');
        // $this->db->from('amp_contact as BaseTbl'); 

         $this->db->select('BaseTbl.id as contactId ,BaseTbl.contact_name,BaseTbl.contact_phone,BaseTbl.contact_email,BaseTbl.assigned_to,BaseTbl.comment ,Cl.*');
        $this->db->from('amp_contact as BaseTbl');
        $this->db->join('amp_clients as Cl', 'Cl.id = BaseTbl.clientId', 'left');    

               
        if(!empty($this->_contact_name)){
            $this->db->like('BaseTbl.contact_name', $this->_contact_name);
        }

        if(!empty($this->_business_name)){
            $this->db->like('Cl.client_name', $this->_business_name);
        }

        if(!empty($this->_buisness_type)){
            $this->db->like('Cl.buisness_type', $this->_buisness_type);
        }

        if(!empty($this->_contact_phone)){
            $this->db->like('BaseTbl.contact_phone', $this->_contact_phone);
        }

        if(!empty($this->_contact_email)){
            $this->db->like('BaseTbl.contact_email', $this->_contact_email);
        }

        if(!empty($this->_assigned_to)){
            $this->db->like('BaseTbl.assigned_to', $this->_assigned_to);
        }

        if(!empty($this->_contact_notes)){
            $this->db->like('BaseTbl.comment', $this->_contact_notes);
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


    /**
     * This function is used to get the Client listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function getClientList()
    {
        
        $this->db->select('BaseTbl.*');
        $this->db->from('amp_clients as BaseTbl');       

        $this->db->order_by('BaseTbl.id', 'DESC');
        
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function getUserList()
    {
        
        $this->db->select('userId, name');
        $this->db->from('amp_users');       
        $this->db->order_by('userId', 'DESC');
        $query = $this->db->get();
        $result = $query->result();        
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
     * This function used to get contact information by id
     * @param number $contactid : This is contact id
     * @return array $result : This is user information
     */
    function getContactInfo($contactId)
    {
        $this->db->select('*');
        $this->db->from('amp_contact');
        $this->db->where('id', $contactId);
        $query = $this->db->get();
        
        return $query->row();
    }

    function getClientAddress($clientId)
    {
        $this->db->select('*');
        $this->db->from('amp_clients');
        $this->db->where('id', $clientId);
        $query = $this->db->get();
        
        return $query->row();
    }

    
    public function deleteContact($where) {
        $this->db->where($where);
        $this->db->delete('amp_contact');
        return $this->db->affected_rows();
    }

    public function deleteContactOptIn($where) {
        $this->db->where($where);
        $this->db->delete('amp_contact_opt_ins');
        return $this->db->affected_rows();
    }

    /**
     * This function used to get option information by id
     * @param number $contactid : This is contact id
     * @return array $result : This is user information
     */
    function getOptionData($contactId)
    {
        $this->db->select('BaseTbl.sms,BaseTbl.calls,BaseTbl.email,BaseTbl.other');
        $this->db->from('amp_contact_opt_ins as BaseTbl');
        $this->db->where('contactId', $contactId);
        $query = $this->db->get();
        $result = $query->result_array();        
        return $result;
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
     * This function used to save client
     */
    function addContact($contactInfo){
        $this->db->insert('amp_contact',$contactInfo);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }

    /**
     * This function is used to update the option data information
     * @param array $contactInfo : This is contact updated information
     * @param number $contactId : This is contact id
     */
    function editoptionData($optionDataInfo, $contactId)
    {
        $this->db->where('contactId', $contactId);
        $this->db->update('amp_contact_opt_ins', $optionDataInfo);
        if($this->db->affected_rows()==0){
            $optionDataInfo['contactId'] = $contactId;
            $this->db->insert('amp_contact_opt_ins',$optionDataInfo);
        }        
        return TRUE;
    }

    /**
     * This function is used to update the contact information
     * @param array $contactInfo : This is contact updated information
     * @param number $contactId : This is contact id
     */
    function editContact($contactInfo, $contactId)
    {
        $this->db->where('id', $contactId);
        $this->db->update('amp_contact', $contactInfo);
        
        return TRUE;
    }


    /**
     * This function is used to add new communication
     * @return number $insert_id : This is last inserted id
     */
    function addCommunication($communicationInfo)
    {
        $this->db->trans_start();
        $this->db->insert('amp_contact_communications', $communicationInfo);
        
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        //echo $this->db->last_query();die;
        return $insert_id;
    }

    /**
     * This function used to get communication information by id
     * @param number $projectId : This is lead id
     * @return array $result : This is user information
     */
    function getCommunication($contactId)
    {
        $this->db->select('*');
        $this->db->from('amp_contact_communications');
        $this->db->where('contactId', $contactId);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function getCommunicationDetails($communicationId){
        $this->db->select('*');
        $this->db->from('amp_contact_communications');
        $this->db->where('communicationId', $communicationId);
        $query = $this->db->get();        
        $result = $query->result();        
        return $result;
    }
}

