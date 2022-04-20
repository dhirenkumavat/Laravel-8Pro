<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require APPPATH.'/libraries/BaseController.php';
class User extends BaseController
{
    /**
     * This is default constructor of the class.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('pagination');
        $this->load->model('project_model');
        $this->load->model('referral_model');
        $this->load->model('site_model','site');
        $this->isLoggedIn();
	$access = array();
        if($_SESSION['role'] == 1)
            $_SESSION['roleAccess'] = array(1,2,3,4);
        if($_SESSION['role'] == 2)
            $_SESSION['roleAccess'] = array(2,3,4);
        if($_SESSION['role'] == 3)
            $_SESSION['roleAccess'] = array(3,4);
        if($_SESSION['role'] == 4)
            $_SESSION['roleAccess'] = array(4);

    if($_SESSION['role'] == 1)
            $_SESSION['roleAccessStr'] = '(1,2,3,4,5,6)';
        if($_SESSION['role'] == 2)
            $_SESSION['roleAccessStr'] = '(2,3,4)';
        if($_SESSION['role'] == 3)
            $_SESSION['roleAccessStr'] = '(3,4)';
        if($_SESSION['role'] == 4)
            $_SESSION['roleAccessStr'] = '(4)';
    }

    /**
     * This function used to load the first screen of the user.
     */
    public function index()
    {   

    }

