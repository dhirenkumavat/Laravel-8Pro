<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Common_model extends CI_Model {
    function setFlashData($status, $flashMsg){
        //if(!function_exists('setFlashData')){
            $CI = get_instance();
            $CI->session->set_flashdata($status, $flashMsg);
        //}
    }

    function getSmtpSetting($logInUserId){
        $this->db->select('BaseTbl.mail_server,BaseTbl.username,BaseTbl.password');
        $this->db->from('amp_smtp as BaseTbl');
        $this->db->where('userid', $logInUserId);
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row_array();        
        return $result;
    }

    // get data with where condition
    public function select_where($table, $field) {
        $this->db->where($field);
        $query = $this->db->get($table);
        return $query->row_array();
    }

}
