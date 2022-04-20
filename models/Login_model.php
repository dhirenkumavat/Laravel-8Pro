<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Login_model extends CI_Model {
    /**
     * This function used to check the login credentials of the user.
     *
     * @param string $email    : This is email of the user
     * @param string $password : This is encrypted password of the user
     */
    public function check_login($email, $password){
        $this->db->select('amp_users.userId, amp_users.password, amp_users.name, amp_users.roleId,amp_users.extension, Roles.role,amp_users.extension');
        $this->db->from('amp_users');
        $this->db->join('amp_roles as Roles', 'Roles.roleId = amp_users.roleId');
        $this->db->where('amp_users.email', $email);
        $this->db->where('amp_users.isDeleted', 0);
        $query = $this->db->get();
        $user  = $query->row();
        if (!empty($user)) {
            if (md5($password) == $user->password) {
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    /**
     * This function used to save login information of user
     * @param array $loginInfo : This is users login information
     */
    function lastLogin($userId,$loginInfo){
        
        $this->db->where('userId', $userId);
        $this->db->update('amp_users', $loginInfo);
       // echo $this->db->last_query();die;        
        return TRUE;       
    }

     /**
     * This function is used to add login Details
     * @return number $insert_id : This is last inserted id
     */
    function insertLoginInfo($insertloginInfo){
        $this->db->trans_start();
        $this->db->insert('amp_login_activity', $insertloginInfo);
        $this->db->trans_complete();        
        return TRUE;
    }

    /**
     * This function used to insert reset password data.
     *
     * @param {array} $data : This is reset password data
     *
     * @return {boolean} $result : TRUE/FALSE
     */
    public function resetPasswordUser($data)
    {
        $result = $this->db->insert('amp_reset_password', $data);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }


     /**
     * This function used to check email exists or not.
     *
     * @param {string} $email : This is users email id
     *
     * @return {boolean} $result : TRUE/FALSE
     */
    public function checkEmailExist($email)
    {
        $this->db->select('userId');
        $this->db->where('email', $email);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('amp_users');

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * This function is used to get customer information by email-id for forget password email.
     *
     * @param string $email : Email id of customer
     *
     * @return object $result : Information of customer
     */
    public function getCustomerInfoByEmail($email)
    {
        $this->db->select('userId, email, name');
        $this->db->from('amp_users');
        $this->db->where('isDeleted', 0);
        $this->db->where('email', $email);
        $query = $this->db->get();

        return $query->row();
    }

    /**
     * This function used to check correct activation deatails for forget password.
     *
     * @param string $email         : Email id of user
     * @param string $activation_id : This is activation string
     */
    public function checkActivationDetails($email, $activation_id)
    {
        $this->db->select('id');
        $this->db->from('amp_reset_password');
        $this->db->where('email', $email);
        $this->db->where('activation_id', $activation_id);
        $query = $this->db->get();

        return $query->num_rows();
    }

    // This function used to create new password by reset link
    public function createPasswordUser($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->where('isDeleted', 0);
        $this->db->update('amp_users', array('password' => md5($password)));
        $this->db->delete('amp_reset_password', array('email' => $email));
    }

    

    /**
     * This function is used to get last login info by user id
     * @param number $userId : This is user id
     * @return number $result : This is query result
     */
    function lastLoginInfo($userId){
        $this->db->select('BaseTbl.createdDtm');
        $this->db->where('BaseTbl.userId', $userId);
        $this->db->order_by('BaseTbl.userId', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('amp_users as BaseTbl');

        return $query->row();
    }

    /**
     * This function used to check the login credentials of the user.
     *
     * @param string $email    : This is email of the user
     * @param string $password : This is encrypted password of the user
     */
    public function checkUser($userId){
        $this->db->select('BaseTbl.userId, BaseTbl.password, BaseTbl.name, BaseTbl.roleId,BaseTbl.email');
        $this->db->from('amp_users as BaseTbl');
        $this->db->where('BaseTbl.userId', $userId);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();

        $result = $query->row_array();        
        return $result;
    }
}
