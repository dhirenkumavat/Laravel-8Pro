<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require APPPATH.'/libraries/BaseController.php';
class Contact extends BaseController
{
    /**
     * This is default constructor of the class.
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('common_model');
        $this->load->model('user_model');
        $this->load->model('communi_model');
        $this->load->model('contact_model');
        $this->load->library('pagination');
        $this->load->library('email');
        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the user.
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Amplify : Contacts';
        $this->global['PageEdit'] = "All Contacts";

        $data['contactRecords'] = $this->contact_model->contactListing();
        $data['userList'] = $this->contact_model->getUserList();
        $this->loadViews('contacts/contacts', $this->global, $data, null);
    }

    /**
     * This function used to contact the filter list.
     */

    public function getFilterList() {
        $contact_name = $this->input->post('contact_name');
        $business_name = $this->input->post('business_name');
        $contact_phone = $this->input->post('contact_phone');
        $contact_email = $this->input->post('contact_email');
        $assigned_to = $this->input->post('assigned_to');
        $notes = $this->input->post('notes');
        $buisness_type = $this->input->post('buisness_type');

        if(!empty($contact_name)){
            $this->contact_model->setContactName($contact_name);
        }
        if(!empty($business_name)){
            $this->contact_model->setBusinessName($business_name);
        }
        if(!empty($contact_phone)){
            $this->contact_model->setContactPhone($contact_phone);
        }
        if(!empty($contact_email)){
            $this->contact_model->setContactEmail($contact_email);
        }
        if(!empty($assigned_to)){
            $this->contact_model->setAssignedTo($assigned_to);
        }
        if(!empty($notes)){
            $this->contact_model->setContactNotes($notes);
        }

        if(!empty($buisness_type)){
            $this->contact_model->setBuisnessType($buisness_type);
        }

        $getOrderInfo = $this->contact_model->getOrders();

        $dataArray = array();
        foreach ($getOrderInfo as $element) {

            $dataArray[] = array(
                "<input type=checkbox class=checkbox name=CalChkBox value=".$element['contactId']." onclick=selectAllChkbox('single');>",
                '<a href="'.base_url().'editContact/'.$element['contactId'].'">'.$element['contact_name'].'</a>',
                $element['client_name'],
                $element['contact_email'],
                $element['contact_phone'],
                $element['comment'],
                $element['buisness_type'],
                '<a href="'.base_url().'editContact/'.$element['contactId'].'" class="btn btn-rounded btn-sm bg-warning"> <i class="fa fa-pencil-alt"></i> </a>
                                                        <a href="#" data-leadid="'.$element['contactId'].'" onClick="delete_contact('. $element['contactId'].')" class="btn btn-rounded bg-danger btn-sm deleteList"> <i class="fa fa-trash-alt"></i> </a>',
            );
        }
        echo json_encode(array("data" => $dataArray));
    }

    /**
     * This function is used to delete the Contact using id.
     *
     * @return bool $result : TRUE / FALSE
     */
    public function deleteContact()
    {
        if ($this->isAdmin() == true) {
            echo json_encode(array('status' => 'access'));
        } else {
            $contactId = $this->input->post('contactId');
            $result = $this->contact_model->deleteContact(array('id'=>$contactId));
            $result1 = $this->contact_model->deleteContactOptIn(array('contactId'=>$contactId));

            if ($result > 0) {
                echo json_encode(array('status' => true));
            } else {
                echo json_encode(array('status' => false));
            }
        }
    }

