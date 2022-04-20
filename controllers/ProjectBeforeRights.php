<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require APPPATH.'/libraries/BaseController.php';
class Project extends BaseController
{
    /**
     * This is default constructor of the class.
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('project_model');
        $this->load->model('common_model');
        $this->load->model('user_model');
        $this->load->model('site_model','site');
        $this->load->model('communi_model');
        $this->load->model('map_model');
        $this->load->library('pagination');
        $this->load->library('email');
        $this->load->helper('comman_helper');
        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the user.
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Amplify : Dashboard';

        $this->loadViews('dashboard', $this->global, null, null);
    }

    

    // get Lead List
    public function getProjectList() {    
        $lead_id = $this->input->post('lead_id');
        $project_name = $this->input->post('project_name');
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $phone_no = $this->input->post('phone_no');
        $email = $this->input->post('email');
        $sales_rep = $this->input->post('sales_rep');  
        $stageId = $this->input->post('stageId');
        $DOB = $this->input->post('DOB');    
        $scope_all=$this->input->post('scope_all');  
        $scope_abatement=$this->input->post('scope_abatement'); 
        $scope_interior_demolition=$this->input->post('scope_interior_demolition');
        $scope_site_demolition=$this->input->post('scope_site_demolition'); 
        $scope_earthwork=$this->input->post('scope_earthwork');
        $scope_other=$this->input->post('scope_other'); 
        $bid_oprt=$this->input->post('bid_oprt'); 
        $bid_price=$this->input->post('bid_price'); 
        $tagId=$this->input->post('tagId'); 
        $filesystem_id=$this->input->post('filesystem_id');
        $estimator=$this->input->post('estimator');
        $sales=$this->input->post('sales');
        $admin=$this->input->post('admin');
        $jobTypeId=$this->input->post('jobTypeId');
        $client_name=$this->input->post('client_name');
        $project_list_stage=$this->input->post('project_list_stage');
        $notes=$this->input->post('notes');
        $buisnessType=$this->input->post('buisnessType');
        
        //print_r($estimator);
        //die;

        if(!empty($lead_id)){
            $this->site->setLeadID($lead_id);
        }
        if(!empty($project_name)){
            $this->site->setProjectName($project_name);
        }        
        if(!empty($first_name)){
            $this->site->setFirstName($first_name);
        } 
        if(!empty($last_name)){
            $this->site->setLastName($last_name);
        }
        if(!empty($phone_no)){
            $this->site->setPhoneNo($phone_no);
        }
        if(!empty($email)){
            $this->site->setEmail($email);
        }
        if(!empty($sales_rep)){
            $this->site->setSalesRep($sales_rep);
        }  
        if(!empty($stageId)){
            $this->site->setStage($stageId);
        }    
        if(!empty($DOB)){
            $this->site->setDOB($DOB);
        }  
        if(!empty($scope_all)){
          $this->site->setScopeAll($scope_all);
        }
        if(!empty($scope_abatement)){
          $this->site->setScopeAbatement($scope_abatement);
        }
        if(!empty($scope_interior_demolition)){
          $this->site->setScopeIntDemolition($scope_interior_demolition);
        }
        if(!empty($scope_site_demolition)){
          $this->site->setScopeSiteDemolition($scope_site_demolition);
        }
        if(!empty($scope_earthwork)){
          $this->site->setScopeEarthwork($scope_earthwork);
        }
        if(!empty($scope_other)){
          $this->site->setScopeOther($scope_other);
        }
        if(!empty($bid_oprt)){
          $this->site->setBidOpertor($bid_oprt);
        }
        if(!empty($bid_price)){
          $this->site->setBidPrice($bid_price);
        }
        if(!empty($tagId)){
          $this->site->settagId($tagId);
        }
        if(!empty($filesystem_id)){
          $this->site->setFilesystemId($filesystem_id);
        }
        if(!empty($estimator)){
          $this->site->setEstimator($estimator);
        }
        if(!empty($sales)){
          $this->site->setSales($sales);
        }
        if(!empty($admin)){
          $this->site->setAdmin($admin);
        }
        if(!empty($jobTypeId)){
          $this->site->setjobTypeId($jobTypeId);
        }
        if(!empty($client_name)){
          $this->site->setClientName($client_name);
        }
        if(!empty($notes)){
          $this->site->setNotes($notes);
        }
        if(!empty($buisnessType)){
          $this->site->setBuisnessType($buisnessType);
        }
        
               
        $getOrderInfo = $this->site->getOrders();
        $getLeadInfo = $this->site->getLeadsId();
        $getsheetInfo = $this->site->getsheetInfo();
        $getemailInfo = $this->site->getsheetInfo();
        $getsmsInfo = $this->site->getsheetInfo();

        $this->session->set_userdata('projectIdsData',$getLeadInfo); 
        $this->session->set_userdata('getsheetInfo',$getsheetInfo); 
        $this->session->set_userdata('getemailInfo',$getemailInfo);
        $this->session->set_userdata('getsmsInfo',$getsmsInfo);      
        $dataArray = array();
        foreach ($getOrderInfo as $element) {            
            if($element['dueDate'] == "0000-00-00" || $element['dueDate'] == "" || $element['dueDate'] == "01/01/1970"){
                $dueDate = date('m/d/Y');
            }else{
                $dueDate = $element['dueDate'];
            }

            $is_priority = '';
            if($element['is_priority'] == 1){
                $is_priority = '<i class="fa fa-bullseye" aria-hidden="true"></i>';
            }

            if($project_list_stage == 11){
                $showtd = "";
                $temp_scope = array();
                if(!empty($element['scope'])){
                    $scopes = explode(",",$element['scope']);
                    for($i = 0; $i<count($scopes); $i++){
                        if($scopes[$i] == "abatement"){
                            $temp_scope['abatement'] = "A";
                        }
                        if($scopes[$i] == "interior_demolition"){
                            $temp_scope['interior_demolition'] = "ID";
                        }
                        if($scopes[$i] == "site_demolition"){
                            $temp_scope['site_demolition'] = "SD";
                        }
                        if($scopes[$i] == "earthwork"){
                            $temp_scope['earthwork'] = "E";
                        }
                        if($scopes[$i] == "other"){
                            $temp_scope['other'] = "O";
                        }
                    }
                }
                if(!empty($temp_scope)){ 
                    $pscope = implode(",", $temp_scope);
                 }else{
                    $pscope = "";
                 }
            }else{

                $showtd = "display:none;";
                $pscope = "";
            }

            $job_walk_array = array('12','10','13');
            $hide_job_walk = "";
            if(in_array($project_list_stage, $job_walk_array)){
                $hide_job_walk = "display:none;";
            }
            // else{
            //     $hide_job_walk = "display:block;";
            // }

            if($element['bid_price'] != "" || $element['bid_price'] != NULL){
                setlocale(LC_MONETARY, 'en_US');
                $bidprice = money_format('%.0n', $element['bid_price']) ;
            }else{
                $bidprice = "";
            }

            $bidprice_array = array('12','10','13');
            if(in_array($project_list_stage, $bidprice_array)){
                $is_show_bidprice = "display:block;";
            }else{
                $is_show_bidprice = "display:none;";
            }



            //$estimator = $element['estimator'];
            //if(isset($estimator) && !empty($estimator)){ 
            $userDetail = userinfo($element['estimator']);
            //print_r($userDetail);
            //die;
            //}

            $filesystemCall = "inlineEdit('filesystem_id','".$element['filesystem_id']."','".$element['projectId']."')";
            $projectNameCall = "inlineEdit('projectName','".$element['projectName']."','".$element['projectId']."')";
            $jobWalkTimeCall = "inlineEdit('jobWalkTime','".$element['jobWalkTime']."','".$element['projectId']."')";
            $dueDateCall = "inlineEdit('dueDate','".date('m/d/Y',strtotime($dueDate))."','".$element['projectId']."')";
            $estimatorCall = "inlineEditEstimator('estimator','".$userDetail["name"]."','".$element['projectId']."')";
            $addressCall = "inlineEditAdd('address','".$element['address']."','".$element['projectId']."')";
            $contractCall = "inlineEditAdd('contract','".$element['contract']."','".$element['projectId']."')";
            $color = "";
            if($element['company'] == 'north'){
                $color = "color:#006400";
            }
            $dataArray[] = array(
                "<input type=checkbox class=checkbox name=CalChkBox value=".$element['projectId']." onclick=selectAllChkbox('single');>",
                '<a title="Status" onclick="statusModal('.$element['projectId'].')" href="javascript:void(0)" class="btn btn-rounded bg-warning btn-xs"> <i class="fa fa-pencil1-alt">S</i> </a><a href="'.base_url().'editProject/'.$element['projectId'].'" class="btn btn-rounded btn-sm bg-warning"> <i class="fa fa-pencil-alt"></i> </a>
                <a href="#" data-leadid="'.$element['projectId'].'" onClick="delete_project('. $element['projectId'].')" class="btn btn-rounded bg-danger btn-sm deleteList"> <i class="fa fa-trash-alt"></i> </a>',
                '<a href="http://maps.google.com/maps?z=12&t=k&q='.$element['address'].'" target="_blank" class="licenseVerifyLink" title="">View</a>',

                '<span class="job_color">'.$is_priority.' '.'<i style="background-color:'.$element['color'].'" data-toggle="tooltip" title="'.$element['jobType'].'">&nbsp;</i></span>',

                '<span id="filesystem_id_'.$element['projectId'].'"></span> <p class="p-l-10" id="edit_filesystem_id_'.$element['projectId'].'" onclick="'.$filesystemCall.'">'.$element['filesystem_id'].'</p>',
                '<span class="p-l-10">'.'<a href="'.base_url().'editProject/'.$element['projectId'].'" style='.$color.'>'.ucfirst($element['company']).'</a>'.'</span>',
                 '<span style="'.$is_show_bidprice.'">'.$bidprice.'</span>',

                 '<span style="'.$showtd.'">'.$pscope.'</span>',

                

                '<span id="projectName_'.$element['projectId'].'"></span><p class="p-l-10" id="edit_projectName_'.$element['projectId'].'" onclick="'.$projectNameCall.'"><a href="'.base_url().'editProject/'.$element['projectId'].'">'.$element['projectName'].'</a></p>',

                '<span id="contract_'.$element['projectId'].'"></span><p class="p-l-10" id="edit_contract_'.$element['projectId'].'" onclick="'.$contractCall.'"><a href="'.base_url().'editProject/'.$element['projectId'].'">'.$element['contract'].'</a></p>',

                '<span id="dueDate_'.$element['projectId'].'"></span><p class="p-l-10" id="edit_dueDate_'.$element['projectId'].'" onclick="'.$dueDateCall.'">'.date('m/d/Y',strtotime($dueDate)).'</p>',

                '<span id="notes_'.$element['projectId'].'></span><p class="p-l-10"">'.$element['notes'].'</p>',

                '<span style="'.$hide_job_walk.'" id="jobWalkTime_'.$element['projectId'].'"></span><p  class="p-l-10" id="edit_jobWalkTime_'.$element['projectId'].'" onclick="'.$jobWalkTimeCall.'">'.$element['jobWalkTime'].'</p>
                <input type="hidden" name="createdDtm" id="createdDtm_'.$element['projectId'].'" value="'.$element['createdDtm'].'">',
                // $element['mainContact'],
                '<span id="address_'.$element['projectId'].'"></span><p class="p-l-10" id="edit_address_'.$element['projectId'].'" onclick="'.$addressCall.'">'.$element['address'].'</p>',
                '<span id="estimator_'.$element['projectId'].'"></span><p class="p-l-10" id="edit_estimator_'.$element['projectId'].'" onclick="'.$estimatorCall.'">'.$userDetail["name"].'</p>',
                
            );
        }
        echo json_encode(array("data" => $dataArray));die;
    }

  

    public function projectListing()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {

             $userId = $this->session->userdata['userId'];
             $result = $this->project_model->getState($userId,'ProjectTable');
             $data['stateresult'] = $result;
            //Get email templates
            $data['emailTemplates'] = $this->project_model->getEmailTemplates();

            //$config['total_rows'] = $this->employee->getAllEmployeeCount();
            $lead_id = $this->security->xss_clean($this->input->post('lead_id'));
            $first_name = $this->security->xss_clean($this->input->post('first_name'));
            $last_name = $this->security->xss_clean($this->input->post('last_name'));
            $phone_no = $this->security->xss_clean($this->input->post('phone_no'));
            $email = $this->security->xss_clean($this->input->post('email'));
            $sales_rep = $this->security->xss_clean($this->input->post('sales_rep'));
            $stageId = $this->security->xss_clean($this->input->post('stageId'));
            
            $data['lead_id'] = $lead_id;
            $data['first_name'] = $first_name;
            $data['last_name'] = $last_name;
            $data['phone_no'] = $phone_no;
            $data['email'] = $email;
            $data['sales_rep'] = $sales_rep;
            $data['stageId'] = $stageId;
            
            $config['total_rows'] = $this->project_model->leadListingCount();
            $data['total_count'] = $config['total_rows'];
            $config['suffix'] = '';
            // $data['sales_rep'] = $this->user_model->getSalesRep(); 
            $data['userlist'] = $this->user_model->getAllActiveUser();
            $data['jobTypes'] = $this->project_model->getJobTypes(); 
            
            $data['stages'] = $this->project_model->getStages();

            $data['tags'] = $this->project_model->getTags();
            

            $data['project_list_stage'] = "All";
            $this->global['pageTitle'] = 'Amplify : Projects';
            $this->global['PageEdit'] = 'All Projects';
            $data['leadRecords'] = $this->project_model->leadListing();
            //print_r($data['leadRecords']);die;
            $this->loadViews('projects/projects', $this->global, $data, null);
        }
    }

public function saveState(){
    $state = $_POST['state'];
    unset($state['start']);
    unset($state['length']);
    $name = $_POST['name'];
    $userId = $this->session->userdata['userId'];
    $this->project_model->saveState($userId,$state,$name);

}

public function loadState(){

    $name = $_POST['name'];
    $userId = $this->session->userdata['userId'];
    $result = $this->project_model->getState($userId,$name);
   // if(!empty($result)){
    //echo json_encode($result[0]->state);die;
    if(!empty($result)){
        echo $result[0]->state;die;
    }else{
        return false;
    }
    // }else{
    //     return false;
    // }
    //echo $result['state'] ;

}

public function updateSortPosition(){

    $position = $_POST['position'];
    $table = $_POST['table'];
    $userId = $this->session->userdata['userId'];
    $this->project_model->updatePosition($userId,$position,$table);

}

    /**
     * This function is used to load prospects project.
     */

