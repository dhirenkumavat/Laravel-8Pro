<?php
$projectId = $leadInfo->projectId;
$project_name = $leadInfo->projectName;
$budget= $leadInfo->budget;
$scope=$leadInfo->scope;
$wages=$leadInfo->wages;
$sales= $leadInfo->sales;
$admin= $leadInfo->admin;
$estimator= $leadInfo->estimator;
//print_r($estimator);die;
$estimator_email = $leadInfo->estimator_email;
$clientName= $leadInfo->clientName;
$dueDate= $leadInfo->dueDate;
$dueTime= $leadInfo->dueTime;
$jobWalkTime= $leadInfo->jobWalkTime;
$estStartDate= $leadInfo->estStartDate;
$rfiDeadline= $leadInfo->rfiDeadline;
$bidForm= $leadInfo->bidForm;
$bid_price= $leadInfo->bid_price;
$reports= $leadInfo->reports;
$mainContact= $leadInfo->mainContact;
$first_name = $leadInfo->firstName;
$last_name = $leadInfo->lastName;
$address = $leadInfo->address;
$reftypeId = $leadInfo->reftypeId;
$dl = $leadInfo->DL;
$dob = $leadInfo->dob;
$email = $leadInfo->email;
$mobile1 = $leadInfo->phoneNo1;
$mobile2 = $leadInfo->phoneNo2;
$salesRepId = $leadInfo->salesRepId;
$stage = $leadInfo->stageId;
$countryId = $leadInfo->countryId;
$fs_id = $leadInfo->filesystem_id;
$createdDtm = $leadInfo->createdDtm;

$marketType = $leadInfo->marketType;
$buildingType = $leadInfo->buildingType;
$materialNeeds = $leadInfo->materialNeeds;
$buildingSf = $leadInfo->buildingSf;
$company = $leadInfo->company;
if($createdDtm == "0000-00-00" || $createdDtm == ""){
    $createdDtm = date("Y-m-d");
}

$brokerFee = $leadInfo->brokerFee;
$iid = $leadInfo->IID;
$tag = $leadInfo->tagId;
$jobtypeid = $leadInfo->jobtypeid;

$referralSourceId = $leadInfo->referralSourceId;
$notes = $leadInfo->notes;
$ownership = $leadInfo->ownership;
$policyExpiration = $leadInfo->policyExpiration;
$businessOwner = $leadInfo->businessOwner;
$is_priority = $leadInfo->is_priority;
$contract = $leadInfo->contract;

