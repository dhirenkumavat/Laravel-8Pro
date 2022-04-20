<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require APPPATH.'/libraries/BaseController.php';
class Tasklist extends BaseController
{
    /**
     * This is default constructor of the class.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('tasklist_model');
        $this->load->model('emailtemplates_model');
        $this->load->library('pagination');
        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the email templates.
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Amplify : Dashboard';
        $this->loadViews('dashboard', $this->global, null, null);
    }

    /**
     * This function is used to load the email templates list.
     */
    public function taskListing()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $repListId = $this->security->xss_clean($this->input->post('repListId'));
            $data['repListId'] = $repListId;
        	//total rows count
        	$config['total_rows'] = count($this->tasklist_model->getAllTaskListing($repListId));
            $data['total_count'] = $config['total_rows'];
            $config['suffix'] = '';


            $data['getAllTaskListingRecords'] = $this->tasklist_model->getAllTaskListing($repListId);
            $data['getAllUserListingRecords'] = $this->tasklist_model->getAllUserListing();
            $this->global['pageTitle'] = 'Amplify : Task Lists';
            $this->global['PageEdit'] = "All Tasks";
            $this->loadViews('tasklist/tasklisting', $this->global, $data, null);
        }
    }

    /**
     * This function is used load user edit information.
     *
     * @param number $userId : Optional : This is user id
     */
    public function editTaskList($taskId = null)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            if ($taskId == null) {
                redirect('taskListing');
            }

            $data['getTaskListInfo'] = $this->tasklist_model->getTaskListInfo($taskId);

            $this->global['pageTitle'] = 'Amplify : Edit Task List';
            $this->global['PageEdit'] = "Edit Task: ".$data['getTaskListInfo']->name;
            $this->loadViews('tasklist/editTasklist', $this->global, $data, null);
        }
    }

    /**
     * This function is used to edit the user information.
     */
    public function saveTaskList()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $taskId = $this->input->post('taskId');

            $this->form_validation->set_rules('message', 'Message', 'required');
            $this->form_validation->set_rules('eventDate', 'Event Date', 'required');

            if ($this->form_validation->run() == false) {
                $this->editTaskList($taskId);
            } else {
                $message = $this->input->post('message');
                $eventDate = $this->input->post('eventDate');
                $taskExpDate = date("Y-m-d", strtotime($eventDate));
                //die();
                $taskListInfo = array('name' => $message, 'eventDate' => $taskExpDate );

                $result = $this->tasklist_model->updateTaskList($taskListInfo, $taskId);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Task List updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Task List updation failed');
                }

                redirect('taskListing');
            }
        }
    }

    /**
     * This function is used to delete the user using userId.
     *
     * @return bool $result : TRUE / FALSE
     */
    public function deleteTaskList()
    {
        if ($this->isAdmin() == true) {
            echo json_encode(array('status' => 'access'));
        } else {
            $taskId = $this->input->post('taskId');
            $result = $this->tasklist_model->deleteTaskList($taskId);

            if ($result > 0) {
                echo json_encode(array('status' => true));
            } else {
                echo json_encode(array('status' => false));
            }
        }
    }

    /**
     * This function is used to delete the user using userId.
     *
     * @return bool $result : TRUE / FALSE
     */
    public function completeTaskList()
    {
        if ($this->isAdmin() == true) {
            echo json_encode(array('status' => 'access'));
        } else {
            $taskId = $this->input->post('taskId');
            $taskInfo = array('taskStatus'=>1); // Comeplete task
            $result = $this->tasklist_model->completeTaskList($taskId,$taskInfo);

            if ($result > 0) {
                echo json_encode(array('status' => true));
            } else {
                echo json_encode(array('status' => false));
            }
        }
    }

    /**
     * Page not found : error 404.
     */
    public function pageNotFound()
    {
        $this->global['pageTitle'] = 'Amplify : 404 - Page Not Found';
        $this->loadViews('404', $this->global, null, null);
    }
}
