<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require APPPATH.'/libraries/BaseController.php';
class Bidresults extends BaseController
{
    /**
     * This is default constructor of the class.
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('common_model');
        $this->load->model('user_model');
        $this->load->model('communi_model');
        $this->load->model('bidresult_model');
        $this->load->library('pagination');
        $this->load->library('email');
        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the user.
     */
    public function index()
    {  $this->load->model('project_model');
        $this->global['pageTitle'] = 'Amplify : Bid Results';
        $this->global['PageEdit'] = "All Bid Results";
        $userId = $this->session->userdata['userId'];
         $result = $this->project_model->getState($userId,'BidTable');
         $data['stateresult'] = $result;
        $data['bidResultsRecords'] = $this->bidresult_model->bidResultListing();
        
        $this->loadViews('bidresults/bidresults', $this->global, $data, null);
    }

    /**
     * This function used to contact the filter list.
     */

    public function getFilterList() {    


        $job_name = $this->input->post('job_name');
        $company_name = $this->input->post('company_name');
        $unit_cost_sign = $this->input->post('unit_cost');
        $unit_cost_value = $this->input->post('unit_cost_value');
        $market_type = $this->input->post('market_type');
        $building_type = $this->input->post('building_type');
        //$scope = $this->input->post('scope');
        $scope_all=$this->input->post('scope_all');  
        $scope_abatement=$this->input->post('scope_abatement'); 
        $scope_interior_demolition=$this->input->post('scope_interior_demolition');
        $scope_site_demolition=$this->input->post('scope_site_demolition'); 
        $scope_earthwork=$this->input->post('scope_earthwork');
        $scope_other=$this->input->post('scope_other'); 
        $project_type = $this->input->post('project_type');
        $material_needs = $this->input->post('material_needs');
        

        if(!empty($job_name)){
            $this->bidresult_model->setJobName($job_name);
        }
        if(!empty($company_name)){
            $this->bidresult_model->setCompanyName($company_name);
        }        
        if(!empty($unit_cost_sign)){
            $this->bidresult_model->setUnitCostSign($unit_cost_sign);
            $this->bidresult_model->setUnitCostValue($unit_cost_value);
        } 
        if(!empty($market_type)){
            $this->bidresult_model->setMarketType($market_type);
        }

        if(!empty($building_type)){
            $this->bidresult_model->setBuildingType($building_type);
        }


        if(!empty($scope_all)){
            $this->bidresult_model->setAllScope($scope_all);
        }

        if(!empty($scope_abatement)){
            $this->bidresult_model->setScopeAbatement($scope_abatement);
        }
        if(!empty($scope_interior_demolition)){
          $this->bidresult_model->setScopeIntDemolition($scope_interior_demolition);
        }
        if(!empty($scope_site_demolition)){
          $this->bidresult_model->setScopeSiteDemolition($scope_site_demolition);
        }
        if(!empty($scope_earthwork)){
          $this->bidresult_model->setScopeEarthwork($scope_earthwork);
        }
        if(!empty($scope_other)){
          $this->bidresult_model->setScopeOther($scope_other);
        }


        if(!empty($project_type)){
            $this->bidresult_model->setProjectType($project_type);
        }
        if(!empty($material_needs)){
            $this->bidresult_model->setMaterialNeeds($material_needs);
        }
               
        $getOrderInfo = $this->bidresult_model->getOrders();
   
        $dataArray = array();
        foreach ($getOrderInfo as $element) { 
            setlocale(LC_MONETARY, 'en_US');
            $bidprice = money_format('%.0n', (float)$element['bidPrice']);
            $marketType = str_replace("_"," ",$element['marketType']);
            $buildingType = str_replace("_"," ",$element['buildingType']);
            if($element['buildingSf'] > 0)
                $unitCost = number_format((float)$element['bidPrice']/(float)$element['buildingSf'], 2, '.', '');
            else 
                $unitCost = number_format("0", 2, '.', '');
            $dataArray[] = array(
                $element['projectName'],
                $element['scope'],
                $element['companyName'],
                ucfirst($marketType),
                ucfirst($buildingType),
                $element['buildingSf'],
                $bidprice,
                $unitCost,
                '<a href="#" data-leadid="'.$element['id'].'" onClick="delete_bid('. $element['id'].')" class="btn btn-rounded bg-danger btn-sm deleteList"> <i class="fa fa-trash-alt"></i> </a>',
            );
        }
        echo json_encode(array("data" => $dataArray));
    }

    /**
     * This function used to load the first screen of the user.
     */
    public function editbidResults($bidId)
    {  
        $this->load->model('project_model');
        $this->global['pageTitle'] = 'Amplify : Edit Bid Results';
        $this->global['PageEdit'] = "Edit Bid Results";
        $userId = $this->session->userdata['userId'];
        $data['bidResultsRecords'] = $this->bidresult_model->getBidResultById($bidId);
        $this->loadViews('bidresults/edit_bidResults', $this->global, $data, null);
    }


    /**
     * This function is used to edit the update Contact information.
     */
    public function editBidSubmit($bidId)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {            
                $this->load->library('form_validation');
                $this->form_validation->set_rules('companyName','Company Name', 'trim|required');
                $this->form_validation->set_rules('bidPrice','Bid Price', 'trim|required');

                if ($this->form_validation->run() == false) {
                    //echo $buisnessId;die;
                    $this->editbidResults($bidId);
                }else{

                    $companyName = $this->security->xss_clean($this->input->post('companyName'));
                    $bidPrice = $this->input->post('bidPrice');
                    $bidInfo = array(
                        'companyName' => $companyName,
                        'bidPrice' => $bidPrice
                    );
                    $result = $this->bidresult_model->editBidReuslts($bidInfo,$bidId);
                   
                    if ($result == true) {
                        $this->session->set_flashdata('success', 'This Bid has been successfully updated.');
                    } else {
                        $this->session->set_flashdata('error', 'Bid updation failed');
                    }
                    redirect('bidresults/editbidResults/'.$bidId);
                }    
        }
    }


    /**
     * This function is used to delete the Bid using id.
     *
     * @return bool $result : TRUE / FALSE
     */
    public function deletebidResults()
    {
        if ($this->isAdmin() == true) {
            echo json_encode(array('status' => 'access'));
        } else {
            $bidId = $this->input->post('bidId');
            $result = $this->bidresult_model->deleteBid(array('id'=>$bidId));
           

            if ($result > 0) {
                echo json_encode(array('status' => true));
            } else {
                echo json_encode(array('status' => false));
            }
        }
    }

}