    public function prospectsProjectListing()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {

            //Get email templates
            $data['emailTemplates'] = $this->project_model->getEmailTemplates();


            $lead_id = $this->security->xss_clean($this->input->post('lead_id'));
            $phone_no = $this->security->xss_clean($this->input->post('phone_no'));
            $email = $this->security->xss_clean($this->input->post('email'));
            $sales_rep = $this->security->xss_clean($this->input->post('sales_rep'));
            $stageId = $this->security->xss_clean($this->input->post('stageId'));
            
            $data['lead_id'] = $lead_id;
            $data['phone_no'] = $phone_no;
            $data['email'] = $email;
            $data['sales_rep'] = $sales_rep;
            $data['stageId'] = $stageId;
            $config['total_rows'] = $this->project_model->leadListingCount(2);
            $data['total_count'] = $config['total_rows'];
            $config['suffix'] = '';
    
            $data['userlist'] = $this->user_model->getAllActiveUser();
            $data['jobTypes'] = $this->project_model->getJobTypes();
            $data['stages'] = $this->project_model->getStages();
            $data['tags'] = $this->project_model->getTags();

            $data['project_list_stage'] = 2;
            $this->global['pageTitle'] = 'Amplify : Projects';
            $this->global['PageEdit'] = 'Projects: Prospects';
            $data['leadRecords'] = $this->project_model->leadListing(2);
            
            $this->loadViews('projects/projects', $this->global, $data, null);
        }
    }

    public function percentProjectListing()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {

            //Get email templates
            $data['emailTemplates'] = $this->project_model->getEmailTemplates();


            $lead_id = $this->security->xss_clean($this->input->post('lead_id'));
            $phone_no = $this->security->xss_clean($this->input->post('phone_no'));
            $email = $this->security->xss_clean($this->input->post('email'));
            $sales_rep = $this->security->xss_clean($this->input->post('sales_rep'));
            $stageId = $this->security->xss_clean($this->input->post('stageId'));
            
            $data['lead_id'] = $lead_id;
            $data['phone_no'] = $phone_no;
            $data['email'] = $email;
            $data['sales_rep'] = $sales_rep;
            $data['stageId'] = $stageId;
            $config['total_rows'] = $this->project_model->leadListingCount(2);
            $data['total_count'] = $config['total_rows'];
            $config['suffix'] = '';
    
            $data['userlist'] = $this->user_model->getAllActiveUser();
            $data['jobTypes'] = $this->project_model->getJobTypes();
            $data['stages'] = $this->project_model->getStages();
            $data['tags'] = $this->project_model->getTags();

            $data['project_list_stage'] = 13;
            $this->global['pageTitle'] = 'Amplify : Projects';
            $this->global['PageEdit'] = 'Projects: 90 Percent';
            $data['leadRecords'] = $this->project_model->leadListing(13);
            
            $this->loadViews('projects/projects', $this->global, $data, null);
        }
    }
    
    /**
     * This function is used to load active project.
     */

    public function activeProject()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {

            //Get email templates
            $data['emailTemplates'] = $this->project_model->getEmailTemplates();

            //$config['total_rows'] = $this->employee->getAllEmployeeCount();
            $lead_id = $this->security->xss_clean($this->input->post('lead_id'));
            $first_name = $this->security->xss_clean($this->input->post('first_name'));
            $last_name = $this->security->xss_clean($this->input->post('last_name'));
            $phone_no = $this->security->xss_clean($this->input->post('phone_no'));
            $email = $this->security->xss_clean($this->input->post('email'));
            $sales_rep = $this->security->xss_clean($this->input->post('sales_rep'));
            $stageId = $this->security->xss_clean($this->input->post('stageId'));
            
            $data['lead_id'] = $lead_id;
            $data['first_name'] = $first_name;
            $data['last_name'] = $last_name;
            $data['phone_no'] = $phone_no;
            $data['email'] = $email;
            $data['sales_rep'] = $sales_rep;
            $data['stageId'] = $stageId;
            $config['total_rows'] = $this->project_model->leadListingCount(11);
            $data['total_count'] = $config['total_rows'];
            $config['suffix'] = '';
            //$data['sales_rep'] = $this->user_model->getSalesRep(); 
            $data['userlist'] = $this->user_model->getAllActiveUser();
            $data['jobTypes'] = $this->project_model->getJobTypes();
            $data['stages'] = $this->project_model->getStages();
            $data['tags'] = $this->project_model->getTags();
            // if ($config['total_rows'] > 0) {
            //     $page_number = $this->uri->segment(2);
            //     $config['base_url'] = base_url() . 'activeProject/';
            //     if (empty($page_number))
            //         $page_number = 1;
            //     $offset = ($page_number - 1) * $this->pagination->per_page;
            //     $this->project_model->setPageNumber($this->pagination->per_page);
            //     $this->project_model->setOffset($offset);
            //     $this->pagination->cur_page = $page_number;
            //     $this->pagination->initialize($config);
            //     $data['page_links'] = $this->pagination->create_links();
            //     //$data['employeeInfo'] = $this->employee->employeeList();
            //     $this->global['pageTitle'] = 'Amplify : Projects';

            //     $data['leadRecords'] = $this->project_model->leadListing(11);
                
            // }
            $data['project_list_stage'] = 11;
            $this->global['pageTitle'] = 'Amplify : Projects';
            $this->global['PageEdit'] = 'Projects: Bid Board';
            $data['leadRecords'] = $this->project_model->leadListing(11);
            
            $this->loadViews('projects/projects', $this->global, $data, null);
        }
    }

    /**
     * This function is used to load completed project.
     */

    public function completedProject()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {

            //Get email templates
            $data['emailTemplates'] = $this->project_model->getEmailTemplates();

            //$config['total_rows'] = $this->employee->getAllEmployeeCount();
            $lead_id = $this->security->xss_clean($this->input->post('lead_id'));
            $first_name = $this->security->xss_clean($this->input->post('first_name'));
            $last_name = $this->security->xss_clean($this->input->post('last_name'));
            $phone_no = $this->security->xss_clean($this->input->post('phone_no'));
            $email = $this->security->xss_clean($this->input->post('email'));
            $sales_rep = $this->security->xss_clean($this->input->post('sales_rep'));
            $stageId = $this->security->xss_clean($this->input->post('stageId'));
            
            $data['lead_id'] = $lead_id;
            $data['first_name'] = $first_name;
            $data['last_name'] = $last_name;
            $data['phone_no'] = $phone_no;
            $data['email'] = $email;
            $data['sales_rep'] = $sales_rep;
            $data['stageId'] = $stageId;
            $config['total_rows'] = $this->project_model->leadListingCount(12);
            $data['total_count'] = $config['total_rows'];
            $config['suffix'] = '';
            //$data['sales_rep'] = $this->user_model->getSalesRep(); 
            $data['userlist'] = $this->user_model->getAllActiveUser();
            $data['jobTypes'] = $this->project_model->getJobTypes();
            $data['stages'] = $this->project_model->getStages();
            $data['tags'] = $this->project_model->getTags();
            // if ($config['total_rows'] > 0) {
            //     $page_number = $this->uri->segment(2);
            //     $config['base_url'] = base_url() . 'activeProject/';
            //     if (empty($page_number))
            //         $page_number = 1;
            //     $offset = ($page_number - 1) * $this->pagination->per_page;
            //     $this->project_model->setPageNumber($this->pagination->per_page);
            //     $this->project_model->setOffset($offset);
            //     $this->pagination->cur_page = $page_number;
            //     $this->pagination->initialize($config);
            //     $data['page_links'] = $this->pagination->create_links();
            //     //$data['employeeInfo'] = $this->employee->employeeList();
            //     $this->global['pageTitle'] = 'Amplify : Projects';

            //     $data['leadRecords'] = $this->project_model->leadListing(12);
                
            // }
                $data['project_list_stage'] = 12;
                $this->global['pageTitle'] = 'Amplify : Projects';
                $this->global['PageEdit'] = 'Projects: Won';
                $data['leadRecords'] = $this->project_model->leadListing(12);
            
            $this->loadViews('projects/projects', $this->global, $data, null);
        }
    }

    /**
     * This function is used to load Pending Budget.
     */

    public function pendingBudget()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {

            //Get email templates
            $data['emailTemplates'] = $this->project_model->getEmailTemplates();

            //$config['total_rows'] = $this->employee->getAllEmployeeCount();
            $lead_id = $this->security->xss_clean($this->input->post('lead_id'));
            $first_name = $this->security->xss_clean($this->input->post('first_name'));
            $last_name = $this->security->xss_clean($this->input->post('last_name'));
            $phone_no = $this->security->xss_clean($this->input->post('phone_no'));
            $email = $this->security->xss_clean($this->input->post('email'));
            $sales_rep = $this->security->xss_clean($this->input->post('sales_rep'));
            $stageId = $this->security->xss_clean($this->input->post('stageId'));
            
            $data['lead_id'] = $lead_id;
            $data['first_name'] = $first_name;
            $data['last_name'] = $last_name;
            $data['phone_no'] = $phone_no;
            $data['email'] = $email;
            $data['sales_rep'] = $sales_rep;
            $data['stageId'] = $stageId;
            $config['total_rows'] = $this->project_model->leadListingCount(1);
            $data['total_count'] = $config['total_rows'];
            $config['suffix'] = '';
            ///$data['sales_rep'] = $this->user_model->getSalesRep(); 
            $data['userlist'] = $this->user_model->getAllActiveUser();
            $data['jobTypes'] = $this->project_model->getJobTypes();
            $data['stages'] = $this->project_model->getStages();
            $data['tags'] = $this->project_model->getTags();

            $data['project_list_stage'] = 1;
            $this->global['pageTitle'] = 'Amplify : Projects';
            $this->global['PageEdit'] = 'Projects: Pending Budget';
            $data['leadRecords'] = $this->project_model->leadListing(1);
            
            $this->loadViews('projects/projects', $this->global, $data, null);
        }
    }

    /**
     * This function is used to load Pending Bids.
     */

    public function pendingBids()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {

            //Get email templates
            $data['emailTemplates'] = $this->project_model->getEmailTemplates();

            //$config['total_rows'] = $this->employee->getAllEmployeeCount();
            $lead_id = $this->security->xss_clean($this->input->post('lead_id'));
            $first_name = $this->security->xss_clean($this->input->post('first_name'));
            $last_name = $this->security->xss_clean($this->input->post('last_name'));
            $phone_no = $this->security->xss_clean($this->input->post('phone_no'));
            $email = $this->security->xss_clean($this->input->post('email'));
            $sales_rep = $this->security->xss_clean($this->input->post('sales_rep'));
            $stageId = $this->security->xss_clean($this->input->post('stageId'));
            
            $data['lead_id'] = $lead_id;
            $data['first_name'] = $first_name;
            $data['last_name'] = $last_name;
            $data['phone_no'] = $phone_no;
            $data['email'] = $email;
            $data['sales_rep'] = $sales_rep;
            $data['stageId'] = $stageId;
            $config['total_rows'] = $this->project_model->leadListingCount(5);
            $data['total_count'] = $config['total_rows'];
            $config['suffix'] = '';
            //$data['sales_rep'] = $this->user_model->getSalesRep(); 
            $data['userlist'] = $this->user_model->getAllActiveUser();
            $data['jobTypes'] = $this->project_model->getJobTypes();
            $data['stages'] = $this->project_model->getStages();
            $data['tags'] = $this->project_model->getTags();
            // if ($config['total_rows'] > 0) {
            //     $page_number = $this->uri->segment(2);
            //     $config['base_url'] = base_url() . 'activeProject/';
            //     if (empty($page_number))
            //         $page_number = 1;
            //     $offset = ($page_number - 1) * $this->pagination->per_page;
            //     $this->project_model->setPageNumber($this->pagination->per_page);
            //     $this->project_model->setOffset($offset);
            //     $this->pagination->cur_page = $page_number;
            //     $this->pagination->initialize($config);
            //     $data['page_links'] = $this->pagination->create_links();
            //     //$data['employeeInfo'] = $this->employee->employeeList();
            //     $this->global['pageTitle'] = 'Amplify : Projects';

            //     $data['leadRecords'] = $this->project_model->leadListing(5);
                
            // }
            $data['project_list_stage'] = 5;
            $this->global['pageTitle'] = 'Amplify : Projects';
            $this->global['PageEdit'] = 'Projects: Pending Bids';
            $data['leadRecords'] = $this->project_model->leadListing(5);
            
            $this->loadViews('projects/projects', $this->global, $data, null);
        }
    }

    /**
     * This function is used to load Pending Bids.
     */

    public function lost()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {

            //Get email templates
            $data['emailTemplates'] = $this->project_model->getEmailTemplates();

            //$config['total_rows'] = $this->employee->getAllEmployeeCount();
            $lead_id = $this->security->xss_clean($this->input->post('lead_id'));
            $first_name = $this->security->xss_clean($this->input->post('first_name'));
            $last_name = $this->security->xss_clean($this->input->post('last_name'));
            $phone_no = $this->security->xss_clean($this->input->post('phone_no'));
            $email = $this->security->xss_clean($this->input->post('email'));
            $sales_rep = $this->security->xss_clean($this->input->post('sales_rep'));
            $stageId = $this->security->xss_clean($this->input->post('stageId'));
            
            $data['lead_id'] = $lead_id;
            $data['first_name'] = $first_name;
            $data['last_name'] = $last_name;
            $data['phone_no'] = $phone_no;
            $data['email'] = $email;
            $data['sales_rep'] = $sales_rep;
            $data['stageId'] = $stageId;
            $config['total_rows'] = $this->project_model->leadListingCount(10);
            $data['total_count'] = $config['total_rows'];
            $config['suffix'] = '';
            //$data['sales_rep'] = $this->user_model->getSalesRep(); 
            $data['userlist'] = $this->user_model->getAllActiveUser();
            $data['jobTypes'] = $this->project_model->getJobTypes();
            $data['stages'] = $this->project_model->getStages();
            $data['tags'] = $this->project_model->getTags();
            // if ($config['total_rows'] > 0) {
            //     $page_number = $this->uri->segment(2);
            //     $config['base_url'] = base_url() . 'activeProject/';
            //     if (empty($page_number))
            //         $page_number = 1;
            //     $offset = ($page_number - 1) * $this->pagination->per_page;
            //     $this->project_model->setPageNumber($this->pagination->per_page);
            //     $this->project_model->setOffset($offset);
            //     $this->pagination->cur_page = $page_number;
            //     $this->pagination->initialize($config);
            //     $data['page_links'] = $this->pagination->create_links();
            //     //$data['employeeInfo'] = $this->employee->employeeList();
            //     $this->global['pageTitle'] = 'Amplify : Projects';

            //     $data['leadRecords'] = $this->project_model->leadListing(10);
                
            // }
            $data['project_list_stage'] = 10;
            $this->global['pageTitle'] = 'Amplify : Projects';
            $this->global['PageEdit'] = 'Projects: Lost';
            $data['leadRecords'] = $this->project_model->leadListing(10);
            
            $this->loadViews('projects/projects', $this->global, $data, null);
        }
    }
    
    public function getProjectContact(){
        
        $projectId = $this->input->post('projectId');
        if($projectId == ""){
            echo json_encode(array('status' => false));die;
        }else{
            $contactDtl = $this->project_model->getContactInfo($projectId);;
            if(count($contactDtl) > 0){
                echo json_encode(array('status' => true,'result' => $contactDtl));die;
            }else{
                echo json_encode(array('status' => false));die;
            }
        }
    }

    public function mapProject($projectId = null){
        //$project_id = $this->uri->segment(2);
        if ($projectId == null) {
            redirect('projectListing');
        }
        $data['leadInfo'] = $this->project_model->getLeadInfo($projectId);

        $this->global['pageTitle'] = 'Amplify : Project Map';

        $this->loadViews('projects/map_project', $this->global, $data, null);
    }

    public function getProjByStage(){
        $stageID = $this->input->post('stageID');
        if($stageID == ""){
            echo json_encode(array('status' => false));die;
        }else{
            $projectList = $this->project_model->getProjByStage($stageID);
            if(count($projectList) > 0){
                echo json_encode(array('status' => true,'result' => $projectList));die;
            }else{
                echo json_encode(array('status' => false));die;
            }
        }
    }

    /**
     * This function is used to load the add new form.
     */
    public function addNewProject()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->model('user_model');
            //$data['sales_rep'] = $this->user_model->getSalesRep();
            $data['sales_rep'] = $this->user_model->getAllActiveUser(); 
            $data['userlist'] = $this->user_model->getAllActiveUser();
            $data['stages'] = $this->project_model->getStages();
            $data['tags'] = $this->project_model->getTags();
            $data['jobTypes'] = $this->project_model->getJobTypes();
            $data['referral_type'] = $this->project_model->getrefType();
            $data['clientsInfo'] = $this->project_model->getClientsInfo();
            $userId = $this->session->userdata['userId'];
            $data['bidInfo'] = $this->project_model->getBid($userId,"",0);
            //$data['referral_sources'] = $this->project_model->getrefSources();
            //$data['cross_selling'] = $this->project_model->getSelling();
            //$data['countries'] = $this->project_model->getCountry();
            $this->global['pageTitle'] = 'Amplify : Add New Project';
            $this->global['PageEdit'] = 'Add Project';

            $this->loadViews('projects/add_project', $this->global, $data, null);
        }
    }
    
    /**
     * This function is used to add new lead to the system.
     */
    
    public function addProject()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('projectName','Project Name', 'trim|required|max_length[128]|callback_check_project_name');
            $this->form_validation->set_rules('filesystem_id','Job Number', 'callback_check_project_file_id');
            //$this->form_validation->set_rules('sales_rep', 'Rep', 'trim|required|numeric');
            

            if ($this->form_validation->run() == false) {
                $this->addNewProject();
            } else {
                $projectName = $this->security->xss_clean($this->input->post('projectName'));
                //$firstName = $this->security->xss_clean($this->input->post('firstName'));
                //$lastName = $this->security->xss_clean($this->input->post('lastName'));
                $budget = $this->input->post('budget');
                $scope = $this->input->post('scope');
                if($scope != ""){
                    $scopeVal = implode(",", $scope);
                }else{
                    $scopeVal = "";
                }
                
                $wages = $this->input->post('wagesId');
                if(!empty($wages)){
                    $wages = implode(",", $wages);
                }
                $sales = $this->input->post('sales');
                $admin = $this->input->post('admin');
                $estimator = $this->input->post('estimator');
                if(!empty($estimator)){
                    $estimator = implode(",", $estimator);
                }
                $estimator_email = $this->input->post('estimator_email');
                $client_name = $this->input->post('client_name');
                $due_date = $this->input->post('due_date');
                $due_time = $this->input->post('due_time');
                $job_walk_time = $this->input->post('job_walk_time');
                $est_start_date = $this->input->post('est_start_date');
                $rfi_deadline = $this->input->post('rfi_deadline');
                $bid_form = $this->input->post('bid_form');
               // $bid_price = $this->input->post('bid_price');

                $bid_price = str_replace( '$', '',str_replace( ',', '', $this->input->post('bid_price')));

                $reports = $this->input->post('reports');
                $lostnote = $this->input->post('lostnote');
                
                //$main_contact = $this->input->post('main_contact');

                $filesystem_id = $this->input->post('filesystem_id');


                $address = $this->input->post('address');
                $referralType = $this->input->post('referralType');
                $dl = $this->input->post('dl');
                $dob = $this->input->post('dob');
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $phone1 = $this->security->xss_clean($this->input->post('phone1'));
                $phone2 = $this->security->xss_clean($this->input->post('phone2'));                
                $sales_rep = $this->input->post('sales_rep');
                $countryId = $this->input->post('countryId');
                $referralId = $this->input->post('referralsourceId');
                $stageId = $this->input->post('stageId');
                $brokerFee = $this->input->post('brokerFee');
                $comment = $this->input->post('comment');
                $tagId = $this->input->post('tagId');
                $jobTypeId = $this->input->post('jobTypeId');
                $ownership = $this->input->post('ownership');
                $policyExp = $this->input->post('policyExp');
                $businessOwner = $this->input->post('businessOwner');
                $iid = $this->input->post('iid');


                $buildingSf = $buildingSf = str_replace( ',', '', $this->input->post('building_sf'));
                $marketType = $this->input->post('marketTypeId');
                $buildingType = $this->input->post('buildingTypeId');
                $materialNeeds = $this->input->post('materialNeedsId');
                
                
                
                // generate random string
                $this->load->helper('string');
                $string = random_string('alpha', 5);
                //$fs_id = $string."-".time();
                $optionIn = $this->input->post('optionIn'); 
                $sms = '' ;
                $call = '';
                $emails='';
                $other = '';
                if(isset($optionIn[0])){
                    $sms = $optionIn[0];
                }if(isset($optionIn[1])){
                    $call = $optionIn[1];
                }if(isset($optionIn[2])){
                    $emails = $optionIn[2];
                }if(isset($optionIn[3])){
                    $other = $optionIn[3];
                }

                $is_priority = $this->input->post('is_priority');
                if( $is_priority == NULL ||  $is_priority == ""){
                    $ispriority = 0;
                }else{
                    $ispriority = 1;
                }

                $contract = $this->input->post('contract');
                if(!empty($materialNeeds)){

                    $materialNeeds = implode(",", $materialNeeds);
                }
                $company = $this->input->post('company');
                $getLatLong    = $this->map_model->getLatLong($address);//print_r($getLatLong);
                $getLatLongArr = explode("@",$getLatLong);
                $latitude      = $getLatLongArr[0];
                $longitude     = $getLatLongArr[1];
                
                $leadInfo = array(
                    'is_priority' => $ispriority,
                	'projectName' => $projectName,
                	'contract' => $contract,
                    'budget' => $budget,
                    'scope' =>  $scopeVal,
                    'wages' =>  $wages,
                    'sales' =>  $sales,
                    'admin' =>  $admin,
                    'estimator' =>  $estimator,
                    'estimator_email' => $estimator_email,
                    'clientName' => $client_name,
                    'dueDate' => $due_date,
                    'dueTime' => $due_time,
                    'jobWalkTime' => $job_walk_time,
                    'estStartDate' => $est_start_date,
                    'rfiDeadline' =>   $rfi_deadline,
                    'bidForm' => $bid_form,
                    'bid_price' => $bid_price,
                    'reports' =>   $reports,
                    //'mainContact' =>  $main_contact,
                	'address' => $address,
                	'reftypeId'=>$referralType,
                	'dl' => $dl,
                	'dob'=>$dob, 
                	'email' => $email,
                	'phoneNo1' => $phone1, 
                	'phoneNo2' => $phone2, 
                	'salesRepId' => $sales_rep, 
                	'countryId' => $countryId,
                	'referralSourceId'=>$referralId, 
                	'userID' => $this->session->userdata['userId'], 
                	'stageId' => $stageId,
                	'brokerFee' => $brokerFee,
                	'notes'=>$comment,
                	'tagId'=> $tagId,
                    'jobtypeid'=> $jobTypeId,
                	'ownership'=>$ownership,
                	'policyExpiration'=>$policyExp,
                	'IID'=>$iid,
                	'businessOwner'=>$businessOwner,
                	'createdDtm' => date('Y-m-d H:i:s'), 
                	'filesystem_id' => $filesystem_id,
                    'buildingSf' => $buildingSf,
                    'marketType' => $marketType,
                    'buildingType' => $buildingType,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'materialNeeds' => $materialNeeds,
                    'company' => $company
                );
              //  $fileInfo = array('name'=>$picture,'type'=>$file_ext,'createdDtm' => date('Y-m-d H:i:s'));
                
                $result = $this->project_model->addNewProject($leadInfo);
                $bidCombinedValues = $this->input->post('bidCombinedValues');
                $bidArray = explode(",", trim($bidCombinedValues,","));
                $userID =  $this->session->userdata['userId'];
                if(!empty($bidArray)){
                    $bidRandomIDVal = $this->input->post('bidRandomIDVal');
                    $this->project_model->updateBids($result,$bidArray, $userID,$bidRandomIDVal,$buildingSf);
                }

                $history = array('projectId'=>$result,'stageId'=>$stageId,'createdDtm' =>  date('Y-m-d H:i:s'),
                    'updatedDtm'    =>  date('Y-m-d H:i:s'));
                $historyresult = $this->project_model->addStageHistory($history);

                 /* Notes History*/
                
                if(!empty($comment) != ""){
                    $noteshistory = array('userId'=>$userID,'projectId'=>$result,'notes'=>$comment,'status'=>1,'createdDtm' =>  date('Y-m-d H:i:s'),'updatedDtm'=>  date('Y-m-d H:i:s'));
                    $notehistoryresult = $this->project_model->addNotesHistory($noteshistory);
                }                
                /* Notes History*/

                /*Lost Notes History*/
                if(isset($lostnote) && !empty($lostnote)){
                    $lnoteshistory = array('userId'=>$userID,'projectId'=>$result,'notes'=>$lostnote,'status'=>1,'createdDtm' =>  date('Y-m-d H:i:s'),'updatedDtm'=>  date('Y-m-d H:i:s'));
                    $lnotehistoryresult = $this->project_model->addNotesHistory($lnoteshistory);
                }
                /* Lost Notes History*/

                // foreach($optionIn as $key=>$val) {
                //     echo $val;
                    
                //     // $this->project_model->addOptions($optionInData,$result);                    
                // }die;


                // code by shubham vaishnav
                $targetDir =  base_url()."assets/uploads/files/";
                $allowTypes = array('jpg','png','jpeg','gif','pdf','docx','doc','tiff','zip','html','xml','xls');
                $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
                if(!empty(array_filter($_FILES['image']['name']))){
                    foreach($_FILES['image']['name'] as $key=>$val){
                        // File upload path
                        $fileName = basename($_FILES['image']['name'][$key]);
                        $targetFilePath = FCPATH."assets/uploads/files/". $fileName;
                        
                        // Check whether file type is valid
                        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                        $fileSize = $_FILES['image']['size'][$key];
                        if(in_array($fileType, $allowTypes)){
                            // Upload file to server
                            if(move_uploaded_file($_FILES["image"]["tmp_name"][$key], $targetFilePath)){
                                // Image db insert sql
                                $insertValuesSQL =  $fileName;                              
                                // Insert image file name into database
                                $fileresult = $this->project_model->addfile($insertValuesSQL,$result,$fileType,$fileSize);
                            }else{
                                $errorUpload .= $_FILES['image']['name'][$key].', ';
                            }
                        }else{
                            $errorUploadType .= $_FILES['image']['name'][$key].', ';
                        }
                    }            
                    if(!empty($insertValuesSQL)){                    
                        if($fileresult){
                            $errorUpload = !empty($errorUpload)?'Upload Error: '.$errorUpload:'';
                            $errorUploadType = !empty($errorUploadType)?'File Type Error: '.$errorUploadType:'';
                            $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType;
                            $statusMsg = "Files are uploaded successfully.".$errorMsg;
                        }else{
                            $statusMsg = "Sorry, there was an error uploading your file.";
                        }
                    }
                }else{
                    $statusMsg = 'Please select a file to upload.';
                }
    
                // Display status message
                //echo $statusMsg;
                // end of code


                 //--------------------------------------------------- Add Task Added By Ram---------------------------------------------------------
                $leadID = $result;
                $taskCombinedValues = $this->security->xss_clean($this->input->post('taskCombinedValues'));
                $taskArr = json_decode($taskCombinedValues);
                if($taskArr){
                    foreach($taskArr as $taskArrVal){
                         $insertData   =  array(
                            'projectId'        =>  $leadID,
                            'userID' => $this->session->userdata['userId'],
                            'taskRandomId'  =>  $taskArrVal->taskRandomID,
                            'name'          =>  $taskArrVal->taskMsg,
                            'eventDate'     =>  date("Y-m-d", strtotime($taskArrVal->taskExpDate)),
                            'createdDtm'    =>  date('Y-m-d H:i:s')
                        );
                        $this->db->insert('amp_tasks',$insertData);
                    }
                }
                //---------------------------------------------------XXXXXXXXXXXXXX-------------------------------------------------------

                    $leadID = $result;

                    $contactCombinedValues = $this->security->xss_clean($this->input->post('contactCombinedValues'));
                    $is_primary_contact = $this->input->post('is_primary_contact');
                    $contactArr = json_decode($contactCombinedValues);
                    
                    if($contactArr){
                        foreach($contactArr as $contactArrVal){
                            $projectId = $leadID;
                            //var_dump($contactArrVal);
                            $contactRandomId = $contactArrVal->contactRandomId;

                            if($contactRandomId == $is_primary_contact){
                                $conatctPrimary = $contactArrVal->conatctPrimary;
                            }else{
                                $conatctPrimary = 0;
                            }

                            $checkClientContact = $this->project_model->checkClientContact($contactArrVal->clientId,$contactRandomId);

                            if(!empty($checkClientContact) && isset($checkClientContact)){
                                $updateContactData   =  array(
                                    'contact_name'  =>  $contactArrVal->contactName,
                                    'contact_email' =>  $contactArrVal->conatctEmail,
                                    'contact_phone' =>  $contactArrVal->conatctPh,
                                    'contact_phone2' =>  $contactArrVal->conatctPh2,
                                    'contact_company' =>  $contactArrVal->conatctCompany,
                                    'created_at'    =>  date('Y-m-d H:i:s')
                                );
                                $contactId = $this->project_model->updateContact($updateContactData,$contactRandomId,$contactArrVal->clientId);
                            }else{
                                $insertContactData   =  array(
                                    'clientId'  =>  $contactArrVal->clientId,
                                    'userID' => $this->session->userdata['userId'],
                                    'contact_name'  =>  $contactArrVal->contactName,
                                    'contact_email'          =>  $contactArrVal->conatctEmail,
                                    'contact_phone'          =>  $contactArrVal->conatctPh,
                                    'contact_phone2'          =>  $contactArrVal->conatctPh2,
                                    'contact_company'          =>  $contactArrVal->conatctCompany,
                                    'contactRandomId'          =>  $contactArrVal->contactRandomId,
                                    'created_at'    =>  date('Y-m-d H:i:s')
                                );
                                $this->db->insert('amp_contact',$insertContactData);
                                $contactId = $this->db->insert_id(); 
                            }

                            if($contactId > 0){
                                $checkProjectContact = $this->project_model->checkProjectContact($projectId,$contactId);
                                if(empty($checkProjectContact)){
                                    $insertProjectContact   =  array(
                                        'userID' => $this->session->userdata['userId'],
                                        'projectId'  =>  $projectId,
                                        'contactId'  =>  $contactId,
                                        'is_primary'  =>  $conatctPrimary,
                                    );
                                    $this->db->insert('amp_project_contact',$insertProjectContact);
                                }else{
                                    $updateProjectContact   =  array('is_primary' => $conatctPrimary);
                                    $checkProjectContact = $this->project_model->updateProjectContact($updateProjectContact,$projectId,$contactId);
                                }
                            }
                        }
                    }

                //---------------------------------------------------client Insert-------------------------------------------------------

                $leadID = $result;
                $clientCombinedValues = $this->security->xss_clean($this->input->post('clientCombinedValues'));
                $clientArr = json_decode($clientCombinedValues);

                if($clientArr){
                    foreach($clientArr as $clientArrVal){
                        $projectId = $leadID;
                        $clientIDs = explode("-",$clientArrVal->clientRandomId);
                        $insertClientData   =  array(
                            'projectId'        =>  $projectId,
                            'userID' => $this->session->userdata['userId'],
                            'clientId'  =>  $clientIDs[1],
                            'created_at'    =>  date('Y-m-d H:i:s')
                        );
                        $this->db->insert('amp_project_clients',$insertClientData);
                    } 
                }


                if ($result > 0) {
                    $optionDataInfo = array('projectId'=>$result,'sms'=>$sms,'calls'=>$call,'email'=>$emails,'other'=>$other,'createdDtm' => date('Y-m-d H:i:s'));
                    $this->project_model->addoptionData($optionDataInfo);
                    $this->session->set_flashdata('success', 'New Project created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Project creation failed');
                }

                redirect('projectListing');
            }
        }
    }

    /**
     * This function is used load lead edit information.
     *
     * @param number $userId : Optional : This is user id
     */
    public function editProject($projectId = null)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            
            //Get email templates
            $data['emailTemplates'] = $this->project_model->getEmailTemplates();

            if ($projectId == null) {
                redirect('projectListing');
            }

            $userID =  $this->session->userdata['userId'];
             //Get call key
            $data['phonecallEnable']  = $this->project_model->checkCallAPIEnable();

            //$data['sales_rep'] = $this->user_model->getSalesRep();
            $data['sales_rep'] = $this->user_model->getAllActiveUser(); 
            $data['userlist'] = $this->user_model->getAllActiveUser();
            $data['stages'] = $this->project_model->getStages();
            $data['tags'] = $this->project_model->getTags();
            $data['jobTypes'] = $this->project_model->getJobTypes();
            $data['referral_type'] = $this->project_model->getrefType();
            $data['communication'] = $this->project_model->getCommunication($projectId);
            $data['files'] = $this->project_model->getFiles($projectId);
            $data['stage_history'] = $this->project_model->getHistory($projectId);
            $data['notes_history'] = $this->project_model->getNotesHistory($projectId);
            $data['optionData'] = $this->project_model->getOptionData($projectId);
            $data['leadInfo'] = $this->project_model->getLeadInfo($projectId);
            $data['clientsInfo'] = $this->project_model->getClientsInfo();
            $data['bidInfo'] = $this->project_model->getBidByProjectId($userID,$projectId);
            //$data['cross_selling'] = $this->project_model->getSelling();
            //$data['referral_sources'] = $this->project_model->getrefSources();
            //$data['countries'] = $this->project_model->getCountry();

            // get file system base url from setting
            $data['filesystem_url'] = NULL;
            $sql    = "SELECT filesystem_url FROM amp_setting WHERE id = 1";
            $result = $this->db->query($sql)->result_array();
            if(isset($result[0]['filesystem_url']) && $result[0]['filesystem_url']!=''){
                $data['filesystem_url'] = $result[0]['filesystem_url'];
            }


            //---------------------------------------------------Get Task info Added by Ram---------------------------------------------------
            $data['taskInfo']       = $this->project_model->getTaskInfo($projectId);
            $taskInfo       = $data['taskInfo'];
            $taskArr        = [];
            $taskArrMain    = [];
            if($taskInfo){
                foreach ($taskInfo as$task) {
                    $taskArr['taskRandomID']=   $task->taskRandomId;
                    $taskArr['taskMsg']     =   $task->name;
                    $taskArr['taskExpDate'] =   date("m/d/Y", strtotime($task->eventDate));
                    $taskArrMain[] = $taskArr;
                }
            }
            $data['taskInfoJson']       = $taskArrMain;
            //--------------------------------------------------XXXXXXXXXXXXXX----------------------------------------------------

            //---------------------------------------------------Get Task info Added by Ram---------------------------------------------------
            $data['contacInfo']       = $this->project_model->getContactInfo($projectId);

            $contacInfo       = $data['contacInfo'];
            $contactArr        = [];
            $contactArrMain    = [];
            if($contacInfo){
                foreach ($contacInfo as$contact) {
                    $contactArr['clientId']=   $contact->clientId;
                    $contactArr['conatctPrimary']=   $contact->is_primary;
                    $contactArr['contactName']=   $contact->contact_name;
                    $contactArr['conatctAddress']     =   $contact->address;
                    $contactArr['conatctEmail']     =   $contact->contact_email;
                    $contactArr['conatctPh'] =   $contact->contact_phone;
                    $contactArr['conatctPh2'] =   $contact->contact_phone2;
                    $contactArr['conatctCompany']     =   $contact->contact_company;
                    $contactArr['contactRandomId'] =   $contact->contactRandomId;
                    $contactArrMain[] = $contactArr;
                }
            }
            $data['contactInfoJson']       = $contactArrMain;
            //---------------------------------------------------Get Client info Added by Ram---------------------------------------------------
            $data['clientInfo']  = $this->project_model->getClientInfo($projectId);


            $clientInfo       = $data['clientInfo'];
            $clientArr        = [];
            $clientArrMain    = [];

            if($clientInfo){

                foreach ($clientInfo as $client) {
                    $clientArr['clientName']=   $client->client_name;
                    $clientArr['clientRandomId'] =  'client-'.$client->id;
                    $clientArrMain[] = $clientArr;
                }
            }
            $data['clientInfoJson']       = $clientArrMain;

            //--------------------------------------------------XXXXXXXXXXXXXX----------------------------------------------------
            

            $this->global['pageTitle'] = 'Amplify : Edit Project';
            $this->global['PageEdit'] = "Edit Project: #".$data['leadInfo']->filesystem_id." - ".$data['leadInfo']->projectName;

            $this->loadViews('projects/edit_project', $this->global, $data, null);
        }
    }

    /**
     * This function is used load lead edit information.
     *
     * @param number $userId : Optional : This is user id
     */
    public function copyProject()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $projectId = $this->input->post('projectId');

            if ($projectId == null) {
                redirect('projectListing');
            }

            $userID =  $this->session->userdata['userId'];
             //Get call key
            $data['phonecallEnable']  = $this->project_model->checkCallAPIEnable();

            //$data['sales_rep'] = $this->user_model->getSalesRep();
            $data['sales_rep'] = $this->user_model->getAllActiveUser(); 
            $data['userlist'] = $this->user_model->getAllActiveUser();
            $data['stages'] = $this->project_model->getStages();
            $data['tags'] = $this->project_model->getTags();
            $data['jobTypes'] = $this->project_model->getJobTypes();
            $data['referral_type'] = $this->project_model->getrefType();
            $data['communication'] = $this->project_model->getCommunication($projectId);
            $data['files'] = $this->project_model->getFiles($projectId);
            $data['stage_history'] = $this->project_model->getHistory($projectId);
            $data['notes_history'] = $this->project_model->getNotesHistory($projectId);
            $data['optionData'] = $this->project_model->getOptionData($projectId);
            $leadInfo = $this->project_model->getLeadInfo($projectId);
            $data['clientsInfo'] = $this->project_model->getClientsInfo();
            $bidInfo = $this->project_model->getBidByProjectId($userID,$projectId);
            //print_r($data['bidInfo']);die;
            //$data['cross_selling'] = $this->project_model->getSelling();
            //$data['referral_sources'] = $this->project_model->getrefSources();
            //$data['countries'] = $this->project_model->getCountry();

            // get file system base url from setting
            $data['filesystem_url'] = NULL;
            $sql    = "SELECT filesystem_url FROM amp_setting WHERE id = 1";
            $result = $this->db->query($sql)->result_array();
            if(isset($result[0]['filesystem_url']) && $result[0]['filesystem_url']!=''){
                $data['filesystem_url'] = $result[0]['filesystem_url'];
            }


            //---------------------------------------------------Get Task info Added by Ram---------------------------------------------------
            $data['taskInfo']       = $this->project_model->getTaskInfo($projectId);
            $taskInfo       = $data['taskInfo'];
            $taskArr        = [];
            $taskArrMain    = [];
            if($taskInfo){
                foreach ($taskInfo as$task) {
                    $taskArr['taskRandomID']=   $task->taskRandomId;
                    $taskArr['taskMsg']     =   $task->name;
                    $taskArr['taskExpDate'] =   date("m/d/Y", strtotime($task->eventDate));
                    $taskArrMain[] = $taskArr;
                }
            }
            $data['taskInfoJson']       = $taskArrMain;
            //--------------------------------------------------XXXXXXXXXXXXXX----------------------------------------------------

            //---------------------------------------------------Get Task info Added by Ram---------------------------------------------------
            $data['contacInfo']       = $this->project_model->getContactInfo($projectId);

            $contacInfo       = $data['contacInfo'];
            $contactArr        = [];
            $contactArrMain    = [];
            if($contacInfo){
                foreach ($contacInfo as$contact) {
                    $contactArr['clientId']=   $contact->clientId;
                    $contactArr['conatctPrimary']=   $contact->is_primary;
                    $contactArr['contactName']=   $contact->contact_name;
                    $contactArr['conatctAddress']     =   $contact->address;
                    $contactArr['conatctEmail']     =   $contact->contact_email;
                    $contactArr['conatctPh'] =   $contact->contact_phone;
                    $contactArr['conatctPh2'] =   $contact->contact_phone2;
                    $contactArr['conatctCompany']     =   $contact->contact_company;
                    $contactArr['contactRandomId'] =   $contact->contactRandomId;
                    $contactArrMain[] = $contactArr;
                }
            }
            $data['contactInfoJson']       = $contactArrMain;
            //---------------------------------------------------Get Client info Added by Ram---------------------------------------------------
            $data['clientInfo']  = $this->project_model->getClientInfo($projectId);


            $clientInfo       = $data['clientInfo'];
            $clientArr        = [];
            $clientArrMain    = [];

            if($clientInfo){

                foreach ($clientInfo as $client) {
                    $clientArr['clientName']=   $client->client_name;
                    $clientArr['clientRandomId'] =  'client-'.$client->id;
                    $clientArrMain[] = $clientArr;
                }
            }
            $data['clientInfoJson']       = $clientArrMain;

            //--------------------------------------------------XXXXXXXXXXXXXX----------------------------------------------------
            
