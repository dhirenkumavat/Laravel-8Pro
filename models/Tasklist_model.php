<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Tasklist_model extends CI_Model
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
    public function getAllTaskListing($refId)
    {
        $this->db->select('u.name as refName, p.projectId,p.projectName, BaseTbl.*,acounty.county');
        $this->db->from('amp_tasks as BaseTbl');
        $this->db->join('amp_users as u', 'u.userId = BaseTbl.userID', 'left');
        $this->db->join('amp_projects as p', 'p.projectId = BaseTbl.projectId', 'left');
        $this->db->join('amp_county as acounty', 'acounty.id = p.countyid','left');
        $this->db->where('BaseTbl.taskStatus', 0);
        $this->db->where('u.isDeleted', 0);
        if(isset($refId) && !empty($refId)){
            $this->db->where('BaseTbl.userID', $refId);
        }

        $user_level_where_condition = manage_user_level_condition();     
        if(!empty($user_level_where_condition)){
            $this->db->where($user_level_where_condition);
        }

        $this->db->order_by('BaseTbl.eventDate', 'DESC');
        $this->db->limit($this->_pageNumber, $this->_offset);
        $query = $this->db->get();

        $result = $query->result();
        //echo $this->db->last_query();
        return $result;
    }

    public function getAllUserListing()
    {
        $this->db->select('BaseTbl.userId, BaseTbl.name');
        $this->db->from('amp_users as BaseTbl');
        $this->db->where('BaseTbl.roleId != ', 1);
        $this->db->where('BaseTbl.isDeleted', 0);

        $manage_user_level_filter = manage_user_level_filter();     
        if(!empty($manage_user_level_filter)){
            $this->db->where($manage_user_level_filter);
        }
        
        $this->db->order_by('BaseTbl.userId', 'ASC');
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
    public function getTaskListInfo($taskId)
    {
        $this->db->select('taskId, name, eventDate');
        $this->db->from('amp_tasks');
        $this->db->where('taskId', $taskId);
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * This function is used to update the user information.
     *
     * @param array  $userInfo : This is users updated information
     * @param number $userId   : This is user id
     */
    public function updateTaskList($taskListInfo, $taskId)
    {
        $this->db->where('taskId', $taskId);
        $this->db->update('amp_tasks', $taskListInfo);
        return true;
    }

    /**
     * This function is used to delete the user information.
     *
     * @param number $userId : This is user id
     *
     * @return bool $result : TRUE / FALSE
     */
    public function deleteTaskList($taskId)
    {
        $this->db->where('taskId', $taskId);
        $this->db->delete('amp_tasks'); 
        return $this->db->affected_rows();
    }

    /**
     * This function is used to delete the user information.
     *
     * @param number $userId : This is user id
     *
     * @return bool $result : TRUE / FALSE
     */
    public function completeTaskList($taskId, $taskInfo)
    {
        $this->db->where('taskId', $taskId);
        $this->db->update('amp_tasks', $taskInfo);
        return true;
    }
}