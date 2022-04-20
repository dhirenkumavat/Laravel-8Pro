<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH.'/libraries/BaseController.php';

/**
 * Class : Emailtemplates (EmailtemplatesController)
 * Emailtemplates Class to control all email templates related operations.
 *
 * @author : Web Team
 *
 * @version : 1.1
 *
 * @since : 29 January 2019
 */
class Emailtemplates extends BaseController
{
    /**
     * This is default constructor of the class.
     */
    public function __construct()
    {
        parent::__construct();
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
    public function emailtemplatesListing()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
        	//total rows count 
        	$config['total_rows'] = count($this->emailtemplates_model->emailTemplateListing());
            $data['total_count'] = $config['total_rows'];
            $config['suffix'] = '';
            if ($config['total_rows'] > 0) {
                $page_number = $this->uri->segment(2);
                $config['base_url'] = base_url() . 'emailtemplatesListing/';
                if (empty($page_number))
                    $page_number = 1;
                $offset = ($page_number - 1) * $this->pagination->per_page;
                $this->emailtemplates_model->setPageNumber($this->pagination->per_page);
                $this->emailtemplates_model->setOffset($offset);
                $this->pagination->cur_page = $page_number;
                $this->pagination->initialize($config);
                $data['page_links'] = $this->pagination->create_links();
                //$data['employeeInfo'] = $this->employee->employeeList();

                $data['emailTemplateRecords'] = $this->emailtemplates_model->emailTemplateListing();
                $this->global['pageTitle'] = 'Amplify : Email Templates List';
                $this->global['PageEdit'] = "All Email Templates";
            }
            
            $this->loadViews('emailtemplates/emailtemplates', $this->global, $data, null);
        }
    }    

    /**
     * This function is used to load the add new form.
     */
    public function addEmailTemplate()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
        	$this->load->model('emailtemplates_model');

            $subject = $this->input->post('subject');
            $body = $this->input->post('body');

            $data['subject'] = $subject;
            $data['body'] = $body;

            $this->global['pageTitle'] = 'Amplify : Add New Email template';
            $this->global['PageEdit'] = "Add Email Template";
            $this->loadViews('emailtemplates/addNewEmailTemplate', $this->global, $data, null);
        }
    }

    /**
     * This function is used to add new user to the system.
     */
    public function addNewEmailTemplate()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('subject', 'Subject', 'required');
            $this->form_validation->set_rules('body', 'Body', 'required');

            if ($this->form_validation->run() == false) {
                $this->addEmailTemplate();
            } else {
                $subject = $this->input->post('subject');
                $body = $this->input->post('body');

                $emailTemplateInfo = array('subject' => $subject, 'body' => $body, 'created_date' => date('Y-m-d H:i:s'), 'modified_date' => date('Y-m-d H:i:s') );

                $this->load->model('emailtemplates_model');
                $result = $this->emailtemplates_model->addNewEmailTemplates($emailTemplateInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Email Template created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Email Template creation failed');
                }

                redirect('emailtemplatesListing');
            }
        }
    }

    /**
     * This function is used load user edit information.
     *
     * @param number $userId : Optional : This is user id
     */
    public function editEmailTemplate($email_template_id = null)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            if ($email_template_id == null) {
                redirect('emailtemplatesListing');
            }

            $data['emailTemplateInfo'] = $this->emailtemplates_model->getEmailTemplateInfo($email_template_id);

            $this->global['pageTitle'] = 'Amplify : Edit Email Template';
            $this->global['PageEdit'] = "Edit Email Template: ".$data['emailTemplateInfo']->subject;
            $this->loadViews('emailtemplates/editEmailTemplate', $this->global, $data, null);
        }
    }

    /**
     * This function is used to edit the user information.
     */
    public function saveEmailTemplate()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $email_template_id = $this->input->post('email_template_id');

            $this->form_validation->set_rules('subject', 'Subject', 'required');
            $this->form_validation->set_rules('body', 'Body', 'required');

            if ($this->form_validation->run() == false) {
                $this->editEmailTemplate($email_template_id);
            } else {
                $subject = $this->input->post('subject');
                $body = $this->input->post('body');

                $emailTemplateInfo = array('subject' => $subject, 'body' => $body, 'modified_date' => date('Y-m-d H:i:s') );

                $result = $this->emailtemplates_model->editEmailTemplate($emailTemplateInfo, $email_template_id);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Email Template updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Email Template updation failed');
                }

                redirect('emailtemplatesListing');
            }
        }
    }

    /**
     * This function is used to delete the user using userId.
     *
     * @return bool $result : TRUE / FALSE
     */
    public function deleteEmailTemplate()
    {
        if ($this->isAdmin() == true) {
            echo json_encode(array('status' => 'access'));
        } else {
            $email_template_id = $this->input->post('email_template_id');
            $result = $this->emailtemplates_model->deleteEmailTemplate($email_template_id);

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
