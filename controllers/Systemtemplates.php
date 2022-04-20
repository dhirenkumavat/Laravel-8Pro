<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH.'/libraries/BaseController.php';

/**
 * Class : Systemtemplates (SystemtemplatesController)
 * Systemtemplates Class to control all system templates related operations.
 *
 * @author : Web Team
 *
 * @version : 1.1
 *
 * @since : 26 June 2020
 */
class Systemtemplates extends BaseController
{
    /**
     * This is default constructor of the class.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('systemtemplates_model');
        $this->load->library('pagination');
        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the system templates.
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Amplify : Dashboard';

        $this->loadViews('dashboard', $this->global, null, null);
    }

    /**
     * This function is used to load the system templates list.
     */
    public function systemtemplatesListing()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
        	//total rows count 
        	$config['total_rows'] = count($this->systemtemplates_model->systemTemplateListing());
            $data['total_count'] = $config['total_rows'];
            $config['suffix'] = '';
            if ($config['total_rows'] > 0) {
                $page_number = $this->uri->segment(2);
                $config['base_url'] = base_url() . 'systemtemplatesListing/';
                if (empty($page_number))
                    $page_number = 1;
                $offset = ($page_number - 1) * $this->pagination->per_page;
                $this->systemtemplates_model->setPageNumber($this->pagination->per_page);
                $this->systemtemplates_model->setOffset($offset);
                $this->pagination->cur_page = $page_number;
                $this->pagination->initialize($config);
                $data['page_links'] = $this->pagination->create_links();
                //$data['employeeInfo'] = $this->employee->employeeList();

                $data['systemTemplateRecords'] = $this->systemtemplates_model->systemTemplateListing();
                $this->global['pageTitle'] = 'Amplify : System Templates List';
                $this->global['PageEdit'] = "All System Templates";
            }
            
            $this->loadViews('systemtemplates/systemtemplates', $this->global, $data, null);
        }
    }    

    /**
     * This function is used to load the add new form.
     */
    public function addSystemTemplate()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
        	$this->load->model('systemtemplates_model');

            $subject = $this->input->post('subject');
            $body = $this->input->post('body');

            $data['subject'] = $subject;
            $data['body'] = $body;

            $this->global['pageTitle'] = 'Amplify : Add New System template';
            $this->global['PageEdit'] = "Add System Template";
            $this->loadViews('systemtemplates/addNewSystemTemplate', $this->global, $data, null);
        }
    }

    /**
     * This function is used to add new user to the system.
     */
    public function addNewSystemTemplate()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('subject', 'Subject', 'required');
            $this->form_validation->set_rules('body', 'Body', 'required');

            if ($this->form_validation->run() == false) {
                $this->addSystemTemplate();
            } else {
                $subject = $this->input->post('subject');
                $body = $this->input->post('body');

                $systemTemplateInfo = array('subject' => $subject, 'body' => $body, 'created_date' => date('Y-m-d H:i:s'), 'modified_date' => date('Y-m-d H:i:s') );

                $this->load->model('systemtemplates_model');
                $result = $this->systemtemplates_model->addNewSystemTemplates($systemTemplateInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New System Template created successfully');
                } else {
                    $this->session->set_flashdata('error', 'System Template creation failed');
                }

                redirect('systemtemplatesListing');
            }
        }
    }

    /**
     * This function is used load user edit information.
     *
     * @param number $userId : Optional : This is user id
     */
    public function editSystemTemplate($system_template_id = null)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            if ($system_template_id == null) {
                redirect('systemtemplatesListing');
            }

            $data['systemTemplateInfo'] = $this->systemtemplates_model->getSystemTemplateInfo($system_template_id);

            $this->global['pageTitle'] = 'Amplify : Edit System Template';
            $this->global['PageEdit'] = "Edit System Template: ".$data['systemTemplateInfo']->subject;
            $this->loadViews('systemtemplates/editSystemTemplate', $this->global, $data, null);
        }
    }

    /**
     * This function is used to edit the user information.
     */
    public function saveSystemTemplate()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $system_template_id = $this->input->post('system_template_id');

            $this->form_validation->set_rules('subject', 'Subject', 'required');
            $this->form_validation->set_rules('body', 'Body', 'required');

            if ($this->form_validation->run() == false) {
                $this->editSystemTemplate($system_template_id);
            } else {
                $subject = $this->input->post('subject');
                $body = $this->input->post('body');

                $systemTemplateInfo = array('subject' => $subject, 'body' => $body, 'modified_date' => date('Y-m-d H:i:s') );

                $result = $this->systemtemplates_model->editSystemTemplate($systemTemplateInfo, $system_template_id);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'System Template updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'System Template updation failed');
                }

                redirect('systemtemplatesListing');
            }
        }
    }

    /**
     * This function is used to delete the user using userId.
     *
     * @return bool $result : TRUE / FALSE
     */
    public function deleteSystemTemplate()
    {
        if ($this->isAdmin() == true) {
            echo json_encode(array('status' => 'access'));
        } else {
            $system_template_id = $this->input->post('system_template_id');
            $result = $this->systemtemplates_model->deleteSystemTemplate($system_template_id);

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