    /**
     * This function is used add contact information.
     */
    public function addContact()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {

            $data['clientList'] = $this->contact_model->getClientList();
            $data['userList'] = $this->contact_model->getUserList();

            $this->global['pageTitle'] = 'Amplify : Add Contact';
            $this->global['PageEdit'] = "Add Contact";
            $this->loadViews('contacts/add_contact', $this->global, $data, null);
        }
    }

    /**
     * This function is used to edit the update Contact information.
     */
    public function addContactSubmit()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('contactName','Contact Name', 'trim|required|max_length[128]');

                if ($this->form_validation->run() == false) {
                    $this->addContact();
                }else{

                    $contact_name = $this->security->xss_clean($this->input->post('contactName'));
                    $contact_email = $this->input->post('contactEmail');
                    $contact_phone = $this->input->post('contactPhone');
                    $contact_phone2 = $this->input->post('contactPhone2');
                    $business_name = $this->input->post('businessName');
                    $clientid = $this->input->post('clientid');
                    $comment = $this->input->post('comment');
                    $contactRandomId = "contact-".rand ( 10000 , 99999 );

                    $optionIn = $this->input->post('optionIn');

                    $assigned_to = $this->input->post('assigned_to');
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


                    $contactInfo = array(
                        'userID' => $this->session->userdata['userId'],
                        'clientId' => $clientid,
                        'contact_name' => $contact_name,
                        'contact_email' => $contact_email,
                        'contact_phone' => $contact_phone,
                        'contact_phone2' => $contact_phone2,
                        //'business_name' => $business_name,
                        'comment' =>  $comment,
                        'contactRandomId' => $contactRandomId,
                        'assigned_to' => $assigned_to,
                    );
                    $contactId = $this->contact_model->addContact($contactInfo);

                    $optionDataInfo = array('sms'=>$sms,'calls'=>$call,'email'=>$emails,'other'=>$other,'createdDtm' => date('Y-m-d H:i:s'));
                    $this->contact_model->editoptionData($optionDataInfo,$contactId);


                    if ($contactId > 0) {
                        $this->session->set_flashdata('success', 'This contact has been successfully updated.');
                    } else {
                        $this->session->set_flashdata('error', 'Project updation failed');
                    }
                    redirect('editContact/'.$contactId);
                }
        }
    }



    /**
     * This function is used load contact edit information.
     *
     * @param number $userId : Optional : This is user id
     */
    public function editContact($contactId = null)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {

            if ($contactId == null) {
                redirect('contacts');
            }

            $data['contactInfo'] = $this->contact_model->getContactInfo($contactId);


            $data['optionData'] = $this->contact_model->getOptionData($contactId);
            $data['emailTemplates'] = $this->contact_model->getEmailTemplates();
            $data['communication'] = $this->contact_model->getCommunication($contactId);
            $data['clientList'] = $this->contact_model->getClientList();
            $data['userList'] = $this->contact_model->getUserList();
            $clientID = $data['contactInfo']->clientId;
            $data['clientAddress'] = $this->contact_model->getClientAddress($clientID);

            $this->global['pageTitle'] = 'Amplify : Edit Contact';
            $this->global['PageEdit'] = "Edit Contact: ".$data['contactInfo']->contact_name;

            $this->loadViews('contacts/edit_contact', $this->global, $data, null);
        }
    }

    /**
     * This function is used to edit the update Contact information.
     */
    public function editContactSubmit()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('contactName','Contact Name', 'trim|required|max_length[128]');

                $contactId = $this->input->post('contactId');

                if ($this->form_validation->run() == false) {
                    $this->editContact($contactId);
                }else{

                    $contact_name = $this->security->xss_clean($this->input->post('contactName'));
                    $contact_email = $this->input->post('contactEmail');
                    $contact_phone = $this->input->post('contactPhone');
                    $contact_phone2 = $this->input->post('contactPhone2');

                    $clientid = $this->input->post('clientid');
                    $comment = $this->input->post('comment');

                    $optionIn = $this->input->post('optionIn');
                    $assigned_to = $this->input->post('assigned_to');
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
                    $this->contact_model->editoptionData($optionDataInfo,$contactId);

                    $contactInfo = array(
                        'clientId' => $clientid,
                        'contact_name' => $contact_name,
                        'contact_email' => $contact_email,
                        'contact_phone' => $contact_phone,
                        'contact_phone2' => $contact_phone2,
                        //'business_name' => $business_name,
                        'comment' =>  $comment,
                        'assigned_to' => $assigned_to,

                    );
                    $result = $this->contact_model->editContact($contactInfo,$contactId);

                    if ($result == true) {
                        $this->session->set_flashdata('success', 'This contact has been successfully updated.');
                    } else {
                        $this->session->set_flashdata('error', 'Project updation failed');
                    }
                    redirect('editContact/'.$contactId);
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
        $address = $this->input->post('address');
        $phNo = $this->input->post('phNo');
        $buisnessType = $this->input->post('buisnessType');
        if($clientName == ""){
            echo json_encode(array('status' => false));die;
        }
        if($address == ""){
            echo json_encode(array('status' => false));die;
        }
        if($phNo == ""){
            echo json_encode(array('status' => false));die;
        }
        if($buisnessType == ""){
            echo json_encode(array('buisnessType' => false));die;
        }
        else{
            $insertClientData   =  array('client_name' =>  $clientName,'buisness_type' =>  $buisnessType,'phone_no' =>  $phNo,'address' =>  $address, 'userID' => $this->session->userdata['userId']);
            $clientaddresult = $this->contact_model->insertClient($insertClientData);

            if($clientaddresult > 0){
                echo json_encode(array('status' => true,'result' => $clientaddresult));die;
            }else{
                echo json_encode(array('status' => false));die;
            }
        }
    }


    public function sendSms(){
        $this->load->library('twilio');

        $sms_sender     = trim($this->input->post('sms_sender'));
        $sms_message    = trim($this->input->post('sms_message'));
        $sms_recipient  = trim($this->input->post('sms_recipient'));
        $contactId         = trim($this->input->post('contactId'));
        $sms_from       = trim($this->input->post('sms_from'));
        $sms_to         = trim($this->input->post('sms_to'));
        $from           = '+'.$sms_sender; //trial account twilio number
        $to             = $sms_recipient;


        $response = $this->twilio->sms($from, "+1".$to,$sms_message);

        if($response->IsError){
            echo json_encode(array('status' => false));die;
        }else{
            $data = array("subject"=>"Amplify Email","body"=>$sms_message);
            $communicationInfo = array(
                    'contactId'  => $contactId,
                    'type'       => 0,
                    'froms'      => $sms_from,
                    'tosend'         => $sms_to,
                    'data'       => json_encode($data),
                    'createdDtm' => date('Y-m-d H:i:s')
            );
            $result = $this->contact_model->addCommunication($communicationInfo);
            if($result>0){
                echo json_encode(array('status' => true));
            }
        }
    }

    /**
     * This function is used to send email
     *
     */
     public function sendEmail(){
        $this->load->library('email');


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
        $contactId     = $this->input->post('contactId');
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
                    'contactId' => $contactId,
                    'type'      => 2,
                    'froms'     => $email_from,
                    'tosend'        => $email_to,
                    'data'      => json_encode($data),
                    'createdDtm'=> date('Y-m-d H:i:s')
            );
            $result = $this->contact_model->addCommunication($communicationInfo);
            $this->session->unset_userdata('getemailInfo');
        } else {
          $this->session->set_flashdata('error', 'Something went wrong!');
        }
        echo json_encode(array('status' => true));
    }

    /*
     * To store call data when click on number.
     */

    function addCallData(){
        $phoneNumber    = $this->input->post('mobile');
        $contactId      = $this->input->post('contactId');
        $logInUserId    = $this->session->userdata['userId'];
        $createdDtm     = date('Y-m-d H:i:s');

        $communicationInfo = array('userID' => $logInUserId, 'contactId' => $contactId, 'type' =>3, 'tosend' => $phoneNumber,'createdDtm' => $createdDtm);
        $result = $this->contact_model->addCommunication($communicationInfo);

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
            $userExtentionData  = $this->contact_model->getCommunicationDetails($comId);
            if($userExtentionData){
                foreach($userExtentionData as $userExtentionDataVal){


                    $str.='<tr><td>From</td> <td>'.$userExtentionDataVal->froms.'</td></tr>';
                    $str.='<tr><td>To</td> <td>'.$userExtentionDataVal->tosend.'</td></tr>';
                    //Get Email data
                    if($userExtentionDataVal->type==0 || $userExtentionDataVal->type==2){   //0->sendSms ,1->call ,2->sendMail

                        if($userExtentionDataVal->data !=''){
                            $dataArray = json_decode($userExtentionDataVal->data);
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
}