?>
<style>
    .disabledbutton {
    pointer-events: none;
    opacity: 0.4;
}.disabledbuttoncall {
    pointer-events: none;
    opacity: 0.4;
}.disabledbuttonemail {
    pointer-events: none;
    opacity: 0.4;
}
.sweet-alert .sa-icon.sa-success::before {
    width: 100px;
    transform: rotate(90deg);
}
.pac-container { z-index: 10000 !important; }
</style>
<script>
    setTimeout(function() {
    $('.alert').fadeOut('fast');
}, 20000); // <-- time in milliseconds
</script>
 <div class="dashboard-wrapper" id="page-content-wrapper">
        <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">
                <!-- ============================================================== -->
                <div class="ecommerce-widget">
            <!-- pageheader -->
            <!-- ============================================================== -->
            
            </div>
            <!-- ============================================================== -->
            <!-- end pageheader -->

            <?php
                $CI =& get_instance();
                $CI->load->model('Project_model');
                $next = $CI->Project_model->next_project($projectId);
                $prev = $CI->Project_model->previous_project($projectId);
            ?>
           
            <strong class="btn btn-rounded bg-info pdfDownload" style=""><a href="<?php echo base_url('pdfProject/'.$projectId);?>">PDF</a></strong>
            <a class="btn btn-lg btn-rounded bg-info pdfDownload" target="_blank" href="<?php echo base_url('folderstrct/'.$fs_id." ".$project_name);?>">
            <i class="fa fa-folder-open-o"></i>Open Project Folder on File Server
            </a>
            <!-- <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body text-right">
                            <?php if($prev['projectId'] != NULL){ ?>
                               <strong style="font-size: 16px;"><a href="<?php echo base_url('editProject/'.$prev['projectId']);?>"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Previous</a></strong>
                            <?php } ?>
                            <?php if($next['projectId'] != NULL){ ?>
                               <strong style="float: right;font-size: 16px;"><a class="projectNext-btn" href="<?php echo base_url('editProject/'.$next['projectId']);?>">Next <i class="fa fa-angle-double-right" aria-hidden="true"></i></a></strong>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div> -->

        <!-- Filter Criteria Form start -->
         <!-- Filter Criteria Form start -->
         <div class="row">
            <div class="col-md-12">
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
        </div>

        <!-- <div class="row">
            <div class="col-sm-12">
                <a href="#" class="btn btn-rounded bg-info float-right mb-2"> <i class="fab fa-telegram-plane"></i>  Send to Rater </a>
            </div>
        </div> -->

        <div class="editViewLeadClass1">
                <?php $this->load->helper("form"); ?>
                <form role="form" action="<?php echo base_url() ?>editProjectSubmit" method="post" id="editProject" enctype="multipart/form-data">
                <input type="hidden" value="<?php echo $projectId; ?>" name="projectId" id="projectId" />

        <div class="row">
        <div class="col-lg-6 editPage">
                

            <!-- Customer Data start -->
            <div class="card">
                <div class="custom-card"><h5 class="card-header"> Project Data </h5></div>
                    <div class="card-body customerDataEditCard">
                        <h4>
                            <div class="row">
                                <strong class="col-lg-4">This project is a priority:</strong>
                                <span class="col-lg-6">
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input class="custom-control-input" value="1" type="checkbox" name="is_priority" <?php echo ($is_priority == '1') ?  "checked" : "" ;  ?> disabled><span class="custom-control-label">&nbsp;</span>
                                    </label>
                                </span>
                            </div>
                        </h4>
                        <h4>
                            <div class="row">
                                <strong class="col-lg-4">Job # <span class="reqEstrik">*</span>:</strong>
                                <span class="col-lg-8" id="jod_num"><?php if(!empty($fs_id)){ echo $fs_id; }?>                               
                                    <input class="form-control jobnum" type="hidden" value="<?php if(!empty($fs_id)){ echo $fs_id; }?> " id="filesystem_id" name="filesystem_id">
                                    <!-- <i class="fas fa-pencil-alt p-l-10" id="jobnum"></i> -->
                                </span>
                            </div>
                        </h4>
                        <h4>
                            <div class="row">
                                <strong class="col-lg-4">Job Name *:</strong>
                                <span class="col-lg-8" id="project_name"><?php echo $project_name; ?>                               
                                    <!-- <input class="form-control pname" type="hidden"  value="<?php //echo $project_name; ?>" name="projectName"/> -->
                                    <input class="form-control pname" type="hidden" value="<?php echo $project_name; ?>" id="projectName" name="projectName">
                                    <!-- <i class="fas fa-pencil-alt p-l-10" id="pname"></i> -->
                                </span>
                            </div>
                        </h4>

                        <h4>
                            <div class="row">
                                <strong class="col-lg-4">Job Type:</strong>
                                <span class="col-lg-8">
                                    <select class="form-control" id="jobTypeId" name="jobTypeId" disabled>
                                        <option value="0">Select Job Type</option>
                                         <?php
                                        if(!empty($jobTypes))
                                        {
                                            foreach ($jobTypes as $job_type) 
                                            {
                                                ?>
                                                <option value="<?php echo $job_type->id ?>" <?php if($job_type->id == $jobtypeid) {echo "selected=selected";} ?>><?php echo $job_type->jobType ?></option>
                                                <?php
                                            }
                                        }
                                        ?>     
                                    </select>
                                </span>
                            </div>
                        </h4>
                         <h4>
                        <div class="row">
                            <strong class="col-lg-4">Company: </strong>
                              <div class="col-lg-4">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="company"  value="contractor" class="custom-control-input " <?php echo ($company== 'contractor') ?  "checked" : "" ;  ?> disabled><span class="custom-control-label">Contractor</span>
                                </label>                              
                            </div>                          
                            <div class="col-lg-4">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="company"  value="north" class="custom-control-input" <?php echo ($company== 'north') ?  "checked" : "" ;  ?> disabled><span class="custom-control-label" style="color: #006400;">North</span>
                                </label>                               
                            </div>                            
                        </div>
                    </h4>
                        <h4>
                            <div class="row">
                                <strong class="col-lg-4">Contract Value: </strong>
                                <span class="col-lg-6">
                                    <!-- <input class="form-control" min="0" type="number" value="<?php echo $contract; ?>" id="contract" name="contract" placeholder="Contract"> -->
                                    <input class="form-control" data-type="currency" type="text" value="<?php echo $contract; ?>" id="contract" name="contract" placeholder="Contract" disabled>
                                </span>
                            </div>
                        </h4>

                      <h4>
                        <div class="row">
                            <strong class="col-lg-4">Budget: </strong>
                              <div class="col-lg-4">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="budget"  value="1" class="custom-control-input " <?php echo ($budget== '1') ?  "checked" : "" ;  ?> disabled><span class="custom-control-label">Yes</span>
                                </label>                              
                            </div>                          
                            <div class="col-lg-4">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="budget"  value="0" class="custom-control-input " <?php echo ($budget== '0') ?  "checked" : "" ;  ?> disabled><span class="custom-control-label">No</span>
                                </label>                               
                            </div>                            
                        </div>
                    </h4>
                    <h4>
                     <div class="row">
                        <?php
                        $scope=explode(",",$scope);

                        ?>
                            <strong class="col-lg-4">Scope : </strong>  
                            <div class="col-lg-8">
                                <label class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" name="scope[]" id="scope" value="abatement" class="custom-control-input " <?php if (in_array("abatement",$scope)) { echo 'checked="checked"';}?> disabled><span class="custom-control-label">Abatement</span>
                                </label>                              
                            
                                <label class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" name="scope[]" id="scope" value="interior_demolition" class="custom-control-input "  <?php if (in_array("interior_demolition",$scope)) { echo 'checked="checked"';}?> disabled><span class="custom-control-label">Interior Demolition</span>
                                </label>                               
                             
                                <label class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" name="scope[]" id="scope" value="site_demolition" class="custom-control-input "  <?php if (in_array("site_demolition",$scope)) { echo 'checked="checked"';}?> disabled><span class="custom-control-label">Site Demolition</span>
                                </label>                               
                             
                                <label class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" name="scope[]" value="earthwork" id="scope" class="custom-control-input "  <?php if (in_array("earthwork",$scope)) { echo 'checked="checked"';}?> disabled><span class="custom-control-label">Earthwork</span>
                                </label>                                
                             
                                <label class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" name="scope[]" value="other" id="scope" class="custom-control-input "  <?php if (in_array("other",$scope)) { echo 'checked="checked"';}?> disabled><span class="custom-control-label">Other</span>
                                </label>
                            </div>
                            
                        </div>
                    </h4>
                    <!-- <h4>
                        <div class="row">
                            <strong class="col-lg-4">Wages: </strong>
                            <span class="col-lg-8">
                                <select class="form-control" id="wages1" name="wages">
                                    <option value="">Select Wages</option> 
                                    <option <?php if( $wages == "Private") {echo "selected=selected";} ?> value="Private">Private</option> 
                                    <option <?php if( $wages == "Prevailing Wage") {echo "selected=selected";} ?> value="Prevailing Wage">Prevailing Wage</option> 
                                    <option <?php if( $wages == "Union") {echo "selected=selected";} ?> value="Union">Union</option> 
                                    <option <?php if( $wages == "PLA") {echo "selected=selected";} ?> value="PLA">PLA</option>  
                                </select>
                        </div>
                    </h4> -->
                    <h4>
                        <div class="row">
                            <strong class="col-lg-4"> Wages:</strong>
                            <div class="col-lg-8">
                                <span class="form-group"> 
                                 <?php $wagesArray = array("Private"=>"Private","Prevailing Wage" => "Prevailing Wage","Union"=>"Union","PLA"=>"PLA"); ?>             
                                 <?php $wage = explode(",",$wages);?>
                                     <select class="form-control" id="wagesId" name="wagesId[]" multiple disabled>
                                                <option value="">Select Wages</option>  
                                                <?php
                                                    if(!empty($wagesArray))
                                                    {
                                                        foreach ($wagesArray as $k=>$rl)
                                                        {
                                                            ?>
                                                            <option value="<?php echo $k; ?>" <?php if(in_array($k,$wage)) {echo "selected=selected";} ?>><?php echo $rl; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>   
                                        </select>
                                </span>
                            </div>
                        </div>
                    </h4>

                    <h4>
                        <div class="row">
                            <strong class="col-lg-4">Sales: </strong>
                            <span class="col-lg-8">                          
                                <select class="form-control selectpicker" id="select-sales" name="sales" data-live-search="true" disabled>
                                        <option value="0">Select Sales</option>
                                        <?php
                                        if(!empty($userlist))
                                        {
                                            foreach ($userlist as $userEmail)
                                            {
                                                ?>
                                                <option data-tokens="<?php echo $userEmail->userId; ?>" <?php if($sales == $userEmail->userId){ echo "selected"; } ?> value="<?php echo $userEmail->userId; ?>"><?php echo $userEmail->name ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                </select>
                            </span>
                        </div>
                    </h4>
                    <h4>
                        <div class="row">
                            <strong class="col-lg-4">Admin: </strong>
                            <span class="col-lg-8">                           
                                <select class="form-control" id="admin" name="admin" disabled>
                                        <option value="0">Select Admin</option>
                                        <?php
                                        if(!empty($userlist))
                                        {
                                            foreach ($userlist as $userInfo)
                                            {
                                                ?>
                                                <option <?php if($admin == $userInfo->userId){ echo "selected"; } ?> value="<?php echo $userInfo->userId; ?>"><?php echo $userInfo->name ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                </select>
                            </span>
                        </div>
                    </h4>
                    <h4>
                        <div class="row">
                            <strong class="col-lg-4">Estimator: </strong>
                            <span class="col-lg-8">
                                <select class="form-control" id="estimator" name="estimator[]" multiple disabled>
                                        <option value="0">Select Estimator</option>
                                        <?php
                                        if(!empty($userlist))
                                        {
                                            $estimators = explode(",",$estimator);
                                            foreach ($userlist as $userInfo)
                                            {
                                                //print_r($estimators);
                                                //print_r($userInfo);
                                                ?>
                                                <option <?php if(in_array($userInfo->userId,$estimators)) {echo "selected=selected";} ?><?php //if($estimator == $userInfo->userId){ echo "selected=selected"; } ?> value="<?php echo $userInfo->userId; ?>"><?php echo $userInfo->name ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                </select>
                            </span>
                        </div>
                    </h4>
                     <!-- <h4>
                        <div class="row">
                            <strong class="col-lg-4">Estimator Email: </strong>
                            <span class="col-lg-8">                          
                                <select class="form-control" id="estimator_email" name="estimator_email">
                                        <option value="0">Select Estimator Email</option>
                                        <?php
                                        if(!empty($userlist))
                                        {
                                            foreach ($userlist as $userInfo)
                                            {
                                                ?>
                                                <option <?php if($estimator_email == $userInfo->userId){ echo "selected"; } ?> value="<?php echo $userInfo->userId; ?>"><?php echo $userInfo->name ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                </select>
                            </span>
                        </div>
                    </h4> -->

                    <h4>
                        <div class="row">
                            <strong class="col-lg-4">Job Site Address <span class="reqEstrik">*</span>:</strong>
                            <span class="col-lg-5 editable" value="<?php echo $address; ?>" id="lblName">
                            <input class="form-control" type="text" value="<?php echo $address; ?>" required name="address" id="autocomplete" onFocus="geolocate()" disabled/>
                            </span>
                            <?php 
                            //get lat long
                            $getLatLong = $this->map_model->getLatLong($address);
                            if(!empty($getLatLong)){
                                $getLatLongArr = explode("@", $getLatLong);
                            }
                            ?>
                            <div class="col-lg-3"> 
                                <!-- <a href="javascript:viewonMap('<?php echo $address; ?>','<?php echo $getLatLongArr[0]; ?>','<?php echo $getLatLongArr[1]; ?>');" class="licenseVerifyLink" title="Verify License">View on Map</a>  -->
                                <a href="http://maps.google.com/maps?z=12&t=k&q=<?php echo $address; ?>" target="_blank" class="licenseVerifyLink" title="">View on Map</a>
                            </div>
                        </div>
                    </h4>       

                    <h4>
                            <div class="row">
                            <strong class="col-lg-4">Bid Date <span class="reqEstrik">*</span>:</strong>
                            <span class="col-lg-8" id="due_date_info"><?php echo $dueDate; ?>
                                <input class="form-control due_date" type="hidden"  value="<?php echo $dueDate; ?>" name="due_date" disabled/>
                                <!-- <i class="fas fa-pencil-alt p-l-10" id="dueDateEdit"></i> -->
                            </span>
                        </div>
                    </h4>
                    <h4>
                            <div class="row">
                            <strong class="col-lg-4">Bid Time <span class="reqEstrik">*</span>: </strong>
                            <span class="col-lg-8" id="due_time_info"><?php echo $dueTime; ?>                               
                                <input class="form-control due_time" type="hidden"  value="<?php echo $dueTime; ?>" name="due_time" disabled/>
                                <!-- <i class="fas fa-pencil-alt p-l-10" id="dueTimeEdit"></i> -->
                            </span>
                        </div>
                    </h4>                  
                    <h4>
                            <div class="row">
                            <strong class="col-lg-4">Job Walk/Time:</strong>
                            <span class="col-lg-8" id="job_walk_time_info"><?php echo $jobWalkTime; ?>
                                <input class="form-control job_walk_time" type="hidden"  value="<?php echo $jobWalkTime; ?>" name="job_walk_time" disabled/>
                                <!-- <i class="fas fa-pencil-alt p-l-10" id="job_walk_time"></i> -->
                            </span>
                        </div>
                    </h4>
                      <h4>
                            <div class="row">
                            <strong class="col-lg-4">Est. Start Date <span class="reqEstrik">*</span>:</strong>
                            <span class="col-lg-8" id="est_start_date_info"><?php echo $estStartDate; ?>                               
                                <input class="form-control est_start_date" type="hidden"  value="<?php echo $estStartDate; ?>" name="est_start_date" disabled/>
                               <!--  <i class="fas fa-pencil-alt p-l-10" id="estStartDateEdit" ></i> -->
                            </span>
                        </div>
                    </h4>
                    <!-- <h4>
                        <div class="row">
                            <strong class="col-lg-4">RFI Deadline *:</strong>
                            <span class="col-lg-8" id="rfi_deadline_info"><?php echo $rfiDeadline; ?>                               
                                <input class="form-control rfi_deadline" type="hidden"  value="<?php echo $rfiDeadline; ?>" name="rfi_deadline"/>
                                <i class="fas fa-pencil-alt p-l-10" id="rfiDeadlineEdit"></i>
                            </span>
                        </div>
                    </h4>  -->
                     <!-- <h4>
                        <div class="row">
                            <strong class="col-lg-4">Bid Form: </strong>
                                <div class="col-lg-4">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="bid_form"  value="1" class="custom-control-input " <?php echo ($bidForm== '1') ?  "checked" : "" ;  ?>><span class="custom-control-label">Yes</span>
                                </label>                              
                            </div>                          
                            <div class="col-lg-4">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="bid_form"  value="0" class="custom-control-input " <?php echo ($bidForm== '0') ?  "checked" : "" ;  ?>><span class="custom-control-label">No</span>
                                </label>                               
                            </div> 
                        </div>
                    </h4>  -->
                        
                    <h4>
                        <div class="row">
                            <strong class="col-lg-4">Budget Price: </strong>
                            <span class="col-lg-8" id="bidPrice"><?php //echo $bid_price; ?>                               
                                <!-- <input class="form-control bidprice" type="hidden" value="<?php echo $bid_price; ?>" id="bid_price" name="bid_price"> -->
                                <?php
                                if($bid_price != "" || $bid_price != NULL){
                                    setlocale(LC_MONETARY, 'en_US');
                                    $bidprice = money_format('%.0n', $bid_price) ;
                                }else{
                                    $bidprice = "";
                                }
                                ?>
                                <input class="form-control bidprice" data-type="currency" type="text" value="<?php echo $bidprice; ?>" id="bid_price" name="bid_price" disabled>
                                <!-- <i class="fas fa-pencil-alt p-l-10" id="bidprice"></i> -->
                            </span>
                        </div>
                    </h4>

                    <!-- <h4>
                        <div class="row">
                            <strong class="col-lg-4">Reports: </strong>
                              <div class="col-lg-4">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="reports"  value="1" class="custom-control-input " <?php echo ($reports== '1') ?  "checked" : "" ;  ?>><span class="custom-control-label">Yes</span>
                                </label>                              
                            </div>                          
                            <div class="col-lg-4">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="reports"  value="0" class="custom-control-input " <?php echo ($reports== '0') ?  "checked" : "" ;  ?>><span class="custom-control-label">No</span>
                                </label>                               
                            </div> 
                          
                        </div>
                    </h4> -->

                    <!-- <h4>
                        <div class="row">
                            <strong class="col-lg-4"> Project Manager *:</strong>
                            <div class="col-lg-8">
                                <span class="form-group">                                
                                    <select required class="form-control" id="sales_rep" name="sales_rep">
                                            <option value="0">Select Project Manager</option>
                                            <?php
                                            if(!empty($sales_rep))
                                            {
                                                foreach ($sales_rep as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->userId; ?>" <?php if($rl->userId == $salesRepId) {echo "selected=selected";} ?>><?php echo $rl->name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                </span>
                            </div>
                        </div>
                    </h4> -->

                    <h4>
                            <div class="row">
                                <strong class="col-lg-4"> Market Type:</strong>
                                <div class="col-lg-8">
                                    <span class="form-group"> 
                                        <?php $marketArray = array("residential"=>"Residential","multi_family" => "Multi Family","light_industrial"=>"Light Industrial","heavy_industrial" => "Heavy Industrial" , "commercial"=> "Commercial","school_K-12" =>"School K-12","college" => "College","hospital" => "Hospital","hotel" => "Hotel","airport" => "Airport","freeway/highway" => "Freeway/Highway")?>                               
                                         <select class="form-control" id="marketTypeId" name="marketTypeId" disabled>
                                                    <option value="">Select Market Type</option>  
                                                    <?php
                                                        if(!empty($marketArray))
                                                        {
                                                            foreach ($marketArray as $k=>$rl)
                                                            {
                                                                ?>
                                                                <option value="<?php echo $k; ?>" <?php if($k == $marketType) {echo "selected=selected";} ?>><?php echo $rl; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    
                                            </select>
                                    </span>
                                </div>
                            </div>
                        </h4> 

                        <h4>
                            <div class="row">
                                <strong class="col-lg-4"> Building Type:</strong>
                                <div class="col-lg-8">
                                    <span class="form-group">   
                                        <?php $buildingArray = array("concrete1to3"=>"Concrete  1-3 Story","concrete4to10" => "Concrete  4-10 Story","steel_framed1to3"=>"Steel Framed  1-3 Story", "steel_framed4to10" => "Steel Framed 4-10 Story" ,"tilt_up" => "Tilt-Up" ,"wood_stucco" => "Wood/Stucco" ,"brick" => "Brick")?>                             
                                         <select class="form-control" id="buildingTypeId" name="buildingTypeId" disabled>
                                                    <option value="">Select Building Type</option>  
                                                    <?php
                                                        if(!empty($buildingArray))
                                                        {
                                                            foreach ($buildingArray as $k=>$rl)
                                                            {
                                                                ?>
                                                                <option value="<?php echo $k; ?>" <?php if($k == $buildingType) {echo "selected=selected";} ?>><?php echo $rl; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                            </select>
                                    </span>
                                </div>
                            </div>
                        </h4> 

                        <h4>
                            <div class="row">
                                <strong class="col-lg-4"> Material Needs:</strong>
                                <div class="col-lg-8">
                                    <span class="form-group"> 
                                     <?php $materialsArray = array("import_soil"=>"Import Soil","export_soil" => "Export Soil","balance_site"=>"Balance Site","crush_on_site"=>"Crush on Site", "concrete_haul_Off" => "Concrete Haul Off");?>             
                                     <?php $materialNeed = explode(",",$materialNeeds);?>
                                         <select class="form-control" id="materialNeedsId" name="materialNeedsId[]" multiple disabled>
                                                    <option value="">Select Material</option>  
                                                    <?php
                                                        if(!empty($materialsArray))
                                                        {
                                                            foreach ($materialsArray as $k=>$rl)
                                                            {
                                                                ?>
                                                                <option value="<?php echo $k; ?>" <?php if(in_array($k,$materialNeed)) {echo "selected=selected";} ?>><?php echo $rl; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>   
                                            </select>
                                    </span>
                                </div>
                            </div>
                        </h4> 

                        <h4>
                            <div class="row">
                                <strong class="col-lg-4">Building SF <span class="reqEstrik">*</span>:</strong>
                                <div class="col-lg-8">
                                    <input class="form-control" required pattern="^[\d,]+$" type="text" value="<?php echo number_format($buildingSf); ?>" id="building_sf" name="building_sf" placeholder="Building SF" disabled> 


                                </div>
                            </div>
                        </h4> 

                    <h4>
                        <div class="row">
                            <strong class="col-lg-4"> Project Stage:</strong>
                            <div class="col-lg-8">
                                <span class="form-group">                                
                                     <select class="form-control" id="stage" name="stage" disabled>
                                                <option value="0">Select Stages</option>  
                                                 <?php
                                                if(!empty($stages))
                                                {
                                                    foreach ($stages as $rl)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $rl->stageId ?>" <?php if($rl->stageId == $stage) {echo "selected=selected";} ?>><?php echo $rl->stageName ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>        
                                        </select>
                                </span>
                            </div>
                        </div>
                    </h4>

                        </div>
                    </div>
<input type="hidden" name="checkStatus" value="<?php echo $stage?>" id="checkStatus">
<input type="hidden" name="bidRandomIDVal" id="bidRandomIDVal" value="<?php  if(!empty($bidInfo)){ echo $bidInfo[0]->bidRandomId; }?>">
<input type="hidden" name="buildingSFValHidden" id="buildingSFValHidden" value="<?php echo $buildingSf; ?>">
            <!-- Customer Data end -->
            <div class="card" id="bidResultArea">
                    <div class="custom-card">
                        <h5 class="card-header"> BID RESULTS </i></h5>
                    </div>
                    <div class="card-body" style="padding: 0;">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="table-responsive" id="render-list-of-order">
                                        <table class="table table-striped table-bordered first" id="bidResult">
                                            <thead>
                                                <!-- <tr>
                                                    <td colspan="2" style="background-color:yellow">Bid Result</td>
                                                    <td></td>
                                                </tr> -->
                                                <tr>
                                                    <td><b>Building SF</b></td>
                                                  
                                                        <?php setlocale(LC_MONETARY, 'en_US');?>
                                                    
                                                        <td><span id="buildingSFVal"><b><?php echo number_format($buildingSf); ?></b></span></td>
                                                    <td>
                                                    </td>
                                                </tr>
                                                <tr>
                                                  <th>Company Name</th>
                                                  <th>Budget Price</th>
                                                  <th>Unit Cost</th>
                                                </tr>
                                            </thead>
                                               <tbody>
                                                    <?php
                                                         if(!empty($bidInfo))
                                                          {
                                                            
                                                    
                                                            $i = 1;
                                                            foreach($bidInfo as $record)
                                                            {
                                                          ?>
                                                        <tr>
                                                          
                                                          <td> <?php echo $record->companyName; ?> </td> 
                                                          <td><?php echo money_format('%.0n', $record->bidPrice);?></td>
                                                          <td><?php echo  ((int)$buildingSf > 0)?number_format((float)$record->bidPrice/(int)$buildingSf, 2, '.', ''):0;?></td>
                                                         </tr>
                                                        <?php
                                                        $i++;
                                                          }
                                                        }
                                                        ?>
                                              </tbody>
                                              <tr style="background-color:orange">
                                                  <th>AMPCO Contracting</th>
                                                  <th><?php if(!empty($bidprice)) { echo $bidprice;}else{ echo "0";} ?></th>
                                                  <th><?php if((int)$buildingSf > 0){ echo  number_format((float)$bid_price/(int)$buildingSf, 2, '.', '');}else{echo "0.0";}?></th>
                                                </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- The Modal -->
                    <div class="modal" id="myModalBid">
                      <div class="modal-dialog">
                        <div class="modal-content">

                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h3 class="modal-title"><strong> Add New Bid </strong></h3>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>

                          <!-- Modal body -->
                          <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-sm-12 form-group">
                                        <label>Company Name:</label>
                                        <input class="form-control" type="text" name="companyName" id="companyName"> 
                                        <span style="color: red; display: none;" id="companyNameError">Please enter name.</span>
                                    </div>

                                    <div class="col-sm-12 form-group">
                                        <label>Budget Price:</label>
                                        <input class="form-control" data-type="currency" type="text" name="bidPricevalue" id="bidPricevalue" required=""> 
                                        <span style="color: red; display: none;" id="bidPriceError">Please enter price.</span>
                                    </div>
                                </div>
                            </div>
                          </div>

                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <a href="javascript:void(0);" onclick="SaveBid();" class="confirm btn btn-sm btn-danger">Save</a>
                            <button type="button" class="btn btn-sm btn-default bg-warning" data-dismiss="modal">Close</button>
                          </div>

                        </div>
                      </div>
                    </div>
                </div>
                </div>
<!-- Private Notes & Comments start -->
     
    <div class="card">
        <div class="custom-card">
            <h5 class="card-header"> Private Notes & Comments </h5>
        </div>
        <div class="card-body">
            <textarea name="comment"  id="comment"><?php //echo $notes;?></textarea>
        </div>
    </div>
         
<!-- Private Notes & Comments start -->

<div class="card editViewLeadClass">
                    <div class="custom-card"><h5 class="card-header"> Notes History</h5></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                   
                                         <div class="row">
              <div class="table-responsive" id="render-list-of-order">                                      
               <!--   <table class="table table-striped table-bordered first" id="noteHistoryTable" cellspacing="0" width="100%"> -->
                    <table class="table table-striped table-bordered first" id="exampleTwo">
                  <thead>
                    <tr>
                      <th>Lead ID</th>
                      <th>Notes</th>
                      <th>Created Time</th>
                    </tr>
                  </thead>
                   <tbody>
                    <?php
                     if(!empty($notes_history))
                      {
                        $i = 1;
                        foreach($notes_history as $record)
                        {
                      ?>
                    <tr>
                      <td> <?php echo  $i ?> </td> 
                      <td> <?php echo $record['notes'] ?> </td> 
                      <td><?php echo  date("h:i:s", strtotime($record['createdDtm']))?></td>
                      <!--<td> //<?php echo $record['name'].' has logged in ' ?> </td> -->
                     </tr>
                    <?php
                    $i++;
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              
          </div>
                                </div>
                            </div>
                        </div>
                </div>

<!-- Data Tags start -->
   
    <div class="card">
        <div class="custom-card">
            <h5 class="card-header"> Data Tag </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 m-t-10">
                    <span class="form-group customTagClass">                                                           
                        <i class="mdi mdi-tag mdi-lg"></i>
                        <select class="form-control required" id="tagId" name="tagId" disabled>
                        <option>Select Tag</option>
                         <?php
                        if(!empty($tags))
                        {
                            foreach ($tags as $rl)
                            {
                                ?>
                                <option value="<?php echo $rl->id ?>" <?php if($rl->id == $tag) {echo "selected=selected";} ?>><?php echo $rl->tagName ?></option>
                                <?php
                            }
                        }
                        ?>     
                    </select>
                    </span>
                </div>
                <div class="col-lg-6">
                    <div class="blue-btn float-right"><a href="#" class="btn btn-rounded bg-blue"> Update </a></div>
                </div>
            </div>
            <p class="p-t-10">*Clicking Update will Trigger Automatic emails based on the tag selected.</p>
        </div>
    </div>
     
<!-- Data Tags start -->


        </div>
        <div class="col-lg-6">

            <!-- Project on Google Map -->
            <?php if($address != "" || $address != NULL){?> 
            <div class="card">
                <div class="custom-card"><h5 class="card-header"> Map </h5></div>
                <div class="card-body">                        
                    <div class="row">
                        <div class="col-md-12">
                            <div id="map" style="width:100%; height:260px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php }?>
            <!-- Project on Google Ma end -->


            <!-- Project Client  start -->
                <div class="card">
                    <div class="custom-card"><h5 class="card-header"> Business </h5></div>  <!-- onclick="AddClientOpenPoup();" -->
                    <div class="card-body">
                        <!-- The Modal -->
                        <div class="modal" id="myModalClients">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h3 class="modal-title"><strong> Business </strong></h3>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                              <!-- Modal body -->
                                <div class="modal-body">
                                    <ul class="nav nav-tabs" id="clientTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="newclient-tab" data-toggle="tab" href="#newclient" role="tab" aria-controls="newclient" aria-selected="true">New Buisness</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="existclient-tab" data-toggle="tab" href="#existclient" role="tab" aria-controls="existclient" aria-selected="false">Existing Buisness</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="newclient" role="tabpanel" aria-labelledby="newclient-tab">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="col-sm-12 form-group">
                                                        <label>Business:</label>
                                                        <input class="form-control" type="text" name="client_name" id="clientName" required=""> 
                                                        <span style="color: red; display: none;" id="clientNameError">Please enter message.</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="col-sm-12 form-group">
                                                        <label>Business Type:</label>
                                                        <input class="form-control" required type="text" value="" id="buisnessType" name="buisness_type">
                                                        <span style="color: red; display: none;" id="buisnessTypeError">Please enter buisness type.</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="col-sm-12 form-group">
                                                        <label>Phone Number:</label>
                                                        <input class="form-control" required type="text" value="" id="contact_buisness_phone" name="contact_buisness_phone">
                                                        <span style="color: red; display: none;" id="conatctBuisnessPhError">please enter valid phone number.</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="col-sm-12 form-group">
                                                        <label>Business Address:</label>
                                                        <input class="form-control" required type="text" value="" id="addressAutocomplete" name="buisnessAddress" onFocus="geolocate()">
                                                        <span style="color: red; display: none;" id="addressError">Please enter address.</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="col-sm-12 form-group">
                                                        <a href="javascript:void(0);" onclick="SaveClient(document.getElementById('clientName').value,0,document.getElementById('buisnessType').value,document.getElementById('contact_buisness_phone').value,document.getElementById('addressAutocomplete').value);" class="confirm btn btn-sm btn-danger">Save</a>
                                                        <button type="button" class="btn btn-sm btn-default bg-warning" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                          <div class="tab-pane fade" id="existclient" role="tabpanel" aria-labelledby="existclient-tab">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label>Existing Business:</label>
                                                    <select class="form-control selectpicker" id="select-existclient" name="existclient" data-live-search="true">
                                                        <option value="0">Select Buisness</option>
                                                        <?php
                                                        if(!empty($clientsInfo))
                                                        {
                                                            foreach ($clientsInfo as $client_info)
                                                            {
                                                                ?>
                                                                <option data-tokens="<?php echo $client_info->id; ?>" value="<?php echo $client_info->id; ?>" data-ph="<?php echo $client_info->phone_no; ?>" data-bt="<?php echo $client_info->buisness_type; ?>" data-address="<?php echo $client_info->address; ?>"><?php echo $client_info->client_name ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <span style="color: red; display: none;" id="ExclientNameError">Please enter message.</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <a href="javascript:void(0);" onclick="sel = document.getElementById('select-existclient'); SaveClient(sel.options[sel.selectedIndex].text,sel.options[sel.selectedIndex].value);" class="confirm btn btn-sm btn-danger">Save</a>
                                                    <button type="button" class="btn btn-sm btn-default bg-warning" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              <!-- Modal footer -->
                              <div class="modal-footer">
                                
                              </div>
                            </div>
                          </div>
                        </div>

                        
                        <div id="clientList" class="ScrollClassDynamic4 m-t-0" style="max-height: 190px; min-height: 190px;">

                            <?php
                            if($clientInfo){
                            foreach($clientInfo as $clientInfoVal){
                                $clientRandomId = "client-".$clientInfoVal->id;
                            ?>

                            <!--<div class="row" id="client-182"><div class="col-lg-4"><p>B1</p></div><div class="col-lg-5"><p>Btype1EditedNow</p></div><div class="col-lg-5"><p>9874554789</p></div><div class="col-lg-5"><p>Fresno, CA, USA</p></div><div class="col-lg-3"><div><a href="javascript:void(0);" class="btn btn-rounded bg-warning btn-xs" onclick="EditClientOpenPoup('client-182','B1','Btype1EditedNow','9874554789','Fresno, CA, USA');"> <i class="fa fa-pencil-alt"></i> </a> <a href="javascript:void(0);" class="btn btn-rounded bg-danger btn-xs" onclick="RemoveClient('client-182');"> <i class="fa fa-trash-alt"></i> </a></div></div></div>-->

                            <div class="row detailsRowBox" id="<?php echo $clientRandomId; ?>">
                               <!--  <a title="Edit" href="javascript:void(0);" class="btn edtiBtndtlRow btn-rounded bg-warning btn-xs" onclick="EditClientOpenPoup('<?php echo $clientRandomId; ?>','<?php echo $clientInfoVal->buisness_type; ?>','<?php echo $clientInfoVal->client_name; ?>','<?php echo $clientInfoVal->phone_no; ?>','<?php echo $clientInfoVal->address; ?>');"> <i class="fa fa-pencil-alt"></i> </a>
                                  <a href="javascript:void(0);" class="btn deleteBtndtlRow btn-rounded bg-danger btn-xs" onclick="RemoveClient('<?php echo $clientInfoVal->id; ?>','<?php echo $clientInfoVal->projectId; ?>','<?php echo $clientRandomId; ?>')"> <i class="fa fa-trash-alt"></i> </a> -->
                                <div class="col-lg-12"> 
                                    <p class="mb-2"><i class="fa fa-user"></i> <?php echo $clientInfoVal->client_name; ?></p>
                                    <p class="mb-2"><i class="fa fa-briefcase"></i> <?php echo $clientInfoVal->buisness_type; ?></p>
                                    <p class="mb-2"><i class="fa fa-phone"></i> <?php echo $clientInfoVal->phone_no; ?></p> 
                                    <p class="mb-0"><i class="fa fa-map-marker"></i> <?php echo $clientInfoVal->address; ?></p> 
                                </div>
                                
                                <div class="col-lg-3">
                                    
                                </div> 
                            </div>
                        <?php  } }?>
                        </div>
                    </div>
                </div>
                <!-- Project Client end -->
                <!-- Project Contacts  start -->
                <div class="card">
                    <div class="custom-card"><h5 class="card-header"> Contacts </h5></div>  <!-- onclick="AddContactOpenPoup();" -->
                    <div class="card-body">
                        <!-- The Modal -->
                        <div class="modal" id="myModalContacts">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <!-- Modal Header -->
                                <div class="modal-header">
                                    <h3 class="modal-title"><strong> Contacts </strong></h3>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                              <!-- Modal body -->
                                <div class="modal-body">
                                    <ul class="nav nav-tabs" id="contactTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="newcontact-tab" data-toggle="tab" href="#newcontact" role="tab" aria-controls="newcontact" aria-selected="true">New Contact</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="existcontact-tab" data-toggle="tab" href="#existcontact" role="tab" aria-controls="existcontact" aria-selected="false">Existing Contact</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="ContactTabContent">
                                        <div class="tab-pane fade show active" id="newcontact" role="tabpanel" aria-labelledby="newcontact-tab">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="col-sm-12 form-group">
                                                        <label>Business:</label>
                                                        <select class="form-control" name="clientId" id="clientId" required=""> 
                                                            <option value="">Select Business</option>
                                                            <?php if($clientInfo){
                                                                foreach($clientInfo as $clientInfoVal){
                                                            ?>
                                                            <option value="<?php echo $clientInfoVal->id; ?>"><?php echo $clientInfoVal->client_name; ?></option>
                                                            <?php } } ?>
                                                        </select>
                                                        <span style="color: red; display: none;" id="contactClientError">Please select company.</span>
                                                    </div>
                                                    <div class="col-sm-12 form-group">
                                                            <label>Assigned To:</label>
                                                            <select class="form-control" id="assignedTo" name="assignedTo" required="">
                                                                <option value="">Select Assigned To</option>
                                                                    <?php
                                                                    if(!empty($userList))
                                                                    {

                                                                        foreach ($userList as $user)
                                                                        {
                                                                            //print_r($user);
                                                                            ?>
                                                                            <option data-tokens="<?php echo $user->userId; ?>" value="<?php echo $user->userId; ?>"><?php echo $user->name ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                            </select>
                                                            <span style="color: red; display: none;" id="assignedToError">Please select user.</span>
                                                        </div>
                                                    <div class="col-sm-12 form-group">
                                                        <label>Address:</label>
                                                        <input class="form-control" type="text" name="client_address" id="contactAddress" readonly=""> 
                                                        <!-- <span style="color: red; display: none;" id="contactAddressError">Please enter Address.</span> -->
                                                    </div>
                                                    <div class="col-sm-12 form-group">
                                                        <label>Name:</label>
                                                        <input class="form-control" type="text" name="contact_name" id="contactName" required=""> 
                                                        <span style="color: red; display: none;" id="contactNameError">Please enter name.</span>
                                                    </div>
                                                    <div class="col-sm-12 form-group">
                                                        <label>Email:</label>
                                                        <input class="form-control" type="email" name="contact_email" id="conatctEmail" required=""> 
                                                        <span style="color: red; display: none;" id="conatctEmailError">Please enter vaild email.</span>
                                                    </div>
                                                    <div class="col-sm-12 form-group">
                                                        <label>Phone #:</label>
                                                        <input class="form-control" type="text" name="contact_phone" id="conatctPh" required=""> 
                                                        <span style="color: red; display: none;" id="conatctPhError">please enter valid phone number.</span>
                                                    </div>
                                                    <div class="col-sm-12 form-group">
                                                        <label>Mobile #:</label>
                                                        <input class="form-control" type="text" name="contact_phone2" id="conatctPh2" required=""> 
                                                        <span style="color: red; display: none;" id="conatctPhError2">please enter valid number.</span>
                                                    </div>
                                                    <div class="col-sm-12 form-group">
                                                        <!-- <label>Company:</label> -->
                                                        <input class="form-control" type="hidden" name="contact_company" id="conatctCompany" required=""> 
                                                        <span style="color: red; display: none;" id="conatctCompanyError">Please enter company name.</span>
                                                    </div>
                                                    <div class="col-sm-12 form-group">
                                                        <label class="custom-control custom-checkbox custom-control-inline">
                                                            <input type="checkbox" value="1" name="primary_contact" id="conatctPrimary" class="custom-control-input "><span class="custom-control-label">Make Primary Contact:</span>
                                                        </label> 
                                                        <!-- <label></label>
                                                        <input class="form-control1" type="checkbox" value="1" name="primary_contact" id="conatctPrimary">  -->
                                                        <span style="color: red; display: none;" id="conatctPrimaryError">Already have primary contact.</span>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="col-sm-12 form-group">
                                                        <a href="javascript:void(0);" onclick="SaveContact(0);" class="confirm btn btn-sm btn-danger">Save</a>
                                                        <button type="button" class="btn btn-sm btn-default bg-warning" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="existcontact" role="tabpanel" aria-labelledby="existcontact-tab">
                                            <div class="col-sm-12 form-group">
                                                <label>Business:</label>
                                                <select class="form-control" name="clientId" id="exClientId" onchange="getClientContact(document.getElementById('exClientId').value)" required=""> 
                                                    <option value="">Select Business</option>
                                                </select>
                                                <span style="color: red; display: none;" id="ExcontactClientError">Please select company.</span>
                                            </div>
                                            <div class="col-sm-12 form-group">
                                                <label>Contact:</label>
                                                <select class="form-control" name="contact_name" id="ExcontactName" required=""> 
                                                    <option value="">Select Contact</option>
                                                </select>
                                                <span style="color: red; display: none;" id="ExcontactNameError">Please select contact.</span>
                                            </div>
                                            <div class="col-sm-12 form-group">
                                                <label>Make Primary Contact:</label>
                                                <input class="form-control1" type="checkbox" value="1" name="ex_primary_contact" id="conatctPrimary"> 
                                                <span style="color: red; display: none;" id="exconatctPrimaryError">Already have primary contact.</span>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="col-sm-12 form-group">
                                                    <a href="javascript:void(0);" onclick="SaveContact(1);" class="confirm btn btn-sm btn-danger">Save</a>
                                                    <button type="button" class="btn btn-sm btn-default bg-warning" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                  <!-- Modal footer -->
                                  <div class="modal-footer"></div>
                            </div>
                          </div>
                        </div>

                        
                        <div id="contactList" class="ScrollClassDynamic4 m-t-0" style="max-height: 190px; min-height: 190px;">

                            <?php
                            if($contacInfo){
                            foreach($contacInfo as $contactInfoVal){
                            ?>
                            <div class="row detailsRowBox" id="<?php echo $contactInfoVal->contactRandomId; ?>">
                                <!-- <a title="Edit" href="javascript:void(0);" class="btn edtiBtndtlRow btn-rounded bg-warning btn-xs" onclick="EditContactOpenPoup('<?php echo $contactInfoVal->contactRandomId; ?>','<?php echo $contactInfoVal->clientId; ?>','<?php echo $contactInfoVal->assigned_to; ?>','<?php echo $contactInfoVal->contact_name; ?>','<?php echo $contactInfoVal->address; ?>','<?php echo $contactInfoVal->contact_email; ?>','<?php echo $contactInfoVal->contact_phone; ?>','<?php echo $contactInfoVal->contact_phone2; ?>','<?php echo $contactInfoVal->contact_company; ?>','<?php echo $contactInfoVal->is_primary; ?>');"> <i class="fa fa-pencil-alt"></i> </a>
                                  <a href="javascript:void(0);" class="btn deleteBtndtlRow btn-rounded bg-danger btn-xs" onclick="RemoveContact('<?php echo $contactInfoVal->contactRandomId; ?>')"> <i class="fa fa-trash-alt"></i> </a> -->
                                <div class="col-lg-12 mb-2">
                                <?php if($contactInfoVal->client_name != ""){?>
                                     <p><i class="fa fa-briefcase"></i> <?php echo $contactInfoVal->client_name; ?></p> 
                                <?php }?>
                                </div>
                                <div class="col-lg-12 mb-2"> <p><i class="fa fa-user"></i> <?php echo $contactInfoVal->contact_name; ?></p> </div>
                                <div class="col-lg-12 mb-2"> 
                                    <p class="mb-0"><i class="fa fa-envelope"></i> <?php echo $contactInfoVal->contact_email; ?></p>  
                                </div>
                                <div class="col-lg-12 mb-0"> 
                                    <p><i class="fa fa-phone"></i> <?php echo $contactInfoVal->contact_phone; ?>, <?php echo $contactInfoVal->contact_phone2; ?></p> 
                                </div>
                                
                                <!-- <div class="col-lg-2"> <p><?php echo $contactInfoVal->contact_company; ?></p> </div> -->
                                
                            </div>
                        <?php  } }?>
                        </div>
                    </div>
                </div>
                <!-- Project Contacts end -->
                


        <!-- Option-In start -->
                <div class="card">
                    <div class="custom-card">
                        <h5 class="card-header"> Communication </h5>
                    </div>
                    <div class="card-body">
                        <div class="row m-t-10 m-b-10">                      
                            
                                <?php 
                               if(!empty($optionData) &&  $optionData[0]['sms']!=''){?>
                                <div class="col-lg-4" >
                                    <label class="custom-control custom-checkbox custom-control-inline" style="display: none;">
                                        <input type="checkbox" name="optionIn[0]" value="sms" checked="checked" class="custom-control-input sms" disabled><span class="custom-control-label" >SMS</span>
                                    </label>
                                    <div class="blue-btn " id="chksms"><a href="javascript:void(0)" class="btn btn-rounded bg-info" style="width: 100%;"> Text </a></div>
                               </div>
                               <?php }else{?>
                                <div class="col-lg-4" style="display: none;">
                                    <label class="custom-control custom-checkbox custom-control-inline" >
                                        <input type="checkbox" name="optionIn[0]"  value="sms" class="custom-control-input sms" disabled><span class="custom-control-label">SMS</span>
                                    </label>
                                    <div class="blue-btn disabledbutton" id="chksms"><a href="javascript:void(0)" class="btn btn-rounded bg-info" style="width: 100%;"> Text </a></div>
                               </div>

                               <div class="col-lg-4">
                                   <div class="blue-btn " id="chksms"><a href="javascript:void(0)" class="btn btn-rounded bg-info" style="width: 100%;"> Text </a></div>
                               </div>

                               <?php }
                               if(!empty($optionData) &&  $optionData[0]['calls']!=''){?>
                                <div class="col-lg-4" >
                                <label class="custom-control custom-checkbox custom-control-inline" style="display: none;">
                                    <input type="checkbox" value="call" checked="checked" name="optionIn[1]" class="custom-control-input call" disabled><span class="custom-control-label">Call</span>
                                </label> 
                                <div class="blue-btn" id="chkcall">
                                    <a href="javascript:void(0)" class="btn btn-rounded bg-info <?php if(isset($phonecallEnable) && !empty($phonecallEnable)) { echo ""; } else { echo "disabledbuttoncall"; } ?>" style="width: 100%;"> Call </a>
                                </div>
                                </div>                              
                               <?php }else{?>
                                <div class="col-lg-4" style="display: none;">
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox"  value="call" name="optionIn[1]" class="custom-control-input call" disabled><span class="custom-control-label">Call</span>
                                    </label> 
                                    <div class="blue-btn disabledbuttoncall" id="chkcall"><a href="#" class="btn btn-rounded bg-info" style="width: 100%;"> Call </a></div>
                                </div>  

                                <div class="col-lg-4">
                                    <div class="blue-btn" id="chkcall">
                                        <a href="javascript:void(0)"  class="btn btn-rounded bg-info <?php if(isset($phonecallEnable) && !empty($phonecallEnable)) { echo ""; } else { echo "disabledbuttoncall"; } ?>" style="width: 100%;"> Call </a>
                                    </div>
                               </div>
                               <?php }
                               if(!empty($optionData) &&  $optionData[0]['email']!=''){?>
                                <div class="col-lg-4" >
                                <label class="custom-control custom-checkbox custom-control-inline" style="display: none;">
                                    <input type="checkbox" value="email" name="optionIn[2]" checked="checked" class="custom-control-input emails" disabled><span class="custom-control-label">Email</span>
                                </label>  
                                <div class="blue-btn " id="chkemail"><a href="javascript:void(0)"  class="btn btn-rounded bg-info" style="width: 100%;"> Email </a></div> 
                                </div>                            
                               <?php } else{?>
                                <div class="col-lg-4" style="display: none;">
                                    <label class="custom-control custom-checkbox custom-control-inline" >
                                        <input type="checkbox"  value="email" name="optionIn[2]" class="custom-control-input emails" disabled><span class="custom-control-label">Email</span>
                                    </label>
                                    <div class="blue-btn disabledbuttonemail" id="chkemail"><a href="#"  class="btn btn-rounded bg-info" style="width: 100%;"> Email </a></div>    
                                </div> 

                                <div class="col-lg-4">
                                    <div class="blue-btn " id="chkemail"><a href="#"  class="btn btn-rounded bg-info" style="width: 100%;"> Email </a></div> 
                                </div>

                               <?php }?>
                              
                                <div class="col-lg-4" style="display: none;">
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <?php if(!empty($optionData) &&  $optionData[0]['other']!=''){?>
                                            <input checked="checked" type="checkbox" name="optionIn[3]" value="other" id="optionIn" class="custom-control-input other" disabled><span class="custom-control-label">Other</span>
                                        <?php }else{?>
                                            <input type="checkbox" name="optionIn[3]" value="other" id="optionIn" class="custom-control-input other" disabled><span class="custom-control-label">Other</span>
                                        <?php }?>
                                    </label>    
                                </div> 
                            
                        </div>
                        <?php if(!empty($communication)) { ?>
                            <div class="ScrollClassDynamic" style="max-height: 240px; min-height: 240px;">
                            <?php foreach ($communication as $rl) { ?>
                                <div class="row">
                                    <div class="col-sm-12 p-0">
                                        <div class="row">
                                            <div class="col-sm-2 text-left pr-0">
                                            <?php if($rl->type==1 || $rl->type == 3){ ?>
                                                <i class="fas fa-phone fa-lg"></i>
                                            <?php }else if($rl->type==2){ ?>
                                                <i class="fas fa-envelope fa-lg"></i>
                                            <?php } else{ ?>
                                                <i class="fas fa-comments fa-lg"></i>
                                            <?php }  ?>
                                            </div>
                                            <div class="col-sm-4 checkbox-a pl-0">
                                                <?php if($rl->type == 3){ ?>
                                                <a href="javascript:void(0)"><?= $rl->to ?></a>
                                                <?php } else { ?>
                                                <a href="#"><?php echo $rl->froms;?></a>
                                                <?php } ?>
                                            </div>
                                            <div class="col-sm-4 pl-0">
                                                <p><?php echo date("m/d/Y H:i:s", strtotime($rl->createdDtm)) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <?php } ?>
                            </div>
                        <?php }?>
                    </div>
                </div>

            
                <!-- File Server start -->
                <!-- <div class="card fileClass">
                    <div class="custom-card">
                        <h5 class="card-header"> Local File Server </h5>
                    </div>
                    <div class="card-body">
                        <?php if(!empty($fs_id)){?> 
                        <div class="row" style="min-height: 100px;margin-top: 25px;">
                            <div class="col-lg-12 p-0 text-center">
                                <a target="_blank" href="<?php echo base_url()."folderstrct/".$fs_id; ?>" class="btn btn-rounded bg-info">
                                   <i class="fa fa-folder-open-o"></i> &nbsp;&nbsp; Open Project Folder on File Server
                                </a>
                            </div>
                        </div>
                        <?php } ?>       
                    </div>
                    
                </div> -->
                <!-- File Server end -->

                <!-- Files start -->
                <div class="card fileClass">
                    <div class="custom-card">
                        <h5 class="card-header"> Files </h5>
                    </div>
                    <div class="card-body"> 
                                         
                        <div class="row">
                            <div class="row" style="min-height: 180px;">
                             <?php
                        if(!empty($files))
                        {
                            foreach ($files as $rl)
                            { ?>  
                             <div class="col-lg-6 p-0">
                               <div class="filesNameBox">
                                     <p>
                                        <a target="_blank" href="javascript:void(0)"><img src="<?php echo base_url(); ?>assets/uploads/files/<?php echo $rl->name;?>"></a>
                                        <a href="javascript:void(0);"  class="dltClose-icon"> <i class="fa fa-times-circle filedelete-icon"></i> </a>
                                    </p>
                               </div>
                            </div>                            
                               <?php }
                        }
                        ?>  

                                <div class="col-lg-12 fileuploadButton">
                                    <div class="col-lg-12 p-0">
                                    <div class="file-chooser btn-info btn-file btnBrowssrBtn">
                                       <i class="fa fa-upload"></i> &nbsp;&nbsp; Upload Support File: &nbsp;<span>Browse </span>
                                       <input class="file-chooser__input" type="file" name="image[]" disabled />
                                    </div>
                                    <div class="ScrollClassDynamic1">
                                        <div class="fileClass file-uploader__message-area">

                                        </div>
                                    </div>
                                    </div>
                                    <br>
                                </div>

                            </div>
                            
                            <!-- <div class="col-lg-12 p-0">
                                <p>Note: you can select multiple file using ctrl button</p>
                            </div> -->
                        </div>
                    </div>
                    
                </div>
                <!-- Files end -->
                
                 <!-- My Tasks / Follow-Up start -->
                <div class="card">
                    <div class="custom-card">
                        <h5 class="card-header"> My Tasks / Follow-Up </h5>
                    </div>
                    <div class="card-body">

                    <!-- The Modal -->
                    <div class="modal" id="myModalTask">
                      <div class="modal-dialog">
                        <div class="modal-content">

                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h3 class="modal-title"><strong> My Tasks / Follow-Up </strong></h3>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>

                          <!-- Modal body -->
                          <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12 p-0">

                                    <div class="col-sm-12 form-group">
                                        <label>Message:</label>
                                        <input class="form-control" type="text" name="taskMsg" id="taskMsg"> 
                                        <span style="color: red; display: none;" id="taskMsgError">Please enter message.</span>
                                    </div>

                                    <div class="col-sm-12 form-group">
                                        <label>Task Date:</label>
                                        <input class="form-control" type="text" name="taskExpDate" id="taskExpDate"> 
                                        <span style="color: red; display: none;" id="taskExpDateError">Please select expiry date.</span>
                                    </div>

                                </div>
                            </div>
                          </div>

                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <a href="javascript:void(0);" onclick="SaveTask();" class="confirm btn btn-sm btn-danger">Save</a>
                            <button type="button" class="btn btn-default bg-warning btn-sm" data-dismiss="modal">Close</button>
                          </div>

                        </div>
                      </div>
                    </div>

                    


                   <div id="tastkList" class="ScrollClassDynamic4 m-t-10" style="max-height: 190px; min-height: 190px;">

                   <?php
                   if($taskInfo){
                    foreach($taskInfo as $taskInfoVal){
                        ?>
                        <div class="row" id="<?php echo $taskInfoVal->taskRandomId; ?>">
                        <div class="col-lg-4">
                            <p><?php echo $taskInfoVal->name; ?></p>
                        </div>
                        <div class="col-lg-4">
                            <p><?php echo  date("m/d/Y", strtotime($taskInfoVal->eventDate)); ?></p>
                        </div>
                        <div class="col-lg-4">
                            
                                <!-- <a title="Edit" href="javascript:void(0);" class="btn btn-rounded bg-warning btn-xs" onclick="EditTaskOpenPoup('<?php echo $taskInfoVal->taskRandomId; ?>','<?php echo $taskInfoVal->name; ?>','<?php echo date("m/d/Y", strtotime($taskInfoVal->eventDate)); ?>');"> <i class="fa fa-pencil-alt"></i> </a> -->
                              <!--  <a title="Delete" href="javascript:void(0);" class="btn btn-rounded bg-danger m-t-b btn-xs" onclick="RemoveTask('<?php echo $taskInfoVal->taskRandomId; ?>');"> <i class="fa fa-trash-alt"></i> </a> -->
                                <?php if($taskInfoVal->taskStatus==1){?>
                                     <label class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" name="task[]" checked="checked" value="<?php echo $taskInfoVal->taskRandomId; ?>" class="custom-control-input" disabled><span class="custom-control-label"></span>
                                </label>
                               <?php  }else{?>
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" name="task[]"  value="<?php echo $taskInfoVal->taskRandomId; ?>" class="custom-control-input" disabled><span class="custom-control-label"></span>
                                </label>
                              <?php   }?>
                          
                        </div> 
                    </div>
                        <?php
                    }
                   }
                   ?>

                   </div>


                     
                    </div>
                </div>
                <!-- My Tasks / Follow-Up end -->

               <!-- Lead Stage - History start -->
                <div class="card">
                    <div class="custom-card">
                        <h5 class="card-header"> Project Stage - History </h5>
                    </div>
                    <div class="card-body">
                        <div class="row ScrollClassDynamic2" style="max-height: 240px; min-height: 240px;">
                        <?php
                        if(!empty($stage_history))
                        {
                            foreach ($stage_history as $rl)
                            { ?>  
                             
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p><?php echo $rl->stageName?></p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p><?php 
                                        $datetime1 = new DateTime();
                                        $datetime2 = new DateTime($rl->createdDtm);
                                        $interval = $datetime1->diff($datetime2);
                                        //print_r($interval);die;
                                       if($interval->h > 24){
                                        echo $interval->format('%D days %H Hours %I Minutes');
                                       }else{
                                        echo $interval->format('%H Hours %I Minutes');
                                       }?></p>
                                    </div> 
                                </div>  

                               <?php }
                        }
                        ?>  
                                                    
                        </div>
                    </div>
                </div>
                <!-- Lead Stage - History end -->
            
        <!-- Option-In end -->
    </div>
  
        <input type="hidden" name="taskCombinedValues" id="taskCombinedValues" value='<?php if($taskInfoJson) { echo json_encode($taskInfoJson); } ?>'>
        <input type="hidden" name="TaskRandomID" id="TaskRandomID">
        <input type="hidden" name="TaskCreateType" id="TaskCreateType">    

        <input type="hidden" name="contactCombinedValues" id="contactCombinedValues" value='<?php if($contactInfoJson) { echo json_encode($contactInfoJson); } ?>'> 
        <input type="hidden" name="contactDelCombinedValues" id="contactDelCombinedValues" value=''>
        
        <input type="hidden" name="bidCombinedValues" id="bidCombinedValues"> 
        <input type="hidden" name="ContactRandomID" id="ContactRandomID">  
        <input type="hidden" name="ContactCreateType" id="ContactCreateType">

        <input type="hidden" id="newClientId">
        <input type="hidden" name="clientCombinedValues" id="clientCombinedValues" value='<?php if($clientInfoJson) { echo json_encode($clientInfoJson); } ?>'>
        <input type="hidden" name="clientDelCombinedValues" id="clientDelCombinedValues" value=''>  
        <input type="hidden" name="ClientRandomID" id="ClientRandomID">  
        <input type="hidden" name="ClientCreateType" id="ClientCreateType">

        <input type="hidden" name="lostnote" id="lostnote">

        <?php
            $is_primary_contact = 0;
            $contact_contactRandomId = "";
            if($contacInfo){
                foreach($contacInfo as $contactInfoVal){
                    if($contactInfoVal->is_primary == 1){
                        $is_primary_contact = 1;
                        $contact_contactRandomId = $contactInfoVal->contactRandomId;
                    }
                }
            }
        ?>

        <input type="hidden" name="is_primary_contact" data-contact="<?php echo $is_primary_contact;?>" id="is_primary_contact" value="<?php echo $contact_contactRandomId; ?>">

        </div>
         <div class="col-sm-12 buttonFooter">
            <div class="col-sm-12 buttonFooterInner">
                <!-- <div class="col-6 m-t-20 m-b-20 bigBtnsDiv">
                    <input type="submit" class="btn btn-rounded bg-info update_form" value="Update"> 
                </div> -->
                <div class="col-6 m-t-20 m-b-20 bigBtnsDiv">
                   <a href="<?php echo base_url(); ?>projectListing" class="btn btn-rounded bg-warning"> Back </a>
                </div>
            </div>
        </div>
        <!-- Filter Criteria Form end -->
    </form>
</div>
</div>

<!--------Lodaer PopUp -------------------->
<div class="modal fade" id="loadMe" tabindex="-1" role="dialog" aria-labelledby="loadMeLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="loader"></div>
                <div class="spinner-border text-info" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
                <div clas="loader-txt">
                    <p class="loader_msg">Please Wait.....</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!---------Mapping Popup---------->
<!-- The Modal -->

<div class="modal" id="sendSmsModal">
      <div class="modal-dialog" id="editsmsloader">
        <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h3 class="modal-title"><strong> Message </strong></h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Modal body -->
              <div class="modal-body">
               
                <div class="row">
                    <div class="col-lg-12">                                                
                        <select class="form-control" id="contac_list" name="contac_list" required="">
                            <option value="">Select Contact</option>
                            <?php
                            if($contacInfo){
                            foreach($contacInfo as $contactInfoVal){
                                if($contactInfoVal->contact_phone != "" || $contactInfoVal->contact_phone != NULL){
                                    if($contactInfoVal->client_name != "" || $contactInfoVal->client_name != NULL){
                                        $optVal = $contactInfoVal->client_name." - ".$contactInfoVal->contact_name;
                                    }else{
                                        $optVal = $contactInfoVal->contact_name;
                                    }
                            ?>
                            <option value="<?php echo $contactInfoVal->contact_phone; ?>"><?php echo $optVal; ?></option>
                        <?php } } } ?>
                        </select>
                        <span style="color: red; display: none;" id="contactListError">Please select contact.</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">                                                
                        <textarea class="form-control" id="sms" rows="4" name="sms" required=""></textarea>
                        <span style="color: red; display: none;" id="smsError">Please enter message.</span>
                    </div>
                </div>
              </div>
            <?php 
                $ci = get_instance(); // CI_Loader instance
                $ci->load->config('twilio');
                $sms_sender = $ci->config->item('number');
            ?>
          <!-- Modal footer -->
          <div class="modal-footer">
            <input type="hidden" name="sms_sender" class="sms_sender" value="<?php echo $sms_sender; ?>">
            <a href="javascript:void(0);" onclick="sendSms();" class="confirm btn btn-sm btn-danger">Send</a>
            <button type="button" class="btn bg-warning btn-sm" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
</div>

<!-- The email Modal -->
<div class="modal" id="sendmailModal">
      <div class="modal-dialog" id="loader">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h3 class="modal-title"><strong> Email </strong></h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- Modal body -->
           <div class="modal-body p-0">
            <div class="row">
                <div class="col-lg-12">                                                
                    <select class="form-control" id="contact_list_email" name="contact_list_email" required="">
                        <option value="">Select Contact</option>
                        <?php
                        if($contacInfo){
                        foreach($contacInfo as $contactInfoVal){
                            if($contactInfoVal->contact_email != "" || $contactInfoVal->contact_email != NULL){
                                if($contactInfoVal->client_name != "" || $contactInfoVal->client_name != NULL){
                                    $optVal = $contactInfoVal->client_name." - ".$contactInfoVal->contact_name;
                                }else{
                                    $optVal = $contactInfoVal->contact_name;
                                }
                        ?>
                        <option value="<?php echo $contactInfoVal->contact_email; ?>"><?php echo $optVal; ?></option>
                    <?php } } } ?>
                    </select>
                    <span style="color: red; display: none;" id="contactListEmailError">Please select contact.</span>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">                        
                    <select name="emailTemplates" id="emailTemplates" class="form-control valid" onchange="getEmailText(this.value);">
                        <option value="">Select Template</option>
                        <?php if($emailTemplates) {
                            foreach($emailTemplates as $emailTemplatesVal){
                            ?>
                             <option value="<?php echo $emailTemplatesVal->body; ?>"><?php echo $emailTemplatesVal->subject; ?></option>
                            <?php
                            }
                        } ?>
                    </select>
                    <br />
                </div>
            </div>
          </div>
              
          <div class="modal-body">
            <div class="row">
                <div class="col-lg-12 p-0">                        
                    <textarea  id="mail" name="mail"></textarea>
                </div>
            </div>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
            <a href="javascript:void(0);" onclick="sendMessages();" class="confirm btn btn-sm btn-danger">Send</a>
            <button type="button" class="btn bg-warning btn-sm" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
</div>


<!-- The call Modal -->
<div class="modal" id="sendcallModal">
      <div class="modal-dialog" id="loader">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h3 class="modal-title"><strong> Call </strong></h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- Modal body -->
           <div class="modal-body p-0">
            <div class="row">
                <div class="col-lg-12">                                                
                    <select class="form-control" id="contact_list_call" name="contact_list_call" required="">
                        <option value="">Select Contact</option>
                        <?php
                        if($contacInfo){
                        foreach($contacInfo as $contactInfoVal){
                            if($contactInfoVal->contact_phone != "" || $contactInfoVal->contact_phone != NULL){
                                if($contactInfoVal->client_name != "" || $contactInfoVal->client_name != NULL){
                                    $optVal = $contactInfoVal->client_name." - ".$contactInfoVal->contact_name;
                                }else{
                                    $optVal = $contactInfoVal->contact_name;
                                }
                        ?>
                        <option value="<?php echo $contactInfoVal->contact_phone; ?>"><?php echo $optVal; ?></option>
                    <?php } } } ?>
                    </select>
                    <span style="color: red; display: none;" id="contactListCallError">Please select contact.</span>
                </div>
            </div>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
            <a href="javascript:void(0);" onclick="sendCalls('<?php echo $projectId; ?>');" class="confirm btn btn-sm btn-danger">Call</a>
            <button type="button" class="btn bg-warning btn-sm" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
</div>

<!-- call Modal -->
<div class="modal fade" id="callModal" tabindex="-1" role="dialog" aria-labelledby="callModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <button type="button" class="close callingModalClose" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      <div class="modal-body text-center callingModal">
        <h3 class="call_number"></h3>
        <p>Using your phone browser plugin, Click on the above.</p>
        <div class="col-sm-12 callingphone">
            <i class="fa fa-phone"></i>
            <img src="<?php echo base_url(); ?>assets/images/phoneloader.svg">
        </div>
      </div>
     <!-- <div class="modal-footer callingModalFooter">
        <button type="button" class="btn btn-default bg-warning btn-sm" data-dismiss="modal">Close</button>
      </div> -->
    </div>
  </div>
</div>


<!-- Communication Details -->
<div class="modal fade" id="ComDetailsModal" tabindex="-1" role="dialog" aria-labelledby="ComDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title"><strong> <span id="ComDetailsTitle"></span> Details</strong></h3>
                <button type="button" class="close" data-dismiss="modal">×</button>
              </div>

        <div class="modal-body text-center">
        <div class="col-sm-12" id="ComDetailsID">
           <img src="<?php echo base_url(); ?>assets/images/loader.svg">
        </div>
      </div>
    </div>
  </div>
</div>


<!-- View on Map -->
<div class="modal fade" id="viewMapModal" tabindex="-1" role="dialog" aria-labelledby="viewMapModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">

        <div class="modal-header" style="border:0;">
           <!-- <h3 class="modal-title"><strong> <span id="ComDetailsTitle"></span> Details</strong></h3>-->
            <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
         <div class="modal-body text-center p-t-0">
          <div id="map1" style="width:100%; height:400px;"></div>
      </div>
    </div>
  </div>
</div>


<!-- Lost Notes Popup -->
<div class="modal" id="lostNoteModal">
    <div class="modal-dialog" id="editsmsloader1">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="modal-title"><strong> Why was the project Lost? </strong></h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">                                                
                        <textarea class="form-control" id="lost_note" rows="4" name="lost_note" required=""></textarea>
                        <span style="color: red; display: none;" id="smsError">Please enter message.</span>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <a href="javascript:void(0);" id="lostbtn" onclick="saveLostNotes();" style="display: none;" class="confirm btn btn-sm btn-danger">Save</a>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo base_url(); ?>assets/js/editLead.js" type="text/javascript"></script>
<script src="//cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/select2/css/select2.css">
<script src="<?php echo base_url(); ?>assets/vendor/select2/js/select2.min.js"></script>

<script>
    $(document).ready(function(){
        // Initialize select2
        $("#select-sales").select2();
        $("#admin").select2();
        //$("#estimator").select2();
        $("#estimator_email").select2();

        $("#select-existclient").select2();
        $("#exClientId").select2();
        $("#clientId").select2();
        $("#ExcontactName").select2();
        
    });
</script>

<script>
    $(document).ready(function(){
        if($('#checkStatus').val() ==10 || $('#checkStatus').val() ==12){
            $('#bidResultArea').show();
        }else{
            $('#bidResultArea').hide();
        }
        $('select#stage').on('change', function (e) {
            var optionSelected = $("option:selected", this);
            var valueSelected = this.value;
            if(valueSelected == 10 || valueSelected == 12){
                $('#bidResultArea').show();
            }else{
                $('#bidResultArea').hide();
            }
        });

        $("#lost_note").keyup(function(){
            var lost_text = $("#lost_note").val();
            if(lost_text.length>0){
                $("#lostbtn").show();
            }else{
                $("#lostbtn").hide();
                $("#lostnote").val(""); 
            }
        });

    });

    function saveLostNotes(){
        var lost_text = $("#lost_note").val();
        $("#lostnote").val(lost_text); 
        $('#lostNoteModal').modal('hide');
    }
</script>

<script>
 CKEDITOR.replace( 'comment' );
 CKEDITOR.replace('mail');
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $(".update_form").click(function(){
            if( $('#editProject').valid() ) {
                $("#loadMe").modal({
                    backdrop: "static", //remove ability to close modal with click
                    keyboard: false, //remove option to close with keyboard
                    show: true //Display loader!
                });
            }
        });
    });
</script>

<script>    
    $(document).ready(function(){
        //$("#policy").datepicker();
        $('#policy').datepicker({  
            minDate:new Date()
        });
       
        $("#add").click(function () {
            $("#lblName").replaceWith('<span class="col-lg-6"><input required name = "address" class="address form-control" type="text" value = '+$("#lblName").html()+'</span>');
            $("#add").remove();
        });
        $("#jobnum").click(function () {
            var jobnumVal = $('input[name="filesystem_id"]').val();
            $("#jod_num").replaceWith('<span class="col-lg-6"><input required class="form-control jobnum" type="text" value="'+jobnumVal+'" id="filesystem_id" name="filesystem_id"></span>');
            $("#pname").remove();
        });
        $("#pname").click(function () {
            var pnameVal = $('input[name="projectName"]').val();
            $("#project_name").replaceWith('<span class="col-lg-6"><input required class="form-control pname" type="text" value="'+pnameVal+'" id="projectName" name="projectName"></span>');
            $("#pname").remove();
        });       
        $("#wages").click(function () {
            var wagesVal = $('input[name="wages"]').val();
            $("#wages_info").replaceWith('<span class="col-lg-6"><input name = "wages" class="wages form-control" type="text" value = "'+wagesVal+'"></span>');
            $("#wages").remove();
        });
        /*
        $("#sales").click(function () {
            var salesVal = $('input[name="sales"]').val();
            $("#sales_info").replaceWith('<span class="col-lg-6"><input name = "sales" class="sales form-control" type="text" value = "'+salesVal+'"></span>');
            $("#sales").remove();
        });
        $("#admin").click(function () {
            var adminVal = $('input[name="admin"]').val();
            $("#admin_info").replaceWith('<span class="col-lg-6"><input name = "admin" class="admin form-control" type="text" value = "'+adminVal+'"></span>');
            $("#admin").remove();
        });
        $("#estimator").click(function () {
            var estimatorVal = $('input[name="estimator"]').val();
            $("#estimator_info").replaceWith('<span class="col-lg-6"><input name = "estimator" class="estimator form-control" type="text" value = "'+estimatorVal+'"></span>');
            $("#estimator").remove();
        });
        $("#estimator_email").click(function () {
            var estimator_emailVal = $('input[name="estimator_email"]').val();
            $("#estimator_email_info").replaceWith('<span class="col-lg-6"><input name = "estimator_email" class="estimator_email form-control" type="text" value = "'+estimator_emailVal+'"></span>');
            $("#estimator").remove();
        });
        */

        $("#bidprice").click(function () {
            var bid_price = $('input[name="bid_price"]').val();
            $("#bidPrice").replaceWith('<span class="col-lg-6"><input class="form-control bidprice" data-type="currency" type="text" value="'+bid_price+'" id="bid_price" name="bid_price"></span>');
            $("#bidprice").remove();
        });  

        $("#client_name").click(function () {
            var clientnameVal = $('input[name="client_name"]').val();
            $("#client_name_info").replaceWith('<span class="col-lg-6"><input name = "client_name" class="client_name form-control" type="text" value = "'+clientnameVal+'"></span>');
            $("#client_name").remove();
        });   

        $("#dueDateEdit").click(function () {           
            var dueDateEditVal = $('input[name="due_date"]').val();
            $("#due_date_info").replaceWith('<span class="col-lg-6"><input required name = "due_date" id="duedatecal" class="dobEdit form-control" type="text" value = "'+dueDateEditVal+'"></span>');           
            $('#duedatecal').datepicker({  
                 minDate:new Date()
            });
            $("#dueDateEdit").remove();
        });     

         
        $("#dueTimeEdit").click(function () {
            var duetimeVal = $('input[name="due_time"]').val();
            $("#due_time_info").replaceWith('<span class="col-lg-6"><input required name = "due_time" class="due_time form-control" type="text" id="dueTimePicker"  value = "'+duetimeVal+'"></span>');
             $( "#dueTimePicker").timepicker();            
            $("#dueTimeEdit").remove();
        });
        $("#job_walk_time").click(function () {
            var jobwalktimeVal = $('input[name="job_walk_time"]').val();
            $("#job_walk_time_info").replaceWith('<span class="col-lg-6"><input readonly id="jobwt" name ="job_walk_time" class="job_walk_time form-control" type="text" value = "'+jobwalktimeVal+'"></span>');
            $('#jobwt').datepicker();
            // $('#jobwt').datepicker({  
            //      maxDate:new Date('<?php echo $createdDtm; ?>')
            // });
            $("#job_walk_time").remove();
        });
        $("#estStartDateEdit").click(function () {           
            var eststartdateVal = $('input[name="est_start_date"]').val();
            $("#est_start_date_info").replaceWith('<span class="col-lg-6"><input required name = "est_start_date" id="estdatecal" class="estStartDateEdit form-control" type="text" value = "'+eststartdateVal+'"></span>');           
            $('#estdatecal').datepicker({  
                 minDate:new Date()
            });
            $("#estStartDateEdit").remove();
        });  

        $("#rfiDeadlineEdit").click(function () {           
            var rfideadlineVal = $('input[name="rfi_deadline"]').val();
            $("#rfi_deadline_info").replaceWith('<span class="col-lg-6"><input required name = "est_start_date" id="rfideadlinecal" class="rfiDeadlineEdit form-control" type="text" value = "'+rfideadlineVal+'"></span>');           
            $('#rfideadlinecal').datepicker({  
                 minDate:new Date()
            });
            $("#rfiDeadlineEdit").remove();
        });  
        
        $("#main_contact").click(function () {
            var maincontactVal = $('input[name="main_contact"]').val();
            $("#main_contact_info").replaceWith('<span class="col-lg-6"><input name = "main_contact" class="main_contact form-control" type="text" value = "'+maincontactVal+'"></span>');
            $("#main_contact").remove();
        });

        $("#fname").click(function () {
            var fnameVal = $('input[name="fname"]').val();
            $("#first_name").replaceWith('<span class="col-lg-6"><input name = "fname" class="fname form-control" type="text" value = "'+fnameVal+'"></span>');
            $("#fname").remove();
        });
        $("#lname").click(function () {
            var lnameVal = $('input[name="lname"]').val();
            $("#last_name").replaceWith('<span class="col-lg-6"><input name = "lname" class="lname form-control" type="text" value = "'+lnameVal+'"></span>');
            $("#lname").remove();
        });

        $("#dlEdit").click(function () {
             var dlEditVal = $('input[name="dl"]').val();
            $("#dl").replaceWith('<span class="col-lg-6"><input name = "dl" class="dlEdit form-control" type="text" value = "'+dlEditVal+'"></span>');
            $("#dlEdit").remove();
        });
        $("#dobEdit").click(function () {
            var dobEditVal = $('input[name="dob"]').val();
            $("#dob").replaceWith('<span class="col-lg-6"><input name = "dob" id="dobcal" class="dobEdit form-control" type="text" value = "'+dobEditVal+'"></span>');
            //$( "#dobcal" ).datepicker();
            $('#dobcal').datepicker({  
                 minDate:new Date()
            });
            $("#dobEdit").remove();
        });
        $("#emailEdit").click(function () {
            var emailEditVal = $('input[name="email"]').val();
            $("#email_add").replaceWith('<span class="col-lg-6"><input name = "email"  class="emailEdit form-control" type="text" value = "'+emailEditVal+'"></span>');
            $("#emailEdit").remove();
        });
        $("#phone1Edit").click(function () {
            var phone1EditVal = $('input[name="phone1"]').val();
            $("#phone1").replaceWith('<span class="col-lg-6"><input name = "phone1" class="phone1Edit form-control" type="text" value = "'+phone1EditVal+'"></span>');
            $("#phone1Edit").remove();
        });
        $("#phone2Edit").click(function () {
            var phone2EditVal = $('input[name="phone2"]').val();
            $("#phone2").replaceWith('<span class="col-lg-6"><input name = "phone2" class="phone2Edit form-control" type="text" value = "'+phone2EditVal+'"></span>');
            $("#phone2Edit").remove();
        });


        $("#administrative_area_level_2").click(function () {
            var administrative_area_level_2Val = $('input[name="countryId"]').val();
            $("#countryId").replaceWith('<span class="col-lg-6"><input name = "countryId" class="administrative_area_level_2 form-control" type="text" value = "'+administrative_area_level_2Val+'"></span>');
            $("#administrative_area_level_2").remove();
        });
        
        $("#ref").click(function () {
           $(".address").remove();
        });

    });
    
</script>

<script>
    $(document).ready(function(){
        //Change number in USD Currency
        $("input[data-type='currency']").on({
            keyup: function() { 
              formatCurrency($(this));
            },
            blur: function() { 
              formatCurrency($(this), "blur");
            }
        });
    });
    function formatNumber(n) {
      // format number 1000000 to 1,234,567
      return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    }

    function formatCurrency(input, blur) {
      // appends $ to value, validates decimal side
      // and puts cursor back in right position.
      
      // get input value
      var input_val = input.val();
      
      // don't validate empty input
      if (input_val === "") { return; }
      
      // original length
      var original_len = input_val.length;

      // initial caret position 
      var caret_pos = input.prop("selectionStart");
        
      // check for decimal
      if (input_val.indexOf(".") >= 0) {

        // get position of first decimal
        // this prevents multiple decimals from
        // being entered
        var decimal_pos = input_val.indexOf(".");

        // split number by decimal point
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);

        // add commas to left side of number
        left_side = formatNumber(left_side);

        // validate right side
        right_side = formatNumber(right_side);
        
        // On blur make sure 2 numbers after decimal
        if (blur === "blur") {
          right_side += "00";
        }
        
        // Limit decimal to only 2 digits
        right_side = right_side.substring(0, 2);

        // join number by .
        input_val = left_side + "." + right_side;

      } else {
        // no decimal entered
        // add commas to number
        // remove all non-digits
        input_val = formatNumber(input_val);
        input_val = input_val;
        
        // final formatting
        if (blur === "blur") {
          input_val = "$"+input_val;
        }
      }
      
      // send updated string to input
      input.val(input_val);

      // put caret back in the right position
      var updated_len = input_val.length;
      caret_pos = updated_len - original_len + caret_pos;
      input[0].setSelectionRange(caret_pos, caret_pos);
    }
</script>



<script type="text/javascript">

    $('.sms').click(function() {
        if($(this).is(':checked')){
            //$("#chksms").removeClass("disabledbutton");
        }
        else{
            //$("#chksms").addClass("disabledbutton");
        }
    });
    
    $('.call').click(function() {
        if($(this).is(':checked')){
            //$("#chkcall").removeClass("disabledbuttoncall");
        }
        else{
            //$("#chkcall").addClass("disabledbuttoncall");
        }
    });

    $('.emails').click(function() {
        if($(this).is(':checked')){
            //$("#chkemail").removeClass("disabledbuttonemail");
        }
        else{
            //$("#chkemail").addClass("disabledbuttonemail");
        }
    });
     //Task expiry date
     $('#taskExpDate').datepicker({  
         minDate:new Date(),
         beforeShow: function (input, inst) {
            var rect = input.getBoundingClientRect();
            setTimeout(function () {
            //Set your datepicker possition
                inst.dpDiv.css({ top: rect.top + 40, left: rect.left + 0 });
            }, 0);
        }            
      });
     $("#policyExp").datepicker();
</script>

<!-- Add/edit task -->
<script>

function addCommData(mobile){

    $.ajax({
        type : "POST",
        dataType : "json",
        url : "<?php echo base_url(); ?>project/addCallData",
        data : { mobile : mobile,projectId: '<?php echo $projectId;?>' },
        success : function(response){

            if (response.status == 200) {
                var html = '<div class="row"><div class="col-sm-2 text-left pr-0"><i class="fas fa-phone fa-lg"></i></div><div class="col-sm-4 checkbox-a pl-0"><a href="javascript:void(0)">'+response.to+'</a></div><div class="col-sm-4 pl-0"><p>'+ response.createdDtm +'</p></div></div>';

                $('.ScrollClassDynamic').append(html);
                $('#notAvail').empty();
            }

        } 
    });

}

function AddBidOpenPoup(){
    var a=$("#building_sf").val();
    a=a.replace(/\,/g,''); // 1125, but a string, so convert it to number
    a=parseInt(a,10);

    if(!isNaN(a) && a !="" && a !="" && a > 0){
        $('#myModalBid').modal('show'); 
        //Assign fields values
        $("#companyName").val('');
        $("#bidPricevalue").val('');
        //Hide error msg
        $("#bidMsgError").hide();
        $("#companyNameError").hide();   
    }else{
        alert("Building SF must be grater then 0");
    }
}

function AddTaskOpenPoup(){
    $('#myModalTask').modal('show'); 
    //Assign fields values
    $("#taskMsg").val('');
    $("#taskExpDate").val('');
    //Hide error msg
    $("#taskMsgError").hide();
    $("#taskExpDateError").hide();   
    $("#TaskCreateType").val('1');
}

function AddContactOpenPoup(){ 

    var client_info = $("#clientCombinedValues").val();

    if(client_info.length != 0){
        var myJsonObject = JSON.parse(client_info); 
        $('#exClientId').empty();
        $('#clientId').empty();

        $('#clientId').append('<option value="">Select Business</option>');
        $('#exClientId').append('<option value="">Select Business</option>');
        $.each( myJsonObject, function( key, value ) {
            //console.log(value.clientName+"_"+value.clientRandomId);
            var res = value.clientRandomId.split("-");
            $('#exClientId').append('<option data-tokens="'+res[1]+'" value="'+res[1]+'">'+value.clientName+'</option>');
            $('#clientId').append('<option data-tokens="'+res[1]+'" value="'+res[1]+'">'+value.clientName+'</option>');
        });
    }

   
    $("#contactTab").show();
    $('#myModalContacts').modal('show'); 
    //Assign fields values
    //$('#cliendId').get(0).selectedIndex = "";
    $('select#clientId option').removeAttr("selected");
    $("#contactName").val('');
    $("#conatctEmail").val('');
    $("#conatctPh").val('');
    $("#conatctPh2").val('');
    $("#conatctCompany").val('');
    $("#contactAddress").val('');
    $("#conatctPrimary").prop("checked", false );
    
    //Hide error msg
    $("#contactClientError").hide();
    $("#contactNameError").hide();
    $("#contactAddressError").hide();
    $("#conatctEmailError").hide(); 
    $("#conatctPhError").hide();
    $("#conatctPhError2").hide();
    $("#conatctCompanyError").hide();   
    $("#ContactCreateType").val('1');
    $("#conatctPrimaryError").hide();

    $("#ExcontactClientError").hide();
    $("#ExcontactNameError").hide();
    
}

function AddClientOpenPoup(){ 
    $("#clientTab").show();
    $('#myModalClients').modal('show'); 
    $("#ClientRandomID").val("");
    //Assign fields values
    $("#clientName").val('');
    $("#addressAutocomplete").val('');
    $("#buisnessType").val('');
    $("#contact_buisness_phone").val('');
    //Hide error msg
    $("#clientNameError").hide();  
    $("#ExclientNameError").hide();
    $("#conatctBuisnessPhError").hide(); 
    $("#addressError").hide(); 
    $("#buisnessTypeError").hide();
    $("#ClientCreateType").val('1');
}

function SaveTask(){
    var taskMsg      = $("#taskMsg").val();
    var taskExpDate  = $("#taskExpDate").val();
    //It will hold value during edit task 
    var TaskRandomID = $("#TaskRandomID").val();
    
    //Apply Validation
    if(taskMsg==''){
        $("#taskMsgError").show();
    }else if(taskExpDate==''){
        $("#taskExpDateError").show();
    }else{

        //Get random number for use show hide div
        //if(TaskRandomID == ''){
        var TaskCreateType  = $("#TaskCreateType").val();
        if(TaskCreateType==1){
             var randomNum = "task-"+Math.floor((Math.random() * 100000) + 1);
        }else{
             var randomNum = TaskRandomID;
        }       

        //Push data in array    
        var taskCombinedValues    = $("#taskCombinedValues").val();
        //console.log(taskCombinedValues);
        //alert(taskCombinedValues.length);
        if(taskCombinedValues.length==0){
            //Push data
            var taskArr = [];
            taskArr.push({
                taskRandomID: randomNum, 
                taskMsg     : taskMsg, 
                taskExpDate : taskExpDate
            });
            taskArr.join();           

            //console.log(taskArr);
            //convert into string
            var taskArrString = JSON.stringify(taskArr);
            $("#taskCombinedValues").val(taskArrString);
        }else{
            //Check edi
            if(TaskRandomID == ''){
            }else{
                var taskCombinedValues  = $("#taskCombinedValues").val();
                //change to obj
                var myJsonObject = JSON.parse(taskCombinedValues); 

                var result = $.grep(myJsonObject, function(e){ 
                     //return e.taskMsg == taskMsgValue;   // Need if exact
                     return e.taskRandomID != randomNum; 
                });
                //console.log(result);    

                //make array
                result.join();    

                //array to string
                var result = JSON.stringify(result);
                $("#taskCombinedValues").val(result);
                //Hide task html div 
                //var TaskCreateType  = $("#TaskCreateType").val();
                if(TaskCreateType==2){
                    $("#"+randomNum).hide();
                    $('#'+randomNum).removeAttr('id', '');
                }
            } 
            
            //Get again  
            var taskCombinedValues  = $("#taskCombinedValues").val();
            //change to obj
            var myJsonObject = JSON.parse(taskCombinedValues); 

            //Push data
            myJsonObject.push({
                taskRandomID    : randomNum, 
                taskMsg         : taskMsg, 
                taskExpDate     : taskExpDate
            });
            //make array
            myJsonObject.join();    

            //array to string
            var taskArrString = JSON.stringify(myJsonObject);
            $("#taskCombinedValues").val(taskArrString);
            //console.log(myJsonObject);
        }
        //console.log(taskArr);

        //alert(taskSubject+" - "+taskExpDate);

        //Close po up
        $('#myModalTask').modal('toggle');
        //alert('test');
        var str='';
        str+='<div class="row" id="'+randomNum+'">';
        str+='<div class="col-lg-4">';
        str+='<p>'+taskMsg+'</p>';
        str+='</div>';
        str+='<div class="col-lg-4">';
        str+='<p>'+taskExpDate+'</p>';
        str+='</div>';
        str+='<div class="col-lg-4">';
        str+='<div><a title="Edit" href="javascript:void(0);" class="btn btn-rounded bg-warning btn-xs" onclick="EditTaskOpenPoup(\''+randomNum+'\',\''+taskMsg+'\',\''+taskExpDate+'\');"> <i class="fa fa-pencil-alt"></i> </a> '; 
        str+='<label class="custom-control custom-checkbox custom-control-inline"><input type="checkbox" name="task[]" value="\''+randomNum+'\'" class="custom-control-input"><span class="custom-control-label"></span></label></div>';
        str+='</div>';
        str+='<div class="col-lg-2">';
        str+='<div></div>';
        str+='</label></p>';
        str+='</div>';
        str+='</div><br />';

        //Append row
        $("#tastkList").append(str);

        //Blank fields
        $("#taskMsg").val('');
        $("#taskExpDate").val('');
    }
}

function RemoveTask(randomNum){
    swal({
      title: "Are you sure to delete Task?",
      text: "Your will not be able to recover this task!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Delete",
      closeOnConfirm: false
    },
    function(){
        var taskCombinedValues    = $("#taskCombinedValues").val();
        var myJsonObject = JSON.parse(taskCombinedValues); 

        //Remove from array
        var result = $.grep(myJsonObject, function(e){ 
             //return e.taskMsg == taskMsgValue;   // Need if exact
             return e.taskRandomID != randomNum; 
        });
                  
        //make array
        result.join();    

        //array to string
        var result = JSON.stringify(result);
        $("#taskCombinedValues").val(result);

        //Hide row
        
        projectId = '<?php echo $projectId;?>';
        $.ajax({
                type : "POST",
                dataType : "json",
                url : "<?php echo base_url(); ?>deleteTask",
                data : { randomNum : randomNum,projectId:projectId } 
                }).done(function(data){
                    if(data.status = true) { 
                        swal({title: "Deleted!", text: "Your task has been deleted.!", type: "success"},
                           function(){ 
                                $("#"+randomNum).hide();
                               location.reload();
                           }
                        );
                    }
                    else if(data.status = false) { 
                        swal("failed!", "Task deletion failed.", "error");
                    }                    
        });  
    });
    
}

function EditTaskOpenPoup(randomNum,taskMsgValue,taskExpDate){    
    $("#TaskRandomID").val(randomNum);
    //Show popup 
    $('#myModalTask').modal('show'); 
    //Assign fields values
    $("#taskMsg").val(taskMsgValue);
    $("#taskExpDate").val(taskExpDate);
    //Hide error msg
    $("#taskMsgError").hide();
    $("#taskExpDateError").hide();    
    $("#TaskCreateType").val('2');
}

function SaveBid(){
    var companyName      = $("#companyName").val();
    var bidPrice  = $("#bidPricevalue").val();
    var bidRandomIDVal = $("#bidRandomIDVal").val();
    if(bidRandomIDVal==""){
             var bidRandomNum = "bid-"+Math.floor((Math.random() * 100000) + 1);
             $("#bidRandomIDVal").val(bidRandomNum);
        }else{
             var bidRandomNum = bidRandomIDVal;
        }     


    if(companyName==''){
        $("#companyNameError").show();
    }else if(bidPrice==''){
        $("#bidPriceError").show();
    }else{
        $.ajax({
            url: "<?php echo base_url().'project/saveBid'?>",
            type: 'POST',
            data:{companyName: companyName,bidPrice: bidPrice,bidRandomId :bidRandomNum},
            success: function (data) {
               
            //}
               get_cat_list("t");
            },
            error: function (data) {
               alert(data);
            }
        });
    }
        
}
//function to retrieve data from database
function get_cat_list(flag) {

    var table = $('#bidResult').DataTable();
    table.clear();
    var bidArr = "";
    var bidRandomIDVal = $("#bidRandomIDVal").val();
    $.ajax({
      url: "<?php echo base_url().'project/getBidAjax'?>",
      type: 'GET',
      data:{bidRandomId :bidRandomIDVal,isUpdate:1},
      dataType: 'JSON',
      success: function (data) {
        //table.row.add([companyName, bidPrice, 'pricenew']).draw();
        $.each(data, function() {
            var number = Number(this.bidPrice.replace(/[^0-9.-]+/g,""));
            var unitCost = 0;
            if(Number($("#buildingSFValHidden").val().replace(/[^0-9.-]+/g,"")) > 0){
                var unitCost = number/Number($("#buildingSFValHidden").val().replace(/[^0-9.-]+/g,""))
            }

            var formatter = new Intl.NumberFormat('en-US', {
              style: 'currency',
              currency: 'USD',
              minimumFractionDigits: 0
            });

           table.row.add([
                this.companyName,
                formatter.format(this.bidPrice),
                unitCost.toFixed(2)
           ]).draw();
            var bidCombinedValues    = $("#bidCombinedValues").val();

            //if(bidCombinedValues.length==0){ 
                //Push data
                bidArr+=","+this.id;
                // bidArr.push(this.id);
                // bidArr.join();           

                //convert into string
                //var bidArrString = JSON.stringify(bidArr);
                $("#bidCombinedValues").val(bidArr);
        });
        if(flag == "t")
            $('#myModalBid').modal('toggle');
   }
});

}

function SaveContact(type){
    var temp = 1;
    if(type == 0){
        //New Contact
        var clientId   = $('#clientId :selected').val();
        var clientName   = $('#clientId :selected').text();
        var assignedTo   = $('#assignedTo :selected').val();
        var contactName   = $("#contactName").val();
        var conatctEmail  = $("#conatctEmail").val();
        var conatctAddress  = $("#contactAddress").val();
        var conatctPh  = $("#conatctPh").val();
        var conatctPh2  = $("#conatctPh2").val();
        var conatctCompany  = $("#conatctCompany").val();
        var conatctPrimary  = $('input[name=primary_contact]:checked').val();
        var contactRand = "";
        if(conatctPrimary != 1){
            conatctPrimary = 0
        }

        if(clientId == ""){
            temp = 0;
            errorID = "#contactClientError";
        }

        if(contactName == ""){
            temp = 0;
            errorID = "#contactNameError";
        }

        // if(conatctAddress == ""){
        //     temp = 0;
        //     errorID = "#contactAddressError";
        // }

        if(conatctEmail != ""){
            if(!validateEmail(conatctEmail)){
                temp = 0;
                errorID = "#conatctEmailError";
            }
        }
        
        if(conatctPh != ""){
            if(validatePhone(conatctPh)==false){
                temp = 0;
                errorID = "#conatctPhError";
            }
        }
        if(conatctPh2 != ""){
            if(validatePhone(conatctPh2)==false){
                temp = 0;
                errorID = "#conatctPhError2";
            }
        }
    }else{
        //Exiting Contact
        var clientId   = $('#exClientId :selected').val();
        var clientName   = $('#exClientId :selected').text();
        var contactId   = $('#ExcontactName :selected').val();
        var conatctPrimary  = $('input[name=ex_primary_contact]:checked').val();

        if(clientId == ""){
            temp = 0;
            errorID = "#ExcontactClientError";
        }
         if(contactId != ""){
            jQuery.ajax({
                url: "<?php echo base_url(); ?>project/getContactDtl",
                data: { contactId : contactId} ,
                type: 'post', 
                dataType: 'json',
                'async': false,
                beforeSend: function () {
                    //jQuery('#editsmsloader').html('<div class="text-center mrgA padA"><i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></div>');
                },            
                success: function (data) {
                    //jQuery('#editsmsloader').hide();
                    if(data.status == true) { 
                        var ContactDtl = data.result;
                        $.each( ContactDtl, function( key, value ) {
                            contactName = value.contact_name;
                            conatctEmail = value.contact_email;
                            conatctAddress = value.address;
                            conatctPh = value.contact_phone;
                            conatctPh2 = value.contact_phone2;
                            conatctCompany = value.contact_company;
                            contactRand = value.contactRandomId
                        });
                        
                    }else if(data.status == false) { 
                        contactName = "";
                        conatctEmail = "";
                        conatctPh = "";
                        conatctPh2 = "";
                        conatctCompany = "";
                        contactRand = "";
                        conatctAddress = "";
                    }
                }        
            });
        }else{
            temp = 0;
            errorID = "#ExcontactNameError";      
        }
    }

    //console.log(contactName+"_"+cconatctEmail+"_"+conatctPh+"_"+conatctCompany);

    var is_primary_contact = $("#is_primary_contact").val();
    var is_primary_contactRandomId = $("#is_primary_contact").attr("data-contact");
    
    var contactRandomId = $("#ContactRandomID").val();

    //Apply Validation
    if(temp == 0){
        $(errorID).show();
    }else{
        var ContactCreateType  = $("#ContactCreateType").val();        

        if(ContactCreateType==1){
            if(contactRand == ""){
                var randomNum = "contact-"+Math.floor((Math.random() * 100000) + 1);
            }else{
                var randomNum = contactRand;
            }
            
        }else{ 
             var randomNum = contactRandomId;
        }  

        conatct_Primary = 0;
        if(conatctPrimary == 1){
            $("#is_primary_contact").val(randomNum);
            $("#is_primary_contact").attr("data-contact",conatctPrimary);
            conatct_Primary = 1;
        }
        
        //Push data in array    
        var contactCombinedValues    = $("#contactCombinedValues").val();

        if(contactCombinedValues.length==0){ 
            //Push data
            var contactArr = [];
            contactArr.push({ 
                clientId : clientId,
                contactName     : contactName, 
                assignedTo : assignedTo,
                contactAddress : conatctAddress,
                conatctEmail : conatctEmail,
                conatctPh     : conatctPh, 
                conatctPh2     : conatctPh2, 
                conatctCompany : conatctCompany,
                conatctPrimary : conatct_Primary,
                contactRandomId: randomNum

            });
            contactArr.join();   

            //console.log("IF_"+contactArr);        

            //convert into string
            var contactArrString = JSON.stringify(contactArr);
            $("#contactCombinedValues").val(contactArrString);
        }else{
            //Check edi
            if(ContactRandomID == ''){
            }else{
                var contactCombinedValues  = $("#contactCombinedValues").val();
                //change to obj
                var myJsonObject = JSON.parse(contactCombinedValues); 

                var result = $.grep(myJsonObject, function(e){ 
                     return e.contactRandomId != randomNum; 
                }); 
                //make array
                result.join();    

                //array to string
                var result = JSON.stringify(result);
                $("#contactCombinedValues").val(result);  

                $("#"+randomNum).remove();
                if(ContactCreateType==2){ 
                    //Hide task html div 
                    $("#"+randomNum).remove();
                    //$('#'+randomNum).removeAttr('id', '');

                }     
            } 

            conatct_Primary = 0;
            if(conatctPrimary == 1){
                $("#is_primary_contact").val(randomNum);
                $("#is_primary_contact").attr("data-contact",conatctPrimary);
                conatct_Primary = 1;
            }
            
            //Get again  
            var contactCombinedValues  = $("#contactCombinedValues").val();
            //change to obj
            var myJsonObject = JSON.parse(contactCombinedValues); 

            //Push data
            myJsonObject.push({
                clientId : clientId,
                contactName     : contactName, 
                assignedTo : assignedTo,
                contactAddress : conatctAddress,
                conatctEmail : conatctEmail,
                conatctPh     : conatctPh, 
                conatctPh2     : conatctPh2,
                conatctCompany : conatctCompany,
                conatctPrimary : conatct_Primary,
                contactRandomId: randomNum
            });
            //make array
            myJsonObject.join();    
            //console.log("Else_"+myJsonObject);        
            //array to string
            var contactArrString = JSON.stringify(myJsonObject);
            $("#contactCombinedValues").val(contactArrString);
            
        }

        //Close po up
        $('#myModalContacts').modal('toggle');
        
        //alert('test');
        var str='';
        str+='<div class="row detailsRowBox" id="'+randomNum+'">';
        // str+='<div><a href="javascript:void(0);" style="font-size:10px;" class="btn edtiBtndtlRow btn-rounded bg-warning btn-xs" onclick="EditContactOpenPoup(\''+randomNum+'\',\''+clientId+'\',\''+assignedTo+'\',\''+contactName+'\',\''+conatctAddress+'\',\''+conatctEmail+'\',\''+conatctPh+'\',\''+conatctPh2+'\',\''+conatctCompany+'\',\''+conatctPrimary+'\');"> <i class="fa fa-pencil-alt"></i> </a> ';
        // str+='<a href="javascript:void(0);" style="font-size:10px;" class="btn deleteBtndtlRow btn-rounded bg-danger btn-xs" onclick="RemoveContact(\''+randomNum+'\');"> <i class="fa fa-trash-alt"></i> </a></div>';
        str+='<div class="col-lg-12 mb-2">';
        str+='<p><i class="fa fa-briefcase"></i> '+clientName+'</p>';
        str+='</div>';

        str+='<div class="col-lg-12 mb-2">';
        str+='<p><i class="fa fa-user"></i> '+contactName+'</p>';
        str+='</div>';

        str+='<div class="col-lg-12 mb-2">';
        str+='<p class="mb-0"><i class="fa fa-envelope"></i> '+conatctEmail+'</p>';
        str+='</div>';
        str+='<div class="col-lg-12 mb-00">';
        str+='<p><i class="fa fa-phone"></i> '+conatctPh+','+conatctPh2+'</p>';
        str+='</div>';

        // str+='<div class="col-lg-2">';
        // str+='<p>'+conatctCompany+'</p>';
        // str+='</div>';
 
        str+='</div>';

        //Append row
        $("#contactList").append(str);

        //Blank fields
        $('select#clientId option').removeAttr("selected");
        $("#contactName").val('');
        $("#conatctEmail").val('');
        $("#conatctPh").val('');
        $("#conatctPh2").val('');
        $("#conatctPrimary").prop( "checked", false );
        $("#conatctCompany").val('');
    }
}

function RemoveContact(randomNum){
    swal({
      title: "Are you sure to delete Contact?",
      text: "",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Delete",
      closeOnConfirm: false
    },
    function(){
        var contactCombinedValues    = $("#contactCombinedValues").val();
        var myJsonObject = JSON.parse(contactCombinedValues); 
               
        //Remove from array
        var result = $.grep(myJsonObject, function(e){ 
             return e.contactRandomId != randomNum; 
        });
        
        //make array
        result.join();    

        //array to string
        var result = JSON.stringify(result);
        $("#contactCombinedValues").val(result);

        //Hide row
        $("#"+randomNum).hide();

        var contactDelCombinedValues = $("#contactDelCombinedValues").val();
        if(contactDelCombinedValues.length==0){ 
            //Push data
            var contactArr = [];
            contactArr.push({ 
                contactRandomId : randomNum, 
            });
            contactArr.join();           

            //convert into string
            var contactArrString = JSON.stringify(contactArr);
            $("#contactDelCombinedValues").val(contactArrString);
        }else{
            //change to obj
            var myJsonObject = JSON.parse(contactDelCombinedValues); 

            //Push data
            myJsonObject.push({
               contactRandomId : randomNum, 
            });
            //make array
            myJsonObject.join();    

            //array to string
            var contactArrString = JSON.stringify(myJsonObject);
            $("#contactDelCombinedValues").val(contactArrString);
        }
        swal("Deleted!", "", "success");
        
        // $.ajax({
        //         type : "POST",
        //         dataType : "json",
        //         url : "<?php echo base_url(); ?>deleteContact",
        //         data : { randomNum : randomNum,projectId:projectId,contactId:contactId } 
        //         }).done(function(data){
        //             if(data.status = true) { 
        //                 swal({title: "Deleted!", text: "Contact has been deleted.!", type: "success"},
        //                    function(){ 
        //                         $("#"+randomNum).hide();
        //                        location.reload();
        //                    }
        //                 );
        //             }
        //             else if(data.status = false) { 
        //                 swal("failed!", "Task deletion failed.", "error");
        //             }                    
        //     });  
        });   
}


function EditContactOpenPoup(randomNum,clientId,assignedTo,contactName,contactAddress,conatctEmail,conatctPh,conatctPh2,conatctCompany,conatctPrimary){   

    $("#contactTab").hide();
    if(!$("#newcontact").hasClass("active")){
        $("#newcontact").addClass("active");
        $("#newcontact").addClass("show");
        $("#existcontact").removeClass("active");
        $("#existcontact").removeClass("show");
    }

    $("#ContactRandomID").val(randomNum);
   
    //Assign fields values
   var client_info = $("#clientCombinedValues").val();

    if(client_info.length != 0){
        var myJsonObject = JSON.parse(client_info); 
        $('#clientId').empty();

        $('#clientId').append('<option value="">Select Business</option>');
        $.each( myJsonObject, function( key, value ) {
            var res = value.clientRandomId.split("-");
            $('#clientId').append('<option data-tokens="'+res[1]+'" value="'+res[1]+'">'+value.clientName+'</option>');
        });
    }

   $('select#clientId option').removeAttr("selected");
   $("#clientId option").each(function(){ 
        if($(this).val()==clientId){ console.log($(this).val());// EDITED THIS LINE
            $(this).attr("selected","selected");    
        }
    });
    $('select#clientId').select2();

    $("#contactName").val(contactName);
    $("#assignedTo").val(assignedTo);
    
    $("#contactAddress").val(contactAddress);
    $("#conatctEmail").val(conatctEmail);
    $("#conatctPh").val(conatctPh);
    $("#conatctPh2").val(conatctPh2);
    $("#conatctCompany").val(conatctCompany);

    $("#conatctPrimary").prop("checked", false );
    var is_primary_contactRandomId = $("#is_primary_contact").val();
    var is_primary_contact = $("#is_primary_contact").attr("data-contact");
    if(conatctPrimary == is_primary_contact && is_primary_contactRandomId == randomNum){
        $("#conatctPrimary").prop("checked", true);
    }

     //Show popup 
    $('#myModalContacts').modal('show'); 


    //Hide error msg
    $("#contactNameError").hide();
    //$("#contactAddressError").hide();
    $("#conatctEmailError").hide();    
    $("#conatctPhError").hide();    
    $("#conatctPhError2").hide();    
    $("#conatctCompanyError").hide();    
    $("#ContactCreateType").val('2');
    $("#conatctPrimaryError").hide();
}

function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}
function validatePhone(phone) {
    
    phone = phone.replace(/[^0-9]/g,'');
    if (phone.length != 10)
    {
        return false;
    }
}

function getClientContact(clientID){

    jQuery.ajax({
        url: "<?php echo base_url(); ?>project/clientContact",
        data: { clientID : clientID} ,
        type: 'post', 
        dataType: 'json',
        'async': false,
        beforeSend: function () {
            //jQuery('#editsmsloader').html('<div class="text-center mrgA padA"><i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></div>');
        },            
        success: function (data) {
            //jQuery('#editsmsloader').hide();
            if(data.status == true) { 
                var clientContacts = data.result;
                $('#ExcontactName').empty();
                $.each( clientContacts, function( key, value ) {
                    $('#ExcontactName').append('<option data-tokens="'+value.id+'" value="'+value.id+'">'+value.contact_name+'</option>');
                });
            }else if(data.status == false) { 
              $('#ExcontactName').empty();
              $('#ExcontactName').append('<option value="">Select Contact</option>');
            }
        }        
    });
}

function SaveClient(clientName,clientID,buisnessType="",phNo="",address=""){

    //var clientName   = $("#clientName").val();
    var clientRandomId = $("#ClientRandomID").val();

    var temp = 0;
    if(clientID == 0){
        if(clientName ==''){
            $("#clientNameError").show();
        }else if(clientName == "Select Client"){
            $("#ExclientNameError").show();
        }else if(buisnessType == ""){
            $("#buisnessTypeError").show();
        }else if(phNo == ''){
            $("#conatctBuisnessPhError").show();
        }else if(validatePhone(phNo)==false){
                $("#conatctBuisnessPhError").show();
        }else if(address == ''){
            $("#addressError").show();
        }else{
            temp = 1;
        }
    }else{
        if(clientName ==''){
            $("#clientNameError").show();
        }else if(clientName == "Select Client"){
            $("#ExclientNameError").show();
        }else{
            temp = 1;
        }
        if(buisnessType ==''){
            buisnessType = $('#select-existclient option:selected').attr('data-bt');
        }
        if(phNo ==''){
            phNo = $('#select-existclient option:selected').attr('data-ph');
        }
        if(address ==''){
            address = $('#select-existclient option:selected').attr('data-address');
        }
    }
    //Apply Validation
    if(temp ==1){
        if(clientID == 0){
            //Save/Update Client
            if(clientRandomId != ""){
                is_update = 1;
                var res = clientRandomId.split("-");
                client_id = res[1];
            }else{
                is_update = 0;
                client_id = 0;
            }
            jQuery.ajax({
                url: "<?php echo base_url(); ?>save_client",
                data: { clientName : clientName,buisnessType:buisnessType, is_update:is_update,client_id:client_id,phNo:phNo,address:address} ,
                type: 'post', 
                dataType: 'json',
                'async': false,
                beforeSend: function () {
                    //jQuery('#editsmsloader').html('<div class="text-center mrgA padA"><i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></div>');
                },            
                success: function (data) {
                    //jQuery('#editsmsloader').hide();
                    if(data.status == true) { 
                        clientId = data.result;
                    }else if(data.status == false) { 
                        $("#clientNameError").text(data.msg);
                        clientId = "";
                    }
                }        
            });
        }else{
            clientId = clientID;
        }

        if(clientId == ""){ 
            $("#clientNameError").show();
        }else{
            var ClientCreateType  = $("#ClientCreateType").val();
            if(ClientCreateType==1){
                 // var randomNum = "client-"+Math.floor((Math.random() * 100000) + 1);
                 var randomNum = "client-"+clientId;
            }else{ 
                 var randomNum = clientRandomId;
            }   
            
            //Push data in array    
            var clientCombinedValues    = $("#clientCombinedValues").val();

            if(clientCombinedValues.length==0){ 
                //Push data
                var clientArr = [];
                clientArr.push({ 
                    clientName     : clientName, 
                    buisnessType     : buisnessType,
                    address     : address, 
                    phNo     : phNo, 
                    clientRandomId: randomNum
                });
                clientArr.join();           

                //convert into string
                var clientArrString = JSON.stringify(clientArr);
                $("#clientCombinedValues").val(clientArrString);
            }else{
                //Check edi
                if(ClientRandomID == ''){
                }else{
                    var clientCombinedValues  = $("#clientCombinedValues").val();
                    //change to obj
                    var myJsonObject = JSON.parse(clientCombinedValues); 

                    var result = $.grep(myJsonObject, function(e){ 
                         return e.clientRandomId != randomNum; 
                    }); 

                    //make array
                    result.join();    

                    //array to string
                    var result = JSON.stringify(result);
                    $("#clientCombinedValues").val(result);  
                    $("#"+randomNum).remove();
                    if(ClientCreateType==2){ 
                        //Hide task html div 
                        $("#"+randomNum).remove();
                        //$('#'+randomNum).removeAttr('id', '');

                    }     
                } 
                
                //Get again  
                var clientCombinedValues  = $("#clientCombinedValues").val();
                //change to obj
                var myJsonObject = JSON.parse(clientCombinedValues); 

                //Push data
                myJsonObject.push({
                    clientName     : clientName, 
                    buisnessType     : buisnessType,
                    address     : address, 
                    phNo     : phNo, 
                    clientRandomId: randomNum
                });
                //make array
                myJsonObject.join();    

                //array to string
                var clientArrString = JSON.stringify(myJsonObject);
                $("#clientCombinedValues").val(clientArrString);
                
            }

            //Close po up
            $('#myModalClients').modal('toggle');

            var str='';
            str+='<div class="row detailsRowBox" id="'+randomNum+'">';
            // str+='<div><a href="javascript:void(0);" style="font-size:10px;" class="btn edtiBtndtlRow btn-rounded bg-warning btn-xs" onclick="EditClientOpenPoup(\''+randomNum+'\',\''+buisnessType+'\',\''+clientName+'\',\''+phNo+'\',\''+address+'\');"> <i class="fa fa-pencil-alt"></i> </a> ';
            // str+='<a href="javascript:void(0);" style="font-size:10px;" class="btn deleteBtndtlRow btn-rounded bg-danger btn-xs" onclick="RemoveClient(\''+clientId+'\',0,\''+randomNum+'\');"> <i class="fa fa-trash-alt"></i> </a></div>';
            str+='<div class="col-lg-12">';
            str+='<p class="mb-2"><i class="fa fa-user"></i> '+clientName+'</p>';
            str+='<p class="mb-2"><i class="fa fa-briefcase"></i> '+buisnessType+'</p>';
            str+='<p class="mb-2"><i class="fa fa-phone"></i> '+phNo+'</p>';
            str+='<p class="mb-0"><i class="fa fa-map-marker"></i> '+address+'</p>';
            str+='</div>';

           
            // //alert('test');
            // var str='';
            // str+='<div class="row" id="'+randomNum+'">';
            // str+='<div class="col-lg-7">';
            // str+='<p>'+clientName+'</p>';
            // str+='</div>';

            
            
             
            str+='</div>';

            //Append row
            $("#clientList").append(str);

            //Blank fields
            $("#clientName").val('');
        }
    }
}

function EditClientOpenPoup(randomNum,buisnessType,clientName,phNo,address){    
    $("#clientTab").hide();
    if(!$("#newclient").hasClass("active")){
        $("#newclient").addClass("active");
        $("#newclient").addClass("show");
        $("#existclient").removeClass("active");
        $("#existclient").removeClass("show");
    }
    
    
    $("#ClientRandomID").val(randomNum);
    //Show popup 
    $('#myModalClients').modal('show'); 
    //Assign fields values
    $("#clientName").val(clientName);
    $("#buisnessType").val(buisnessType);
    $("#contact_buisness_phone").val(phNo);
    $("#addressAutocomplete").val(address);

    //Hide error msg
    $("#clientNameError").hide();
    $("#ExclientNameError").hide();
    $("#ClientCreateType").val('2');
}

function RemoveClient(clientId,projectId,randomNum){
    swal({
      title: "Are you sure to delete Client?",
      text: "Your will not be able to recover this task!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Delete",
      closeOnConfirm: false
    },
    function(){
        var clientCombinedValues = $("#clientCombinedValues").val();
        var myJsonObject = JSON.parse(clientCombinedValues); 
               
        //Remove from array
        var result = $.grep(myJsonObject, function(e){ 
             return e.clientRandomId != randomNum; 
        });
        
        //make array
        result.join();    

        //array to string
        var result = JSON.stringify(result);
        $("#clientCombinedValues").val(result);

        //Hide row
        $("#"+randomNum).hide();

        var clientDelCombinedValues  = $("#clientDelCombinedValues").val();
        if(clientDelCombinedValues.length==0){ 
            //Push data
            var clientArr = [];
            clientArr.push({ 
                clientID : clientId, 
                // buisnessType     : buisnessType,
                // address     : address, 
                // phNo     : phNo, 
                projectId: projectId
            });
            clientArr.join();           

            //convert into string
            var clientArrString = JSON.stringify(clientArr);
            $("#clientDelCombinedValues").val(clientArrString);
        }else{
            //change to obj
            var myJsonObject = JSON.parse(clientDelCombinedValues); 

            //Push data
            myJsonObject.push({
                clientID : clientId,
                // buisnessType     : buisnessType,
                // address     : address, 
                // phNo     : phNo,  
                projectId: projectId
            });
            //make array
            myJsonObject.join();    

            //array to string
            var clientArrString = JSON.stringify(myJsonObject);
            $("#clientDelCombinedValues").val(clientArrString);
        }
        swal("Deleted!", "", "success");



        
        // $.ajax({
        //         type : "POST",
        //         dataType : "json",
        //         url : "<?php echo base_url(); ?>deleteClient",
        //         data : { randomNum : randomNum,projectId:projectId,clientId:clientId } 
        //         }).done(function(data){
        //             if(data.status = true) { 
        //                 swal({title: "Deleted!", text: "Client has been deleted.!", type: "success"},
        //                    function(){ 
        //                         $("#"+randomNum).hide();
        //                        location.reload();
        //                    }
        //                 );
        //             }
        //             else if(data.status = false) { 
        //                 swal("failed!", "Client deletion failed.", "error");
        //             }                    
        // });  
    });   
}


    function sendText(){
        $("#contactListError").hide();
        $("#smsError").hide();
        $('#sendSmsModal').modal('show');        
    }
    function sendMail(){
        $("#contactListEmailError").hide();
        $('#sendmailModal').modal('show');        
    }
    function sendCall(){
        $("#contactListCallError").hide();
        $('#sendcallModal').modal('show');      
    }


    function sendSms(){
            sms_message = $("#sms").val();
            sms_sender = $(".sms_sender").val();
            sms_recipient = $("#contac_list :selected").val();
            projectId = '<?php echo $projectId;?>';
            sms_from  = "<?php echo $this->session->userdata['name'];?>";
            // sms_to = $(".fname").val();
            sms_to = $("#contac_list :selected").val();
           
            if(sms_to==''){
                $("#contactListError").show();
            }else if(sms_message == ""){
                  $("#smsError").show();
            }else{
                jQuery.ajax({
                    url: "<?php echo base_url(); ?>editSms",
                    data: { sms_sender : sms_sender,sms_message:sms_message,sms_recipient:sms_recipient,projectId:projectId,sms_from:sms_from,sms_to:sms_to} ,
                    type: 'post', 
                    dataType: 'json',
                    beforeSend: function () {
                        jQuery('#editsmsloader').html('<div class="text-center mrgA padA"><i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></div>');
                    },            
                    success: function (data) {
                        jQuery('#editsmsloader').hide();
                        if(data.status == true) { 
                            swal({title: "Meesage Sent", text: "Your Message  has been sent!", type: "success"},
                               function(){ 
                                   location.reload();
                               }
                            );
                        }else if(data.status == false) { 
                            //swal("failed!", "failed.", "error");

                            swal({title: "failed", text: "failed", type: "error"},
                               function(){ 
                                   location.reload();
                               }
                            );

                        }
                    }        
                });
            }    
    }

    function sendMessages(){
        var text    = CKEDITOR.instances['mail'].getData();    
        var email   = $("#contact_list_email :selected").val(); 
        projectId      = '<?php echo $projectId;?>';
        email_from  = "<?php echo $this->session->userdata['name'];?>";
        email_to    = $("#contact_list_email :selected").val();

        if(email_to == ''){
            $("#contactListEmailError").show();
        }else{
            jQuery.ajax({
                url: "<?php echo base_url(); ?>project/sendEmail",
                data: { text : text,email:$.trim(email),projectId:projectId,email_from:email_from,email_to:email_to } ,
                type: 'post', 
                dataType: 'json',
                beforeSend: function () {
                    jQuery('#loader').html('<div class="text-center mrgA padA"><i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></div>');
                },           
                success: function (data) {
                    jQuery('#loader').hide();
                    if(data.status = true) { 
                        swal({title: "Mail Sent", text: "Your Message  has been sent!", type: "success"},
                           function(){ 
                               location.reload();
                           }
                        );
                    }else if(data.status = false) { 
                            swal("failed!", "failed.", "error");
                    }
                }        
            });  
        }  
    }

    function sendCalls(projectId){ 
        phoneNumber  = $("#contact_list_call :selected").val();
        if(phoneNumber == ''){
            $("#contactListCallError").show();
        }else{
            conectCallAPI(projectId,phoneNumber);
        }
    }

    function deleteImage(imageId){
        swal({
          title: "Are you sure to delete this file?",
          text: "You will not be able to recover this file.",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes",
          closeOnConfirm: false
        },
        function(){
            $.ajax({
            type : "POST",
            dataType : "json",
            url : "<?php echo base_url(); ?>deleteImage",
            data : { imageId : imageId } 
            }).done(function(data){
                if(data.status == true) { 
                    swal({title: "Deleted", text: "Your Image  has been deleted!", type: "success"},
                           function(){ 
                               location.reload();
                           }
                    );
                }
                else if(data.status == false) { 
                    swal("failed!", "Image deletion failed.", "error");
                }                    
            });
          
        });        
    } 
</script>

<script>
$(document).ready(function(){
 if ($('.ScrollClassDynamic').height() > 135) {    
        $('div.ScrollClassDynamic').addClass('addScrollClassDynamic');
    }

 if ($('.ScrollClassDynamic1').height() > 135) {    
        $('div.ScrollClassDynamic1').addClass('addScrollClassDynamic1');
    }
    if ($('.ScrollClassDynamic2').height() > 135) {    
        $('div.ScrollClassDynamic2').addClass('addScrollClassDynamic2');
    }
    if ($('.ScrollClassDynamic3').height() > 135) {    
        $('div.ScrollClassDynamic3').addClass('addScrollClassDynamic3');
    }
    if ($('.ScrollClassDynamic4').height() > 135) {    
        $('div.ScrollClassDynamic4').addClass('addScrollClassDynamic4');
    }

});
</script>


 <script>
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name',
        administrative_area_level_2: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        addressAutocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('addressAutocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
        addressAutocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>
    <!-- AIzaSyB7_NfvBxKc8FpOZgAlRLlW0SApkVbidb4 -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXnYIF2RRd5COYQasKvQdAK6Pa7jKl5Oc&libraries=places&callback=initAutocomplete" async defer></script>
 
  <script type="text/javascript">
        //jQuery plugin
(function( $ ) {
   
   $.fn.uploader = function( options ) 

   {
     var settings = $.extend({
       MessageAreaText: "No files selected.",
       DefaultErrorMessage: "Unable to open this file.",
       BadTypeErrorMessage: "We cannot accept this file type at this time.",
       acceptedFileTypes: ['pdf', 'jpg', 'gif', 'jpeg', 'bmp', 'tif', 'tiff', 'png', 'xps', 'doc', 'docx',
        'fax', 'wmp', 'ico', 'txt', 'cs', 'rtf', 'xls', 'xlsx']
     }, options );
  
     var uploadId = 1;
     //update the messaging 
      $('.file-uploader__message-area p').text(options.MessageAreaText || settings.MessageAreaText);
     
     //create and add the file list and the hidden input list
     var fileList = $('<ul class="file-list fileLsitStyle"></ul>');
     var hiddenInputs = $('<div class="hidden-inputs hidden"></div>');
     $('.file-uploader__message-area').after(fileList);
     $('.file-list').after(hiddenInputs);
     
    //when choosing a file, add the name to the list and copy the file input into the hidden inputs
     $('.file-chooser__input').on('change', function(){
        var file = $('.file-chooser__input').val();
        var fileName = (file.match(/([^\\\/]+)$/)[0]);

       //clear any error condition
       $('.file-chooser').removeClass('error');
       $('.error-message').remove();
       
       //validate the file
       var check = checkFile(fileName);
       if(check === "valid") {
         
         // move the 'real' one to hidden list 
        $('.hidden-inputs').append($('.file-chooser__input')); 
       
         //insert a clone after the hiddens (copy the event handlers too)
         $('.file-chooser').append($('.file-chooser__input').clone({ })); 
         //$('.file-chooser').append($('.file-chooser__input'));          
       
         //add the name and a remove button to the file-list
         $('.file-list').append('<li style="display: none;"><span class="file-list__name">' + fileName + '</span><button class="fileCloseIcon removal-button" data-uploadid="'+ uploadId +'"><i class="fa fa-times"></i></button></li>');
         $('.file-list').find("li:last").show(800);
        
         //removal button handler
         $('.removal-button').on('click', function(e){
           e.preventDefault();
         
           //remove the corresponding hidden input
           $('.hidden-inputs input[data-uploadid="'+ $(this).data('uploadid') +'"]').remove(); 
         
           //remove the name from file-list that corresponds to the button clicked
           $(this).parent().hide("puff").delay(10).queue(function(){$(this).remove();});
           
           //if the list is now empty, change the text back 
           if($('.file-list li').length === 0) {
             $('.file-uploader__message-area').text(options.MessageAreaText || settings.MessageAreaText);
           }
         });
       
         //so the event handler works on the new "real" one
         $('.hidden-inputs .file-chooser__input').removeClass('file-chooser__input').attr('data-uploadId', uploadId); 
       
         //update the message area
         $('.file-uploader__message-area').text(options.MessageAreaTextWithFiles || settings.MessageAreaTextWithFiles);
         
         uploadId++;
         
       } else {
         //indicate that the file is not ok
         $('.file-chooser').addClass("error");
         var errorText = options.DefaultErrorMessage || settings.DefaultErrorMessage;
         
         if(check === "badFileName") {
           errorText = options.BadTypeErrorMessage || settings.BadTypeErrorMessage;
         }
         
         $('.file-chooser__input').after('<p class="error-message">'+ errorText +'</p>');
       }
     });
     
     var checkFile = function(fileName) {
       var accepted          = "invalid",
           acceptedFileTypes = this.acceptedFileTypes || settings.acceptedFileTypes,
           regex;

       for ( var i = 0; i < acceptedFileTypes.length; i++ ) {
         regex = new RegExp("\\." + acceptedFileTypes[i] + "$", "i");

         if ( regex.test(fileName) ) {
           accepted = "valid";
           break;
         } else {
           accepted = "badFileName";
         }
       }

       return accepted;
    };
  }; 
}( jQuery ));

//init 
$(document).ready(function(){
  $('.fileUploader').uploader({
    MessageAreaText: "No files selected. Please select a file."
  });
});

    </script>  
<script type="text/javascript">
    function getEmailText(emailText){
        //alert(emailText);
        //$("#msg").val(emailText);
        CKEDITOR.instances['mail'].setData(emailText);
    }
</script>


<script type="text/javascript">
    function conectCallAPI(projectId,phoneNumber){
        $("#sendcallModal").modal("hide");
        var callLink = "<a href='javascript:void(0);' onclick='addCommData("+phoneNumber+")'>"+phoneNumber+"</a>";
        $(".call_number").html(callLink);
        $('#callModal').modal('show');

        // $.ajax({
        // type        : "POST",
        // dataType    : "json",
        // url         : "<?php //echo base_url(); ?>project/conectCallAPI",
        // data        : {  projectId : projectId, phoneNumber : phoneNumber} 
        // }).done(function(data){
        //     console.log(data);
        // });

    }
</script>


<script type="text/javascript">
    function commShowDetails(ComType,comId){   
        if(ComType==0){
            var title="SMS ";
        }else if(ComType==1){
            var title="Call ";
        }else{
            var title="Email ";
        }  
        
        $.ajax({
            type        : "POST",
            url         : "<?php echo base_url(); ?>project/getCommunicationDetails",
            data        : {  comId : comId} 
            }).done(function(data){
                //console.log(data);
                $('#ComDetailsTitle').html(title);
                $('#ComDetailsID').html(data);
        });

        $('#ComDetailsModal').modal('show');
        
    }
</script>
<script type="text/javascript">
$('#clientId').on('change', function() {
  var clientId = this.value;
   $.ajax({
            type        : "POST",
            url         : "<?php echo base_url(); ?>project/getAddressInfo",
            data        : {  clientId : clientId} 
            }).done(function(data){
                //console.log(data);
                $('#contactAddress').val(data);
        });
});
</script>
<!---------------- View on Map ---------------->
  <style>
    /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */
    #map-address {
      height: 100%;
    }
    /* Optional: Makes the sample page fill the window. */
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
    #floating-panel {
      position: absolute;
      top: 10px;
      left: 25%;
      z-index: 5;
      background-color: #fff;
      padding: 5px;
      border: 1px solid #999;
      text-align: center;
      font-family: 'Roboto','sans-serif';
      line-height: 30px;
      padding-left: 10px;
    }
    .projectNext-btn{
        padding-left: 10px;
        border-left: 2px solid #999;
        margin-left: 10px;
    }
    .customerDataEditCard h4{
        font-size: 14px;
    }
    #tastkList .custom-control {
   
    margin-left: 15px !important;
}
  </style>
<?php 
    //get lat long
    $getLatLong = $this->map_model->getLatLong($address);
    if(!empty($getLatLong)){
        $getLatLongArr = explode("@", $getLatLong);
    }
?>
 <script type="text/javascript">
    $(document).ready(function() {
        var address = "<?php echo $address; ?>";
        var lat = "<?php echo $getLatLongArr[0]; ?>";
        var long = "<?php echo $getLatLongArr[1]; ?>";
        viewonMap(address,lat,long);
    });

    function viewonMap(address,lat,long){
        //alert(lat+"="+long);

        if(lat!='' && long!=''){
            var locations = [
              [address, lat,long, 4]];

            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 17,
              center: new google.maps.LatLng(lat, long),
              mapTypeId: google.maps.MapTypeId.SATELLITE
            });

            var infowindow = new google.maps.InfoWindow();

            var marker, i;

            for (i = 0; i < locations.length; i++) {  
              marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
              });

              google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                  infowindow.setContent(locations[i][0]);
                  infowindow.open(map, marker);
                }
              })(marker, i));
            }
        }
        //$('#viewMapModal').modal('show'); 
    }
 </script>
 <script type="text/javascript">
    $("#stage").change(function() {
        $('#tagId option:selected').removeAttr('selected');
    });
</script>

<script>

document.getElementById('building_sf').addEventListener('input', event =>
  event.target.value = (parseInt(event.target.value.replace(/[^\d]+/gi, '')) || 0).toLocaleString('en-US')
);

$(document).ready(function() {
   
     $('#exampleTwo').DataTable( {
        "scrollY": 200    
    } );
   
} );

var timeoutId = null;

function updateIt()
{
    
    get_cat_list('f');
}

$("#building_sf").keyup(function() {
    $("#buildingSFVal").html('<b>'+$(this).val()+'</b>');
    $("#buildingSFValHidden").val($(this).val());
    if (timeoutId != null)
        window.clearTimeout(timeoutId);
    timeoutId = window.setTimeout(updateIt, 500);
    
  });

</script>