//print_r($data);die;

               $projectName = $leadInfo->projectName."- COPY";
               $filesystem_id = trim($leadInfo->filesystem_id)."-1";
                //$firstName = $this->security->xss_clean($this->input->post('firstName'));
                //$lastName = $this->security->xss_clean($this->input->post('lastName'));
                $budget = $leadInfo->budget;
                $scope = $leadInfo->scope;
                // if($scope != ""){
                //     $scopeVal = implode(",", $scope);
                // }else{
                //     $scopeVal = "";
                // }
                
                $wages = $leadInfo->wages;
                // if(!empty($wages)){
                //     $wages = implode(",", $wages);
                // }
                $sales = $leadInfo->sales;
                $admin = $leadInfo->admin;
                $estimator = $leadInfo->estimator;
                // if(!empty($estimator)){
                //     $estimator = implode(",", $estimator);
                // }
                $estimator_email = $leadInfo->estimator_email;
                $client_name = "";
                $due_date = $leadInfo->dueDate;
                $due_time = $leadInfo->dueTime;
                $job_walk_time = $leadInfo->jobWalkTime;
                $est_start_date = $leadInfo->estStartDate;
                $rfi_deadline = $leadInfo->rfiDeadline;
                $bid_form = $leadInfo->bidForm;
               // $bid_price = $this->input->post('bid_price');

                $bid_price = $leadInfo->bid_price;

                $reports = $leadInfo->reports;
                //$lostnote = $this->input->post('lostnote');
                
                $main_contact = $leadInfo->mainContact;

                


                $address = $leadInfo->address;
                $referralType = "";
                $dl = $leadInfo->DL;
                $dob = $leadInfo->dob;
                $email = $leadInfo->email;
                $phone1 = $leadInfo->phoneNo1;
                $phone2 = $leadInfo->phoneNo2;
                $sales_rep = $leadInfo->salesRepId;
                $countryId = $leadInfo->countryId;
                $referralId = "";
                $stageId = $leadInfo->stageId;
                $brokerFee = $leadInfo->brokerFee;
                $comment = $leadInfo->notes;
                $tagId = $leadInfo->tagId;
                $jobTypeId = $leadInfo->jobtypeid;
                $ownership = $leadInfo->ownership;
                $policyExp = $leadInfo->policyExpiration;
                $businessOwner = $leadInfo->businessOwner;
                $iid = $leadInfo->IID;


                $buildingSf = $leadInfo->buildingSf;
                $marketType = $leadInfo->marketType;
                $buildingType = $leadInfo->buildingType;
                $materialNeeds = $leadInfo->materialNeeds;
                
                
                
                // generate random string
                $this->load->helper('string');
                $string = random_string('alpha', 5);
                //$fs_id = $string."-".time();
                $optionIn = $this->input->post('optionIn'); 
                $sms = '' ;
                $call = '';
                $emails='';
                $other = '';
                if(isset($optionIn[0])){
                    $sms = $optionIn[0];
                }if(isset($optionIn[1])){
                    $call = $optionIn[1];
                }if(isset($optionIn[2])){
                    $emails = $optionIn[2];
                }if(isset($optionIn[3])){
                    $other = $optionIn[3];
                }

                $is_priority = $leadInfo->is_priority;//$this->input->post('is_priority');
                // if( $is_priority == NULL ||  $is_priority == ""){
                //     $ispriority = 0;
                // }else{
                //     $ispriority = 1;
                // }

                $contract = $leadInfo->contract;
                if(!empty($materialNeeds)){

                    $materialNeeds = implode(",", $materialNeeds);
                }
                $company =$leadInfo->company;
               
                $latitude      = $leadInfo->latitude;
                $longitude     = $leadInfo->longitude;
                
                $leadInfo = array(
                    'is_priority' => $is_priority,
                    'projectName' => $projectName,
                    'contract' => $contract,
                    'budget' => $budget,
                    'scope' =>  $scope,
                    'wages' =>  $wages,
                    'sales' =>  $sales,
                    'admin' =>  $admin,
                    'estimator' =>  $estimator,
                    'estimator_email' => $estimator_email,
                    'clientName' => $client_name,
                    'dueDate' => $due_date,
                    'dueTime' => $due_time,
                    'jobWalkTime' => $job_walk_time,
                    'estStartDate' => $est_start_date,
                    'rfiDeadline' =>   $rfi_deadline,
                    'bidForm' => $bid_form,
                    'bid_price' => $bid_price,
                    'reports' =>   $reports,
                    //'mainContact' =>  $main_contact,
                    'address' => $address,
                    'reftypeId'=>$referralType,
                    'dl' => $dl,
                    'dob'=>$dob, 
                    'email' => $email,
                    'phoneNo1' => $phone1, 
                    'phoneNo2' => $phone2, 
                    'salesRepId' => $sales_rep, 
                    'countryId' => $countryId,
                    'referralSourceId'=>$referralId, 
                    'userID' => $this->session->userdata['userId'], 
                    'stageId' => $stageId,
                    'brokerFee' => $brokerFee,
                    'notes'=>$comment,
                    'tagId'=> $tagId,
                    'jobtypeid'=> $jobTypeId,
                    'ownership'=>$ownership,
                    'policyExpiration'=>$policyExp,
                    'IID'=>$iid,
                    'businessOwner'=>$businessOwner,
                    'createdDtm' => date('Y-m-d H:i:s'), 
                    'filesystem_id' => $filesystem_id,
                    'buildingSf' => $buildingSf,
                    'marketType' => $marketType,
                    'buildingType' => $buildingType,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'materialNeeds' => $materialNeeds,
                    'company' => $company
                );
              //  $fileInfo = array('name'=>$picture,'type'=>$file_ext,'createdDtm' => date('Y-m-d H:i:s'));
               //print_r($leadInfo);die;
                $result = $this->project_model->addNewProject($leadInfo);
                $userID =  $this->session->userdata['userId'];
                $dupBidArray = array();
                if(!empty($bidInfo)){
                    $rand = 'bid-'.rand(10,100000);
                    foreach ($bidInfo as $key => $value) {
                        unset($value->id);
                        $dupBidArray[$key] = $value;
                        $dupBidArray[$key]->projectId = $result;
                        $dupBidArray[$key]->created_date = date('Y-m-d H:i:s');
                        $dupBidArray[$key]->bidRandomId = $rand;
                    }
                    $insertId = $this->project_model->insertDuplicateBid($dupBidArray);
                }
                if ($result > 0) {
                    echo json_encode(array('status' => true,'projectId' => $result));
                } else {
                    echo json_encode(array('status' => false));
                }
        }
    }

    /**
     * This function is used to create pdf .
     *
     * @param number $userId : Optional : This is user id
     */
    public function pdfProject($projectId = null)
    {
        // $this->load->library('dompdf_lib');
        // $data = array();
        // $html = $this->loadViews('projects/pdf_project', $this->global, $data, null);
        // $this->dompdf_lib->convert_html_to_pdf($html, $pdf_filename, true);die;
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            
            //Get email templates
            $data['emailTemplates'] = $this->project_model->getEmailTemplates();

            if ($projectId == null) {
                redirect('projectListing');
            }


             //Get call key
            $data['phonecallEnable']  = $this->project_model->checkCallAPIEnable();

            //$data['sales_rep'] = $this->user_model->getSalesRep();
            $data['sales_rep'] = $this->user_model->getAllActiveUser(); 
            $data['userlist'] = $this->user_model->getAllActiveUser();
            $data['stages'] = $this->project_model->getStages();
            $data['tags'] = $this->project_model->getTags();
            $data['jobTypes'] = $this->project_model->getJobTypes();
            $data['referral_type'] = $this->project_model->getrefType();
            $data['communication'] = $this->project_model->getCommunication($projectId);
            $data['files'] = $this->project_model->getFiles($projectId);
            $data['stage_history'] = $this->project_model->getHistory($projectId);
            $data['notes_history'] = $this->project_model->getNotesHistory($projectId);
            $data['optionData'] = $this->project_model->getOptionData($projectId);
            $data['leadInfo'] = $this->project_model->getLeadInfo($projectId);
            $data['clientsInfo'] = $this->project_model->getClientsInfo();
            //$data['cross_selling'] = $this->project_model->getSelling();
            //$data['referral_sources'] = $this->project_model->getrefSources();
            //$data['countries'] = $this->project_model->getCountry();

            // get file system base url from setting
            $data['filesystem_url'] = NULL;
            $sql    = "SELECT filesystem_url FROM amp_setting WHERE id = 1";
            $result = $this->db->query($sql)->result_array();
            if(isset($result[0]['filesystem_url']) && $result[0]['filesystem_url']!=''){
                $data['filesystem_url'] = $result[0]['filesystem_url'];
            }


            //---------------------------------------------------Get Task info Added by Ram---------------------------------------------------
            $data['taskInfo']       = $this->project_model->getTaskInfo($projectId);
            $taskInfo       = $data['taskInfo'];
            $taskArr        = [];
            $taskArrMain    = [];
            if($taskInfo){
                foreach ($taskInfo as$task) {
                    $taskArr['taskRandomID']=   $task->taskRandomId;
                    $taskArr['taskMsg']     =   $task->name;
                    $taskArr['taskExpDate'] =   date("m/d/Y", strtotime($task->eventDate));
                    $taskArrMain[] = $taskArr;
                }
            }
            $data['taskInfoJson']       = $taskArrMain;
            //--------------------------------------------------XXXXXXXXXXXXXX----------------------------------------------------

            //---------------------------------------------------Get Task info Added by Ram---------------------------------------------------
            $data['contacInfo']       = $this->project_model->getContactInfo($projectId);
            $contacInfo       = $data['contacInfo'];
            $contactArr        = [];
            $contactArrMain    = [];
            if($contacInfo){
                foreach ($contacInfo as$contact) {
                    $contactArr['clientId']=   $contact->clientId;
                    $contactArr['conatctPrimary']=   $contact->is_primary;
                    $contactArr['contactName']=   $contact->contact_name;
                    $contactArr['conatctAddress']     =   $contact->address;
                    $contactArr['conatctEmail']     =   $contact->contact_email;
                    $contactArr['conatctPh'] =   $contact->contact_phone;
                    $contactArr['conatctPh2'] =   $contact->contact_phone2;
                    $contactArr['conatctCompany']     =   $contact->contact_company;
                    $contactArr['contactRandomId'] =   $contact->contactRandomId;
                    $contactArrMain[] = $contactArr;
                }
            }
            $data['contactInfoJson']       = $contactArrMain;

            //---------------------------------------------------Get Client info Added by Ram---------------------------------------------------
            $data['clientInfo']  = $this->project_model->getClientInfo($projectId);

            $clientInfo       = $data['clientInfo'];
            $clientArr        = [];
            $clientArrMain    = [];

            if($clientInfo){

                foreach ($clientInfo as $client) {
                    $clientArr['clientName']=   $client->client_name;
                    $clientArr['clientRandomId'] =  'client-'.$client->id;
                    $clientArrMain[] = $clientArr;
                }
            }
            $data['clientInfoJson']       = $clientArrMain;

            //--------------------------------------------------XXXXXXXXXXXXXX----------------------------------------------------
            

            // $this->global['pageTitle'] = 'Amplify : Edit Project';
            // $this->global['PageEdit'] = $data['leadInfo']->projectName;
            // $this->loadViews('projects/pdf_project', $this->global, $data, null);

            $this->load->library('pdf');
            $this->pdf->load_view('projects/pdf_project',$data);
            $this->pdf->render();
            $this->pdf->stream("pdf_project.pdf");

            //$this->loadViews('projects/edit_project', $this->global, $data, null);
        }
    }

    /**
     * This function is used to edit the lead information.
     */
    public function editProjectSubmit()
    {
        //print_r($this->input->post('contactCombinedValues'));die;
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {            
                $this->load->library('form_validation');

                $this->form_validation->set_rules('projectName','Project Name', 'trim|required|max_length[128]|callback_check_project_name');
                $this->form_validation->set_rules('filesystem_id','Job Number', 'callback_check_project_file_id');

                $projectId = $this->input->post('projectId');

                if ($this->form_validation->run() == false) {
                    $this->editProject($projectId);
                }else{

                    $pname = $this->security->xss_clean($this->input->post('projectName'));
                   
                    $budget = $this->input->post('budget');
                    $scope = $this->input->post('scope');
                    if($scope != ""){
                        $scopeVal = implode(",", $scope);
                    }else{
                        $scopeVal = "";
                    }
                    $wages = $this->input->post('wagesId');
                    if(!empty($wages)){
                        $wages = implode(",", $wages);
                    }
                    $sales = $this->input->post('sales');
                    $admin = $this->input->post('admin');
                    $estimator = $this->input->post('estimator');
                    if(!empty($estimator)){
                        $estimator = implode(",", $estimator);
                    }
                    $estimator_email = $this->input->post('estimator_email');
                    $client_name = $this->input->post('client_name');
                    $due_date = $this->input->post('due_date');
                    $due_time = $this->input->post('due_time');
                    $job_walk_time = $this->input->post('job_walk_time');
                    $est_start_date = $this->input->post('est_start_date');
                    $rfi_deadline = $this->input->post('rfi_deadline');
                    $bid_form = $this->input->post('bid_form');
                    $bid_price = str_replace( '$', '',str_replace( ',', '', $this->input->post('bid_price')));
                    $reports = $this->input->post('reports');
                    //$main_contact = $this->input->post('main_contact');

                    $filesystem_id = $this->input->post('filesystem_id');

                    $lostnote = $this->input->post('lostnote');


                    $address = $this->input->post('address');
                    $referral_type = $this->input->post('referral_type');
                    $dl = $this->input->post('dl');
                    $dob = $this->input->post('dob');
                    $email = strtolower($this->security->xss_clean($this->input->post('email')));
                    $phone1 = $this->security->xss_clean($this->input->post('phone1'));
                    $phone2 = $this->security->xss_clean($this->input->post('phone2')); 
                    
                    $sales_rep = $this->input->post('sales_rep');
                    
                    $referralId = $this->input->post('referralSourceId');
                    $stage = $this->input->post('stage');
                    $brokerFee = $this->input->post('brokerFee');
                    $brokerFee = str_replace("$", "", $brokerFee);
                    $countryId = $this->input->post('countryId');

                    $comment = $this->input->post('comment');
                    $tag = $this->input->post('tagId');
                    $jobTypeId = $this->input->post('jobTypeId');
                    $ownership = $this->input->post('ownership');
                    $policyExp = $this->input->post('policyExp');
                    $businessOwner = $this->input->post('businessOwner');
                    $iid = $this->input->post('iid');

                    $buildingSf = str_replace( ',', '', $this->input->post('building_sf'));//$this->input->post('building_sf');
                    $marketType = $this->input->post('marketTypeId');
                    $buildingType = $this->input->post('buildingTypeId');
                    $materialNeeds = $this->input->post('materialNeedsId');
                    $company = $this->input->post('company');

                    $is_priority = $this->input->post('is_priority');
                    if( $is_priority == NULL ||  $is_priority == ""){
                        $ispriority = 0;
                    }else{
                        $ispriority = 1;
                    }

                    $contract = $this->input->post('contract');

                    if(!empty($materialNeeds)){
                        $materialNeeds = implode(",", $materialNeeds);
                    }
                    $optionIn = $this->input->post('optionIn');
                    $projectId = $this->input->post('projectId');
                    $sms = '' ;
                    $call = '';
                    $emails='';
                    $other='';
                    if(isset($optionIn[0])){
                        $sms = $optionIn[0];
                    }if(isset($optionIn[1])){
                        $call = $optionIn[1];
                    }if(isset($optionIn[2])){
                        $emails = $optionIn[2];
                    }if(isset($optionIn[3])){
                        $other = $optionIn[3];
                    }

                    $optionDataInfo = array('sms'=>$sms,'calls'=>$call,'email'=>$emails,'other'=>$other,'createdDtm' => date('Y-m-d H:i:s'));
                    $this->project_model->editoptionData($optionDataInfo,$projectId);

                    $history = array('projectId'=>$projectId,'stageId'=>$stage,'createdDtm' =>  date('Y-m-d H:i:s'),
                        'updatedDtm'    =>  date('Y-m-d H:i:s'));
                    $checkHistory = $this->project_model->checkleadHistory($projectId,$stage);
                    if(empty($checkHistory)){
                        $historyresult = $this->project_model->addStageHistory($history);
                    }

                    /* Notes History*/
                    if(isset($comment) && !empty($comment)){
                        $userID =  $this->session->userdata['userId'];
                        $noteshistory = array('userId'=>$userID,'projectId'=>$projectId,'notes'=>$comment,'status'=>1,'createdDtm' =>  date('Y-m-d H:i:s'),'updatedDtm'=>  date('Y-m-d H:i:s'));
                        $notehistoryresult = $this->project_model->addNotesHistory($noteshistory);
                    }
                    /* Notes History*/

                    /*Lost Notes History*/
                    if(isset($lostnote) && !empty($lostnote)){
                        $userID =  $this->session->userdata['userId'];
                        $lnoteshistory = array('userId'=>$userID,'projectId'=>$projectId,'notes'=>$lostnote,'status'=>1,'createdDtm' =>  date('Y-m-d H:i:s'),'updatedDtm'=>  date('Y-m-d H:i:s'));
                        $lnotehistoryresult = $this->project_model->addNotesHistory($lnoteshistory);
                    }
                    /* Lost Notes History*/

                    // file coded by shubham vaishnav
                    $targetDir =  base_url()."assets/uploads/files/";
                    $allowTypes = array('jpg','png','jpeg','gif','pdf','docx','doc','tiff','zip','html','xml','xls');
                    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
                   
                    if(!empty(array_filter($_FILES['image']['name']))){
                        //$result = $this->project_model->deletefile($projectId);
                         $files = array_unique($_FILES['image']['name']);
                        foreach($files as $key=>$val){
                            // File upload path
                            $fileName = basename($_FILES['image']['name'][$key]);
                            $targetFilePath = FCPATH."assets/uploads/files/". $fileName;
                    
                            // Check whether file type is valid
                            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                            $fileSize = $_FILES['image']['size'][$key];
                            if(in_array($fileType, $allowTypes)){
                                // Upload file to server
                                if(move_uploaded_file($_FILES["image"]["tmp_name"][$key], $targetFilePath)){
                                    // Image db insert sql
                                    $insertValuesSQL =  $fileName;
                                    
                                    // Insert image file name into database
                                    $result = $this->project_model->editfile($projectId,$insertValuesSQL,$fileType,$fileSize);
                                }else{
                                    $errorUpload .= $_FILES['image']['name'][$key].', ';
                                }
                            }else{
                                $errorUploadType .= $_FILES['image']['name'][$key].', ';
                            }
                        }
        
                        if(!empty($insertValuesSQL)){
                            
                            if($result){
                                $errorUpload = !empty($errorUpload)?'Upload Error: '.$errorUpload:'';
                                $errorUploadType = !empty($errorUploadType)?'File Type Error: '.$errorUploadType:'';
                                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType;
                                $statusMsg = "Files are uploaded successfully.".$errorMsg;
                            }else{
                                $statusMsg = "Sorry, there was an error uploading your file.";
                            }
                        }
                    }else{
                        $statusMsg = 'Please select a file to upload.';
                    }
                        //}
                            // file code end 
                            // Display status message
                           // echo $statusMsg;
                    $getLatLong    = $this->map_model->getLatLong($address);//print_r($getLatLong);
                    $getLatLongArr = explode("@",$getLatLong);
                    $latitude      = $getLatLongArr[0];
                    $longitude     = $getLatLongArr[1];
                    
                    $leadInfo = array(
                        'is_priority' => $ispriority,
                        'projectName' => $pname,
                        'contract' => $contract,
                        //'firstName' => $fname,
                       // 'lastName' => $lname, 
                        'budget' => $budget,
                        'scope' =>  $scopeVal,
                        'wages' =>  $wages,
                        'sales' =>  $sales,
                        'admin' =>  $admin,
                        'estimator' =>  $estimator,
                        'estimator_email' => $estimator_email,
                        'clientName' => $client_name,
                        'dueDate' => $due_date,
                        'dueTime' => $due_time,
                        'jobWalkTime' => $job_walk_time,
                        'estStartDate' => $est_start_date,
                        'rfiDeadline' =>   $rfi_deadline,
                        'bidForm' => $bid_form,
                        'bid_price' => $bid_price,
                        'reports' =>   $reports,
                        //'mainContact' =>  $main_contact,
                        'phoneNo1' => $phone1, 
                        'phoneNo2' => $phone2, 
                        'email' => $email, 
                        'salesRepId' => $sales_rep, 
                        'stageId' => $stage,
                        'brokerFee'=>$brokerFee,
                        'reftypeId'=>$referral_type, 
                        'referralSourceId' => $referralId, 
                        'DL'=>$dl,
                        'dob'=>$dob, 
                        'address' => $address,
                        'notes'=>$comment,
                        'ownership'=>$ownership,
                        'policyExpiration'=>$policyExp,
                        'businessOwner'=>$businessOwner, 
                        'countryId'=>$countryId,
                        'IID'=>$iid,
                        'tagId' => $tag,
                        'jobtypeid' => $jobTypeId,
                        'updatedDtm' => date('Y-m-d H:i:s'),
                        'filesystem_id' => $filesystem_id,
                        'buildingSf' => $buildingSf,
                        'marketType' => $marketType,
                        'buildingType' => $buildingType,
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'materialNeeds' => $materialNeeds,
                        'company' => $company
                    );

                    $result = $this->project_model->editLead($leadInfo,$projectId);
                   
                    $bidCombinedValues = $this->input->post('bidCombinedValues');
                    $bidArray = explode(",", trim($bidCombinedValues,","));
                    $userID =  $this->session->userdata['userId'];
                    if(!empty($bidArray)){
                        $bidRandomIDVal = $this->input->post('bidRandomIDVal');
                        $this->project_model->updateBids($projectId,$bidArray, $userID,$bidRandomIDVal,$buildingSf);
                    }
                    
                     //--------------------------------------------------- Edit Task Added by Ram---------------------------------------------------------
                    //Delete Task First
                    // $this->db->where('projectId', $projectId);
                    // $this->db->delete('amp_tasks');

                    //Insert  Task
                    $taskCombinedValues = $this->security->xss_clean($this->input->post('taskCombinedValues'));
                    //print_r($taskCombinedValues);die;
                    $taskArr = json_decode($taskCombinedValues);
                    if($taskArr){
                        foreach($taskArr as $taskArrVal){
                            $projectId = $projectId;
                            $taskRandomId =$taskArrVal->taskRandomID;
                            $checkStatus = $this->project_model->checkTaskStatus($projectId,$taskRandomId);
                            if(!empty($checkStatus) && isset($checkStatus)){
                                    $insertData   =  array(
                                    'name'          =>  $taskArrVal->taskMsg,
                                    'eventDate'    =>  date("Y-m-d", strtotime($taskArrVal->taskExpDate)),
                                    //'userID' => $this->session->userdata['userId'],
                                    'createdDtm'    =>  date('Y-m-d H:i:s')
                                );
                                $taskaddresult = $this->project_model->updateTask($insertData,$taskArrVal->taskRandomID,$projectId);
                            }else{
                                $insertData   =  array(
                                'projectId'        =>  $projectId,
                                'taskRandomId'  =>  $taskArrVal->taskRandomID,
                                'name'          =>  $taskArrVal->taskMsg,
                                'userID' => $this->session->userdata['userId'],
                                'eventDate'    =>  date("Y-m-d", strtotime($taskArrVal->taskExpDate)),
                                'createdDtm'    =>  date('Y-m-d H:i:s')
                            );
                            $this->db->insert('amp_tasks',$insertData);
                            
                            }                         
                        }
                    }
                    $taskData = $this->input->post('task');
                    if($taskData){
                        foreach ($taskData as $task) {                       
                            $taskupdateInfo = array('taskStatus' => 1);
                            $taskresult = $this->project_model->updateTaskStatus($taskupdateInfo,$task,$projectId);
                        }
                    }
                    
                    //---------------------------------------------------XXXXXXXXXXXXXX-------------------------------------------------------


                    //--------------------------------------------------- Edit Contact Added by Ram---------------------------------------------------------
      
                    //Insert  Contact
                    $contactCombinedValues = $this->security->xss_clean($this->input->post('contactCombinedValues'));

                    $is_primary_contact = $this->input->post('is_primary_contact');
                    $contactArr = json_decode($contactCombinedValues);
                    
                    if($contactArr){
                        foreach($contactArr as $contactArrVal){
                            $projectId = $projectId;
                            //var_dump($contactArrVal);
                            $contactRandomId = $contactArrVal->contactRandomId;

                            if($contactRandomId == $is_primary_contact){
                                $conatctPrimary = $contactArrVal->conatctPrimary;
                            }else{
                                $conatctPrimary = 0;
                            }

                            $checkClientContact = $this->project_model->checkClientContact($contactArrVal->clientId,$contactRandomId);

                            if(!empty($checkClientContact) && isset($checkClientContact)){
                                $updateContactData   =  array(
                                    'contact_name'  =>  $contactArrVal->contactName,
                                    'contact_email' =>  $contactArrVal->conatctEmail,
                                    'contact_phone' =>  $contactArrVal->conatctPh,
                                    'contact_phone2' =>  $contactArrVal->conatctPh2,
                                    'contact_company' =>  $contactArrVal->conatctCompany,
                                    'created_at'    =>  date('Y-m-d H:i:s')
                                );
                                $contactId = $this->project_model->updateContact($updateContactData,$contactRandomId,$contactArrVal->clientId);
                            }else{
                                $insertContactData   =  array(
                                    'clientId'  =>  $contactArrVal->clientId,
                                    'userID' => $this->session->userdata['userId'],
                                    'contact_name'  =>  $contactArrVal->contactName,
                                    'contact_email'          =>  $contactArrVal->conatctEmail,
                                    'contact_phone'          =>  $contactArrVal->conatctPh,
                                    'contact_phone2'          =>  $contactArrVal->conatctPh2,
                                    'contact_company'          =>  $contactArrVal->conatctCompany,
                                    'contactRandomId'          =>  $contactArrVal->contactRandomId,
                                    'created_at'    =>  date('Y-m-d H:i:s')
                                );
                                $this->db->insert('amp_contact',$insertContactData);
                                $contactId = $this->db->insert_id(); 
                            }

                            if($contactId > 0){
                                $checkProjectContact = $this->project_model->checkProjectContact($projectId,$contactId);
                                if(empty($checkProjectContact)){
                                    $insertProjectContact   =  array(
                                        'userID' => $this->session->userdata['userId'],
                                        'projectId'  =>  $projectId,
                                        'contactId'  =>  $contactId,
                                        'is_primary'  =>  $conatctPrimary,
                                    );
                                    $this->db->insert('amp_project_contact',$insertProjectContact);
                                }else{
                                    $updateProjectContact   =  array('is_primary' => $conatctPrimary);
                                    $checkProjectContact = $this->project_model->updateProjectContact($updateProjectContact,$projectId,$contactId);
                                }
                            }
                        }
                    }

                    $contactDelCombinedValues = $this->security->xss_clean($this->input->post('contactDelCombinedValues'));
                    $contactDelArr = json_decode($contactDelCombinedValues);

                    if($contactDelArr){
                        foreach($contactDelArr as $contactDelArrVal){
                            $projectId = $projectId;
                            $contactRandomId = $contactDelArrVal->contactRandomId;
                            $this->project_model->removeProjectContact($projectId,$contactRandomId);
                        }
                    }

                    //--------------------------------------------------- Edit Client Added by Ram---------------------------------------------------------
      
                    //Insert  Contact
                    $clientCombinedValues = $this->security->xss_clean($this->input->post('clientCombinedValues'));
                    $clientArr = json_decode($clientCombinedValues);
                    
                    if($clientArr){
                        foreach($clientArr as $clientArrVal){
                            $projectId = $projectId;
                            //$clientRandomId = $clientArrVal->clientRandomId;
                            $clientIDs = explode("-",$clientArrVal->clientRandomId);
                            
                            $checkStatus1 = $this->project_model->checkClientStatus($projectId,$clientIDs[1]);
                           
                            if(empty($checkStatus1)){
                                $insertClientData   =  array(
                                    'projectId'        =>  $projectId,
                                    'userID' => $this->session->userdata['userId'],
                                    'clientId'  =>  $clientIDs[1],
                                    'created_at'    =>  date('Y-m-d H:i:s')
                                );
                                $this->db->insert('amp_project_clients',$insertClientData);
                            }  

                        }
                        
                    }

                    $clientDelCombinedValues = $this->security->xss_clean($this->input->post('clientDelCombinedValues'));
                    $clientDelArr = json_decode($clientDelCombinedValues);

                    if($clientDelArr){
                        foreach($clientDelArr as $clientDelArrVal){
                            $projectId = $projectId;
                            $clientID = $clientDelArrVal->clientID;
                            $this->project_model->removeProjectClient($projectId,$clientID);
                        }
                    }

                    //---------------------------------------------------XXXXXXXXXXXXXX-------------------------------------------------------

                    if ($result == true) {
                        $this->session->set_flashdata('success', 'This project has been successfully updated.');
                    } else {
                        $this->session->set_flashdata('error', 'Project updation failed');
                    }
                    redirect('editProject/'.$projectId);
                }    
        }
    }

    function getAddressInfo(){
        $clientID = $this->input->post("clientId");
        $result = $this->project_model->getClientAddress($clientID);
        
        if(isset($result[0])){
            echo $result[0]->address;
        }
    }

    //Callback method for check duplicate project name
    function check_project_name($prj_name) {        
        if($this->input->post('projectId'))
            $id = $this->input->post('projectId');
        else
            $id = '';
        $result = $this->project_model->check_unique_project_name($id, $prj_name);
        if($result == 0)
            $response = true;
        else {
            $this->form_validation->set_message('check_project_name', 'Project name is already exist');
            $response = false;
        }
        return $response;
    }

    //Callback method for check duplicate project file id
    function check_project_file_id($filesystem_id) {        
        if($this->input->post('projectId'))
            $id = $this->input->post('projectId');
        else
            $id = '';
        
        if($filesystem_id != ""){
            $result = $this->project_model->check_unique_file_id($id, $filesystem_id);
            if($result == 0)
                $response = true;
            else {
                $this->form_validation->set_message('check_project_file_id', 'Job number is already exist');
                $response = false;
            }
        }else{
            $response = true;
        }
        return $response;
    }

    public function inLineProjectUpdate(){
        $fieldname = $this->input->post('fieldname');
        $fieldval = $this->input->post('fieldval');
        $projectid = $this->input->post('projectid');

        if($fieldname == "projectName"){
            $res = $this->project_model->check_unique_project_name($projectid, $fieldval);
            if($res != 0){
                echo json_encode(array('status' => false,'msg'=>'Project name is already exist'));die;
            }
        }

        if($fieldname == "filesystem_id"){
            $res = $this->project_model->check_unique_file_id($projectid, $fieldval);
            if($res != 0){
                echo json_encode(array('status' => false,'msg'=>'Job number is already exist'));die;
            }
        }

        if($fieldval == ""){
            echo json_encode(array('status' => false,'msg'=>'Please add value'));die;
        }else{
            $leadInfo = array($fieldname => $fieldval);
            //print_r($leadInfo);die;
            $result = $this->project_model->editLead($leadInfo,$projectid);
            if($result == true){
                echo json_encode(array('status' => true,'msg'=>'Update successfully'));die;
            }else{
                echo json_encode(array('status' => false,'msg'=>'Something is wrong!'));die;
            }
        }
    }


    /**
     * This function is used to save the client.
     *
     * @return bool $result : TRUE / FALSE
     */
    function saveClient(){

        $clientName = $this->input->post('clientName');
        $is_update = $this->input->post('is_update');
        $client_id = $this->input->post('client_id');
        $phNo = $this->input->post('phNo');
        $address = $this->input->post('address');
        $buisnessType = $this->input->post('buisnessType');
        if($clientName == ""){
            echo json_encode(array('status' => false,'msg' => "Please enter company name"));die;
        }if($address == ""){
            echo json_encode(array('status' => false,'msg' => "Please enter address"));die;
        }if($phNo == ""){
            echo json_encode(array('status' => false,'msg' => "Please enter Phone number"));die;
        }if($buisnessType == ""){
            echo json_encode(array('status' => false,'msg' => "Please enter Buisness Type"));die;
        }
        else{

            $clientExist = $this->project_model->checkClientExist($clientName,$client_id);
            if(!empty($clientExist)){
                echo json_encode(array('status' => false,'msg' => "This company already exist"));die;
            }else{
                if($is_update == 0 && $client_id == 0){
                    $insertClientData   =  array('client_name' =>  $clientName, 'buisness_type' =>$buisnessType,'phone_no' =>  $phNo, 'address' =>  $address, 'userID' => $this->session->userdata['userId']);
                    $clientaddresult = $this->project_model->insertClient($insertClientData);
                }else{
                    //print_r($updateClientData);die;
                    $updateClientData   =  array('client_name'  => $clientName, 'buisness_type' =>$buisnessType,'address' =>  $address,'phone_no' => $phNo);
                    //print_r($updateClientData);die;
                    $this->db->where('id', $client_id);
                    $this->db->update('amp_clients', $updateClientData);
                    $this->db->affected_rows();
                    $clientaddresult = $client_id;
                }

                if($clientaddresult > 0){
                    echo json_encode(array('status' => true,'result' => $clientaddresult));die;
                }else{
                    echo json_encode(array('status' => false,'msg' => "Something is wrong"));die;
                }
            }
        }
    }

    function clientContact(){

        $client_id = $this->input->post('clientID');
        if($client_id == ""){
            echo json_encode(array('status' => false));die;
        }else{
            $clientContacts = $this->project_model->getClientContact($client_id);
            if(count($clientContacts) > 0){
                echo json_encode(array('status' => true,'result' => $clientContacts));die;
            }else{
                echo json_encode(array('status' => false));die;
            }
        }
    }
    
    function getContactDtl(){
        $contactId = $this->input->post('contactId');
        if($contactId == ""){
            echo json_encode(array('status' => false));die;
        }else{
            $contactDtl = $this->project_model->getContactDtl($contactId);
            if(count($contactDtl) > 0){
                echo json_encode(array('status' => true,'result' => $contactDtl));die;
            }else{
                echo json_encode(array('status' => false));die;
            }
        }
    }


    /**
     * This function is used to delete the lead using projectId.
     *
     * @return bool $result : TRUE / FALSE
     */
    public function deleteProject()
    {
        if ($this->isAdmin() == true) {
            echo json_encode(array('status' => 'access'));
        } else {
            $projectId = $this->input->post('projectId');
            $projectInfo = array('isDeleted' => 1, 'updatedDtm' => date('Y-m-d H:i:s'));

            $result = $this->project_model->deleteProject($projectId, $projectInfo);

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
     * This function is used to load the view lead list.
     */
    public function viewleadListing()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $lead_id    = $this->security->xss_clean($this->input->post('projectId'));
            $filesystem_id    = $this->security->xss_clean($this->input->post('filesystem_id'));
            $projectName = $this->security->xss_clean($this->input->post('projectName'));
            $phone_no   = $this->security->xss_clean($this->input->post('phoneNo'));
            $email      = $this->security->xss_clean($this->input->post('email'));
            $sales_rep  = $this->security->xss_clean($this->input->post('sales_rep'));
            $stageId    = $this->security->xss_clean($this->input->post('stageId'));

            //$data['sales_repList'] = $this->user_model->getSalesRep(); 
            $data['sales_repList'] = $this->user_model->getAllActiveUser(); 
            $data['stages'] = $this->project_model->getStages();
            
            $data['lead_id'] = $lead_id;
            $data['filesystem_id'] = $filesystem_id;
            $data['projectName'] = $projectName;
            $data['phone_no'] = $phone_no;
            $data['email'] = $email;
            $data['sales_rep'] = $sales_rep;
            $data['stageId'] = $stageId;


            $this->load->library('pagination');

            
            $count = $this->project_model->leadListingCount($lead_id,$projectName,$phone_no,$email,$sales_rep,$stageId,$filesystem_id);

            $returns = $this->paginationCompress('leadListing/', $count, 10);

            $data['leadRecords'] = $this->project_model->leadstageListing($lead_id,$projectName,$phone_no,$email,$sales_rep,$stageId,$filesystem_id);

            $data['leadRecordsArray'] = $this->project_model->leadstageListingArray($lead_id,$projectName,$phone_no,$email,$sales_rep,$stageId,$filesystem_id);

            $data['stageIdAll'] = array_column( $data['leadRecordsArray'] ,'stageId');

            $this->global['pageTitle'] = 'Amplify : Project Listing';
            $this->global['PageEdit'] = "Projects: Pipeline";
            $this->loadViews('projects/view_projects', $this->global, $data, null);
        }
    }

    public function changes_stage()
    {
        $stage_val = $this->input->post('stage_val');
        $projectId = $this->input->post('newlead_id');
        if ($stage_val == 1) {
            $stage = 1;
        }
        if ($stage_val == 2) {
            $stage = 1;
        }
        if ($stage_val == 3) {
            $stage = 3;
        }
        if ($stage_val == 4) {
            $stage = 4;
        }

        $lead_stageInfo = array('stageId' => $stage);
        $result = $this->project_model->change_leadstage($projectId, $lead_stageInfo);
        if ($result > 0) {
            echo json_encode(array('status' => true));
        } else {
            echo json_encode(array('status' => false));
        }
    }


    /**
     * This function is used to creat task
     *
     * @param number $userId : Optional : This is lead id
     */
    public function scheduleTask()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {            
            // if ($projectId == null) {
            //     redirect('leadListing');
            // }

            // $data['sales_rep'] = $this->user_model->getSalesRep();
            // $data['stages'] = $this->project_model->getStages();
            // $data['leadInfo'] = $this->project_model->getLeadInfo($projectId);
            if(!empty($this->session->userdata['projectIdsData'][0]['projectId'])){
               $data['projectId']= $this->session->userdata['projectIdsData'][0]['projectId'];
            }
            if(empty($this->session->userdata['projectIdsData'])){
                $data['projectId']='';
            }
            if(!empty($this->session->userdata['projectIdsData']) && count($this->session->userdata['projectIdsData'])>1){
                foreach ($this->session->userdata['projectIdsData'] as $value) {
                    $lead[] = $value['projectId'];
                    $this->session->set_userdata('leadData',$lead);  

                }                
            }
            $this->global['pageTitle'] = 'Amplify : schedule Task';

            $this->loadViews('projects/schedule_task', $this->global, $data, null);
        }
    }
 

     /**
     * This function is used to add new task to the system.
     */
    public function addTask()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('taskName', 'Task Name', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('taskDate', 'Task Date', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('taskComment', 'Task Comment', 'trim|required|max_length[128]');
            if ($this->form_validation->run() == false) {
                $this->scheduleTask();
            } else {
                $taskName = $this->security->xss_clean($this->input->post('taskName'));
                $taskDate = $this->security->xss_clean($this->input->post('taskDate'));
                $taskexDate = date("Y-m-d", strtotime($taskDate));
                $taskComment = $this->security->xss_clean($this->input->post('taskComment'));
                $taskId = "task".'-'.rand(10000, 99999);
                $projectId = $this->input->post('projectId');
                if(empty($projectId)){
                    $projectIdData = $this->project_model->getLeadId();
                    foreach ($projectIdData as $value) {
                        $taskInfo = array('taskRandomId'=>$taskId,'eventDate'=>$taskexDate,'name' => $taskName, 'projectId' => $value,'createdDtm' => date('Y-m-d H:i:s'));
                        $result = $this->project_model->addNewTask($taskInfo);

                    }                   
                }else if(count($this->session->userdata['leadData'])>1){
                    foreach ($this->session->userdata['leadData'] as $value) {
                        $taskInfo = array('taskRandomId'=>$taskId,'eventDate'=>$taskexDate,'name' => $taskName, 'projectId' => $value,'createdDtm' => date('Y-m-d H:i:s'));
                        $result = $this->project_model->addNewTask($taskInfo);

                    }
                }else{
                    //die("lead_id");
                    $taskInfo = array('taskRandomId'=>$taskId,'eventDate'=>$taskexDate,'name' => $taskName, 'projectId' => $projectId,'createdDtm' => date('Y-m-d H:i:s'));
                    $result = $this->project_model->addNewTask($taskInfo);
                }
                

                if ($result > 0) {
                    $this->session->unset_userdata('projectIdsData');
                    $this->session->unset_userdata('leadData');
                    $this->session->set_flashdata('success', 'New Task created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Task creation failed');
                }

                redirect('projectListing');
            }
        }
    }


      /**
     * This function is used to send email
     *
     */
     public function sendMail(){
        $this->load->library('email');       
        $this->load->model('site_model','site');
        //SMTP & mail configuration
        
        // $config = array(
        //     'protocol'  => $this->config->item('protocol'),
        //     'smtp_host' => $this->config->item('smtp_host'),
        //     'smtp_port' => $this->config->item('smtp_port'),
        //     'smtp_user' => $this->config->item('smtp_user'),
        //     'smtp_pass' => $this->config->item('smtp_pass'),
        //     'mailtype'  => $this->config->item('mailtype'),
        //     'charset'   => $this->config->item('charset')
        // );
        $logInUserId    = $this->session->userdata['userId'];
        $smtpData = $this->common_model->getSmtpSetting($logInUserId);

        $logUserData = $this->user_model->getUserData($logInUserId); 
        $logUserName = $logUserData[0]["name"];
        $logUserEmail = $logUserData[0]["email"];

        $smtp_host = $smtpData["mail_server"];
        $smtp_user = $smtpData["username"];
        $smtp_pass = $smtpData["password"];
    
        $config = array(
            'protocol'  => $this->config->item('protocol'),
            'smtp_host' => $smtp_host,
            'smtp_port' => $this->config->item('smtp_port'),
            'smtp_user' => $smtp_user,
            'smtp_pass' => $smtp_pass,
            'mailtype'  => $this->config->item('mailtype'),
            'charset'   => $this->config->item('charset')
        );

        
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");       
        $text           = $this->input->post('text');
        $email_from     = $this->input->post('email_from');
        
        
        $isAll          = $this->input->post('isAll');
        if($isAll==1){ //select all
            $logInUserId    = $this->session->userdata['userId'];
            $allChkLeads    = $this->project_model->getAllLeadIdsofUser($logInUserId);
        }else{
            $allChkLeads    = $this->input->post('allChkLeads');
        }

        //echo $allChkLeads;die;
        $allChkLeadsArr = explode(",", $allChkLeads);
        
        $checkLeadEmailOption = 0;
        $temp = 0;
        if(isset($allChkLeadsArr) && !empty($allChkLeadsArr)){
            foreach ($allChkLeadsArr as  $leadid) {
                //Get Lead email     
                // $to = $this->project_model->getLeadEmail($leadid);
                $getLeadDetails = $this->communi_model->getContactDetail($leadid);
                //Check email is enable or disable
                $checkLeadEmailOption = $this->user_model->checkLeadEmailOption($leadid);
                //echo $projectId." = ".$checkLeadEmailOption;

                if(!empty($getLeadDetails)){
                   $to = $getLeadDetails[0]['contact_email'];
                    if(isset($to) && !empty($to) && $checkLeadEmailOption>0){
                        $this->email->to($to);                
                        $this->email->from('dadenllc@amplify.com','Amplify');
                        $this->email->reply_to($logUserEmail, $logUserName);
                        $this->email->subject('Amplify Email');
                        $this->email->message($text);
                        if($this->email->send()) {            
                            $this->session->set_flashdata('success', 'Email has been sent successfully');

                            $data = array("subject"=>"Amplify Email","body"=>$text);
                            $communicationInfo = array(
                                'projectId'    => $leadid,  
                                'type'      => 2,  
                                'userID'    => $this->session->userdata['userId'], 
                                'froms'     => $email_from,
                                'to'        => $to,
                                'data'      => json_encode($data),
                                'createdDtm'=> date('Y-m-d H:i:s')
                            );              
                            $result = $this->communi_model->addCommunication($communicationInfo);
                            $temp = 1;
                        } else {
                          $this->session->set_flashdata('success', 'Something went wrong!');
                          $temp = 0;
                        }
                    }
                }else{
                    $temp = 0;
                }
            }
            //echo json_encode(array('status' => true));
            if($temp == 1){
                echo json_encode(array('status' => true));die;
            }else{
                echo json_encode(array('status' => false));die;
            }
        }               
    }

     /**
     * This function is used to change lead stage
     */
    public function leadChangeStage(){
        $projectId = $this->security->xss_clean($this->input->post('projectId'));
        $newStage = $this->security->xss_clean($this->input->post('newStage'));

        if($projectId && $newStage){
            //Update lead stage
            $updateData   =  array('stageId'=>$newStage);
            $this->db->where('projectId', $projectId);
            $this->db->update('amp_leads', $updateData);
            //Insert Lead history
            //Insert user
            $insertData   =  array(
                    'projectId'        =>  $projectId,
                    'stageId'       =>  $newStage,
                    'createdDtm'    =>  date('Y-m-d H:i:s'),
                    'updatedDtm'    =>  date('Y-m-d H:i:s')
            );
            $this->db->insert('amp_lead_stage_history',$insertData);
        }
        echo "1";
        die();
    }


    /**
     * This function is used load lead information.
     *
     * @param number $userId : Optional : This is user id
     */
    public function viewleadDetails($projectId = null)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            if ($projectId == null) {
                redirect('projectListing');
            }
            //$data['sales_rep'] = $this->user_model->getSalesRep();
            $data['sales_rep'] = $this->user_model->getAllActiveUser(); 
            $data['stages'] = $this->project_model->getStages();
            $data['referral_type'] = $this->project_model->getrefType();
            $data['leadInfo'] = $this->project_model->getLeadInfo($projectId);
            $data['countries'] = $this->project_model->getCountry();
            $data['referral_sources'] = $this->project_model->getrefSources();

            $data['leadInfo'] = $this->project_model->getLeadInfo($projectId);
            
            $this->global['pageTitle'] = 'Amplify : Lead profile';

            $this->loadViews('leads/lead_Details', $this->global, $data, null);
        }
    }

     /**
     * This function is used to delete image of Lead.
     *
     * @return bool $result : TRUE / FALSE
     */
    public function deleteImage()
    {
        if ($this->isAdmin() == true) {
            echo json_encode(array('status' => 'access'));
        } else {
            $imageId = $this->input->post('imageId');
            $result = $this->project_model->deleteImage($imageId);
            if ($result > 0) {
                echo json_encode(array('status' => true));
            } else {
                echo json_encode(array('status' => false));
            }
        }
    }

    /**
     * This function is used to send email
     *
     */
     public function sendEmail(){
        $this->load->library('email');       

        //SMTP & mail configuration

        // $config = array(
        //     'protocol'  => $this->config->item('protocol'),
        //     'smtp_host' => $this->config->item('smtp_host'),
        //     'smtp_port' => $this->config->item('smtp_port'),
        //     'smtp_user' => $this->config->item('smtp_user'),
        //     'smtp_pass' => $this->config->item('smtp_pass'),
        //     'mailtype'  => $this->config->item('mailtype'),
        //     'charset'   => $this->config->item('charset')
        // );

        $logInUserId    = $this->session->userdata['userId'];
        $smtpData = $this->common_model->getSmtpSetting($logInUserId);

        $logUserData = $this->user_model->getUserData($logInUserId); 
        $logUserName = $logUserData[0]["name"];
        $logUserEmail = $logUserData[0]["email"];
        

        $smtp_host = $smtpData["mail_server"];
        $smtp_user = $smtpData["username"];
        $smtp_pass = $smtpData["password"];
    
        $config = array(
            'protocol'  => $this->config->item('protocol'),
            'smtp_host' => $smtp_host,
            'smtp_port' => $this->config->item('smtp_port'),
            'smtp_user' => $smtp_user,
            'smtp_pass' => $smtp_pass,
            'mailtype'  => $this->config->item('mailtype'),
            'charset'   => $this->config->item('charset')
        );
        
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");       
        $text       = $this->input->post('text');
        $email      = $this->input->post('email');        
        $projectId     = $this->input->post('projectId');
        $email_from = $this->input->post('email_from');
        $email_to   = $this->input->post('email_to');

        $this->email->to($email);                
        $this->email->from('dadenllc@amplify.com','Amplify');
        $this->email->reply_to($logUserEmail, $logUserName);
        $this->email->subject('Amplify Email');
        $this->email->message($text);
        if($this->email->send()) {            
            $this->session->set_flashdata('success', 'Email has been sent successfully');
            $data = array("subject"=>"Amplify Email","body"=>$text);
            $communicationInfo = array(
                    'projectId'    => $projectId, 
                    'type'      => 2, 
                    'froms'     => $email_from,
                    'to'        => $email_to,
                    'data'      => json_encode($data),
                    'createdDtm'=> date('Y-m-d H:i:s')
            );              
            $result = $this->communi_model->addCommunication($communicationInfo);
            $this->session->unset_userdata('getemailInfo'); 
        } else {
          $this->session->set_flashdata('error', 'Something went wrong!');
        }           
        echo json_encode(array('status' => true));
                 
    }

    /**
     * This function is used to delete the Task.
     *
     * @return bool $result : TRUE / FALSE
     */
    public function deleteTask()
    {
        if ($this->isAdmin() == true) {
            echo json_encode(array('status' => 'access'));
        } else {
            $randomNum = $this->input->post('randomNum');
            $leadID = $this->input->post('leadID');
            $result = $this->project_model->deleteTask($randomNum,$leadID);
            if ($result > 0) {
                echo json_encode(array('status' => true));
            } else {
                echo json_encode(array('status' => false));
            }
        }
    }

        /**
     * This function is used to delete the Contact.
     *
     * @return bool $result : TRUE / FALSE
     */
    public function deleteContact()
    {
        if ($this->isAdmin() == true) {
            echo json_encode(array('status' => 'access'));
        } else {
            $randomNum = $this->input->post('randomNum');
            $projectId = $this->input->post('projectId');
            $contactId = $this->input->post('contactId');
            $result = $this->project_model->deleteContact($randomNum,$projectId,$contactId);
            if ($result > 0) {
                echo json_encode(array('status' => true));
            } else {
                echo json_encode(array('status' => false));
            }
        }
    }

    /**
     * This function is used to delete the Client Of project.
     *
     * @return bool $result : TRUE / FALSE
     */
    public function deleteClient()
    {
        if ($this->isAdmin() == true) {
            echo json_encode(array('status' => 'access'));
        } else {
            $randomNum = $this->input->post('randomNum');
            $projectId = $this->input->post('projectId');
            $clientId = $this->input->post('clientId');
            $result = $this->project_model->deleteClient($randomNum,$projectId,$clientId);
            if ($result > 0) {
                echo json_encode(array('status' => true));
            } else {
                echo json_encode(array('status' => false));
            }
        }
    }


    function conectCallAPI(){
        //Get extetion of logged in user
        $logInUserId        = $this->session->userdata['userId'];
        $userExtentionData  = $this->project_model->getUserExtension($logInUserId);
        $userExtentionExp   = explode('~', $userExtentionData); 
        $userName           = $userExtentionExp[0];
        $userExtention      = $userExtentionExp[1];
        //Set API key
        //$apiKey         = 'bb4c0655b72f1aaaac27c978bee55a61';
        //Get key from setting tbl
        $apiKey         = '';
        $sqlPhoneKey    = "SELECT phonecall_key FROM amp_setting WHERE id = 1";
        $resultPhoneKey = $this->db->query($sqlPhoneKey)->result_array();
        if(isset($resultPhoneKey[0]['phonecall_key']) && $resultPhoneKey[0]['phonecall_key']!=''){
            $apiKey = $resultPhoneKey[0]['phonecall_key'];
        }


        $phoneNumber    = $this->input->post('phoneNumber');
        $projectId         = $this->input->post('projectId');
        //Get Lead name
        $getLeadName  = $this->project_model->getLeadName($projectId);
        if($apiKey !=''){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, 'https://breatheeasyins.freevoicepbx.com/api/click2dialapi/?api_key='.$apiKey.'&user='.$userExtention.'&number='.$phoneNumber);
            echo $result = curl_exec($ch);
            //print_r($result);die;
            curl_close($ch);
            $resultDecode = json_decode($result); 
            //print_r($resultDecode);die;
            //echo $resultDecode->status;die;  //OK
            //echo "1";

            if($resultDecode->status == 'OK'){
                $communicationInfo = array('projectId' => $projectId, 'type' =>1, 'froms' => $userName,'to'=>$getLeadName,'createdDtm' => date('Y-m-d H:i:s'));              
                //$result = $this->communi_model->addCommunication($communicationInfo);
                }

            die();
        }
    }

    /*
     * To store call data when click on number.
     */

    function addCallData(){
        $phoneNumber    = $this->input->post('mobile');
        $projectId      = $this->input->post('projectId');
        $logInUserId    = $this->session->userdata['userId'];
        $createdDtm     = date('Y-m-d H:i:s');

        $communicationInfo = array('userID' => $logInUserId, 'projectId' => $projectId, 'type' =>3, 'to' => $phoneNumber,'createdDtm' => $createdDtm);              
        $result = $this->communi_model->addCommunication($communicationInfo);

        if ($result) {
            echo json_encode(array('status' => 200, 'to' => $phoneNumber,'createdDtm' => $createdDtm));
        }else{
            echo json_encode(array('status' => 500));
        }

        exit;
    }


     function getCommunicationDetails(){
        $comId = $this->input->post('comId');
        $str='<table id=communicationDetails class=table text-left>';
        if($comId){
            $userExtentionData  = $this->project_model->getCommunicationDetails($comId);    
            if($userExtentionData){
                foreach($userExtentionData as $userExtentionDataVal){
                    
                    $leadSourceName ='';
                    if($userExtentionDataVal->projectId > 0)
                        $leadSourceName  = $this->project_model->getLeadName($userExtentionDataVal->projectId); 
                    else if($userExtentionDataVal->refID > 0)
                        $leadSourceName  = $this->project_model->getReferralSourceName($userExtentionDataVal->refID); 
                    

                    $str.='<tr><td>From</td> <td>'.$userExtentionDataVal->froms.'</td></tr>';
                    $str.='<tr><td>To</td> <td>'.$userExtentionDataVal->to.'</td></tr>';
                    //Get Email data
                    if($userExtentionDataVal->type==0 || $userExtentionDataVal->type==2){   //0->sendSms ,1->call ,2->sendMail
                        //echo $userExtentionDataVal->data;
                        if($userExtentionDataVal->data !=''){
                            $dataArray = json_decode($userExtentionDataVal->data);
                            //print_r($dataArray);
                            $body = $dataArray->body;
                        }
                        if(isset($body) && $body!=''){
                            $str.='<tr><td>Body</td> <td>'.$body.'</td></tr>';
                        }
                    }else if($userExtentionDataVal->type==1){
                        if($userExtentionDataVal->data !=''){
                            $dataArray = json_decode($userExtentionDataVal->data);                            
                        }
                        if(isset($dataArray) && $dataArray!=''){
                            $str.='<tr><td>Id</td> <td>'.$dataArray->id.'</td></tr>';
                            $str.='<tr><td>Callstart</td> <td>'.date('m/d/Y H:i:s',strtotime($dataArray->callstart)).'</td></tr>';
                            $str.='<tr><td>Callerid</td> <td>'.$dataArray->callerid.'</td></tr>';
                            $str.='<tr><td>Duration</td> <td>'.$dataArray->duration.'</td></tr>';
                            $str.='<tr><td>Status</td> <td>'.$dataArray->status.'</td></tr>';
                            $str.='<tr><td>Calltype</td> <td>'.$dataArray->calltype.'</td></tr>';
                            $str.='<tr><td>Callanswer</td> <td>'.date('m/d/Y H:i:s',strtotime($dataArray->callanswer)).'</td></tr>';
                            $str.='<tr><td>Callend</td> <td>'.date('m/d/Y H:i:s',strtotime($dataArray->callend)).'</td></tr>';
                            if(isset($dataArray->recording) && !empty($dataArray->recording))
                                $dataArray->recording = 'https://breatheeasyins.freevoicepbx.com/maint/modules/cdrs/api.php?user=beasyInsApi&pass=5t4hbgwD3f24fdg-f33dwGd4fd&function=download_recording&file='.$dataArray->recording;
                            else 
                                $dataArray->recording = 'None';
                             $str.='<tr><td>Recording</td> <td>'.$dataArray->recording.'</td></tr>';
                        }
                    }
                    $str.='<tr><td>Created Date</td> <td>'.date('m/d/Y',strtotime($userExtentionDataVal->createdDtm)).'</td></tr>';
                }
            }   
        }
        $str.='</table>';
        echo $str;
        die();
    }


