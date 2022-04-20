
<style type="text/css">
    .mapContentClass {
        text-align: center;
    }
    .mapCompanyNameClass {
        font-size: 22px;
    }
    .mapNameClass {
        font-size: 16px;
        padding: 5px 0px;
    }
    .mapRefBtnClass a {
        background: #2182c6;
        display: block;
        color: #fff;
        padding: 6px 35px;
        border-radius: 3px;
        margin-top: 8px;
    }
</style>

<div class="dashboard-wrapper" id="page-content-wrapper">
<div class="dashboard-ecommerce">
<div class="container-fluid dashboard-content ">
<!-- ============================================================== -->
<div class="ecommerce-widget">
   <!-- pageheader -->
   <!-- ============================================================== -->
   <div class="row">
      <div class="col-xl-12 text-left">
         <?php
            $this->load->helper('form');
            $error = $this->session->flashdata('error');
            if($error)
            {
            ?>
         <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $this->session->flashdata('error'); ?>                    
         </div>
         <?php } ?>
         <?php  
            $success = $this->session->flashdata('success');
            if($success)
            {
            ?>
         <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $this->session->flashdata('success'); ?>
         </div>
         <?php } ?>
         <div class="col-md-12">
            <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
         </div>
      </div>
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-0">
         <div class="page-header">
            <h2 class="pageheader-title">administrator - Real Time Map</h2>
         </div>
      </div>
   </div>
   <!-- ============================================================== -->
   <!-- end pageheader -->
   <!-- Filter Criteria Form start -->
   <div class="card">
      <!-- <div class="custom-card"><h5 class="card-header"> Pending Tasks </h5></div> -->
      <div class="card-body">
         <!-- <form role="form" id="mapFrm" name="mapFrm" action="<?php echo base_url() ?>mapListing" method="post" role="form"> -->
             <div class="form-row">
                            <div class="row">                        
                                <div class="form-group col-sm-2 mb-4">
                                    <label>Select Material :</label>                                
                                </div> 
                                <div class="form-group col-sm-10 mb-4">
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" name="material[]" value="all" id="material_all" class="custom-control-input "><span class="custom-control-label">All</span>
                                    </label>

                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" name="material[]"  id="import_soil" value="IS" class="custom-control-input "><span class="custom-control-label">Import Soil</span>
                                    </label>    
                               
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" name="material[]" id="export_soil" value="ES" class="custom-control-input "><span class="custom-control-label">Export Soil</span>
                                    </label>    
                               
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" name="material[]"  id="balance_site" value="BS" class="custom-control-input "><span class="custom-control-label">Balance Site</span>
                                    </label>      
                               
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" name="material[]"  id="crush_site" value="CS" class="custom-control-input "><span class="custom-control-label">Crush on Site</span>
                                    </label>      
                               
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" name="material[]" value="CHO" id="concrete_haul_off" class="custom-control-input "><span class="custom-control-label">Concrete Haul Off</span>
                                    </label>     
                                </div>                        
                            </div>
                        </div>
         <!-- </form> --> 
      </div>
   </div>
   <!-- Filter Criteria Form end -->
   <div class="card">
      <div class="card-body">
         <div class="row">

             <?php


            if(isset($getProjects) && !empty($getProjects)){
                $i = 0;
                $arr            = array();
                $getProjectsArr = array();
                foreach ($getProjects as $value) {
                    $projectId    = $value->projectId;
                    $projectName  = ucwords(preg_replace('/[^\w]/', '', $value->projectName));
                    $firstName    = ucwords($value->firstName);
                    $lastName     = $value->lastName;
                    $address      = $value->address." ".$value->city." ".$value->state." ".$value->countryId." ".$value->zip;
                    $fullName     = $firstName.' '.$lastName;
                    $latitude      = $value->latitude;//$getLatLongArr[0];
                    $longitude     = $value->longitude;//$getLatLongArr[1];
                    $currentTime = date("m-d-Y h:i:s", strtotime($value->createdDtm));
                    $projectId = base_url()."editProject/".$projectId;

                    $userInfo = '<strong>Name: '.ucwords($projectName).'</strong><br><a href="'.$projectId.'" class="btn btn-rounded bg-info btn-block m-t-b"> View Project </a>';

                    $arr[] = "'".$userInfo."'".",".$latitude.",".$longitude.",".$i.",".$value->projectId;      

                    //map tooltip
                    $getProjectsArrInfo = '<strong>Name: '.ucwords($projectName).'</strong><br><a href="'.$projectId.'" class="btn btn-rounded bg-info btn-block m-t-b"> View Project </a>';
                    $getProjectsArr[] = "'$getProjectsArrInfo'".','.$latitude.','.$longitude.','.$i;

                    $i++;
                }     
            } 
            ?>

          <div id="map" style="height: 600px;"></div>
         </div>
      </div>
   </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


<script type="text/javascript">
      $(document).ready(function(){

        arr = [];
        $('input[type="checkbox"]').click(function(){

            if($(this).is(":checked")){
              arr.push(this.id);

            }
            else{
                if ((index = arr.indexOf(this.id)) !== -1) {
                  
                    arr.splice(index, 1);
                }

            }

            $.ajax({
                  url: "<?php echo base_url().'map/getProjectByMaterialId'?>",
                  type: 'POST',
                  data:{materialIdArray: arr},
                  success: function (data) {
                    filterMarkers(data)
                  },
                  error: function (data) {
                     alert(data);
                  }
              });

        });

    });

var map;
function initMap() {

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 4,
        center: new google.maps.LatLng(<?php echo $projectLat; ?>, <?php echo $projectLong; ?>),
        mapTypeId: google.maps.MapTypeId.SATELLITE
    });
}

filterMarkers = function (arr) {
	var locations = [
        <?php if(isset($arr) && !empty($arr)){ foreach ($arr as $value) { ?>
            [<?php echo $value; ?>],
        <?php } } ?>
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 4,
        center: new google.maps.LatLng(<?php echo $projectLat; ?>, <?php echo $projectLong; ?>),
        mapTypeId: google.maps.MapTypeId.SATELLITE
    });

    var marker, i;
    for (i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map,
            id : locations[i][4]
        });
        
        if(arr.indexOf(marker.id) !== -1){
          marker.setVisible(true);
        }else{
          marker.setVisible(false);
        }

        // if($.inArray('n',arr)){
        //   console.log("here");
        //   console.log("marker.id ====IF===>"+marker.id);
        //   console.log("arr =======>"+arr);
        //     marker.setVisible(true);
        // }else {
          
        //   console.log("marker.id ====ELSE===>"+marker.id);
        //   console.log("arr =======>"+arr);
        //     marker.setVisible(false);
        // }
        // // If is same id
        // if (marker.id == id || id.length === 0) {
        //     marker.setVisible(true);
        // }
        // id don't match 
        
        var infowindow = new google.maps.InfoWindow({});
        google.maps.event.addListener(marker, 'click', (function (marker, i) {
            return function () {
                infowindow.setContent(locations[i][0]);
                infowindow.open(map, marker);
            }
        })(marker, i));
    }

}
</script>
<!-- AIzaSyDXnYIF2RRd5COYQasKvQdAK6Pa7jKl5Oc -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7_NfvBxKc8FpOZgAlRLlW0SApkVbidb4&callback=initMap"></script>