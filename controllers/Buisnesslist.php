<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require APPPATH.'/libraries/BaseController.php';
class Buisnesslist extends BaseController
{
    /**
     * This is default constructor of the class.
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('common_model');
        $this->load->model('user_model');
        $this->load->model('communi_model');
        $this->load->model('buisness_model');
        $this->load->library('pagination');
        $this->load->library('email');
        //$this->load->library('MY_form_validation');
        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the user.
     */
    public function index()
    {
        $this->load->model('project_model');
        $this->global['pageTitle'] = 'Amplify : Buisness List';
        $userId = $this->session->userdata['userId'];
        $data['buisnessListRecords'] = $this->buisness_model->buisnessListing();
        $this->loadViews('buisness/buisnesslist', $this->global, $data, null);
    }


    /**
     * This function used to contact the filter list.
     */

    public function getFilterList() {


        $client_name = $this->input->post('client_name');
        $buisness_type = $this->input->post('buisness_type');


        if(!empty($client_name)){
            $this->buisness_model->setClientName($client_name);
        }
        if(!empty($buisness_type)){
            $this->buisness_model->setBuisnessType($buisness_type);
        }

        $getOrderInfo = $this->buisness_model->getOrders();

        $dataArray = array();
        foreach ($getOrderInfo as $element) {

            $dataArray[] = array(
                $element['client_name'],
                $element['buisness_type'],
                $element['phone_no'],
                $element['address'],
                '<a href="'.base_url().'editBuisness/'.$element['id'].'" class="btn btn-rounded btn-sm bg-warning"> <i class="fa fa-pencil-alt"></i> </a>
                <a href="#" data-contactid="'.$element['id'].'" onClick="delete_buisness('. $element['id'].')" class="btn btn-rounded bg-danger btn-sm deleteList"> <i class="fa fa-trash-alt"></i> </a>',
            );
        }
        echo json_encode(array("data" => $dataArray));
    }

    /**
     * This function is used to delete the Buisness using id.
     *
     * @return bool $result : TRUE / FALSE
     */
    public function deleteBuisnessResults()
    {
        if ($this->isAdmin() == true) {
            echo json_encode(array('status' => 'access'));
        } else {
            $buisnessId = $this->input->post('buisnessId');
            $result = $this->buisness_model->deleteBuisness($buisnessId);
            if ($result > 0) {
                echo json_encode(array('status' => true));
            } else {
                echo json_encode(array('status' => false));
            }
        }
    }

    /**
     * This function is used load contact edit information.
     *
     * @param number $userId : Optional : This is user id
     */
    public function editBuisness($buisnesstId = null)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            //echo $buisnesstId;die;
            if ($buisnesstId == null) {
                redirect('buisnessList');
            }

            $data['buisnessInfo'] = $this->buisness_model->getBuisnessInfo($buisnesstId);
            $this->global['pageTitle'] = 'Amplify : Edit Buisness';
            $this->global['PageEdit'] = "Edit Buisness: ".$data['buisnessInfo']->client_name;

            $this->loadViews('buisness/edit_buisness', $this->global, $data, null);
        }
    }

    /**
     * This function is used to edit the update Contact information.
     */
    public function editBuisnessSubmit()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('buisnessName','Buisness Name', 'trim|required');
                $this->form_validation->set_rules('phNo', 'Phone Number ', 'required|regex_match[/^[0-9]{10}$/]');
                //$this->form_validation->set_rules('phNo', 'Phone number', 'valid_phone_number_or_empty');
                $this->form_validation->set_rules('address','Address', 'trim|required');
                $buisnessId = $this->input->post('buisnessId');

                if ($this->form_validation->run() == false) {

                    $this->editBuisness($buisnessId);
                }else{

                    $buisnessName = $this->security->xss_clean($this->input->post('buisnessName'));
                    $buisnessType = $this->input->post('buisnessType');
                    $phNo = $this->input->post('phNo');
                    $address = $this->input->post('address');

                    $buisnessId = $this->input->post('buisnessId');
                    $buisnessInfo = array(
                        'client_name' => $buisnessName,
                        'buisness_type' => $buisnessType,
                        'phone_no' => $phNo,
                        'address' => $address

                    );
                    $result = $this->buisness_model->editBuisness($buisnessInfo,$buisnessId);

                    if ($result == true) {
                        $this->session->set_flashdata('success', 'This buisness has been successfully updated.');
                    } else {
                        $this->session->set_flashdata('error', 'Buisness updation failed');
                    }
                    redirect('editBuisness/'.$buisnessId);
                }
        }
    }

}
