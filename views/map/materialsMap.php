
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
    .gm-style-iw.gm-style-iw-c{
      background-color: #D3D3D3!important;
    }
    .gm-style-iw-d {
      scrollbar-color: #D3D3D3!important;
    }
</style>
<script type="text/javascript">




   $( function() {
        $('#bidStart').datepicker();
    });
</script>
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
                        <div class="form-row">
                            <div class="row">                        
                                <div class="form-group col-sm-2 mb-4">
                                    <label>Project Status :</label>                                
                                </div> 
                                <div class="form-group col-sm-10 mb-4">
                                    <select class="form-control" id="stageId" name="stageId[]" multiple="">
                                          <!-- <option value="0">Select Status</option>   -->
                                           <?php
                                          if(!empty($stages))
                                          {
                                              foreach ($stages as $rl)
                                              {
                                                  ?>
                                                  <option value="<?php echo $rl->stageId ?>" ><?php echo $rl->stageName ?></option>
                                                  <?php
                                              }
                                          }
                                          ?>        
                                  </select>
                                </div>                        
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="row align-items-center">    
                              <label class="col-md-2">BID Start :</label>                     
                                <div class="form-group col-md-4 mb-2">
                                    
                                    <input class="form-control" required type="text" value="<?php echo set_value('bidStart'); ?>" id="bidStart" placeholder="mm/dd/yyyy"  name="bidStart" placeholder="BID Start">         

                                   

                                </div> 
                                  <label class="col-md-2">BID End :</label>            
                                  <div class="form-group col-md-4 mb-2">
                                      
                                      <input class="form-control" required type="text" value="<?php echo set_value('bidEnd'); ?>" id="bidEnd" placeholder="mm/dd/yyyy"  name="bidEnd" placeholder="BID End">                              
                                  </div>
                               </div> 
                             
                              <div class="row"> 
                                  <div class="col-md-2"></div>
                                  <div class="form-group col-md-10 pt-1 d-flex align-items-center">
                                    <input type="button" class="dateButton btn btn-primary btn-xs mr-1" id="three_months" name="three_months" value="+3 Months"><input type="button" class="dateButton btn btn-primary btn-xs mr-1" id="six_months" name="six_months" value="+6 Months"><input type="button" class="dateButton btn btn-primary btn-xs mr-1" id="nine_months" name="nine_months" value="+9 Months"><input type="button" class="dateButton btn btn-primary btn-xs mr-1" id="twelve_months" name="twelve_months" value="+12 Months">   
                                  </div>
                                </div>

                                </div>                        
                             
                        </div>
                         

                        <div class="col-xl-2 col-lg-2 col-md-2 mb-3">
                                 
                                 <button name="filter_order_filter" type="button" class="btn btn-rounded bg-info pd-6-30" id="filter-order-filter" value="filter"><i class="fa fa-search fa-fw"></i></button>  
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
                    $estStartDate      = $value->estStartDate;//$getLatLongArr[0];
                    $materialNeedsArray = explode(",", $value->materialNeeds);

                    $material = "";
                    if(in_array('import_soil', $materialNeedsArray)){
                      $material.="IS ,";
                    }
                    if(in_array('export_soil', $materialNeedsArray)){
                      $material.="ES ,";
                    }
                    if(in_array('balance_site', $materialNeedsArray)){
                      $material.="BS ,";
                    }
                    if(in_array('crush_on_site', $materialNeedsArray)){
                      $material.="COS ,";
                    }
                    if(in_array('concrete_haul_Off', $materialNeedsArray)){
                      $material.="CHO ,";
                    }
                    

                    $userInfo = '<strong><b>Job Name:</b> <b style="font-size:14px;">'.ucwords($projectName).'</b></strong>'."<br/>".'<strong>Material Needs: '.rtrim($material,",").'</strong>'."<br/>".'<strong><b>Est. Start Date: </b><b style="font-size:14px;">'. $estStartDate .'</b></strong>'."<br/>".'<strong>Address: '. trim(addslashes(preg_replace('/\s+/', ' ', $value->address))).'</strong>'.'<br>'.'<a href="'.$projectId.'" target="_blank" class="btn btn-rounded bg-info btn-block m-t-b">View</a>';

                    $arr[] = "'".$userInfo."'".",".$latitude.",".$longitude.",".$i.",".$value->projectId;      

                    //map tooltip
                    $getProjectsArrInfo = '<strong>Name: '.ucwords($projectName).'</strong>'.'<br>'.'<strong>Address: '.trim(addslashes(preg_replace('/\s+/', ' ', $value->address))).'</strong>'.'<br>'.'<a href="'.$projectId.'" target="_blank" class="btn btn-rounded bg-info btn-block m-t-b"> View Project </a>';

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