/*--
    Server Directory Listing
*/
    function getFloderStrct(){
        $this->load->library('DirectoryListing');

        $filesystem_url = NULL;
        $sql    = "SELECT filesystem_url FROM amp_setting WHERE id = 1";
        $result = $this->db->query($sql)->result_array();
        if(isset($result[0]['filesystem_url']) && $result[0]['filesystem_url']!=''){
            $filesystem_url = $result[0]['filesystem_url'];
        }
        $project_number = $this->uri->segment(2);
        $root_path = $filesystem_url.$project_number;

        $listing = new DirectoryListing($root_path,$project_number);
        $data = $listing->run();

        $data['dlisting'] = $listing->run();
        
        $data['listing'] = $listing;

        $this->global['pageTitle'] = 'Amplify : Directory Listing';

        $this->loadViews('directorylisting', $this->global, $data, null);
    }

    function getActiveUsers(){
        $result = $this->user_model->getAllActiveUser();
        if ($result > 0) {
            echo json_encode(array('status' => true,'result' => $result));die;
        } else {
            echo json_encode(array('status' => false));die;
        }
    }

    function saveBid(){
        $bidArray = $this->input->post();
        $bidArray['bidPrice'] = str_replace( '$', '',str_replace( ',', '', $this->input->post('bidPrice')));
        $bidArray['userId'] = $this->session->userdata['userId'];
        echo $this->project_model->insertBid($bidArray);
    }

    function getBidAjax(){
        $userId = $this->session->userdata['userId'];
        $randomBidId = $this->input->get('bidRandomId'); 
        $isUpdate = $this->input->get('isUpdate'); 
        $array = $this->project_model->getBid($userId,$randomBidId,$isUpdate);
        echo json_encode($array);
        
    }

    function changeProjectStatus(){
        $projectid    = $this->input->post('projectid');
        $stage      = $this->input->post('stage');
     
        $updateData   =  array('stageId'=>$stage);
        $this->db->where('projectId', $projectid);
        $result = $this->db->update('amp_projects', $updateData);

        if ($result) {
            echo json_encode(array('status' => true));
        }else{
            echo json_encode(array('status' => false));
        }
        exit;
    }


}
