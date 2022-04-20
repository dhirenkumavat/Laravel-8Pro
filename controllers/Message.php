<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH.'/libraries/BaseController.php';
class Message extends BaseController
{
    /**
     * This is default constructor of the class.
     */
    public function __construct()
    {
        parent::__construct();      
        $this->load->model('site_model','site'); 
        $this->load->library('twilio');
        $this->load->model('communi_model');
        $this->isLoggedIn();
    }

  
    public function sendSms(){      
        
        $sms_sender     = trim($this->input->post('sms_sender'));
        $sms_message    = trim($this->input->post('sms_message'));
        $sms_from       = trim($this->input->post('sms_from'));
        $from           = '+'.$sms_sender; //trial account twilio number

        $isAll          = $this->input->post('isAll');
        if($isAll==1){ //select all
            $logInUserId    = $this->session->userdata['userId'];
            $allChkLeads    = $this->communi_model->getAllLeadIdsofUser($logInUserId);
        }else{
            $allChkLeads    = $this->input->post('allChkLeads');
        }

        //echo $allChkLeads;die;
        $allChkLeadsArr = explode(",", $allChkLeads);

        $checkLeadSMSOption = 0;
        $temp = 0;
        if(isset($allChkLeadsArr) && !empty($allChkLeadsArr)){
            foreach ($allChkLeadsArr as  $leadId) {
                //Get Lead info                
                // $getLeadDetails = $this->communi_model->getLeadDetails($leadId);
                $getLeadDetails = $this->communi_model->getContactDetail($leadId);
                if(!empty($getLeadDetails)){
                      $to     = $getLeadDetails[0]['contact_phone'];
                      $sms_to = $getLeadDetails[0]['contact_phone'];

                    //Check email is enable or disable
                    $checkLeadSMSOption = $this->site->checkLeadSMSOption($leadId);        
                    if($checkLeadSMSOption>0 && !empty($to) && isset($getLeadDetails) && !empty($getLeadDetails)){       
                        //echo $from." = ".$to." = ".$sms_to;die;
                        $response = $this->twilio->sms($from, "+1".$to,$sms_message);
                        //$response = $this->twilio->sms($from, $to,$sms_message);
                        if($response->IsError){
                            echo json_encode(array('status' => false));die;        
                        }else{
                            $data = array("subject"=>"Breatheeasy SMS","body"=>$sms_message);
                            $communicationInfo = array(
                                                'projectId'     => $leadId, 
                                                'type'       => 0, 
                                                'froms'      => $sms_from,
                                                'to'         => $sms_to,
                                                'data'       => json_encode($data),
                                                'createdDtm' => date('Y-m-d H:i:s')
                            );              
                            $result = $this->communi_model->addCommunication($communicationInfo);
                            if($result>0){
                                $this->session->unset_userdata('getsmsInfo'); 
                                $temp = 1;
                            }else{
                                $temp = 0;
                            }
                        }
                    }
                }
                else{
                    $temp = 0;
                }
            }  
            if($temp == 1){
                echo json_encode(array('status' => true));die;
            }else{
                echo json_encode(array('status' => false));die;
            }
                      
        }      
    }

    public function editSms(){
        $sms_sender     = trim($this->input->post('sms_sender'));
        $sms_message    = trim($this->input->post('sms_message'));
        $sms_recipient  = trim($this->input->post('sms_recipient'));
        $projectId         = trim($this->input->post('projectId'));
        $sms_from       = trim($this->input->post('sms_from'));
        $sms_to         = trim($this->input->post('sms_to'));
        $from           = '+'.$sms_sender; //trial account twilio number
        $to             = $sms_recipient;

        $response = $this->twilio->sms($from, "+1".$to,$sms_message);
        //$response = $this->twilio->sms($from,$to,$sms_message);
        if($response->IsError){
            echo json_encode(array('status' => false));die;        
        }else{
            $data = array("subject"=>"Amplify Email","body"=>$sms_message);
            $communicationInfo = array(
                    'projectId'     => $projectId, 
                    'type'       => 0, 
                    'froms'      => $sms_from,
                    'to'         => $sms_to,
                    'data'       => json_encode($data),
                    'createdDtm' => date('Y-m-d H:i:s')
            );  
            $result = $this->communi_model->addCommunication($communicationInfo);
            if($result>0){
                echo json_encode(array('status' => true));
            }
        }
    }


    public function editRefSms(){
        $sms_sender     = trim($this->input->post('sms_sender'));
        $sms_message    = trim($this->input->post('sms_message'));
        $sms_recipient  = trim($this->input->post('sms_recipient'));
        $referralSourceId         = trim($this->input->post('referralSourceId'));
        $sms_from       = trim($this->input->post('sms_from'));
        $sms_to         = trim($this->input->post('sms_to'));

        $from = '+'.$sms_sender; //trial account twilio number
        $to = $sms_recipient;

        $response = $this->twilio->sms($from, "+1".$to,$sms_message);
        if($response->IsError){
            echo json_encode(array('status' => false));die;        
        }else{  

                $data = array("subject"=>"Breatheeasy SMS","body"=>$sms_message);
                $communicationInfo = array(
                    'refID'     => $referralSourceId, 
                    'type'              => 0, 
                    'froms'             => $sms_from,
                    'to'                => $sms_to,
                    'data'              => json_encode($data),
                    'communicationsFrom'=> 1, 
                    'createdDtm'        => date('Y-m-d H:i:s')
                );    
                $result = $this->communi_model->addCommunication($communicationInfo); 

            if($result>0){
                echo json_encode(array('status' => true));
            }        
        }
    }

}