<link rel="stylesheet" href="http://ampco-test.dadenllc.com/assets/libs/css/jquery-ui.css">

<script src="http://ampco-test.dadenllc.com/assets/libs/js/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/select2/css/select2.css">
<script src="<?php echo base_url(); ?>assets/vendor/select2/js/select2.min.js"></script>

<script>
    $(document).ready(function(){
        // Initialize select2
        $("#stageId").select2();
    });
</script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script> -->

<script type="text/javascript">

  $('.dateButton').click(function(){
    
      id = $(this).attr('id');
      $('#bidStart').val(("0" +(new Date()).getMonth()).slice(-2) + "/" + ("0" +(new Date()).getDate()).slice(-2) + "/" + (new Date()).getFullYear());   
    
    
    if(id == 'three_months'){

      date =(new Date());
      var newDate = new Date(date.setMonth(date.getMonth()+3));
      $('#bidEnd').val(convertDate(newDate));                 
    }
    
    if(id == 'six_months'){
      date =(new Date());
      var newDate = new Date(date.setMonth(date.getMonth()+6));
      $('#bidEnd').val(convertDate(newDate));         
    }
    
    if(id == 'nine_months'){
      date =(new Date());
      var newDate = new Date(date.setMonth(date.getMonth()+9));
      $('#bidEnd').val(convertDate(newDate));         
    }
    
    if(id == 'twelve_months'){
      date =(new Date());
      var newDate = new Date(date.setMonth(date.getMonth()+12));
      $('#bidEnd').val(convertDate(newDate));       
    }
});

  function convertDate(inputFormat) {
  function pad(s) { return (s < 10) ? '0' + s : s; }
  var d = new Date(inputFormat)
  return [pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('/')
}

$( function() {
    $( "#bidStart" ).datepicker();
    $( "#bidEnd" ).datepicker();
  });



  // render date datewise
   jQuery(document).on('click','#filter-order-filter', function(){
        arr = [];
        if($("#material_all").is(":checked")){
          arr.push("material_all");
        }else{
            if ((index = arr.indexOf("material_all")) !== -1) {
              
                arr.splice(index, 1);
            }

        }
        if($("#import_soil").is(":checked")){
          arr.push("import_soil");
        }else{
            if ((index = arr.indexOf("import_soil")) !== -1) {
              
                arr.splice(index, 1);
            }

        }
        if($("#export_soil").is(":checked")){
          arr.push("export_soil");
        }else{
            if ((index = arr.indexOf("export_soil")) !== -1) {
              
                arr.splice(index, 1);
            }

        }
        if($("#balance_site").is(":checked")){
          arr.push("balance_site");
        }else{
            if ((index = arr.indexOf("balance_site")) !== -1) {
              
                arr.splice(index, 1);
            }

        }
        if($("#crush_site").is(":checked")){
          arr.push("crush_site");
        }else{
            if ((index = arr.indexOf("crush_site")) !== -1) {
              
                arr.splice(index, 1);
            }

        }
        if($("#concrete_haul_off").is(":checked")){
          arr.push("concrete_haul_off");
        }else{
            if ((index = arr.indexOf("concrete_haul_off")) !== -1) {
              
                arr.splice(index, 1);
            }

        }


        var stageId = $("#stageId").val();
        var bidDueStart = $("#bidStart").val();
        var bidDueEnd = $("#bidEnd").val();

        if(arr.length == 0 && stageId == "" && bidDueStart == "" && bidDueEnd == ""){
            alert("Please Select filter");
            return false;
        }
         //var data = {materialIdArray: arr,stageId:stageId};
         $.ajax({
                  url: "<?php echo base_url().'map/getProjectByMaterialId'?>",
                  type: 'POST',
                  data:{materialIdArray: arr,stageId:stageId,bidDueStart:bidDueStart,bidDueEnd:bidDueEnd},
                  success: function (data) {
                    filterMarkers(data)
                  },
                  error: function (data) {
                     alert(data);
                  }
              });
        //getMapPins(data);
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