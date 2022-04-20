<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Export Model
 *
 * @author Saurabh Kadam
 *
 * Date  24-10-2018
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Export_model extends CI_Model {
    // get project list
    /**
     * This function is used to get the project listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function projectList()
    {
        
        $url= $_SERVER['HTTP_REFERER'];
        $uriMethod = explode("/",$url);
        
        $this->db->select('BaseTbl.projectId,BaseTbl.userID,BaseTbl.sales,BaseTbl.is_priority,BaseTbl.projectName,BaseTbl.scope,BaseTbl.dueDate,BaseTbl.jobWalkTime,BaseTbl.address,BaseTbl.estimator,BaseTbl.mainContact, BaseTbl.createdDtm, BaseTbl.salesRepId, BaseTbl.stageId, BaseTbl.bid_price,BaseTbl.contract,BaseTbl.company,User.name,Stage.stageName,BaseTbl.phoneNo1,BaseTbl.email,BaseTbl.updatedDtm,BaseTbl.filesystem_id,BaseTbl.notes,BaseTbl.ownership,BaseTbl.businessOwner,jobtype.jobType,jobtype.color,pc.projectId,pc.contactId,pcontact.contact_email,pcontact.contact_phone');
        $this->db->from('amp_projects as BaseTbl');
        $this->db->join('amp_users as User', 'User.userId = BaseTbl.sales','left');
        $this->db->join('amp_stages as Stage', 'Stage.stageId = BaseTbl.stageId','left');
        $this->db->join('amp_jobtype as jobtype', 'jobtype.id = BaseTbl.jobtypeid','left');
        $this->db->join('amp_project_contact as pc', 'pc.projectId = BaseTbl.projectId');
        $this->db->join('amp_contact as pcontact', 'pcontact.id = pc.contactId');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->group_by('pc.projectId'); 
       
        switch ($uriMethod[3]) {
            case 'prospects':
                $stageId = 2;
                break;
            case 'activeProject':
                $stageId = 11;
                break;
            case 'pendingBids':
                $stageId = 5;
                break;
            case 'pendingBudget':
                $stageId = 1;
                break;
            case 'percent':
                $stageId = 13;
                break;
            case 'completedProject':
                $stageId = 12;
                break;
            case 'lost':
                $stageId = 10;
                break;
            default:
                $stageId = "";
                break;
        }
        if (!empty($stageId)) {
            $this->db->where('Stage.stageId', $stageId);
        }
        $user_level_where_condition = manage_user_level_condition();     
        if(!empty($user_level_where_condition) && ($uriMethod[3] == 'projectListing' || $uriMethod[3] == 'prospectsProjectListing' || $uriMethod[3] == 'prospects')){
            $this->db->where($user_level_where_condition);
        }
        $this->db->order_by('BaseTbl.projectId', 'ASC');
        $query = $this->db->get();
        $result = $query->result(); 
        //echo $this->db->last_query();die;
        return $result;
    }


     /**
     * This function is used to get the communication listing 
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function communicationList()
    {
        $this->db->select('BaseTbl.communicationId, BaseTbl.type,BaseTbl.data,BaseTbl.froms,BaseTbl.to,BaseTbl.createdDtm');
        $this->db->from('amp_communications as BaseTbl');
        $this->db->join('amp_projects as Project', 'Project.projectId = BaseTbl.projectId','left');
       
        $this->db->order_by('BaseTbl.communicationId', 'DESC');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }


    /**
     * This function is used to get the project listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function projectListbyId($projectId)
    {
        $method = $this->router->fetch_method();
        $this->db->select('BaseTbl.projectId, BaseTbl.firstName, BaseTbl.lastName, BaseTbl.createdDtm, BaseTbl.salesRepId, BaseTbl.stageId,User.name, BaseTbl.sales');
        $this->db->from('amp_projects as BaseTbl');
        $this->db->join('amp_users as User', 'User.userId = BaseTbl.sales','left');
        
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.projectId', $projectId);
        // $user_level_where_condition = manage_user_level_condition();     

        // if(!empty($user_level_where_condition) && ($method == 'projectListing' || $method == 'prospectsProjectListing')){
        //     $this->db->where($user_level_where_condition);
        // }

        $this->db->order_by('BaseTbl.projectId', 'ASC');
        $query = $this->db->get();
        $result = $query->result(); 
        return $result;
    }


    /**
     * This function is used to get the project listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function projectListsId($projectId)
    {
        $this->db->select('BaseTbl.projectId, BaseTbl.firstName, BaseTbl.lastName, BaseTbl.createdDtm, BaseTbl.salesRepId, BaseTbl.stageId,User.name,BaseTbl.sales');
        $this->db->from('amp_projects as BaseTbl');
        $this->db->join('amp_users as User', 'User.userId = BaseTbl.sales','left');
        
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.projectId', $projectId);
        $this->db->order_by('BaseTbl.projectId', 'ASC');
        $query = $this->db->get();
        $result = $query->result_array(); 
        return $result;
    }
}
?>