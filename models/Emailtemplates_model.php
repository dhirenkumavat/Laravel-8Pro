<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Emailtemplates_model extends CI_Model
{

    private $_limit;
    private $_pageNumber;
    private $_offset;

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
     * This function is used to get the user listing count.
     *
     * @param string $searchText : This is optional search text
     * @param number $page       : This is pagination offset
     * @param number $segment    : This is pagination limit
     *
     * @return array $result : This is result
     */
    public function emailTemplateListing()
    {
        $this->db->select('*');
        $this->db->from('amp_email_templates');
        $this->db->order_by('email_template_id', 'DESC');
        $this->db->limit($this->_pageNumber, $this->_offset);
        $query = $this->db->get();

        $result = $query->result();

        return $result;
    }

    /**
     * This function is used to add new user to system.
     *
     * @return number $insert_id : This is last inserted id
     */
    public function addNewEmailTemplates($emailTemplateInfo)
    {
        $this->db->trans_start();
        $this->db->insert('amp_email_templates', $emailTemplateInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * This function used to get user information by id.
     *
     * @param number $userId : This is user id
     *
     * @return array $result : This is user information
     */
    public function getEmailTemplateInfo($email_template_id)
    {
        $this->db->select('*');
        $this->db->from('amp_email_templates');
        $this->db->where('email_template_id', $email_template_id);
        $query = $this->db->get();

        return $query->row();
    }

    /**
     * This function is used to update the user information.
     *
     * @param array  $userInfo : This is users updated information
     * @param number $userId   : This is user id
     */
    public function editEmailTemplate($emailTemplateInfo, $email_template_id)
    {
        $this->db->where('email_template_id', $email_template_id);
        $this->db->update('amp_email_templates', $emailTemplateInfo);

        return true;
    }

    /**
     * This function is used to delete the user information.
     *
     * @param number $userId : This is user id
     *
     * @return bool $result : TRUE / FALSE
     */
    public function deleteEmailTemplate($email_template_id)
    {
        $this->db->where('email_template_id', $email_template_id);
        $this->db->delete('amp_email_templates'); 

        return $this->db->affected_rows();
    }
}