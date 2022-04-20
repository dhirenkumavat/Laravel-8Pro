<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Map_model extends CI_Model
{

    private $_limit;
    private $_pageNumber;
    private $_offset;

    // setter getter function
    public function setLimit($limit) {
        $this->_limit = $limit;
    }
    public function setPageNumber($pageNumber) {
        $this->_pageNumber = $pageNumber;
    }
    public function setOffset($offset) {
        $this->_offset = $offset;
    }

    /**
     * This function is used to get the Territory manager information.
     *
     * @return array $result : This is result of the query
     */
    public function getProjects($projectIdFrm)
    {
        $this->db->select('BaseTbl.*');
        //$this->db->select('BaseTbl.projectId,BaseTbl.projectName,BaseTbl.address,BaseTbl.createdDtm');
        $this->db->from('amp_projects as BaseTbl');
        if($projectIdFrm && $projectIdFrm!=''){
            $this->db->where('BaseTbl.projectId', $projectIdFrm);    
        } 

        $user_level_where_condition = manage_user_level_condition();     

        if(!empty($user_level_where_condition)){
            $this->db->where($user_level_where_condition);
        }

        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.address != ""');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }

    // function to get  the address
    public function getLatLong($address){

        //https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBSy4oTrksxRZyycZlC08uDYgtzdZ03SuQ&address=
        $geo = @file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyB7_NfvBxKc8FpOZgAlRLlW0SApkVbidb4&address='.urlencode($address).'&sensor=false');
        $geo = json_decode($geo, true); // Convert the JSON to an array
        //print_r($geo);die;
        
        if (isset($geo['results'][0]['geometry']['location']['lat'])) {
          $latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
          $longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
          $return = $latitude."@".$longitude;    
          return $return ;
        }
        else {        
            return "22.719568@75.858727";
        }

        /*
        $address = str_replace(" ", "+", $address);
        $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
        $json = json_decode($json);
        print_r($json);die;
        $lat  = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
        $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
        return $lat."#".$long;
        */    
    }

    // get Orders List
    public function getProjectIdByMaterialId($materialIdArr,$stageIdArr,$bidDueStart,$bidDueEnd) {  
        if(!empty($materialIdArr) || !empty($stageIdArr) || (!empty($bidDueStart) && !empty($bidDueEnd))){
            $this->db->select('projectId');
            $this->db->from('amp_projects');
            //  $materialArray = $this->_material_needs;
            
            if(!empty($materialIdArr)){
                $this->db->group_start();
                foreach($materialIdArr as $value)
                {
                    if($value == "material_all"){
                        $this->db->or_where("find_in_set('import_soil', materialNeeds)");
                        $this->db->or_where("find_in_set('export_soil', materialNeeds)");
                        $this->db->or_where("find_in_set('balance_site', materialNeeds)");
                        $this->db->or_where("find_in_set('crush_site', materialNeeds)");
                        $this->db->or_where("find_in_set('concrete_haul_off', materialNeeds)");
                    }else{
                        $this->db->or_where("(find_in_set('$value', materialNeeds)) ");
                    }
                }
                $this->db->group_end();
            }
            
            if(!empty($stageIdArr)){
                
                    $this->db->where_in('stageId',$stageIdArr);
                
            }
            if((!empty($bidDueStart) && !empty($bidDueEnd))){
                    $this->db->where('dueDate >=',$bidDueStart);
                    $this->db->where('dueDate <=',$bidDueEnd);
            }
        
            $user_level_where_condition = manage_user_level_condition();     
            if(!empty($user_level_where_condition)){
                $this->db->where($user_level_where_condition);
            }
            $query = $this->db->get();  
            //echo $this->db->last_query();die;      
            return $query->result_array();
            }
        }
    

    /**
     * This function used to get Stages information
     * @return array $result : This is user information
     */
    function getStages()
    {
        $this->db->select('stageId,stageName,  stageOrder');
        $this->db->from('amp_stages');
        $this->db->where('isDeleted', 0);
        $this->db->order_by('amp_stages.stageOrder', 'ASC');
        $query = $this->db->get();        
        $result = $query->result();        
        return $result;
    }
}