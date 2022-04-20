
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
.pac-container { z-index: 10000 !important; }


</style>
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
               <form  id="addLead" action="<?php echo base_url() ?>addProject" method="post" enctype="multipart/form-data" role="form">
        <div class="row">
        <div class="col-lg-6">

            <!-- Customer Data start -->
            <div class="card">
                <div class="custom-card"><h5 class="card-header"> Project Data </h5></div>
                    <div class="card-body customerDataCard">
                        <h4>
                            <div class="row">
                                <strong class="col-lg-6">This project is a priority:</strong>
                                <span class="p-l-10 col-lg-6">
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input class="custom-control-input" value="1" type="checkbox" name="is_priority"><span class="custom-control-label">&nbsp;</span>
                                    </label>
                                </span>
                            </div>
                        </h4>
                        <h4>
                            <div class="row">
                                <strong class="col-lg-6"> Project Status:</strong>
                                <div class="col-lg-6 p-l-10">
                                    <span class="form-group">                                
                                         <select class="form-control" id="stageId" name="stageId">
                                                    <option value="0">Select Status</option>  
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
                                    </span>
                                </div>
                            </div>
                        </h4> 
                        <h4>
                            <div class="row">
                                <strong class="col-lg-6">Job # <span class="reqEstrik">*</span>: </strong>
                                <span class="p-l-10 col-lg-6">
                                    <input class="form-control" required type="text" value="" id="filesystem_id" name="filesystem_id" placeholder="Job #">
                                </span>
                            </div>
                        </h4>
                        <h4>
                            <div class="row">
                                <strong class="col-lg-6">Job Name *: </strong>
                                <span class="p-l-10 col-lg-6">
                                    <input class="form-control" required type="text" value="<?php echo set_value('projectName'); ?>" id="projectName" name="projectName" placeholder="Job Name">
                                </span>
                            </div>
                        </h4>
                        <h4>
                            <div class="row">
                                <strong class="col-lg-6">Job Type: </strong>
                                <span class="p-l-10 col-lg-6">
                                    <select class="form-control" id="jobTypeId" name="jobTypeId">
                                        <option value="0">Select Job Type</option>
                                         <?php
                                        if(!empty($jobTypes))
                                        {
                                            foreach ($jobTypes as $job_type)
                                            {
                                                ?>
                                                <option value="<?php echo $job_type->id ?>"><?php echo $job_type->jobType ?></option>
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
                                <strong class="col-lg-6">Company: </strong>
                            <div class="col-lg-6">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="company"  value="contracting" class="custom-control-input "><span class="custom-control-label">Contracting</span>
                                </label>  
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="company"  value="north" class="custom-control-input"><span class="custom-control-label" style="color: #006400;">North</span>
                                </label>                              
                            </div>
                            </div>
                        </h4>
                        <!-- <h4 id="contract_val_input">
                            <div class="row">
                                <strong class="col-lg-6">Contract Value: </strong>
                                <span class="p-l-10 col-lg-6">
                                    <input class="form-control" data-type="currency" type="text" value="<?php echo set_value('contract'); ?>" id="contract" name="contract" placeholder="Contract"> 
                                </span>
                            </div>
                        </h4> -->
                        <h4 id="budget_input">
                            <div class="row">
                                <strong class="col-lg-6">Budget: </strong>
                            <div class="col-lg-6">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="budget"  value="1" class="custom-control-input "><span class="custom-control-label">Yes</span>
                                </label>  
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="budget"  value="0" class="custom-control-input "><span class="custom-control-label">No</span>
                                </label>                              
                            </div>
                            </div>
                        </h4>
                        <h4>
                            <div class="row">
                                <strong class="col-lg-6">Scope: </strong>
                                 <div class="col-lg-6">
                                <label class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" name="scope[]" id="scope" value="abatement" class="custom-control-input "><span class="custom-control-label">Abatement</span>
                                </label>  
                                <label class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" name="scope[]" id="scope" value="interior_demolition" class="custom-control-input "><span class="custom-control-label">Interior Demolition</span>
                                </label> 
                                <label class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" name="scope[]" id="scope" value="site_demolition" class="custom-control-input "><span class="custom-control-label">Site Demolition</span>
                                </label>  
                                <label class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" name="scope[]" value="earthwork" id="scope" class="custom-control-input "><span class="custom-control-label">Earthwork</span>
                                </label>     
                                <label class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" name="scope[]" value="other" id="scope" class="custom-control-input "><span class="custom-control-label">Other</span>
                                </label>                       
                               </div>
                            </div>
                        </h4>
                        <!-- <h4>
                            <div class="row">
                                <strong class="col-lg-6">Wages:</strong>
                                <span class="p-l-10 col-lg-6">
                                    <select class="form-control" id="wages" name="wages">
                                        <option value="">Select Wages</option> 
                                        <option value="Private">Private</option> 
                                        <option value="Prevailing Wage">Prevailing Wage</option> 
                                        <option value="Union">Union</option> 
                                        <option value="PLA">PLA</option>  
                                    </select>
                                </span>
                            </div>
                        </h4> -->
                        <h4 id="wages_input">
                            <div class="row">
                                <strong class="col-lg-6"> Wages:</strong>
                                <div class="col-lg-6 p-l-10">
                                    <span class="form-group">                                
                                         <select class="form-control" id="wagesId" name="wagesId[]" multiple>
                                            <option value="">Select Wages</option>  
                                            <option value="Private">Private</option>  
                                            <option value="Prevailing Wage">Prevailing Wage</option>  
                                            <option value="Union">Union</option>  
                                            <option value="PLA">PLA</option>     
                                        </select>
                                    </span>
                                </div>
                            </div>
                        </h4>
                        <h4>
                            <div class="row">
                                <strong class="col-lg-6">Sales:</strong>
                                <span class="p-l-10 col-lg-6">
                                    <select class="form-control" id="sales" name="sales">
                                        <option value="0">Select Sales</option>
                                        <?php
                                        if(!empty($userlist))
                                        {
                                            foreach ($userlist as $userEmail)
                                            {
                                                ?>
                                                <option value="<?php echo $userEmail->userId; ?>"><?php echo $userEmail->name ?></option>
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
                                <strong class="col-lg-6">Admin:</strong>
                                <span class="p-l-10 col-lg-6">
                                    <select class="form-control" id="admin" name="admin">
                                        <option value="0">Select Admin</option>
                                        <?php
                                        if(!empty($userlist))
                                        {
                                            foreach ($userlist as $userInfo)
                                            {
                                                ?>
                                                <option value="<?php echo $userInfo->userId; ?>"><?php echo $userInfo->name ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </span>
                            </div>
                        </h4>
                        <h4 id="estimator_input">
                            <div class="row">
                                <strong class="col-lg-6">Estimator:</strong>
                                <span class="p-l-10 col-lg-6">
                                    <select class="form-control" id="estimator" name="estimator[]" multiple>
                                        <option value="0">Select Estimator</option>
                                        <?php
                                        if(!empty($userlist))
                                        {
                                            foreach ($userlist as $userInfo)
                                            {
                                                ?>
                                                <option value="<?php echo $userInfo->userId; ?>"><?php echo $userInfo->name ?></option>
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
                                <strong class="col-lg-6">Estimator Email:</strong>
                                <span class="p-l-10 col-lg-6">
                                    <select class="form-control" id="estimator_email" name="estimator_email">
                                        <option value="0">Select Estimator Email</option>
                                        <?php
                                        if(!empty($userlist))
                                        {
                                            foreach ($userlist as $userInfo)
                                            {
                                                ?>
                                                <option value="<?php echo $userInfo->userId; ?>"><?php echo $userInfo->name ?></option>
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
                                <strong class="col-lg-6">Job Site Address <span class="reqEstrik">*</span>:</strong> 
                                <span class="col-lg-6 p-l-10">
                                    <input class="form-control" required type="text" value="" id="autocomplete" name="address" placeholder="Job Site Address" onFocus="geolocate()">
                                </span>
                            </div>
                        </h4>

                        <h4>
                            <div class="row">
                                <strong class="col-lg-6">County:</strong> 
                                <span class="col-lg-6 p-l-10">
                                    <select class="form-control" id="countyid" name="countyid">
                                            <option value="0">Select County</option>  
                                                <?php
                                                if(!empty($counties))
                                                {
                                                    foreach ($counties as $county)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $county->id ?>" ><?php echo $county->county ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>    
                                    </select>
                                </span>
                            </div>
                        </h4>

                        <h4 id="bid_date_input">
                            <div class="row">
                                <strong class="col-lg-6">Bid Date <span class="reqEstrik">*</span>:</strong>
                                <span class="p-l-10 col-lg-6">
                                    <input class="form-control" required type="text" value="<?php echo set_value('due_date'); ?>" id="due_date" placeholder="mm/dd/yyyy"  name="due_date" placeholder="Bid Date">
                                </span>
                            </div>
                        </h4>
                         <h4 id="bid_time_input">
                            <div class="row">
                                <strong class="col-lg-6">Bid Time <span class="reqEstrik">*</span>:</strong>
                                <span class="p-l-10 col-lg-6">
                                     <input class="form-control" required type="text" value="<?php echo set_value('due_time'); ?>" id="due_time" name="due_time" placeholder="Bid Time" >
                                </span>
                            </div>
                        </h4>
                        <h4 id="job_walk_input">
                            <div class="row">
                                <strong class="col-lg-6">Job Walk Time:</strong>
                                <span class="p-l-10 col-lg-3">
                                    <!-- <textarea class="form-control" required id="job_walk_time" name="job_walk_time" placeholder="Job Walk/Time" rows="2" cols="50"></textarea>  -->
                                    <input class="form-control" readonly type="text" value="<?php echo set_value('job_walk_time'); ?>" id="job_walk_time" placeholder="mm/dd/yyyy" name="job_walk_time">
                                </span>
                                <span class="p-l-10 col-lg-3">
                                     <input class="form-control" readonly required type="text" value="<?php echo set_value('job_time'); ?>" id="job_time" name="job_time" placeholder="Job Time" >
                                </span>
                            </div>
                        </h4>
                            <h4>
                            <div class="row">
                                <strong class="col-lg-6">Est. Start Date <span class="reqEstrik">*</span>:</strong>
                                <span class="p-l-10 col-lg-6">
                                    <input class="form-control" type="text" required value="<?php echo set_value('est_start_date'); ?>" id="est_start_date" placeholder="mm/dd/yyyy"  name="est_start_date" placeholder="Est. Start Date">
                                </span>
                            </div>
                        </h4>         
                        <h4>
                            <div class="row">
                                <strong class="col-lg-6">ROM :</strong>
                                <span class="p-l-10 col-lg-6">
                                    <input class="form-control" type="text" required value="<?php echo set_value('rom'); ?>" id="rom" placeholder="ROM"  name="rom">
                                </span>
                            </div>
                        </h4>                  
                        <!-- <h4>
                            <div class="row">
                                <strong class="col-lg-6">RFI Deadline *:</strong>
                                <span class="p-l-10 col-lg-6">
                                    <input class="form-control" type="text" value="<?php //echo set_value('rfi_deadline'); ?>" id="rfi_deadline" placeholder="mm/dd/yyyy"  name="rfi_deadline" placeholder="RFI Deadline">
                                </span>
                            </div>
                        </h4> -->
                        <h4 id="bid_form_input">
                            <div class="row">
                                <strong class="col-lg-6">Bid Form:</strong>
                                <div class="col-lg-6">
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="bid_form"  value="1" class="custom-control-input "><span class="custom-control-label">Yes</span>
                                    </label>  
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="bid_form"  value="0" class="custom-control-input "><span class="custom-control-label">No</span>
                                    </label>                             
                                </div>
                            </div>
                        </h4>
                        <h4 id="budget_price_input">
                            <div class="row">
                                <strong class="col-lg-6">Bid Price:</strong>
                                <div class="col-lg-6">
                                    <input class="form-control" data-type="currency" type="text" value="<?php echo set_value('bid_price'); ?>" id="bid_price" name="bid_price" placeholder="Bid Price"> 
                                </div>
                            </div>
                        </h4>
                        <h4 id="reports_input">
                            <div class="row">
                                <strong class="col-lg-6">Reports:</strong>
                                <div class="col-lg-6">
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="reports"  value="1" class="custom-control-input "><span class="custom-control-label">Yes</span>
                                    </label> 
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="reports"  value="0" class="custom-control-input "><span class="custom-control-label">No</span>
                                    </label>                             
                                </div>
                            </div>
                        </h4>
                        <!-- <h4>
                            <div class="row">
                                <strong class="col-lg-6"> Project Manager *: </strong>
                                <div class="col-lg-6 p-l-10">
                                    <span class="form-group">                                
                                        <select class="form-control" id="sales_rep" name="sales_rep">
                                                <option value="0">Select Project Manager</option>
                                                <?php
                                                /*if(!empty($sales_rep))
                                                {
                                                    foreach ($sales_rep as $rl)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $rl->userId; ?>"><?php echo $rl->name ?></option>
                                                        <?php
                                                    }
                                                }*/
                                                ?>
                                            </select>
                                    </span>
                                </div>
                            </div>
                        </h4> -->

                        <h4 id="market_type_input">
                            <div class="row">
                                <strong class="col-lg-6"> Market Type:</strong>
                                <div class="col-lg-6 p-l-10">
                                    <span class="form-group">                                
                                         <select class="form-control" id="marketTypeId" name="marketTypeId">
                                                    <option value="">Select Market Type</option>  
                                                    <option value="residential">Residential</option>  
                                                    <option value="multi_family">Multi Family</option>  
                                                    <option value="light_industrial">Light Industrial</option>  
                                                    <option value="heavy_industrial">Heavy Industrial</option>  
                                                    <option value="commercial">Commercial</option>
                                                    <option value="school_K-12">School K-12</option>
                                                    <option value="college">College</option>
                                                    <option value="hospital">Hospital</option>
                                                    <option value="hotel">Hotel</option>
                                                    <option value="airport">Airport</option>
                                                    <option value="freeway/highway">Freeway/Highway</option>
                                                    <option value="other">Other</option>  
                                                     
                                            </select>
                                    </span>
                                </div>
                            </div>
                        </h4> 

                        <h4 id="building_type_input">
                            <div class="row">
                                <strong class="col-lg-6"> Building Type:</strong>
                                <div class="col-lg-6 p-l-10">
                                    <span class="form-group">                                
                                         <select class="form-control" id="buildingTypeId" name="buildingTypeId">
                                                    <option value="">Select Building Type</option>  
                                                    <option value="concrete1to3">Concrete  1-3 Story</option>  
                                                    <option value="concrete4to10">Concrete  4-10 Story</option>  
                                                    <option value="steel_framed1to3">Steel Framed  1-3 Story</option>
                                                    <option value="steel_framed4to10">Steel Framed 4-10 Story</option>  
                                                    <option value="tilt_up">Tilt-Up</option>  
                                                    <option value="wood_stucco">Wood/Stucco</option>  
                                                    <option value="brick">Brick</option>
                                                    <option value="other">Other</option>  
                                            </select>
                                    </span>
                                </div>
                            </div>
                        </h4> 


                        <h4 id="materila_need_input">
                            <div class="row">
                                <strong class="col-lg-6"> Material Needs:</strong>
                                <div class="col-lg-6 p-l-10">
                                    <span class="form-group">                                
                                         <select class="form-control" id="materialNeedsId" name="materialNeedsId[]" multiple>
                                                    <option value="">Select Material Needs</option>  
                                                    <option value="import_soil">Import Soil</option>  
                                                    <option value="export_soil">Export Soil</option>  
                                                    <option value="balance_site">Balance Site</option>  
                                                    <option value="crush_on_site">Crush on Site</option>
                                                    <option value="concrete_haul_Off">Concrete Haul Off</option>      
                                            </select>
                                    </span>
                                </div>
                            </div>
                        </h4> 

                        <h4 id="building_sf_input">
                            <div class="row">
                                <strong class="col-lg-6">Building SF <span class="reqEstrik">*</span>:</strong>
                                <div class="col-lg-6">
                                    <input class="form-control" required pattern="^[\d,]+$" type="text" value="<?php echo set_value('building_sf'); ?>" id="building_sf" name="building_sf" placeholder="Building SF"> 
                                </div>
                            </div>
                        </h4> 

                        

                                       
                    </div>
            </div>
            <input type="hidden" name="buildingSFValHidden" id="buildingSFValHidden">
            <!-- Customer Data end -->
            <div class="card" style="display: none;" id="bidResultArea">
                    <div class="custom-card">
                        <h5 class="card-header"> BID RESULTS  <i style="float: right; font-size: 1.5em !important;" class="fas fa-plus-circle fa-2x" onclick="AddBidOpenPoup();"></i></h5>
                    </div>
                    <div class="card-body" style="padding: 0;">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    
                                    <div class="table-responsive" id="render-list-of-order">
                                        <table class="table table-striped table-bordered first w-100" id="bidResult">
                                            <thead>
                                                <tr>
                                                  <td><b>Building SF</b></td>                                                  
                                                  <td><span id="buildingSFVal"></span></td>
                                                  <td></td>
                                                </tr>
                                                <tr>
                                                  <th>Company Name</th>
                                                  <th>Bid Price</th>
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
                                                          <td><?php echo  $record->bidPrice;?></td>
                                                          <td></td>
                                                         </tr>
                                                        <?php
                                                        $i++;
                                                          }
                                                        }
                                                        ?>
                                                        
                                              </tbody>

                                              <tr style="background-color:orange">
                                                  <th>AMPCO Contracting</th>
                                                  <th>$0</th>
                                                  <th>0.00</th>
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
                                        <label>Bid Price:</label>
                                        <input class="form-control" data-type="currency" type="text" name="bidPrice" id="bidPrice" required=""> 
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

                    


                   <!-- <div id="tastkList" style="min-height: 250px;">

                   </div> -->


                     
                    </div>
                </div>
<!-- Private Notes & Comments start -->
    
        <div class="card">
            <div class="custom-card">
                <h5 class="card-header"> Private Notes & Comments </h5>
            </div>
            <div class="card-body">
                <textarea name="comment" id="comment"></textarea>
            </div>
        </div>
         
<!-- Private Notes & Comments start -->

<!-- Data Tags start -->
     
        <div class="card">
            <div class="custom-card">
                <h5 class="card-header"> Data Tag </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 m-t-10">
                        <span class="form-group customTagClass">
                            <i class="mdi mdi-tag mdi-lg"></i>                                                               
                                <select class="form-control" id="tagId" name="tagId">
                                <option value="0">Select Tag</option>
                                 <?php
                                if(!empty($tags))
                                {
                                    foreach ($tags as $rl)
                                    {
                                        ?>
                                        <option value="<?php echo $rl->id ?>" <?php //if($rl->userId == set_value('name')) {echo "selected=selected";} ?>><?php echo $rl->tagName ?></option>
                                        <?php
                                    }
                                }
                                ?>     
                            </select>
                        </span>
                    </div>                       
                </div>
            </div>
        </div>
       
<!-- Data Tags start -->
       
<!-- Data Tags start -->

<!-- Cross-Selling start -->
  
    <!-- <div class="card">
        <div class="custom-card">
            <h5 class="card-header"> Cross-Selling </h5>
        </div>
        <div class="card-body crossSellingCard">
            <h4>
            <div class="row">
                <strong class="col-lg-6"> Ownership: </strong>                       
                    <span class="p-l-10 col-lg-6">                                   
                       <select class="form-control" id="ownership" name="ownership">
                        <option value="0">Please Select</option>
                             <?php
                            if(!empty($cross_selling))
                            {
                                foreach ($cross_selling as $rl)
                                {
                                    ?>
                                    <option value="<?php echo $rl->ownership ?>" <?php //if($rl->userId == set_value('name')) {echo "selected=selected";} ?>><?php echo $rl->ownership ?></option>
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
                    <strong class="col-lg-6"> Policy Expiration: </strong>                            
                        <span class="p-l-10 col-lg-6"> 
                            <input class="form-control" type="text"  id="policyExp" name="policyExp">
                        </span>                            
                </div>
            </h4>
            <h4>
                <div class="row">
                    <strong class="col-lg-6"> Business Owner? </strong>
                        <span class="p-l-10 col-lg-6">                                
                            <select class="form-control" id="businessOwner" name="businessOwner">
                                <option value="0">Please Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </span>                           
                </div>
            </h4>
        </div>
    </div> -->
      
<!-- Cross-Selling start -->
        </div>
        <div class="col-lg-6">
        <!-- Option-In start -->
                <div class="card" style="display: none;">
                    <div class="custom-card">
                        <h5 class="card-header"> Option-In </h5>
                    </div>
                    <div class="card-body">
                        <div class="row p-t-20 p-b-20">
                            <div class="col-lg-4">
                                <label class="custom-control custom-checkbox custom-control-inline" style="display: none;">
                                    <input type="checkbox" name="optionIn[0]" id="optionIn" value="sms" class="custom-control-input sms"><span class="custom-control-label">SMS</span>
                                </label>
                                <div class="blue-btn disabledbutton"  id="chksms"><a href="#" class="btn btn-rounded bg-info" style="width: 100%;"> Text </a></div>
                            </div>
                            <div class="col-lg-4">
                                <label class="custom-control custom-checkbox custom-control-inline" style="display: none;">
                                    <input type="checkbox" name="optionIn[1]" id="optionIn" value="call" class="custom-control-input call"><span class="custom-control-label">Call</span>
                                </label>
                                <div class="blue-btn disabledbuttoncall" id="chkcall"><a href="#" class="btn btn-rounded bg-info" style="width: 100%;"> Call </a></div>
                            </div>
                            <div class="col-lg-4">
                                <label class="custom-control custom-checkbox custom-control-inline" style="display: none;">
                                    <input type="checkbox" name="optionIn[2]" value="email" id="optionIn" class="custom-control-input emails"><span class="custom-control-label">Email</span>
                                </label>
                                <div class="blue-btn disabledbuttonemail" id="chkemail"><a href="#" class="btn btn-rounded bg-info" style="width: 100%;"> Email </a></div>
                            </div>
                            <div class="col-lg-4" style="display: none;">
                                <label class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" name="optionIn[3]" value="other" id="optionIn" class="custom-control-input other"><span class="custom-control-label">Other</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Project Clients  start -->
                <div class="card">
                    <div class="custom-card"><h5 class="card-header"> Business </h5></div>
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
                                            <a class="nav-link active" id="newclient-tab" data-toggle="tab" href="#newclient" role="tab" aria-controls="newclient" aria-selected="true">New Business</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="existclient-tab" data-toggle="tab" href="#existclient" role="tab" aria-controls="existclient" aria-selected="false">Existing Business</a>
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
                                                        <label>Business Address:</label>
                                                        <input class="form-control" required type="text" value="" id="addressAutocomplete" name="buisnessAddress" onFocus="geolocate()">
                                                        <span style="color: red; display: none;" id="addressError">Please enter address.</span>
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
                                                        <option value="0">Select Business</option>
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
                              <div class="modal-footer"></div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 text-right">
                                <p><i class="fas fa-plus-circle fa-2x" onclick="AddClientOpenPoup();"></i></p>
                            </div>
                        </div>
                       <div id="clientList" style="min-height: 250px;"></div>
                    </div>
                </div>
                <!-- Project Clients end -->

                <!-- Project Contacts  start -->
                <div class="card">
                    <div class="custom-card"><h5 class="card-header"> Contacts </h5></div>
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
                                                            <!-- <label>Make Primary Contact:</label>
                                                            <input class="form-control1" type="checkbox" value="1" name="primary_contact" id="conatctPrimary"> --> 
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
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <p><i class="fas fa-plus-circle fa-2x" onclick="AddContactOpenPoup();"></i></p>
                            </div>
                        </div>
                        <div id="contactList" style="min-height: 250px;"></div>
                    </div>
                </div>
                <!-- Project Contacts end -->

               <div class="card communicationClass" style="display: none;">
                    <div class="custom-card">
                        <h5 class="card-header"> Communications </h5>
                    </div>
                    <div class="card-body">
                        <div class="row" style="min-height: 230px;">
                            <div class="col-sm-12">
                                <div class="">
                                    No communication available.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Files start -->
                <div class="card fileClass">
                    <div class="custom-card">
                        <h5 class="card-header"> Files </h5>
                    </div>
                    <div class="card-body">                        
                        <div class="row" style="min-height: 230px;">
                            <div class="col-lg-12">
                                <div class="col-lg-12 p-0">
                                    <div class="file-chooser btn-info btn-file btnBrowssrBtn">
                                       <i class="fa fa-upload"></i> &nbsp;&nbsp; Upload Support File: &nbsp;<span>Browse </span>
                                       <input class="file-chooser__input" type="file" name="image[]"/>
                                    </div>
                                    <div class="ScrollClassDynamic1">
                                        <div class="fileClass file-uploader__message-area">

                                        </div>
                                    </div>
                                    </div>
                                <!--<br>
                                <p>Note: you can select multiple file using ctrl button</p>-->
                            </div>
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
                                <div class="col-lg-12">
                                    <div class="col-sm-12 form-group">
                                        <label>Message:</label>
                                        <input class="form-control" type="text" name="taskMsg" id="taskMsg"> 
                                        <span style="color: red; display: none;" id="taskMsgError">Please enter message.</span>
                                    </div>

                                    <div class="col-sm-12 form-group">
                                        <label>Task Date:</label>
                                        <input class="form-control" type="text" name="taskExpDate" id="taskExpDate" required=""> 
                                        <span style="color: red; display: none;" id="taskExpDateError">Please select expiry date.</span>
                                    </div>
                                </div>
                            </div>
                          </div>

                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <a href="javascript:void(0);" onclick="SaveTask();" class="confirm btn btn-sm btn-danger">Save</a>
                            <button type="button" class="btn btn-sm btn-default bg-warning" data-dismiss="modal">Close</button>
                          </div>

                        </div>
                      </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-right">
                            <p><i class="fas fa-plus-circle fa-2x" onclick="AddTaskOpenPoup();"></i></p>
                        </div>
                    </div>


                   <div id="tastkList" style="min-height: 250px;">

                   </div>


                     
                    </div>
                </div>
                <!-- My Tasks / Follow-Up end -->

            
        <!-- Option-In end -->
        </div>
         
    </div>
   <div class="col-sm-12 buttonFooter">
         <div class="col-sm-12 buttonFooterInner">
            <div class="col-6 m-t-20 m-b-20 bigBtnsDiv">
              <input type="submit" class="btn btn-rounded bg-info save_form" value="Submit" />
            </div>
            <div class="col-6 m-t-20 m-b-20 bigBtnsDiv">
                <a href="<?php echo base_url(); ?>projectListing" class="btn btn-rounded bg-warning"> Cancel </a>
            </div>
        </div>
    </div>
    <input type="hidden" name="taskCombinedValues" id="taskCombinedValues">
    <input type="hidden" name="TaskRandomID" id="TaskRandomID">    
    <input type="hidden" name="TaskCreateType" id="TaskCreateType">   

    <input type="hidden" name="contactCombinedValues" id="contactCombinedValues"> 
    <input type="hidden" name="ContactRandomID" id="ContactRandomID">  
    <input type="hidden" name="ContactCreateType" id="ContactCreateType">

    <input type="hidden" name="clientCombinedValues" id="clientCombinedValues"> 
    <input type="hidden" name="ClientRandomID" id="ClientRandomID"> 
    <input type="hidden" name="ClientCreateType" id="ClientCreateType">

<input type="hidden" name="bidRandomIDVal" id="bidRandomIDVal"> 
<input type="hidden" name="bidCombinedValues" id="bidCombinedValues"> 
    <input type="hidden" name="lostnote" id="lostnote">

    <input type="hidden" name="is_primary_contact" data-contact="" id="is_primary_contact" value="">

</form>
            </div>
            <!-- Filter Criteria Form end -->
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
<!---------Mapping Popup---------->


<script src="<?php echo base_url(); ?>assets/js/addLead.js" type="text/javascript"></script>
<script src="//cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/select2/css/select2.css">
<script src="<?php echo base_url(); ?>assets/vendor/select2/js/select2.min.js"></script>

<script>
    $(document).ready(function(){
        // Initialize select2
        $("#sales").select2();
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
        $('select#stageId').on('change', function (e) {
            var optionSelected = $("option:selected", this);
            var valueSelected = this.value;
            
            if(valueSelected == 2){
                $('#autocomplete').removeAttr('required');
                $('#due_date').removeAttr('required');
                $('#due_time').removeAttr('required');
                $('#est_start_date').removeAttr('required');
                $('#building_sf').removeAttr('required');
                $('#filesystem_id').removeAttr('required');
                $('#filesystem_id-error').hide();
                $('#autocomplete-error').hide();
                $('#due_date-error').hide();
                $('#due_time-error').hide();
                $('#est_start_date-error').hide();
                $('#building_sf-error').hide();
                $('.reqEstrik').hide();
                
                $('#contract_val_input').hide();
                $('#budget_input').hide();
                $('#wages_input').hide();
                $('#estimator_input').hide();
                $('#bid_date_input').hide();
                $('#bid_time_input').hide();
                $('#job_walk_input').hide();
                $('#bid_form_input').hide();


                $('#budget_price_input').hide();
                $('#reports_input').hide();
                $('#market_type_input').hide();
                $('#building_type_input').hide();


                $('#materila_need_input').hide();
                $('#building_sf_input').hide();
                
            }else{
                $('#autocomplete').attr('required', '');
                $('#due_date').attr('required', '');
                $('#due_time').attr('required', '');
                $('#est_start_date').attr('required', '');
                $('#building_sf').attr('required', '');
                $('#filesystem_id').attr('required', '');
                $('#filesystem_id-error').show();
                $('#autocomplete-error').show();
                $('#due_date-error').show();
                $('#due_time-error').show();
                $('#est_start_date-error').show();
                $('#building_sf-error').show();
                $('.reqEstrik').show();

                $('#contract_val_input').show();
                $('#budget_input').show();
                $('#wages_input').show();
                $('#estimator_input').show();
                $('#bid_date_input').show();
                $('#bid_time_input').show();
                $('#job_walk_input').show();
                $('#bid_form_input').show();


                $('#budget_price_input').show();
                $('#reports_input').show();
                $('#market_type_input').show();
                $('#building_type_input').show();


                $('#materila_need_input').show();
                $('#building_sf_input').show();

            }
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
    //Change number in USD Currency
    $("input[data-type='currency']").on({
        keyup: function() { 
          formatCurrency($(this));
        },
        blur: function() { 
          formatCurrency($(this), "blur");
        }
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

<script>
 CKEDITOR.replace( 'comment' );
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $(".save_form").click(function(){
            if( $('#addLead').valid() ) {
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
  $( function() {
    $( "#datepicker" ).datepicker();
    $( "#policyExp" ).datepicker();
    $( "#rfi_deadline" ).datepicker();
    $( "#est_start_date" ).datepicker();
    $( "#due_date" ).datepicker();
    //$("#job_walk_time").datepicker({maxDate: new Date()});
    $("#job_walk_time").datepicker();
    $( "#job_time").timepicker();
    
    $( "#due_time").timepicker();

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
     
  } );
  </script>



  <!-- Add/edit Tasl -->
<script>

function AddBidOpenPoup(){

    var a=$("#building_sf").val();
    a=a.replace(/\,/g,''); // 1125, but a string, so convert it to number
    a=parseInt(a,10);

    if(!isNaN(a) && a !="" && a !="" && a > 0){
        $('#myModalBid').modal('show'); 
        //Assign fields values
        $("#companyName").val('');
        $("#bidPrice").val('');
        //Hide error msg
        $("#bidMsgError").hide();
        $("#companyNameError").hide();   
        //$("#TaskCreateType").val('1');
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
   //$('#assigned_to').empty();


    $("#assignedTo").val($("#target option:first").val());
    $("#assignedToError").hide();
    $("#contactTab").show();

    $('#myModalContacts').modal('show'); 
    //Assign fields values
    $("#contactName").val('');
    $("#conatctEmail").val('');
    $("#conatctPh").val('');
    $("#conatctPh2").val('');
    $("#conatctCompany").val('');
    $("#conatctPrimary").prop("checked", false );
    //Hide error msg
    $("#contactNameError").hide();
    $("#conatctEmailError").hide(); 
    $("#conatctPhError").hide();
    $("#conatctPhError2").hide();
    $("#conatctCompanyError").hide();   
    $("#ContactCreateType").val('1');
    $("#contactAddress").val('');
    $("#contactAddressError").hide();
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
    $("#buisnessType").val('');
    $("#contact_buisness_phone").val('');


    $("#addressAutocomplete").val('');
    //Hide error msg
    $("#clientNameError").hide(); 
    $("#addressError").hide();
    $("#conatctBuisnessPhError").hide();  
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

                //var TaskCreateType  = $("#TaskCreateType").val();
                if(TaskCreateType==2){
                    //Hide task html div 
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
                taskRandomID : randomNum, 
                taskMsg      : taskMsg, 
                taskExpDate  : taskExpDate
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
        str+='<div><a href="javascript:void(0);" class="btn btn-rounded bg-warning btn-xs" onclick="EditTaskOpenPoup(\''+randomNum+'\',\''+taskMsg+'\',\''+taskExpDate+'\');"> <i class="fa fa-pencil-alt"></i> </a> ';
        str+='<a href="javascript:void(0);" class="btn btn-rounded bg-danger btn-xs" onclick="RemoveTask(\''+randomNum+'\');"> <i class="fa fa-trash-alt"></i> </a></div>';
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
        $("#"+randomNum).hide();
          swal("Deleted!", "Your task has been deleted.", "success");
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
    var bidPrice  = $("#bidPrice").val();
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
      data:{bidRandomId :bidRandomIDVal,isUpdate:0},
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
        var contactName   = $("#contactName").val();
        var conatctEmail  = $("#conatctEmail").val();
        var conatctAddress  = $("#contactAddress").val();
        var assignedTo  = $("#assignedTo").val();
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
                            conatctPh = value.contact_phone;

                            conatctPh2 = value.contact_phone2;
                            conatctCompany = value.contact_company;
                            contactRand = value.contactRandomId;
                            assignedTo = "";
                        });
                        
                    }else if(data.status == false) { 
                        contactName = "";
                        cconatctEmail = "";
                        conatctPh = "";
                        conatctPh2 = "";
                        conatctCompany = "";
                        contactRand = "";
                        assignedTo = "";
                    }
                }        
            });
        }else{
            temp = 0;
            errorID = "#ExcontactNameError";      
        }
    }
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
                contactAddress : conatctAddress,
                conatctEmail : conatctEmail,
                conatctPh     : conatctPh, 
                conatctPh2     : conatctPh2, 
                conatctCompany : conatctCompany,
                conatctPrimary : conatct_Primary,
                contactRandomId: randomNum,
                assignedTo: assignedTo
            });
            contactArr.join();           

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
                conatctEmail : conatctEmail,
                contactAddress : conatctAddress,
                conatctPh     : conatctPh, 
                conatctPh2     : conatctPh2,
                conatctCompany : conatctCompany,
                conatctPrimary : conatct_Primary,
                contactRandomId: randomNum,
                assignedTo: assignedTo
            });
            //make array
            myJsonObject.join();    

            //array to string
            var contactArrString = JSON.stringify(myJsonObject);
            $("#contactCombinedValues").val(contactArrString);
            
        }

        //Close po up
        $('#myModalContacts').modal('toggle');
        
        //alert('test');
        // var str='';
        // str+='<div class="row" id="'+randomNum+'">';
        // str+='<div class="col-lg-3">';
        // str+='<p>'+clientName+'</p>';
        // str+='</div>';

        // str+='<div class="col-lg-3">';
        // str+='<p>'+contactName+'</p>';
        // str+='</div>';

        // str+='<div class="col-lg-4 p-0">';
        // str+='<p class="mb-0">'+conatctEmail+'</p>';
        // str+='<p>'+conatctPh+'</p>';
        // str+='<p>'+conatctPh2+'</p>';
        // str+='</div>';

        

        // // str+='<div class="col-lg-2">';
        // // str+='<p>'+conatctCompany+'</p>';
        // // str+='</div>';

        // str+='<div class="col-lg-2 p-0">';
        // str+='<div><a href="javascript:void(0);" style="font-size: 10px;" class="btn btn-rounded bg-warning btn-xs" onclick="EditContactOpenPoup(\''+randomNum+'\',\''+clientId+'\',\''+contactName+'\',\''+conatctEmail+'\',\''+conatctPh+'\',\''+conatctPh2+'\',\''+conatctCompany+'\',\''+conatctPrimary+'\');"> <i class="fa fa-pencil-alt"></i> </a> ';
        // str+='<a href="javascript:void(0);" style="font-size: 10px;" class="btn btn-rounded bg-danger btn-xs" onclick="RemoveContact(\''+randomNum+'\');"> <i class="fa fa-trash-alt"></i> </a></div>';
        // str+='</div>';
        
        // str+='</div>';

        var str='';
        str+='<div class="row detailsRowBox" id="'+randomNum+'">';
        str+='<div><a href="javascript:void(0);" style="font-size:10px;" class="btn edtiBtndtlRow btn-rounded bg-warning btn-xs" onclick="EditContactOpenPoup(\''+randomNum+'\',\''+clientId+'\',\''+contactName+'\',\''+conatctAddress+'\',\''+conatctEmail+'\',\''+conatctPh+'\',\''+conatctPh2+'\',\''+conatctCompany+'\',\''+conatctPrimary+'\');"> <i class="fa fa-pencil-alt"></i> </a> ';
        str+='<a href="javascript:void(0);" style="font-size:10px;" class="btn deleteBtndtlRow btn-rounded bg-danger btn-xs" onclick="RemoveContact(\''+randomNum+'\');"> <i class="fa fa-trash-alt"></i> </a></div>';
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
      text: "Your will not be able to recover this contact!",
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
          swal("Deleted!", "Your contact has been deleted.", "success");
    });
}

function EditContactOpenPoup(randomNum,clientId,contactName,contactAddress,conatctEmail,conatctPh,conatctPh2,conatctCompany,conatctPrimary){   

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


    //Show popup 
    $('#myModalContacts').modal('show'); 
    //Assign fields values
    $("#contactName").val(contactName);
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

    //Hide error msg
    $("#contactNameError").hide();
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
                data: { clientName : clientName, buisnessType:buisnessType,is_update:is_update,client_id:client_id,phNo:phNo,address:address} ,
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
                //var randomNum = "client-"+Math.floor((Math.random() * 100000) + 1);
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

        //     var str='';
        // str+='<div class="row" id="'+randomNum+'">';
        // str+='<div class="col-lg-4">';
        // str+='<p>'+clientName+'</p>';
        // str+='</div>';
        //  str+='<div class="col-lg-5">';
        // str+='<p>'+buisnessType+'</p>';
        // str+='</div>';
        // str+='<div class="col-lg-5">';
        // str+='<p>'+phNo+'</p>';
        // str+='</div>';
        // str+='<div class="col-lg-5">';
        // str+='<p>'+address+'</p>';
        // str+='</div>';

       

        //     str+='<div class="col-lg-3">';
        //     str+='<div><a href="javascript:void(0);" class="btn btn-rounded bg-warning btn-xs" onclick="EditClientOpenPoup(\''+randomNum+'\',\''+clientName+'\',\''+buisnessType+'\',\''+phNo+'\',\''+address+'\');"> <i class="fa fa-pencil-alt"></i> </a> ';
        //     str+='<a href="javascript:void(0);" class="btn btn-rounded bg-danger btn-xs" onclick="RemoveClient(\''+randomNum+'\');"> <i class="fa fa-trash-alt"></i> </a></div>';
        //     str+='</div>';
            
        //     str+='</div>';

            var str='';
            str+='<div class="row detailsRowBox" id="'+randomNum+'">';
            str+='<div><a href="javascript:void(0);" style="font-size:10px;" class="btn edtiBtndtlRow btn-rounded bg-warning btn-xs" onclick="EditClientOpenPoup(\''+randomNum+'\',\''+clientName+'\',\''+buisnessType+'\',\''+phNo+'\',\''+address+'\');"> <i class="fa fa-pencil-alt"></i> </a> ';
            str+='<a href="javascript:void(0);" style="font-size:10px;" class="btn deleteBtndtlRow btn-rounded bg-danger btn-xs" onclick="RemoveClient(\''+randomNum+'\');"> <i class="fa fa-trash-alt"></i> </a></div>';
            str+='<div class="col-lg-12">';
            str+='<p class="mb-2"><i class="fa fa-user"></i> '+clientName+'</p>';
            str+='<p class="mb-2"><i class="fa fa-briefcase"></i> '+buisnessType+'</p>';
            str+='<p class="mb-2"><i class="fa fa-phone"></i> '+phNo+'</p>';
            str+='<p class="mb-0"><i class="fa fa-map-marker"></i> '+address+'</p>';
            str+='</div>';

            //Append row
            $("#clientList").append(str);

            //Blank fields
            $("#clientName").val('');
        }
    }
}

function EditClientOpenPoup(randomNum,clientName,address){    

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
    $("#addressAutocomplete").val(address);
    //Hide error msg
    $("#clientNameError").hide();
    $("#ClientCreateType").val('2');
}

function RemoveClient(randomNum){
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
        var clientCombinedValues    = $("#clientCombinedValues").val();
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
          swal("Deleted!", "Your client has been deleted.", "success");
    });
}

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

        // autocomplete2 = new google.maps.places.Autocomplete(document.getElementById('autocomplete2'), { types: [ 'geocode' ] });
        // google.maps.event.addListener(autocomplete2, 'place_changed', function() {
        //   fillInAddress();
        // });

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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXnYIF2RRd5COYQasKvQdAK6Pa7jKl5Oc&libraries=places&callback=initAutocomplete"
        async defer></script>
    <script type="text/javascript">
        //jQuery plugin
(function( $ ) {
   
   $.fn.uploader = function( options ) {
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
         //$('.file-chooser').append('<input class="file-chooser__input" type="file" name="image[]" multiple="multiple" />');          
       
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
document.getElementById('building_sf').addEventListener('input', event =>
  event.target.value = (parseInt(event.target.value.replace(/[^\d]+/gi, '')) || 0).toLocaleString('en-US')
);

$(document).ready(function() {
   
     $('#bidResult').DataTable( {
        "scrollY": 200    
    } );
   
} );


var timeoutId = null;

function updateIt()
{
    
    get_cat_list('f');
}

$("#building_sf").keyup(function() {
    $("#buildingSFVal").html("<b>"+$(this).val()+"</b>");
    $("#buildingSFValHidden").val($(this).val());
    if (timeoutId != null)
        window.clearTimeout(timeoutId);
    timeoutId = window.setTimeout(updateIt, 500);
    
  });
</script>

<style type="text/css">
    #render-list-of-order .dataTables_scrollHeadInner{
        width: 100%;
        min-width: 100%;
    }
</style>