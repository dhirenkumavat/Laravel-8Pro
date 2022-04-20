<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH.'/libraries/BaseController.php';

/**
 * Class : Map (MapController)
 * Map Class to control all Territory Manager by user related operations.
 *
 * @author : Web Team
 *
 * @version : 1.1
 *
 * @since : 01 February 2019
 */
class Map extends BaseController
{
    /**
     * This is default constructor of the class.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('map_model');
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
     * This function is used to load the map list.
     */
    public function mapListing()
    { 
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {

            $projectIdFrm = $this->security->xss_clean($this->input->post('projectIdFrm'));
            if(isset($projectIdFrm) && !empty($projectIdFrm)){
                $data['getProjects'] = $this->map_model->getProjects($projectIdFrm);
            }else{
                $data['getProjects'] = $this->map_model->getProjects('');
            }

                       
            $data['projectLat']  = "33.942467"; 
            $data['projectLong'] = "-117.229675";            
            //print_r($data['getTerritoryManager']);
            $this->global['pageTitle'] = 'Amplify : Projects Map';            
            $this->loadViews('map/map', $this->global, $data, null);
        }
    }

    /**
     * This function is used to load the material map list.
     */
    public function materialsMapListing()
    { 
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {

            $projectIdFrm = $this->security->xss_clean($this->input->post('projectIdFrm'));
            if(isset($projectIdFrm) && !empty($projectIdFrm)){
                $data['getProjects'] = $this->map_model->getProjects($projectIdFrm);
                
            }else{
                $data['getProjects'] = $this->map_model->getProjects('');
            }
            $data['stages'] = $this->map_model->getStages();
            $data['projectLat']  = "33.942467"; 
            $data['projectLong'] = "-117.229675";            
            //print_r($data['getTerritoryManager']);
            $this->global['pageTitle'] = 'Amplify : Material Map'; 
            $this->loadViews('map/materialsMap', $this->global, $data, null);
        }
    }

    /**
     * This function is used to load the material map list.
     */
    public function getProjectByMaterialId()
    { 
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $materialIdArr = $this->input->post('materialIdArray');
            $stageIdArr = $this->input->post('stageId');
            $bidDueStart = $this->input->post('bidDueStart');
            $bidDueEnd = $this->input->post('bidDueEnd');
          
            $projectsIdArray = $this->map_model->getProjectIdByMaterialId($materialIdArr,$stageIdArr,$bidDueStart,$bidDueEnd);
            if(!empty($projectsIdArray)){
                $projectId = array();
                foreach ($projectsIdArray as $key => $value) {
                    $projectId[] = $value['projectId'];
                }
                echo json_encode($projectId);
            }else{
                echo json_encode($projectsIdArray);
            }
        }
    }

    /*
     * This function will filter the map by project.
     */

    public function getMapById(){
        $projectId = $this->input->post('projectId');
        $project = $this->map_model->getProjects($projectId);
        echo json_encode($project);
        exit;
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
