<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User_model extends CI_Model
{

    private $_limit;
    private $_pageNumber;
    private $_offset;


    /**
     * This function is used to get the user listing count.
     *
     * @param string $searchText : This is optional search text
     *
     * @return number $count : This is row count
     */
    public function userListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.createdDtm, Role.role');
        $this->db->from('amp_users as BaseTbl');
        $this->db->join('amp_roles as Role', 'Role.roleId = BaseTbl.roleId', 'left');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.roleId !=', 1);
        $this->db->where_in('BaseTbl.roleId', $_SESSION['roleAccess']);
        $query = $this->db->get();

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
     * This function is used to get the user listing count.
     *
     * @param string $searchText : This is optional search text
     * @param number $page       : This is pagination offset
     * @param number $segment    : This is pagination limit
     *
     * @return array $result : This is result
     */
    public function userListing()
    {
        $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.createdDtm, Role.role');
        $this->db->from('amp_users as BaseTbl');
        $this->db->join('amp_roles as Role', 'Role.roleId = BaseTbl.roleId', 'left');
       
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.roleId !=', 1);
        $this->db->where_in('BaseTbl.roleId', $_SESSION['roleAccess']);
        $this->db->order_by('BaseTbl.userId', 'DESC');
        $this->db->limit($this->_pageNumber, $this->_offset);
        $query = $this->db->get();

        $result = $query->result();

        return $result;
    }

    /**
     * This function is used to get the user roles information.
     *
     * @return array $result : This is result of the query
     */
    public function getUserRoles()
    {
        $this->db->select('roleId, role');
        $this->db->from('amp_roles');
        $this->db->where('roleId !=', 1);
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * This function is used to get the sales representative information.
     *
     * @return array $result : This is result of the query
     */
    public function getSalesRep()
    {
        $this->db->select('userId,name,roleId');
        $this->db->from('amp_users');
        $this->db->where('roleId =', 4);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * This function is used to get the sales representative information.
     *
     * @return array $result : This is result of the query
     */
    public function getAllActiveUser()
    {
        $this->db->select('userId,name,roleId,email');
        $this->db->from('amp_users');
        $this->db->where('roleId !=', 1);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();
        return $query->result();
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
        $this->db->select('email');
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

    /**
     * This function used to get user information by id.
     *
     * @param number $userId : This is user id
     *
     * @return array $result : This is user information
     */
    public function getUserInfo($userId)
    {
        $this->db->select('userId, name, email, mobile, roleId,extension');
        $this->db->from('amp_users');
        $this->db->where('isDeleted', 0);
        $this->db->where('roleId !=', 1);
        $this->db->where('userId', $userId);
        $query = $this->db->get();

        return $query->row();
    }


        /**
     * This function used to get user information by id.
     *
     * @param number $userId : This is user id
     *
     * @return array $result : This is user information
     */
    public function getUserData($userId)
    {
        $this->db->select('userId, name, email, mobile, roleId,extension');
        $this->db->from('amp_users');
        $this->db->where('isDeleted', 0);
        $this->db->where('userId', $userId);
        $query = $this->db->get();

        return $query->result_array();
    }

    /**
     * This function used to get user information by id.
     *
     * @param number $userId : This is user id
     *
     * @return array $result : This is user information
     */
    public function getSalesUserAssignedInfo($userId)
    {
        return $this->db->query('select amp_userassigned.userassigned as userassigned from amp_userassigned left join amp_users on amp_users.userId = amp_userassigned.userassigned 
            where userassigned > 0 and executiveId = 0 and salesManagerId ='.$userId)->result_array();                
    }

    /**
     * This function used to get user information by id.
     *
     * @param number $userId : This is user id
     *
     * @return array $result : This is user information
     */
    public function getAllSalesAgentInfo()
    {
        return $this->db->query('select amp_users.name,amp_users.userId from amp_users where roleId = 4 and isDeleted = 0')->result_array();                
    }   

    /**
     * This function used to get user information by id.
     *
     * @param number $userId : This is user id
     *
     * @return array $result : This is user information
     */
    public function getAllDepartmentInfo()
    {
        return $this->db->query('select amp_users.name,amp_users.userId from amp_users where roleId = 4 and isDeleted = 0')->result_array();                
    }

    /**
     * This function used to get user information by id.
     *
     * @param number $userId : This is user id
     *
     * @return array $result : This is user information
     */
    public function getDepartmentUserAssignedInfo($userId)
    {
        return $this->db->query('select amp_users.name,amp_userassigned.userassigned,amp_userassigned.salesManagerId,amp_userassigned.executiveId from amp_userassigned left join amp_users on amp_users.userId = amp_userassigned.salesManagerId 
            where userassigned = 0 and executiveId ='.$userId)->result_array();        
    } 

    /**
     * This function used to get user information by id.
     *
     * @param number $userId : This is user id 
     *
     * @return array $result : This is user information 
     */
    public function getSalesUserAssignedInfoByD($userId)
    {
        return $this->db->query('select amp_userassigned.salesManagerId as salesManagerId from amp_userassigned left join amp_users on amp_users.userId = amp_userassigned.salesManagerId 
            where userassigned > 0 and executiveId ='.$userId)->result_array();                
    }

    /**
    * This function is used to addNewUserAssigned.
    *
    * @return number $insert_id : This is last inserted id
    */
    public function addNewUserAssigned($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('amp_userassigned', $userInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * This function is used to deleteSalesUserAssigned.
     *
     * @param number $userId : This is user id
     *
     * @return bool $result : TRUE / FALSE
     */
    public function deleteSalesUserAssigned($userId)
    {
        $this->db->where('salesManagerId', $userId);
        $this->db->delete('amp_userassigned');

        return $this->db->affected_rows();
    }   

    /**
     * This function is used to deleteDepartmentUserAssigned.
     *
     * @param number $userId : This is user id
     *
     * @return bool $result : TRUE / FALSE
     */
    public function deleteDepartmentUserAssigned($userId)
    {
        $this->db->where('executiveId', $userId);
        $this->db->delete('amp_userassigned');

        return $this->db->affected_rows();
    }

    /**
     * This function is used to update the user information.
     *
     * @param array  $userInfo : This is users updated information
     * @param number $userId   : This is user id
     */
    public function editUser($userInfo, $userId)
    {
        $this->db->where('userId', $userId);
        $this->db->update('amp_users', $userInfo);
        return true;
    }

    /**
     * This function is used to delete the user information.
     *
     * @param number $userId : This is user id
     *
     * @return bool $result : TRUE / FALSE
     */
    public function deleteUser($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->update('amp_users', $userInfo);

        return $this->db->affected_rows();
    }


    /**
     * This function is used to match users password for change password.
     *
     * @param number $userId : This is user id
     */
    public function matchOldPassword($userId, $oldPassword)
    {
        $this->db->select('userId, password');
        $this->db->where('userId', $userId);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('amp_users');
        $user = $query->result();

        if (!empty($user)) {
            if (md5($oldPassword)==$user[0]->password) {
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    /**
     * This function is used to change users password.
     *
     * @param number $userId   : This is user id
     * @param array  $userInfo : This is user updation info
     */
    public function changePassword($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->where('isDeleted', 0);
        $this->db->update('amp_users', $userInfo);

        return $this->db->affected_rows();
    }

    /**
     * This function is used to get user login history.
     *
     * @param number $userId : This is user id
     */
    public function loginHistoryCount($userId, $searchText, $fromDate, $toDate)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.sessionData LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if (!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if (!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        if ($userId >= 1) {
            $this->db->where('BaseTbl.userId', $userId);
        }
        $this->db->from('amp_last_login as BaseTbl');
        $query = $this->db->get();

        return $query->num_rows();
    }

    /**
     * This function is used to get user login history.
     *
     * @param number $userId  : This is user id
     * @param number $page    : This is pagination offset
     * @param number $segment : This is pagination limit
     *
     * @return array $result : This is result
     */
    public function loginHistory($userId, $searchText, $fromDate, $toDate, $page, $segment)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        $this->db->from('amp_last_login as BaseTbl');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.sessionData  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if (!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if (!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        if ($userId >= 1) {
            $this->db->where('BaseTbl.userId', $userId);
        }
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();

        return $result;
    }

    /**
     * This function used to get user information by id.
     *
     * @param number $userId : This is user id
     *
     * @return array $result : This is user information
     */
    public function getUserInfoById($userId)
    {
        $this->db->select('userId, name, email, mobile, roleId');
        $this->db->from('amp_users');
        $this->db->where('isDeleted', 0);
        $this->db->where('userId', $userId);
        $query = $this->db->get();

        return $query->row();
    }

    /**
     * This function used to get user information by id with role.
     *
     * @param number $userId : This is user id
     *
     * @return aray $result : This is user information
     */
    public function getUserInfoWithRole($userId){
        $this->db->select('amp_users.userId, amp_users.email, amp_users.name, amp_users.mobile, amp_users.roleId, Roles.role');
        $this->db->from('amp_users');
        $this->db->join('amp_roles as Roles', 'Roles.roleId = amp_users.roleId');
        $this->db->where('amp_users.userId', $userId);
        $this->db->where('amp_users.isDeleted', 0);
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * This function is used to get the representative listing count.
     *
     * @param string $searchText : This is optional search text
     *
     * @return number $count : This is row count
     */
    public function repListingCount()
    {
        $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.createdDtm,BaseTbl.lastLogin');
        $this->db->from('amp_users as BaseTbl');

        $user_level_where_condition = manage_user_level_condition('view_reps');     

        if(!empty($user_level_where_condition)){
            $this->db->where($user_level_where_condition);
        }
       
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('Lead.isDeleted', 0);
        $this->db->where('BaseTbl.roleId !=',1);
        $this->db->limit($this->_pageNumber, $this->_offset);
        $query = $this->db->get();

        return $query->num_rows();
    }

    /**
     * This function is used to get the rep listing count.
     *
     * @param string $searchText : This is optional search text
     * @param number $page       : This is pagination offset
     * @param number $segment    : This is pagination limit
     *
     * @return array $result : This is result
     */
    public function repListing()
    {
        $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile,BaseTbl.createdDtm,BaseTbl.lastLogin');
        $this->db->from('amp_users as BaseTbl');
        
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('Lead.isDeleted', 0);
        $this->db->where('BaseTbl.roleId !=', 1);

        $user_level_where_condition = manage_user_level_condition('view_reps');     

        if(!empty($user_level_where_condition)){
            $this->db->where($user_level_where_condition);
        }

        $this->db->order_by('BaseTbl.userId', 'DESC');
        $this->db->limit($this->_pageNumber, $this->_offset);
        $query = $this->db->get();
       // echo $this->db->last_query(); die;  
        $result = $query->result();

        return $result;
    }

    /**
     * This function is used to get the sales representative information.
     *
     * @return array $result : This is result of the query
     */
    public function getRepInfo($userId)
    {
        $this->db->select('userId,name,email,mobile');
        $this->db->from('amp_users');
        $this->db->where('userId =', $userId);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();

        return $query->row();
    }

    /**
     * This function is used to update the rep information.
     *
     * @param array  $userInfo : This is users updated information
     * @param number $userId   : This is user id
     */
    public function editRep($repInfo, $userId)
    {
        $this->db->where('userId', $userId);
        $this->db->update('amp_users', $repInfo);

        return true;
    }

    /**
     * This function is used to delete the rep information.
     *
     * @param number $userId : This is user id
     *
     * @return bool $result : TRUE / FALSE
     */
    public function deleteRep($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->update('amp_users', $userInfo);

        return $this->db->affected_rows();
    }


     /**
     * This function is used to get the Territory manager information.
     *
     * @return array $result : This is result of the query
     */
    public function getTerritorymanager()
    {
        $this->db->select('userId,name,roleId');
        $this->db->from('amp_users');
        $this->db->where('roleId =', ROLE_TERRITORY_MANAGER);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();
        return $query->result();
    }

     public function checkLeadEmailOption($leadId){
        $this->db->select('optInId');
        $this->db->from('amp_opt_ins');
        $this->db->where('projectId', $leadId);
        $this->db->where('email', 'email');
        $query = $this->db->get();
        return $query->num_rows();
    }

    /**
     * This function is used to get the Login  information.
     *
     * @return array $result : This is result of the query
     */
    public function getLoginInfo($userId)
    {
        $this->db->select('BaseTbl.id,BaseTbl.createdDtm,BaseTbl.userId,BaseTbl.lastLogin,User.name');
        $this->db->from('amp_login_activity as BaseTbl');
        $this->db->join('amp_users as User', 'User.userId = BaseTbl.userId');
        $this->db->where('BaseTbl.userId', $userId);
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit($this->_pageNumber, $this->_offset);
        $query = $this->db->get();
        return $query->result_array();
    }

     /**
     * This function is used to get the Login  information.
     *
     * @return array $result : This is result of the query
     */
    public function getLoginInfoCount($userId)
    {
        $this->db->select('BaseTbl.id,BaseTbl.createdDtm,BaseTbl.userId,BaseTbl.lastLogin,User.name');
        $this->db->from('amp_login_activity as BaseTbl');
        $this->db->join('amp_users as User', 'User.userId = BaseTbl.userId');
        $this->db->where('BaseTbl.userId', $userId);
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit($this->_pageNumber, $this->_offset);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
}