    /**
     * This function is used to load the user list.
     */
    public function userListing()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $data['roles'] = $this->user_model->getUserRoles();  
            $config['total_rows'] = $this->user_model->userListingCount();
            $data['total_count'] = $config['total_rows'];
            $config['suffix'] = '';
            /*
            if ($config['total_rows'] > 0) {
                $page_number = $this->uri->segment(2);
                $config['base_url'] = base_url() . 'userListing/';
                if (empty($page_number))
                    $page_number = 1;
                $offset = ($page_number - 1) * $this->pagination->per_page;
                $this->user_model->setPageNumber($this->pagination->per_page);
                $this->user_model->setOffset($offset);
                $this->pagination->cur_page = $page_number;
                $this->pagination->initialize($config);
                $data['page_links'] = $this->pagination->create_links();
                //$data['employeeInfo'] = $this->employee->employeeList();
                $this->global['pageTitle'] = 'Amplify : User Lists';

                $data['userRecords'] = $this->user_model->userListing();
            }
            */
                $this->global['pageTitle'] = 'Amplify : Users List';
                $this->global['PageEdit'] = 'All Users';
                $data['userRecords'] = $this->user_model->userListing();
            $this->loadViews('users', $this->global, $data, null);
        }
    }


    // get Lead List
    public function searchuserList() {    
        $username = $this->input->post('username');
        $phone = $this->input->post('phone_no');
        $useremail = $this->input->post('email');
        $role = $this->input->post('role');
        if(!empty($username)){
            $this->site->setName($username);
        }        
        if(!empty($phone)){
            $this->site->setPhone($phone);
        }
        if(!empty($useremail)){
            $this->site->setUserEmail($useremail);
        }
        if(!empty($role)){
            $this->site->setUserRole($role);
        }
                       
               
        $getuserInfo = $this->site->getuserList();
        $dataArray = array();
        foreach ($getuserInfo as $element) {            
            $dataArray[] = array(
                $element['name'],
                $element['email'],
                $element['mobile'],
                $element['role'],
                $element['createdDtm'],
                ' <a href="'.base_url().'editUser/'.$element['userId'].'"  class="btn btn-rounded bg-warning btn-sm"> <i class="fa fa-pencil-alt"></i> </a>
                                                            <a href="#" class="btn btn-rounded bg-danger btn-sm deleteUser" onClick="delete_user('.$element['userId'].')" data-userid="'.$element['userId'].'"> <i class="fa fa-trash-alt"></i> </a>'
            );
        }
        echo json_encode(array("data" => $dataArray));
    }

    /**
     * This function is used to load the add new form.
     */
    public function addNewUser()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->model('user_model');
            $data['roles'] = $this->user_model->getUserRoles();

            $this->global['pageTitle'] = 'Amplify : Add New User';
            $this->global['PageEdit'] = "Add User";
            $this->loadViews('addNewUser', $this->global, $data, null);
        }
    }

    /**
     * This function is used to check whether email already exist or not.
     */
    public function checkEmailExists(){
        $userId = $this->input->post('userId');
        $email  = $this->input->post('email');
        if (empty($userId)) {
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }
        if (empty($result)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    /**
     * This function is used to add new user to the system.
     */
    public function addNewUserSubmit(){
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('fname', 'Full Name', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password', 'Password', 'required|max_length[20]');
            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]|max_length[20]');
            $this->form_validation->set_rules('role', 'Role', 'trim|required|numeric');
            $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|min_length[10]');

            if ($this->form_validation->run() == false) {
                $this->addNewUser();
            } else {
                $name   = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $email  = strtolower($this->security->xss_clean($this->input->post('email')));
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->security->xss_clean($this->input->post('mobile'));
                $extension = $this->input->post('extension');

                $userInfo = array('email' => $email, 'password' => md5($password), 'roleId' => $roleId, 'name' => $name,
                                    'mobile' => $mobile,'extension'=>$extension, 'createdBy' => $this->vendorId, 'createdDtm' => date('Y-m-d H:i:s'), );

                $this->load->model('user_model');
                $result = $this->user_model->addNewUser($userInfo); 
                if($roleId == 2)
                {
                    if(isset($_POST['salesManager']) && !empty($_POST['salesManager']))
                    {
                        $salesManager = $_POST['salesManager'];                    
                        // delete all agent 
                        foreach ($salesManager as $key => $value) {  
                            $userassigneds = (isset($_POST['salesAgent'][$value]) && !empty($_POST['salesAgent'][$value]))?$_POST['salesAgent'][$value]:0;
                            if(is_array($userassigneds)) {
                                foreach ($userassigneds as $key1 => $userassigned) {  
                                    $userAgentInfo = array('executiveId' => $result, 'salesManagerId' => $value,'userassigned' => $userassigned);
                                    $userAgentResult = $this->user_model->addNewUserAssigned($userAgentInfo);
                                 }                            
                            }else {
                                $userAgentInfo = array('executiveId' => $result, 'salesManagerId' => $value,'userassigned' => $userassigneds);
                                $userAgentResult = $this->user_model->addNewUserAssigned($userAgentInfo);
                            }  
                        }
                    }
                }
                if($roleId == 3) {
                    if(isset($_POST['salesAgent']) && !empty($_POST['salesAgent']))
                    {
                        $salesManager = $_POST['salesAgent'];

                        // delete all agent 
                        foreach ($salesManager as $key => $value) {  
                              $userAgentInfo = array('executiveId' => 0, 'salesManagerId' => $result,'userassigned' => $value);
                              $userAgentResult = $this->user_model->addNewUserAssigned($userAgentInfo);                         
                        }
                    }
                }  
                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New User created successfully');
                } else {
                    $this->session->set_flashdata('error', 'User creation failed');
                }
                redirect('userListing');
            }
        }
    }

    /**
     * This function is used load user edit information.
     *
     * @param number $userId : Optional : This is user id
     */
    public function editUser($userId = null)
    {
        if ($this->isAdmin() == true || $userId == 1) {
            $this->loadThis();
        } else {
            if ($userId == null) {
                redirect('userListing');
            }
            $data['roles']      = $this->user_model->getUserRoles();
            $data['userInfo']   = $this->user_model->getUserInfo($userId);
            // Depatmantmanager 
            if(isset($data['userInfo']->roleId) && ($data['userInfo']->roleId == 2))
            {
                $data['departmentUserAssignedInfo'] = $this->user_model->getDepartmentUserAssignedInfo($data['userInfo']->userId);
                $data['salesUserAssignedInfo'] = $this->user_model->getSalesUserAssignedInfoByD($data['userInfo']->userId);
            }
            if(isset($data['userInfo']->roleId) && ($data['userInfo']->roleId == 3))
            {
                $data['salesUserAssignedInfo'] = $this->user_model->getSalesUserAssignedInfo($data['userInfo']->userId);
                $data['AllSalesAgentInfo'] = $this->user_model->getAllSalesAgentInfo();
            }
             
            $this->global['pageTitle']  = 'Amplify : Edit User';
            $this->global['PageEdit']   = "Edit Project: ".$data['userInfo']->name;
             $config['total_rows']      = $this->user_model->getLoginInfoCount($userId);
            $data['total_count']        = $config['total_rows'];
            $config['suffix']           = '';
            if ($config['total_rows'] > 0) {
                $page_number = $this->uri->segment(3);
                $config['base_url'] = base_url() . 'editUser/'.$userId;
                if (empty($page_number))
                    $page_number = 1;
                $offset = ($page_number - 1) * $this->pagination->per_page;
                $this->user_model->setPageNumber($this->pagination->per_page);
                $this->user_model->setOffset($offset);
                $this->pagination->cur_page = $page_number;
                $this->pagination->initialize($config);
                $data['page_links'] = $this->pagination->create_links();
                //$data['employeeInfo'] = $this->employee->employeeList();
                $this->global['pageTitle'] = 'Amplify : User Lists';

                $data['loginInfo'] = $this->user_model->getLoginInfo($userId);
            }            
            $this->loadViews('editUser', $this->global, $data, null);
        }
    }

    /**
     * This function is used load user edit information.
     *
     * @param number $userId : Optional : This is user id
     */
    public function loadData($userId = null)
    {
        $output = '';  
      	if(isset($_POST["roleId"]))  
       	{  
      	   if($_POST["roleId"]==3) 
           {
               $roleId = 4;
               if(isset($roleId))
               {
                    $sql = "SELECT * FROM amp_users WHERE roleId in (".$roleId.") AND isDeleted=0";            
                    $result =  $this->db->query($sql)->result_array();
                    $output = '<div class="col-sm-12"><ul class="mailsalesul"><li> <span class="salesRepheading">Sales Reps</span>
                                                    <ul class="salesperul">';
                    foreach ($result as $key => $row) {                      
                      $output .= '<li><label class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class ="salesAgent salesManager custom-control-input" checked value="'.$row["userId"].'"  name="salesAgent[]"/>
                                                                            <span class="custom-control-label">'.$row["name"].'</span>
                                                                        </label>
                                                                      </li>'; 
                    }
                    $output .= '</ul>
                                                  </li></ul>
                                                  </div>';  
                    echo $output;  die;
               } 
           }      	      
           else if($_POST["roleId"]==2) 
           {
              $roleId = 3;      	   
              if(isset($roleId))
               {

                    $output = '<div class="col-sm-12">
                                                 
                                                <ul class="mailsalesul">';                
                    $sql = "SELECT * FROM amp_users WHERE roleId in (".$roleId.") AND isDeleted=0";            
                    $result =  $this->db->query($sql)->result_array();
                    foreach ($result as $key => $row) {  

                     $output .= '<li class="salmanagertag">
                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox" class ="salesManager custom-control-input" checked name="salesManager[]" value="'.$row["userId"].'"/>
                                                        <span class="custom-control-label">'.$row["name"].'</span>
                                                    </label>
                                                  </li>';                          

                        $sqlUserAssigned = " SELECT amp_userassigned.userassigned as userId, amp_users.name as name from amp_userassigned left join amp_users on amp_users.userId  = amp_userassigned.userassigned WHERE userassigned > 0 and executiveId = 0 and amp_userassigned.salesManagerId =  ".$row["userId"];            
                        $resultUserAssigned =  $this->db->query($sqlUserAssigned)->result_array();

                        if(isset($resultUserAssigned) && !empty($resultUserAssigned))
                        {
                            $output .= '<li> <span class="salesRepheading">Sales Reps</span>
                                                    <ul class="salesperul">';
                            foreach ($resultUserAssigned as $key => $userAssigned) {
                                $output .= '<li>
                                                        <label class="custom-control custom-checkbox">
                                                            <span class="custom-label">'.$userAssigned["name"].'</span>
                                                        </label>
                                                      </li>';
                            }
                            $output .="</ul></li>";
                        } 
                    }
                     $output .= '</ul></div>';   
                    echo $output;  die;
               }
           }
          
       	}
    }

    /**
     * This function is used load user edit information.
     *
     * @param number $userId : Optional : This is user id
     */
    public function loadDataEdit($userId = null)
    {
        $output = '';  
        $roleId = $_POST["roleId"];
        if(isset($_POST["roleId"]))  
        {   
           if($_POST["roleId"]==3) 
           {
               $salesUserAssignedInfo = $this->user_model->getSalesUserAssignedInfo($_POST["userId"]);
               $AllSalesAgentInfo = $this->user_model->getAllSalesAgentInfo();
               $salesUserAssignedInfo = array_column($salesUserAssignedInfo, 'userassigned');
                                                    echo ' <div class="col-sm-12"><ul class="mailsalesul"><li> <span class="salesRepheading">Sales Reps</span>
                                                    <ul class="salesperul">';
                                                    $resultUserAssigned = $salesUserAssignedInfo;
                                                    {    
                                                        foreach ($AllSalesAgentInfo as $key => $row) {
                                                                $checked =  (in_array($row["userId"], $salesUserAssignedInfo))?'checked' :'';
                                                                if($row["userId"] > 0) {
                                                                {                                                                    
                                                                        $output = '
                                                                        <li>
                                                                        <label class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class ="salesAgent salesManager custom-control-input" '.$checked.' value="'.$row["userId"].'" name="salesAgent[]"/>
                                                                            <span class="custom-control-label">'.$row["name"].'</span>
                                                                        </label>
                                                                      </li>';                                 
                                                                }
                                                            }                                                            
                                                            echo $output;
                                                        } 
                                                   }
                                                   echo '</ul>
                                                  </li></ul>
                                                  </div>';
                                                  die;
           }              
           else if($roleId==2) 
          {
              $departmentUserAssignedInfo = $this->user_model->getDepartmentUserAssignedInfo($_POST["userId"]);
              $departmentUserAssignedInfo = array_column($departmentUserAssignedInfo, 'salesManagerId');
              $roleId = 3;           
              if(isset($roleId))
               {

                    $output = '<div class="col-sm-12">
                                                <h4 class="salesmanagerHeding">Sales Manager</h4>
                                                <ul class="mailsalesul">';                
                    $sql = "SELECT * FROM amp_users WHERE roleId in (".$roleId.")";            
                    $result =  $this->db->query($sql)->result_array();
                    foreach ($result as $key => $row) {  
                    $checked =  (in_array($row["userId"], $departmentUserAssignedInfo))?'checked' :'';
                     $output .= '<li>
                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox" class ="salesManager custom-control-input" '.$checked.' name="salesManager[]" value="'.$row["userId"].'"/>
                                                        <span class="custom-control-label">'.$row["name"].'</span>
                                                    </label>
                                                  </li>';                          

                        $sqlUserAssigned = " SELECT amp_userassigned.userassigned as userId, amp_users.name as name from amp_userassigned left join amp_users on amp_users.userId  = amp_userassigned.userassigned WHERE userassigned > 0 and executiveId = 0 and amp_userassigned.salesManagerId =  ".$row["userId"];            
                        $resultUserAssigned =  $this->db->query($sqlUserAssigned)->result_array();

                        if(isset($resultUserAssigned) && !empty($resultUserAssigned))
                        {
                            $output .= '<li> <span class="salesRepheading">Sales Reps</span>
                                                    <ul class="salesperul">';
                            foreach ($resultUserAssigned as $key => $userAssigned) {
                                /*$output .= '<li>
                                                        <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" class ="salesAgent custom-control-input" checked disabled name="salesAgent['.$row["userId"].'][]" value="'.$userAssigned["userId"].'"/>
                                                            <span class="custom-control-label">'.$userAssigned["name"].'</span>
                                                        </label>
                                                      </li>'; */
                                $output .= '<li>
                                                        <label class="custom-control custom-checkbox">
                                                            <span class="custom-label">'.$userAssigned["name"].'</span>
                                                        </label>
                                                      </li>';
                            }
                            $output .="</ul></li>";
                        } 
                    }
                     $output .= '</ul></div>';   
                    echo $output;  die;
               }
          }
        }
    }

    /**
     * This function is used to edit the user information.
     */
    public function editUserSubmit()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $userId = $this->input->post('userId');
            $this->form_validation->set_rules('fname', 'Full Name', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password', 'Password', 'matches[cpassword]|max_length[20]');
            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'matches[password]|max_length[20]');
            $this->form_validation->set_rules('role', 'Role', 'trim|required|numeric');
            $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|min_length[10]');

            if ($this->form_validation->run() == false) {
                $this->editUser($userId);
            } else {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $password = $this->input->post('password');
                $extension = $this->input->post('extension');
                $roleId = $this->input->post('role');
                $mobile = $this->security->xss_clean($this->input->post('mobile'));

                $userInfo = array();

                if (empty($password)) {
                    $userInfo = array('email' => $email, 'roleId' => $roleId, 'name' => $name,
                                    'mobile' => $mobile,'extension'=>$extension, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s'), );
                } else {
                    $userInfo = array('email' => $email, 'password' => md5($password), 'roleId' => $roleId,
                        'name' => ucwords($name), 'mobile' => $mobile,'extension'=>$extension, 'updatedBy' => $this->vendorId,
                        'updatedDtm' => date('Y-m-d H:i:s'), );
                }

                $result = $this->user_model->editUser($userInfo, $userId); 
                if($roleId == 2)
                {
                    if(isset($_POST['salesManager']) && !empty($_POST['salesManager']))
                    {
                        $salesManager = $_POST['salesManager']; 
                        $this->user_model->deleteDepartmentUserAssigned($userId);                    
                        // delete all agent 
                        foreach ($salesManager as $key => $value) {  
                            $userassigneds = (isset($_POST['salesAgent'][$value]) && !empty($_POST['salesAgent'][$value]))?$_POST['salesAgent'][$value]:0;
                            if(is_array($userassigneds)) {
                                foreach ($userassigneds as $key1 => $userassigned) {  
                                    $userAgentInfo = array('executiveId' => $userId, 'salesManagerId' => $value,'userassigned' => $userassigned);
                                    $userAgentResult = $this->user_model->addNewUserAssigned($userAgentInfo);
                                 }                            
                            }else {
                                $userAgentInfo = array('executiveId' => $userId, 'salesManagerId' => $value,'userassigned' => $userassigneds);
                                $userAgentResult = $this->user_model->addNewUserAssigned($userAgentInfo);
                            }  
                        }
                    }
                }
                if($roleId == 3) {
                    if(isset($_POST['salesAgent']) && !empty($_POST['salesAgent']))
                    {
                        $salesManager = $_POST['salesAgent'];
                        $this->user_model->deleteSalesUserAssigned($userId);

                        // delete all agent 
                        foreach ($salesManager as $key => $value) {  
                              $userAgentInfo = array('executiveId' => 0, 'salesManagerId' => $userId,'userassigned' => $value);
                              $userAgentResult = $this->user_model->addNewUserAssigned($userAgentInfo);                         
                        }
                    }
                }                 
                if ($result == true) {
                    $this->session->set_flashdata('success', 'User updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'User updation failed');
                }
                redirect('userListing');
            }
        }
    }

    /**
     * This function is used to delete the user using userId.
     *
     * @return bool $result : TRUE / FALSE
     */
    public function deleteUser()
    {
        if ($this->isAdmin() == true) {
            echo json_encode(array('status' => 'access'));
        } else {
            $userId = $this->input->post('userId');
            $userInfo = array('isDeleted' => 1, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s'));

            $result = $this->user_model->deleteUser($userId, $userInfo);

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

    /**
     * This function used to show login history.
     *
     * @param number $userId : This is user id
     */
    public function loginHistoy($userId = null)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $userId = ($userId == null ? 0 : $userId);

            $searchText = $this->input->post('searchText');
            $fromDate = $this->input->post('fromDate');
            $toDate = $this->input->post('toDate');

            $data['userInfo'] = $this->user_model->getUserInfoById($userId);

            $data['searchText'] = $searchText;
            $data['fromDate'] = $fromDate;
            $data['toDate'] = $toDate;

            $this->load->library('pagination');

            $count = $this->user_model->loginHistoryCount($userId, $searchText, $fromDate, $toDate);

            $returns = $this->paginationCompress('login-history/'.$userId.'/', $count, 10, 3);

            $data['userRecords'] = $this->user_model->loginHistory($userId, $searchText, $fromDate, $toDate, $returns['page'], $returns['segment']);

            $this->global['pageTitle'] = 'Amplify : User Login History';

            $this->loadViews('loginHistory', $this->global, $data, null);
        }
    }

    /**
     * This function is used to show users profile.
     */
    public function profile($active = 'details')    {
        $data['userInfo'] = $this->user_model->getUserInfoWithRole($this->vendorId);
        $data['active'] = $active;
        $this->global['pageTitle'] = $active == 'details' ? 'Amplify : My Profile' : 'Amplify : Change Password';
        $this->loadViews('profile', $this->global, $data, null);
    }

    /**
     * This function is used to update the user details.
     *
     * @param text $active : This is flag to set the active tab
     */
    public function profileUpdate($active = 'details')
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('fname', 'Full Name', 'trim|required|max_length[128]');
        $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|min_length[10]');

        if ($this->form_validation->run() == false) {
            $this->profile($active);
        } else {
            $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
            $mobile = $this->security->xss_clean($this->input->post('mobile'));

            $userInfo = array('name' => $name, 'mobile' => $mobile, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s'));

            $result = $this->user_model->editUser($userInfo, $this->vendorId);

            if ($result == true) {
                $this->session->set_userdata('name', $name);
                $this->session->set_flashdata('success', 'Profile updated successfully');
            } else {
                $this->session->set_flashdata('error', 'Profile updation failed');
            }

            redirect('profile/'.$active);
        }
    }

    /**
     * This function is used to change the password of the user.
     *
     * @param text $active : This is flag to set the active tab
     */
    public function changePassword($active = 'changepass')
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('oldPassword', 'Old password', 'required|max_length[20]');
        $this->form_validation->set_rules('newPassword', 'New password', 'required|max_length[20]');
        $this->form_validation->set_rules('cNewPassword', 'Confirm new password', 'required|matches[newPassword]|max_length[20]');

        if ($this->form_validation->run() == false) {
            $this->profile($active);
        } else {
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');

            $resultPas = $this->user_model->matchOldPassword($this->vendorId, $oldPassword);

            if (empty($resultPas)) {
                $this->session->set_flashdata('nomatch', 'Your old password is not correct');
                redirect('profile/'.$active);
            } else {
                $usersData = array('password' => md5($newPassword), 'updatedBy' => $this->vendorId,
                                'updatedDtm' => date('Y-m-d H:i:s'), );

                $result = $this->user_model->changePassword($this->vendorId, $usersData);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Password updation successful');
                } else {
                    $this->session->set_flashdata('error', 'Password updation failed');
                }

                redirect('profile/'.$active);
            }
        }
    }

    /**
     * This function is used to load the rep list.
     */
    public function repListing()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $config['total_rows'] = $this->user_model->repListingCount();
            $data['total_count'] = $config['total_rows'];
            $config['suffix'] = '';
            if ($config['total_rows'] > 0) {
                $page_number = $this->uri->segment(2);
                $config['base_url'] = base_url() . 'repListing/';
                if (empty($page_number))
                    $page_number = 1;
                $offset = ($page_number - 1) * $this->pagination->per_page;
                $this->user_model->setPageNumber($this->pagination->per_page);
                $this->user_model->setOffset($offset);
                $this->pagination->cur_page = $page_number;
                $this->pagination->initialize($config);
                $data['page_links'] = $this->pagination->create_links();
                //$data['employeeInfo'] = $this->employee->employeeList();
                $this->global['pageTitle'] = 'Amplify : View Reps';

                $data['repRecords'] = $this->user_model->repListing();
            }
            
            $this->loadViews('representative', $this->global, $data, null);
        }
    }

    /**
     * This function is used load lead edit information.
     *
     * @param number $userId : Optional : This is user id
     */
    public function editOldRep($userId = null)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            if ($userId == null) {
                redirect('repListing');
            }
            $data['repInfo'] = $this->user_model->getRepInfo($userId);

            $this->global['pageTitle'] = 'Amplify : Edit Representative';

            $this->loadViews('edit_rep', $this->global, $data, null);
        }
    }

    /**
     * This function is used to edit the Rep information.
     */
    public function editRep()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $userId = $this->input->post('userId');

            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|min_length[10]');
            if ($this->form_validation->run() == false) {
                $this->editOldRep($userId);
            } else {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('name'))));
                $mobile = $this->security->xss_clean($this->input->post('mobile'));
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $repInfo = array('name' => $name, 'mobile' => $mobile, 'email' => $email, 'updatedDtm' => date('Y-m-d H:i:s'));

                $result = $this->user_model->editRep($repInfo, $userId);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Representative updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Representative updation failed');
                }

                redirect('repListing');
            }
        }
    }

    /**
     * This function is used to delete the Rep using userId.
     *
     * @return bool $result : TRUE / FALSE
     */
    public function deleteRep()
    {
        if ($this->isAdmin() == true) {
            echo json_encode(array('status' => 'access'));
        } else {
            $userId = $this->input->post('userId');
            $userInfo = array('isDeleted' => 1, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s'));

            $result = $this->user_model->deleteRep($userId, $userInfo);

            if ($result > 0) {
                echo json_encode(array('status' => true));
            } else {
                echo json_encode(array('status' => false));
            }
        }
    }


     public function download($id){
        if(!empty($id)){
            //load download helper
            $this->load->helper('download');
            
            //get file info from database
            $fileInfo = $this->lead_model->getfilesData($id);
            //file path
            //$targetDir =  base_url()."assets/uploads/files/";
            $file =  base_url(). 'assets/uploads/files/'.$fileInfo['name'];
            //echo $file;die;
            //download file from directory

            $data = file_get_contents($file);
            force_download($fileInfo['name'], $data);
            //force_download($fileInfo['name'],$file);
            redirect('dashboard');
        }
    }
}
