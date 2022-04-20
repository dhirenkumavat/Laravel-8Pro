<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	 /**
     * This is default constructor of the class.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('login_model','common_model'));
        $this->load->library('email');
    }
	/**
     * Index Page for this controller.
     */
    public function index()
    {
        $this->isLoggedIn();
    }

    /**
     * This function used to check the user is logged in or not.
     */
    public function isLoggedIn()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');

        if (!isset($isLoggedIn) || $isLoggedIn != true) {
            $this->load->view('login');
        } else {
            redirect('/dashboard');
        }
    }

	/**
     * This function used to logged in user.
     */
    public function loginCheck(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[32]');
        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $email 		= strtolower($this->security->xss_clean($this->input->post('email')));
            $password 	= $this->input->post('password');
            $result 	= $this->login_model->check_login($email, $password);
            if (!empty($result)) {
                $sessionArray = array('userId' 		=> $result->userId,
                                        'role' 		=> $result->roleId,
                                        'roleText' 	=> $result->role,
                                        'name' 		=> $result->name,
                                        'lastLogin' => date("Y-m-d h:i:s"),
                                        'isLoggedIn'=> true,
                                        'extension' => $result->extension,
                                );
                //Set user details into session variable
                $this->session->set_userdata($sessionArray);
                unset($sessionArray['userId'],$sessionArray['lastLogin']);
                $loginInfo 			= array('lastLogin' => date("Y-m-d h:i:s"));
                $insertloginInfo 	= array('lastLogin' => date("Y-m-d h:i:s"),'userId'=>$result->userId,'createdDtm'=> date("h:i:s"));
                $this->login_model->lastLogin($result->userId,$loginInfo);
                $this->login_model->insertLoginInfo($insertloginInfo);
                redirect('/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Email or password mismatch');
                $this->index();
            }
        }
    }

    public function logout(){        
        $this->session->sess_destroy();
        redirect('login');
    }

     /**
     * This function used to load forgot password view.
     */
    public function forgotPassword()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        if (!isset($isLoggedIn) || $isLoggedIn != true) {
            $this->load->view('forgotPassword');
        } else {
            // redirect('/dashboard');
         $this->load->view('forgotPassword');   
        }
    }


    /**
     * This function used to reset the password.
     *
     * @param string $activation_id : This is unique id
     * @param string $email         : This is user email
     */
    public function resetPasswordConfirmUser($activation_id, $email)
    {
        // Get email and activation code from URL values at index 3-4
        $email = urldecode($email);

        // Check activation id in database
        $is_correct = $this->login_model->checkActivationDetails($email, $activation_id);

        $data['email'] = $email;
        $data['activation_code'] = $activation_id;

        if ($is_correct == 1) {
            $this->load->view('newPassword', $data);
        } else {
            redirect('/login');
        }
    }

     /**
     * This function used to create new password for user.
     */
    public function createPasswordUser()
    {
        $status = '';
        $message = '';
        $email = strtolower($this->input->post('email'));
        $activation_id = $this->input->post('activation_code');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('password', 'Password', 'required|max_length[20]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]|max_length[20]');

        if ($this->form_validation->run() == false) {
            $this->resetPasswordConfirmUser($activation_id, urlencode($email));
        } else {
            $password = $this->input->post('password');
            $cpassword = $this->input->post('cpassword');

            // Check activation id in database
            $is_correct = $this->login_model->checkActivationDetails($email, $activation_id);

            if ($is_correct == 1) {
                $this->login_model->createPasswordUser($email, $password);

                $status = 'success';
                $message = 'Password reset successfully';
            } else {
                $status = 'error';
                $message = 'Password reset failed';
            }

            setFlashData($status, $message);

            redirect('/login');
        }
    }

    /**
     * This function used to generate reset password request link.
     */
    public function resetPasswordUser()
    {
        $status = '';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('login_email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == false) {
            $this->forgotPassword();
        } else {
            $email = strtolower($this->security->xss_clean($this->input->post('login_email')));
            if ($this->login_model->checkEmailExist($email)) {
                $encoded_email = urlencode($email);
                $this->load->helper('string');
                $data['email'] = $email;
                $data['activation_id'] = random_string('alnum', 15);
                $data['createdDtm'] = date('Y-m-d H:i:s');
                $data['agent'] = getBrowserAgent();
                $data['client_ip'] = $this->input->ip_address();
                $save = $this->login_model->resetPasswordUser($data);
                if ($save) {
                    $data1['reset_link'] = base_url().'resetPasswordConfirmUser/'.$data['activation_id'].'/'.$encoded_email;
                    $userInfo = $this->login_model->getCustomerInfoByEmail($email);
                    if (!empty($userInfo)) {
                        $data1['name'] = $userInfo->name;
                        $data1['email'] = $userInfo->email;
                        $data1['message'] = 'Reset Your Password';
                    }
                    $sendStatus = $this->resetPasswordEmail($data1);
                    if ($sendStatus) {
                        $status = 'send';
                        $this->common_model->setFlashData($status, 'Reset password link sent successfully, please check mails.');
                    } else {
                        $status = 'notsend';
                        $this->common_model->setFlashData($status, 'Email has been failed, try again.');
                    }
                } else {
                    $status = 'unable';
                    $this->common_model->setFlashData($status, 'It seems an error while sending your details, try again.');
                }
            } else {
                $status = 'invalid';
                $this->common_model->setFlashData($status, 'This email is not registered with us.');
            }
            redirect('login/forgotPassword');
        }
    }


     /**
     * This function is used to send email
     *
     */
     public function resetPasswordEmail($detail){    

        $config = array(
            'protocol'  => $this->config->item('protocol'),
            'smtp_host' => $this->config->item('smtp_host'),
            'smtp_port' => $this->config->item('smtp_port'),
            'smtp_user' => $this->config->item('smtp_user'),
            'smtp_pass' => $this->config->item('smtp_pass'),
            'mailtype'  => $this->config->item('mailtype'),
            'charset'   => $this->config->item('charset')
        );
        
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");       
       
       
        $this->email->to($detail['email']);                
        $this->email->from('dadenllc@breatheasy.com','Amplify');
        $this->email->subject('Reset Password');
        $data["data"] = $detail;
        $status = $this->load->view('email/resetPassword', $data, TRUE);
        
        $this->email->message($status); 
        if($this->email->send()) {            
            return $status;         
        } else {
          return $status;     
        }              
    }

    public function registration(){
        $this->load->view('registration');
    }
}
