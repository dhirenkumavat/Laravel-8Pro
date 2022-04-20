<script>
    setTimeout(function() {
    $('.alert').fadeOut('fast');
}, 20000); // <-- time in milliseconds
</script>

<div class="dashboard-wrapper" id="page-content-wrapper">
        <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">
                <!-- ============================================================== -->
                <div class="ecommerce-widget project_table">
            <!-- pageheader -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-0">
                    <div class="page-header">
                        <h2 class="pageheader-title">Filter Criteria </h2>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end pageheader -->

            <div class="col-xs-6 text-left">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> x </button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> x </button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
             <!-- <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> x </button></div>'); ?>
                    </div>
                </div> -->
            </div>
        <!-- Filter Criteria Form start -->
        <div class="card">
            <!-- <div class="custom-card"><h5 class="card-header"> Pending Tasks </h5></div> -->
                <div class="card-body">
                        <div class="form-row">
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-4">
                                <label>Job #</label>
                                <input type="text" name="filesystem_id"  class="form-control" id="filesystem_id" placeholder="Job #">
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-4">
                                <label>Job Name</label>
                                <input type="text" name="project_name"  class="form-control" id="project_name" placeholder="Job Name">
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-4">
                                <label>Estimator</label>
                                <select class="form-control required" id="estimator" name="estimator[]" multiple>
                                    <option value="0">Select Estimator</option>
                                    <?php                                    
                                        if(!empty($userlist))
                                        {
                                            foreach ($userlist as $rl)
                                            {
                                                ?>
                                                <option value="<?php echo $rl->userId ?>"><?php echo $rl->name ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12 mb-4">
                                <label>Sales Associate</label>
                                <select class="form-control required" id="sales" name="sales">
                                    <option value="0">Select Sales Associate</option>
                                    <?php                                    
                                        if(!empty($userlist))
                                        {
                                            foreach ($userlist as $rl)
                                            {
                                                ?>
                                                <option value="<?php echo $rl->email ?>"><?php echo $rl->name ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                </select>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12 mb-4">
                                <label>Admin</label>
                                <select class="form-control required" id="admin" name="admin">
                                    <option value="0">Select Admin</option>
                                    <?php                                    
                                        if(!empty($userlist))
                                        {
                                            foreach ($userlist as $rl)
                                            {
                                                ?>
                                                <option value="<?php echo $rl->userId ?>"><?php echo $rl->name ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                </select>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12 mb-4">
                                <label>Business Name</label>
                                <input type="text" name="client_name" class="form-control" id="client_name" placeholder="Business Name">
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12 mb-4">
                                <label>Notes</label>
                                <input type="text" name="notes" class="form-control" id="notes" placeholder="Notes">
                            </div>
                        </div>
                        <div class="form-row">
                            
                            <div class="form-group col-xl-2 mb-4">
                                <label>Job Type</label>
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
                            </div>
                            <?php 
                            if($this->uri->segment(1) == "completedProject"){?>
                            <!-- <div class="form-group col-xl-2 mb-4">
                                <label>Project Manager</label>
                                <select class="form-control required" id="sales_rep" name="sales_rep">
                                    <option value="0">Select Project M.</option>
                                    <?php                                    
                                        if(!empty($userlist))
                                        {
                                            foreach ($userlist as $rl)
                                            {
                                                ?>
                                                <option value="<?php echo $rl->userId ?>"><?php echo $rl->name ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                </select>
                            </div> -->
                            <?php } ?>
                            <div class="form-group col-xl-2 mb-4">
                                <label>Stage</label>
                                <select class="form-control required" id="stageId" name="stageId">
                                    <option value="0">Select Stages</option>
                                     <?php
                                    if(!empty($stages))
                                   {
                                        foreach ($stages as $rl)
                                       {
                                            ?>
                                             <option <?php if($project_list_stage == $rl->stageId){?> selected="selected"  <?php } ?> value="<?php echo $rl->stageId; ?>"><?php echo $rl->stageName; ?></option> 
                                            <?php
                                        }
                                    }
                                    ?>        
                                </select>
                            </div> 
                            <div class="form-group col-xl-2 mb-4">
                                <label>Tag</label>
                                <select class="form-control" id="tagId" name="tagId">
                                    <option value="0">Select Tag</option>
                                     <?php
                                    if(!empty($tags))
                                    {
                                        foreach ($tags as $rl)
                                        {
                                            ?>
                                            <option value="<?php echo $rl->id ?>"><?php echo $rl->tagName ?></option>
                                            <?php
                                        }
                                    }
                                    ?>     
                                </select>
                            </div>
                            <?php if($project_list_stage != 11){ ?>
                            <div class="form-group col-xl-4 mb-4">
                                <div class="row"> 
                                    <label style="padding-left: 16px;">Budget Price</label>
                                </div>
                                <div class="row"> 
                                    <div class="col-xl-4 mb-4">
                                        <select class="form-control" id="bid_oprt" name="bid_oprt">
                                            <option value="greater"> > </option>
                                            <option value="less"> < </option>
                                            <option value="greater_equal"> >= </option>
                                            <option value="less_equal"> <= </option>
                                        </select>
                                    </div>
                                    <div class="col-xl-8 mb-4">
                                        <input type="text" name="bid_price" data-type="currency" class="form-control" id="bid_price" placeholder="Budget Price">
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                        <div class="form-row">
                            <div class="row">                        
                                <div class="form-group col-sm-2 mb-4">
                                    <label>Scope :</label>                                
                                </div> 
                                <div class="form-group col-sm-10 mb-8">
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" name="scope[]" id="scope_all" value="all" class="custom-control-input "><span class="custom-control-label">All</span>
                                    </label>    
                               
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" name="scope[]" id="scope_abatement" value="abatement" class="custom-control-input "><span class="custom-control-label">Abatement</span>
                                    </label>    
                               
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" name="scope[]" id="scope_interior_demolition" value="interior_demolition" class="custom-control-input "><span class="custom-control-label">Interior Demolition</span>
                                    </label>      
                               
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" name="scope[]" id="scope_site_demolition" value="site_demolition" class="custom-control-input "><span class="custom-control-label">Site Demolition</span>
                                    </label>      
                               
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" name="scope[]" value="earthwork" id="scope_earthwork" class="custom-control-input "><span class="custom-control-label">Earthwork</span>
                                    </label>     
                               
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" name="scope[]" value="other" id="scope_other" class="custom-control-input "><span class="custom-control-label">Other</span>
                                    </label>     
                                </div>                        
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xl-2 col-lg-2 col-md-2">
                                 <label class="clearfix">&nbsp;</label><br>
                                 <button name="filter_order_filter" type="button" class="btn btn-rounded bg-info pd-6-30" id="filter-order-filter" value="filter"><i class="fa fa-search fa-fw"></i></button>  
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-4" style="display: none;">
                                <label>First Name</label>
                                <input type="text" name="first_name"  class="form-control" id="first_name" placeholder="First Name">
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-4" style="display: none;">
                                <label>Last Name</label>
                                <input type="text" name="last_name"  class="form-control" id="last_name" placeholder="Last Name">
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-4 phoneinput" style="display: none;">
                                <label>Phone Number</label>
                                <input type="text" name="phone_no" maxlength="10" class="form-control" id="phone_no" placeholder="Phone Number">
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-4" style="display: none;">
                                <label>Email Address</label>
                                <input type="text" name="email"  class="form-control" id="email" placeholder="Email Address">
                            </div>
                        </div>
                </div>
        </div>
        <!-- Filter Criteria Form end -->
        <div class="card">
            <!-- <div class="custom-card"><h5 class="card-header"> Pending Tasks </h5></div> -->
                <div class="card-body">

                    <div class="row LeadsBtnclass">
                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 p-0">
                            <h4 class="actionforallhead"> Actions for All: </h4>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
                            <a href="<?php echo base_url(); ?>exportExcel" class="btn btn-rounded bg-info btn-block m-t-b"> Export Projects </a>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
                            <a href="<?php echo base_url() ?>viewleadListing" class="btn btn-rounded bg-info btn-block m-t-b"> View Pipeline </a>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
                            <a href="#" onclick="sendText();" class="btn btn-rounded bg-info btn-block m-t-b"> Send Text </a>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
                            <a href="javascript:void(0);" onclick="sendMail();" class="btn btn-rounded bg-info btn-block  m-t-b"> Send Email </a>
                        </div>
                        <!-- <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6" style="display: none;">
                            <a href="<?php echo base_url() ?>scheduleTask/" class="btn btn-rounded bg-info btn-block m-t-b"> Schedule Tasks </a>
                        </div> -->
                    </div>
                        <div class="col-xl-12 col-lg-4 col-md-12 col-sm-12">
                            <a href="<?php echo base_url(); ?>addNewProject" class="btn btn-rounded bg-warning m-t-b float-right m-b-0"> <i class="fa fa-plus"></i> </a>
                        </div>

                    <!-- <div class="custom-card"><h5 class="card-header"> Pending Tasks </h5></div> -->
                        <div class="row">
                            <input type="hidden" id="project_list_stage" name="project_list_stage" value="<?php echo $project_list_stage; ?>">
                            <?php
                                    
                                    $job_walk_array = array('12','10','13');
                                    $hide_job_walk = "";
                                    if(in_array($project_list_stage, $job_walk_array)){
                                        $hide_job_walk = "display:none;";
                                    }
                                    // else{
                                    //     $hide_job_walk = "display:block;";
                                    // }

                                    $bidprice_array = array('12','10','13');
                                    if(in_array($project_list_stage, $bidprice_array)){
                                        $is_show_bidprice = "display:block;";
                                    }else{
                                        $is_show_bidprice = "display:none;";
                                    }
                                ?>      
                            <div class="table-responsive" id="render-list-of-order">   
                                                             
                                  <table class="table table-striped table-bordered first ProjectTable resizable" id="ProjectTable"  cellspacing="0">
                                    <thead>
                                        <tr class="dnd-moved">
                                            <th>
                                                <input type="checkbox" class="checkboxAll" id="select_all" onclick="selectAllChkbox('all');">
                                            </th>
                                            <th class="text-center">Action</th>
                                            <th>Map</th>
                                            <th>Job Type</th>
                                            <th>Job #</th>
                                            <th>Company</th>
                                            <th style="<?php echo $is_show_bidprice; ?>">Budget Price</th>
                                            <?php if($project_list_stage == 11){ ?>
                                                <th>Scope</th>
                                            <?php }?>
                                            <th>Job Name</th>
                                            <th>Contract Value</th>
                                            <th>Bid Date</th>
                                            <th>Notes</th>

                                            <th style="<?php echo $hide_job_walk; ?>">Job Walk</th>

                                            <!-- <th>Main Contact</th> -->
                                            <th>Job Site Address</th>
                                            <th>Estimator</th>
                                        </tr>
                                    </thead>
                                   <tbody class="row_positions">
                                        <?php
                                            if(!empty($leadRecords))
                                            {
                                                foreach($leadRecords as $record)
                                                { //print_r($record);
                                                    $datetime1 = new DateTime();
                                                    $datetime2 = new DateTime($record->updatedDtm);
                                                    $interval = $datetime1->diff($datetime2);
                                            ?>
                                        <tr id="<?php echo $record->projectId; ?>" class="dnd-moved">
                                            <!-- <input type="hidden" value="<?php echo $record->projectId; ?>" id="proj" name="proj"> -->
                                            <td><input type="checkbox" class="checkbox" name="CalChkBox" value="<?php echo $record->projectId; ?>" onclick="selectAllChkbox('single');"></td>
                                            <td class="text-center">   
                                                <a title="Status" onclick="statusModal('<?php echo $record->projectId; ?>')" href="javascript:void(0)" class="btn btn-rounded bg-warning btn-xs"> <i class="fa fa-pencil1-alt">S</i> </a>  
                                                <a title="Edit" href="<?php echo base_url().'editProject/'.$record->projectId; ?>" class="btn btn-rounded bg-warning btn-xs"> <i class="fa fa-pencil-alt"></i> </a>
                                                <a title="Delete" href="#" data-leadid="<?php echo $record->projectId; ?>" onClick="delete_project(<?php echo $record->projectId; ?>)" class="btn btn-rounded bg-danger deleteProject btn-xs"> <i class="fa fa-trash-alt"></i> </a>
                                                <a title="Copy" href="#" data-leadid="<?php echo $record->projectId; ?>" onClick="copy_project(<?php echo $record->projectId; ?>)" class="btn btn-rounded bg-danger copyLead btn-xs"> <i class="fa fa-copy"></i> </a>
                                            </td>
                                            <td>
                                                <a href="http://maps.google.com/maps?z=12&t=k&q=<?php echo $record->address; ?>" target="_blank" class="licenseVerifyLink" title="">View</a>
                                            </td>
                                            <td>
                                                <span class="job_color">
                                                    <?php if($record->is_priority == 1){ ?><i class="fa fa-bullseye" aria-hidden="true"></i><?php }?> <i data-html="true" data-toggle="tooltip" title="<?php echo $record->jobType ?>" style="background-color: <?php echo $record->color ?>;">&nbsp;</i>
                                                </span>
                                            </td>

                                            <td>
                                                <span id="filesystem_id_<?php echo $record->projectId; ?>"></span>
                                                <p class="p-l-10" id="edit_filesystem_id_<?php echo $record->projectId; ?>" onclick="inlineEdit('filesystem_id','<?php echo $record->filesystem_id ?>','<?php echo $record->projectId; ?>')">
                                                    <?php echo $record->filesystem_id ?>
                                                </p>
                                            </td>

                                            <td>
                                                <span id="company_<?php echo $record->projectId; ?>"></span>
                                                <p class="p-l-10">
                                                    <?php if($record->company == 'north'){ ?>
                                                    <a title="Edit" style="color:#006400" href="<?php echo base_url().'editProject/'.$record->projectId; ?>"><?php echo ucfirst($record->company); ?></a>
                                                <?php }else{ ?>
                                                    <a title="Edit"  href="<?php echo base_url().'editProject/'.$record->projectId; ?>"><?php echo ucfirst($record->company); ?></a>
                                                <?php } ?>
                                                </p>
                                                
                                            </td>


                                            <td style="<?php echo $is_show_bidprice; ?>">
                                                <?php
                                                    if($record->bid_price != "" || $record->bid_price != NULL){
                                                        setlocale(LC_MONETARY, 'en_US');
                                                        $bidprice = money_format('%.0n', $record->bid_price) ;
                                                    }else{
                                                        $bidprice = "";
                                                    }

                                                    echo $bidprice;
                                                ?>
                                            </td>

                                            <?php if($project_list_stage == 11){ 
                                                $temp_scope = array();
                                                if(!empty($record->scope)){
                                                    $scopes = explode(",",$record->scope);
                                                    for($i = 0; $i<count($scopes); $i++){
                                                        if($scopes[$i] == "abatement"){
                                                            $temp_scope['abatement'] = "A";
                                                        }
                                                        if($scopes[$i] == "interior_demolition"){
                                                            $temp_scope['interior_demolition'] = "ID";
                                                        }
                                                        if($scopes[$i] == "site_demolition"){
                                                            $temp_scope['site_demolition'] = "SD";
                                                        }
                                                        if($scopes[$i] == "earthwork"){
                                                            $temp_scope['earthwork'] = "E";
                                                        }
                                                        if($scopes[$i] == "other"){
                                                            $temp_scope['other'] = "O";
                                                        }
                                                    }
                                                }
                                            ?>
                                                <td>
                                                    <?php if(!empty($temp_scope)){ 
                                                        echo implode(",", $temp_scope);
                                                     } ?>
                                                </td>
                                            <?php }?>

                                            


                                            <td>
                                                <span id="projectName_<?php echo $record->projectId; ?>"></span>
                                                <p class="p-l-10" id="edit_projectName_<?php echo $record->projectId; ?>" onclick="inlineEdit('projectName','<?php echo $record->projectName ?>','<?php echo $record->projectId; ?>')">
                                                    <a title="Edit" href="<?php echo base_url().'editProject/'.$record->projectId; ?>"><?php echo $record->projectName ?></a>
                                                </p>
                                                
                                            </td>

                                            <td>
                                                <span id="contract_<?php echo $record->projectId; ?>"></span>
                                                <p class="p-l-10" id="edit_contract_<?php echo $record->projectId; ?>" onclick="inlineEdit('contract','<?php echo $record->contract ?>','<?php echo $record->projectId; ?>')">
                                                    <a title="Edit" href="<?php echo base_url().'editProject/'.$record->projectId; ?>"><?php echo $record->contract ?></a>
                                                </p>
                                            </td> 

                                            

                                            <td>
                                                <span id="dueDate_<?php echo $record->projectId; ?>"></span>  
                                                <p class="p-l-10" id="edit_dueDate_<?php echo $record->projectId; ?>" onclick="inlineEdit('dueDate','<?php echo $record->dueDate ?>','<?php echo $record->projectId; ?>')">
                                                    <?php 

                                                        if($record->dueDate == "0000-00-00" || $record->dueDate == "" || $record->dueDate == "01/01/1970") {
                                                             echo date("m/d/Y");
                                                        }else{
                                                             echo date("m/d/Y", strtotime($record->dueDate));
                                                        }
                                                    ?> 
                                                </p>
                                                
                                            </td>

                                           <!--  <td>
                                                <span id="buisnesType_<?php echo $record->projectId; ?>"></span>  
                                                <p class="p-l-10">
                                                    <a title="Edit" href=""><?php echo $record->buisnes_type ?></a>
                                                </p>
                                            </td> 
 -->
                                            <td>
                                                <span id="notes_<?php echo $record->projectId; ?>"></span>  
                                                <p class="p-l-10">
                                                    <a title="Edit" href=""><?php echo $record->notes ?></a>
                                                </p>
                                            </td> 

                                            <td style="<?php echo $hide_job_walk; ?>"> 
                                                <span id="jobWalkTime_<?php echo $record->projectId; ?>"></span>
                                                <p class="p-l-10" id="edit_jobWalkTime_<?php echo $record->projectId; ?>" onclick="inlineEdit('jobWalkTime','<?php echo $record->jobWalkTime ?>','<?php echo $record->projectId; ?>')">
                                                    <?php echo $record->jobWalkTime; ?> 
                                                </p>
                                                <input type="hidden" name="createdDtm" id="createdDtm_<?php echo $record->projectId; ?>" value="<?php echo $record->createdDtm; ?>">
                                            </td> 
                                            <!-- <td> <?php //echo $record->mainContact; ?> </td>  -->
                                            <td>
                                                <span id="address_<?php echo $record->projectId; ?>"></span>  
                                                <p class="p-l-10" id="edit_address_<?php echo $record->projectId; ?>" onclick="inlineEditAdd('address','<?php echo $record->address ?>','<?php echo $record->projectId; ?>')">
                                                    <?php echo $record->address; ?>
                                                </p>
                                            </td>
                                            <td>
                                                <?php 
                                                    /*$estimator = "";
                                                    $userDetail = userinfo($record->estimator); 
                                                    if($userDetail["name"] != "" || $userDetail["name"] != NULL){
                                                        $estimator = $userDetail["name"];
                                                    }*/

                                                    $estimator_name_arr = array();
                                                    $estimator_id_arr = array();
                                                    if(!empty($userlist))
                                                    {
                                                        //print_r($record->estimator);
                                                        //print_r($userlist);

                                                        $estimator = $record->estimator;
                                                        //print_r($estimator);
                                                        
                                                        if(isset($estimator) && !empty($estimator)){
                                                            $estimators = explode(",",$estimator);
                                                            //print_r($estimators);
                                                            foreach ($userlist as $userInfo)
                                                            {
                                                                //print_r($userInfo);
                                                                //print_r($estimators);
                                                                if(in_array($userInfo->userId,$estimators)) {
                                                                    $estimator_id_arr[] = $userInfo->userId;
                                                                    $estimator_name_arr[] = $userInfo->name;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    $estimator_id = implode(',', $estimator_id_arr);
                                                    $estimator_name = implode(',', $estimator_name_arr);
                                                ?>
                                                <span id="estimator_<?php echo $record->projectId; ?>"></span> 
                                                 <p class="p-l-10" id="edit_estimator_<?php echo $record->projectId; ?>" onclick="inlineEditEstimatorNew('estimator','<?php echo $estimator_id;//$estimator ?>','<?php echo $record->projectId; ?>')">
                                                     <?php echo $estimator_name;//$estimator; ?>
                                                 </p>
                                                          
                                            </td> 


                                             <!-- <td>
                                                <?php 
                                                    //$estimator = "";
                                                    //$userDetail = userinfo($record->estimator); 

                                                    /*if($userDetail["name"] != "" || $userDetail["name"] != NULL){
                                                        $estimator = $userDetail["name"];
                                                    }*/

                                                    $estimator_name_arr = array();
                                                    $estimator_id_arr = array();
                                                    if(!empty($userlist))
                                                    {
                                                        //print_r($record->estimator);
                                                        //print_r($userlist);

                                                        $estimator = $record->estimator;
                                                        //print_r($estimator);
                                                        
                                                        if(isset($estimator) && !empty($estimator)){
                                                            $estimators = explode(",",$estimator);
                                                            //print_r($estimators);
                                                            foreach ($userlist as $userInfo)
                                                            {
                                                                //print_r($userInfo);
                                                                //print_r($estimators);
                                                                if(in_array($userInfo->userId,$estimators)) {
                                                                    $estimator_id_arr[] = $userInfo->userId;
                                                                    $estimator_name_arr[] = $userInfo->name;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    $estimator_id = implode(',', $estimator_id_arr);
                                                    $estimator_name = implode(',', $estimator_name_arr);
                                                    //print_r($estimator_id);
                                                    //print_r($estimator_name);
                                                ?>
                                                <div id="estimator_<?php echo $record->projectId; ?>"> 
                                                 <p class="p-l-10" id="edit_estimator_<?php echo $record->projectId; ?>" onclick="inlineEditEstimatorNew('estimator','<?php echo $record->projectId; ?>')">
                                                     <?php 
                                                    echo $estimator_name;
                                                    ?>
                                                 </p>
                                             </div>

                                                 <div class="estimatorSltClass" id="estimatorSlt_<?php echo $record->projectId; ?>" style="display: none;">
                                                    <select class="form-control" id="estimator" name="estimator[]" multiple>
                                                            <option value="0">Select Estimator</option>
                                                            <?php
                                                            if(!empty($userlist))
                                                            {
                                                                $estimator = $record->estimator;
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
                                                    <i class="fa fa-check" aria-hidden="true" onclick="saveInlineVal('estimator','<?php echo $record->projectId; ?>')"></i>
                                                </div>
                                                          
                                            </td> -->  
                                            
                                        </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="box-footer clearfix">
                                <?php echo $this->pagination->create_links(); ?>
                            </div>
                    </div>
                  
                </div>
        </div>
</div>
</div>
 <!-- The Modal -->
<div class="modal" id="sendmailModal">
      <div class="modal-dialog" id="loader">
        <div class="modal-content" style="position: fixed !important;">
              <!-- Modal Header -->

              <div class="modal-header">
                <h3 class="modal-title"><strong> Message </strong></h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Modal body -->

              <div class="modal-body p-0">
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


              <div class="modal-body p-0">
                <div class="row">
                    <div class="col-lg-12">                        
                         <textarea  id="msg" name="msg"></textarea>
                    </div>
                </div>
              </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <a href="javascript:void(0);" onclick="sendMessages();" class="confirm btn btn-sm btn-danger">Send</a>
            <button type="button" class="btn btn-default bg-warning btn-sm" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
</div>

 <!-- The Modal -->
<div class="modal" id="sendSmsModal">
      <div class="modal-dialog" id="smsloader">
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
                        <textarea class="form-control" id="sms" name="sms"></textarea>
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
            <a href="javascript:void(0);" onclick="sendSms();" class="confirm btn btn-danger btn-sm">Send</a>
            <button type="button" class="btn btn-default bg-warning btn-sm" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
</div>

 <!-- The Modal change project status -->
<div class="modal" id="changeStatus">
      <div class="modal-dialog" id="status_loader">
        <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h3 class="modal-title"><strong> Project Status </strong></h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Modal body -->
              <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">                                                
                        <select class="form-control required" id="stage_Id" name="stage_Id">
                            <option value="0">Select Stages</option>
                             <?php
                            if(!empty($stages))
                           {
                                foreach ($stages as $rl)
                               {
                                    ?>
                                     <option <?php if($project_list_stage == $rl->stageId){?> selected="selected"  <?php } ?> value="<?php echo $rl->stageId; ?>"><?php echo $rl->stageName; ?></option> 
                                    <?php
                                }
                            }
                            ?>        
                        </select>
                    </div>
                </div>
              </div>
          <!-- Modal footer -->
          <div class="modal-footer">
            <input type="hidden" class="projectid" name="projectid">
            <a href="javascript:void(0);" onclick="changeStatus();" class="confirm btn btn-danger btn-sm">Save</a>
            <button type="button" class="btn btn-default bg-warning btn-sm" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
</div>
<?php 
if(!empty($stateresult)){ 
    $stateFalg = 1;
 }else{
    $stateFalg = 0;
 } ?>

<input type="hidden" class="tablestateresult" name="tablestateresult" id="tablestateresult"  value="<?php echo $stateFalg;?>">

 
<script src="<?php echo base_url(); ?>assets/js/addLead.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script src="https://cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/libs/css/jquery-ui.css">
<script src="<?php echo base_url(); ?>assets/libs/js/jquery-ui.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/select2/css/select2.css">
<script src="<?php echo base_url(); ?>assets/vendor/select2/js/select2.min.js"></script>

<script type="text/javascript">
    function inlineEdit(fieldname,fieldval,projectid){

        $("#"+fieldname+"_"+projectid).html('<span><input class="form-control" style="width: 150px !important;" type="text" value="'+fieldval+'" id="'+fieldname+'_edit_'+projectid+'" name="'+fieldname+'"></span><i class="fa fa-check" aria-hidden="true" onclick="saveInlineVal(\''+fieldname+'\',\''+projectid+'\')"></i>');
        $("#edit_"+fieldname+"_"+projectid).hide();

        if(fieldname == "jobWalkTime"){
            var createdDtm = $("#createdDtm_"+projectid).val();
            $("#"+fieldname+"_edit_"+projectid).datepicker({  
                maxDate:new Date(createdDtm)
            });
        }

        if(fieldname == "dueDate"){
            $("#"+fieldname+"_edit_"+projectid).datepicker();
        }
    }

    function inlineEditAdd(fieldname,fieldval,projectid){
        $("#"+fieldname+"_"+projectid).html('<span><input class="form-control address-auto-complete" style="width: 150px !important;" type="text" value="'+fieldval+'" id="'+fieldname+'_edit_'+projectid+'" name="'+fieldname+'"></span><i class="fa fa-check" aria-hidden="true" onclick="saveInlineVal(\''+fieldname+'\',\''+projectid+'\')"></i>');
        $("#edit_"+fieldname+"_"+projectid).hide();
        $.getScript("https://maps.googleapis.com/maps/api/js?key=AIzaSyDXnYIF2RRd5COYQasKvQdAK6Pa7jKl5Oc&libraries=places&callback=initAutocomplete");
    }


    function inlineEditEstimatorNew(fieldname,fieldval,projectid){  
        <?php
            /*if(!empty($userlist)){
                $estimators = explode(",",$estimator);
                foreach ($userlist as $userInfo){
                    if(in_array($userInfo->userId,$estimators)) {
                        echo "selected=selected";
                    }
                }
            }*/
            ?>
            $("#"+fieldname+"_"+projectid).html('<span><select class="form-control" id="'+fieldname+'_edit_'+projectid+'" style="width: 150px !important;" name="'+fieldname+'[]" multiple></select></span><i class="fa fa-check" aria-hidden="true" onclick="saveInlineVal(\''+fieldname+'\',\''+projectid+'\')"></i>');
            $("#edit_"+fieldname+"_"+projectid).hide();
            
            var selectedValArr = fieldval.split(',');
            //console.log(selectedValArr);

                // Get User list
                jQuery.ajax({
                    url: "<?php echo base_url(); ?>project/getActiveUsers",
                    data: { } ,
                    type: 'post', 
                    dataType: 'json',
                    'async': false,
                    beforeSend: function () {
                    //jQuery('#editsmsloader').html('<div class="text-center mrgA padA"><i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></div>');
                    },            
                    success: function (data) {
                        //jQuery('#editsmsloader').hide();
                        if(data.status == true) { 
                            var userDetail = data.result;
                            $('#'+fieldname+'_edit_'+projectid).empty();
                            $('#'+fieldname+'_edit_'+projectid).append('<option value="">Select Estimator</option>');
                            $.each( userDetail, function( key, value ) {


                                if ($.inArray(value.userId, selectedValArr) != -1) {
                                    var $selected = "selected=selected";//$(value.userId).prop('selected', true);
                                }else{
                                    var $selected = '';                                    
                                }

                                $('#'+fieldname+'_edit_'+projectid).append('<option '+$selected+' data-tokens="'+value.userId+'" value="'+value.userId+'">'+value.name+'</option>');
                            });
                        }else if(data.status == false) { 
                           
                        }
                    }        
                });
            //$("#"+fieldname+"_edit_"+projectid).select2();
    }

    function inlineEditEstimator(fieldname,fieldval,projectid){
        //alert('test');
            <?php
            /*if(!empty($userlist)){
                $estimators = explode(",",$estimator);
                foreach ($userlist as $userInfo){
                    if(in_array($userInfo->userId,$estimators)) {
                        echo "selected=selected";
                    }
                }
            }*/
            ?>
            $("#"+fieldname+"_"+projectid).html('<span><select class="form-control" id="'+fieldname+'_edit_'+projectid+'" style="width: 150px !important;" name="'+fieldname+'"></select></span><i class="fa fa-check" aria-hidden="true" onclick="saveInlineVal(\''+fieldname+'\',\''+projectid+'\')"></i>');
            $("#edit_"+fieldname+"_"+projectid).hide();

                // Get User list
                jQuery.ajax({
                    url: "<?php echo base_url(); ?>project/getActiveUsers",
                    data: { } ,
                    type: 'post', 
                    dataType: 'json',
                    'async': false,
                    beforeSend: function () {
                    //jQuery('#editsmsloader').html('<div class="text-center mrgA padA"><i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></div>');
                    },            
                    success: function (data) {
                        //jQuery('#editsmsloader').hide();
                        if(data.status == true) { 
                            var userDetail = data.result;
                            $('#'+fieldname+'_edit_'+projectid).empty();
                            $('#'+fieldname+'_edit_'+projectid).append('<option value="">Select Estimator</option>');
                            $.each( userDetail, function( key, value ) {
                                $('#'+fieldname+'_edit_'+projectid).append('<option data-tokens="'+value.userId+'" value="'+value.userId+'">'+value.name+'</option>');
                            });
                        }else if(data.status == false) { 
                           
                        }
                    }        
                });
            $("#"+fieldname+"_edit_"+projectid).select2();
    }

    function saveInlineVal(fieldname,projectid){
        if(fieldname == "estimator"){
            //var fieldval = $("#"+fieldname+"_"+projectid+" #"+fieldname+"_edit_"+projectid+" :selected").val();
            var fieldval = $("#"+fieldname+"_"+projectid+" #"+fieldname+"_edit_"+projectid+" option:selected").map(function () {
                return $(this).val();
            }).get().join(',');
            //console.log(fieldval);
            //var fieldtext = $("#"+fieldname+"_"+projectid+" #"+fieldname+"_edit_"+projectid+" :selected").text();
            var fieldtext = $("#"+fieldname+"_"+projectid+" #"+fieldname+"_edit_"+projectid+" option:selected").map(function () {
                return $(this).text();
            }).get().join(',');
        }else{
            var fieldval = $("#"+fieldname+"_"+projectid+" #"+fieldname+"_edit_"+projectid).val();
            var fieldtext = fieldval;
        }

        if(fieldval.length>0){
            jQuery.ajax({
                url: "<?php echo base_url(); ?>project/inLineProjectUpdate",
                data: { fieldname : fieldname,fieldval: fieldval,projectid:projectid } ,
                type: 'post', 
                dataType: 'json',
                'async': false,
                beforeSend: function () {
                //jQuery('#editsmsloader').html('<div class="text-center mrgA padA"><i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></div>');
                },            
                success: function (data) {
                    //jQuery('#editsmsloader').hide();
                    if(data.status == true) { 
                        if(fieldname == "projectName"){
                            var htML = '<p class="p-l-10" id="edit_'+fieldname+'_'+projectid+'" onclick="inlineEdit(\''+fieldname+'\',\''+fieldval+'\',\''+projectid+'\')"><a title="Edit" href="<?php echo base_url() ?>editProject/'+projectid+'" >'+fieldtext+'</a> </p>';
                        }else if(fieldname == "estimator"){
                           var htML = '<p class="p-l-10" id="edit_'+fieldname+'_'+projectid+'" onclick="inlineEditEstimatorNew(\''+fieldname+'\',\''+fieldval+'\',\''+projectid+'\')">'+fieldtext+'</p>';
                        }else if(fieldname == "address"){
                            var htML = '<p class="p-l-10" id="edit_'+fieldname+'_'+projectid+'" onclick="inlineEditAdd(\''+fieldname+'\',\''+fieldtext+'\',\''+projectid+'\')">'+fieldtext+'</p>';
                        }else{
                            var htML = '<p class="p-l-10" id="edit_'+fieldname+'_'+projectid+'" onclick="inlineEdit(\''+fieldname+'\',\''+fieldval+'\',\''+projectid+'\')">'+fieldtext+'</p>';
                        }
                        
                        $("#"+fieldname+"_"+projectid).html(htML);
                    }else if(data.status == false) { 
                        swal("failed!", data.msg, "error");
                    }
                }        
            });
        }
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
 CKEDITOR.replace('msg');
</script>
<script>        
    function phoneno(){          
        $('#phone_no').keypress(function(e) {
            var a = [];
            var k = e.which;

            for (i = 48; i < 58; i++)
                a.push(i);

            if (!(a.indexOf(k)>=0))
                e.preventDefault();
        });
    }
</script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script> -->
<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/libs/css/dragndrop.table.columns.css">
 -->


<!-- <script src="<?php echo base_url(); ?>assets/js/jQuery.resizableColumns.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dragndrop.table.columns.js" type="text/javascript"></script>
 -->

<script type="text/javascript">

    //  $(function(){
    //     $('#ProjectTable').colResizable({liveDrag:true});


    //  // $('table.resizable').resizableColumns();

    // })

// $(document).ready( function() {
//   $('#ProjectTable').dataTable( {
//     "sDom": "Rlfrtip"
//   } );
// } );

// $('.table').dragableColumns({
//    drag: true,
//    dragClass: 'drag',
//    overClass: 'over',
//    movedContainerSelector: '.dnd-moved'
// });
   

    //     $( ".row_position" ).sortable({

    //     delay: 150,

    //     stop: function() {

    //         var selectedData = new Array();

    //         $('.row_position>tr').each(function() {

    //             selectedData.push($(this).attr("id"));

    //         });

    //         updateOrder(selectedData);

    //     }

    // });


    // function updateOrder(data) {
    //     $.ajax({

    //         url: "<?php echo base_url(); ?>project/updateSortPosition",

    //         type:'post',

    //         data:{position:data,table:'amp_projects'},

    //         success:function(){

    //             alert('your change successfully saved');

    //         }

    //     })

    // }
    // $(document).ready(function() {
    //     $('#ProjectTable').DataTable( {
    //         "lengthMenu": [[20, 40, 60, 80, 100, -1], [20, 40, 60, 80, 100, "All"]],
    //         "dom": '<"top"i>rt<"bottom"flp><"clear">'
    //     } );
    // } );


    $(document).ready(function() {
       
        if($('#tablestateresult').val()=="1"){
            $('#ProjectTable').DataTable( {
           // "bLengthChange": false,
            "lengthMenu": [[20, 40, 60, 80, 100, -1], [20, 40, 60, 80, 100, "All"]],
            //"pageLength": 10,
            "dom": '<"top"i>rt<"bottom"flp><"clear">',
            "sDom": "Rlfrtip",
            "stateSave": true,
              stateSaveCallback: function(settings,data) {
                  $.ajax( {
                     "url": '<?php echo base_url()?>project/saveState',
                     "deferRender": true,
                     "data": {"name":"ProjectTable", "state": data} ,//you can use the id of the datatable as key if it's unique
                     "dataType": "json",
                     "type": "POST",
                     "success": function (data) {
                        console.log(data);
                     }
                     });
                },
              stateLoadCallback: function(settings) {
                //return JSON.parse( localStorage.getItem( 'DataTables_' + settings.sInstance ) )
                        var o;
                        // Send an Ajax request to the server to get the data. Note that
                        // this is a synchronous request since the data is expected back from the
                        // function
                        $.ajax( {
                            "url": '<?php echo base_url()?>project/loadState',
                            "deferRender": true,
                            "data":{"name":"ProjectTable"},
                            "async": false,
                            "dataType": "json",
                            "type": "POST",
                            "success": function (json) {
                                //console.log(json);
                                o = json;
                            }
                        } );
                        return o;
                }
            } );
        }else{
            $('#ProjectTable').DataTable( {
           // "bLengthChange": false,
            "lengthMenu": [[20, 40, 60, 80, 100, -1], [20, 40, 60, 80, 100, "All"]],
            //"pageLength": 10,
            "dom": '<"top"i>rt<"bottom"flp><"clear">',
            "sDom": "Rlfrtip",
            "stateSave": true,
          stateSaveCallback: function(settings,data) {
              $.ajax( {
                 "url": '<?php echo base_url()?>project/saveState',
                 "deferRender": true,
                 "data": {"name":"ProjectTable", "state": data} ,//you can use the id of the datatable as key if it's unique
                 "dataType": "json",
                 "type": "POST",
                 "success": function (data) {
                    console.log(data);
                 }
                 });
            }
        } );
        }
        
    } );


    // $('#ProjectTable').DataTable( {
    //     stateSave: true,
    //       stateSaveCallback: function(settings,data) {
    //           localStorage.setItem( 'DataTables_' + settings.sInstance, JSON.stringify(data) )
    //         },
    //       stateLoadCallback: function(settings) {
    //         return JSON.parse( localStorage.getItem( 'DataTables_' + settings.sInstance ) )
    //         }
    // } );

    function delete_project(projectId){
        swal({
          title: "Are you sure to delete project?",
          text: "Your will not be able to recover this Project!",
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
            url : "<?php echo base_url(); ?>deleteProject",
            data : { projectId : projectId } 
            }).done(function(data){
                if(data.status = true) { 
                    swal({title: "Deleted!", text: "Your Project  has been deleted.!", type: "success"},
                       function(){ 
                           location.reload();
                       }
                    );
                }
                else if(data.status = false) { 
                    swal("failed!", "Project deletion failed.", "error");
                }                    
            });
          
        });        
    }

function copy_project(projectId){
        swal({
          title: "Are you sure you would like to duplicate this project?",
          text: "You can further delete this project from listing",
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
            url : "<?php echo base_url(); ?>copyProject",
            data : { projectId : projectId } 
            }).done(function(data){
                if(data.status = true) { 
                    swal({title: "Copied!", text: "Your Project  has been copied.!", type: "success"},
                       function(){ 
                           //location.reload();
                           // Simulate a mouse click:
                        window.location.href = "<?php echo base_url()."editProject/"?>"+data.projectId;
                       }
                    );
                }
                else if(data.status = false) { 
                    swal("failed!", "Project copy failed.", "error");
                }                    
            });
          
        });        
    }
 $(document).ready(function() {      
    // render date datewise
    jQuery(document).on('click','#filter-order-filter', function(){
        var lead_id = $("#leadId").val();    
        var project_name = $("#project_name").val();
        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();
        var phone_no = $("#phone_no").val();
        var email = $("#email").val();
        var sales_rep = $("#sales_rep").val();
        var stageId = $("#stageId").val();
        var DOB = $("#datepicker2").val();
        var scope_all = $("#scope_all:checked").val();
        var scope_abatement = $("#scope_abatement:checked").val();
        var scope_interior_demolition = $("#scope_interior_demolition:checked").val();
        var scope_site_demolition = $("#scope_site_demolition:checked").val();
        var scope_earthwork = $("#scope_earthwork:checked").val();
        var scope_other = $("#scope_other:checked").val();
        var bid_oprt = $("#bid_oprt").val();
        var bid_price = $("#bid_price").val();
        var tagId = $("#tagId").val();
        var filesystem_id = $("#filesystem_id").val();
        var estimator = $("#estimator").val();
        var sales = $("#sales").val();
        var admin = $("#admin").val();
        var jobTypeId = $("#jobTypeId").val();
        var client_name = $("#client_name").val();
        var project_list_stage = $("#project_list_stage").val();
        var notes = $("#notes").val();
        
       
        var data = {lead_id:lead_id, project_name:project_name, first_name:first_name, last_name:last_name, phone_no:phone_no,email:email,sales_rep:sales_rep,stageId:stageId,DOB:DOB,scope_all:scope_all,scope_abatement:scope_abatement,scope_interior_demolition:scope_interior_demolition,scope_site_demolition:scope_site_demolition,scope_earthwork:scope_earthwork,scope_other:scope_other,bid_oprt:bid_oprt,bid_price:bid_price,tagId:tagId,filesystem_id:filesystem_id,estimator:estimator,sales:sales,admin:admin,jobTypeId:jobTypeId,client_name:client_name,project_list_stage:project_list_stage,notes:notes};
        generateLeadTable(data);
    });

    // generate Order Table
    function generateLeadTable(element){ 
        var project_list_stage = element.project_list_stage;
        var showtd = "";
        if(project_list_stage != 11){
            var showtd = "display:none;";
        }

        var job_walk_array = ['12','10','13'];
        if($.inArray(project_list_stage, job_walk_array) != -1){
            var hide_job_walk = "display:none;";
        }else{
            var hide_job_walk = "display:block;";
        }

        var bidprice_array = ['12','10','13'];
        if($.inArray(project_list_stage, bidprice_array) != -1){
            var is_show_bidprice = "display:block;";
        }else{
            var is_show_bidprice = "display:none;";
        }
        
        jQuery.ajax({
            url: "<?php echo site_url('project/getProjectList')?>",
            data: {'lead_id' : element.lead_id,'project_name':element.project_name,'first_name':element.first_name,'last_name':element.last_name,'phone_no':element.phone_no,'email':element.email,'sales_rep':element.sales_rep,'stageId':element.stageId,'DOB':element.DOB,'scope_all':element.scope_all,'scope_abatement':element.scope_abatement,'scope_interior_demolition':element.scope_interior_demolition,'scope_site_demolition':element.scope_site_demolition,'scope_earthwork':element.scope_earthwork,'scope_other':element.scope_other,'bid_oprt':element.bid_oprt,'bid_price':element.bid_price,'tagId':element.tagId,'filesystem_id':element.filesystem_id,'estimator':element.estimator,'sales':element.sales,'admin':element.admin,'jobTypeId':element.jobTypeId,'client_name':element.client_name,'project_list_stage':element.project_list_stage,'notes':element.notes},
            type: 'post', 
            dataType: 'json',
            beforeSend: function () {
                jQuery('#render-list-of-order').html('<div class="text-center mrgA padA"><i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></div>');
            },           
            success: function (html) {
                var dataTable='<table id="ProjectTable" class="table table-striped ProjectTable dataTable dataTable" cellspacing="0"></table>';
                jQuery('#render-list-of-order').html(dataTable);  

                

                var table = $('#ProjectTable').DataTable({
                    data: html.data,
                    "bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": false,
                    "bInfo": true,
                    "bAutoWidth": false,
                    "bScrollX": true,
                    "lengthMenu": [[20, 40, 60, 80, 100, -1], [20, 40, 60, 80, 100, "All"]],
                    "dom": '<"top"i>rt<"bottom"flp><"clear">',
                    "sDom": "Rlfrtip",
                    "stateSave": true,
                    // "columnDefs": [ {
                    //     "targets": 5,
                    //     "orderable": true
                    // },
                    // {
                    //     "targets": 6,
                    //     "orderable": false
                    // },
                    // {
                    //     "targets": 7,
                    //     "orderable": false
                    // },
                    // {
                    //     "targets": 8,
                    //     "orderable": true
                    // } 
                    // ],
                    
                    columns: [
                        { title: "<input type='checkbox' class='checkboxAll' id='select_all' onclick=selectAllChkbox('all');>"},
                        { title: "Action"},
                        { title: "Map"},
                        { title: "Job Type"},
                        { title: "Job #"},
                        { title: "Company"},
                         { title: "<span style='"+is_show_bidprice+"'>Bid Price</span>"},
                         { title: "<span style='"+showtd+"'>Scope</span>"},
                        { title: "Job Name"},
                        { title: "Contract Value"},
                        { title: "Bid Date"},
                        { title: "Notes"},
                        { title: "<span style='"+hide_job_walk+"'>Job Walk</span>"},
                        // { title: "Main Contact"},
                        { title: "Job Site Address"},
                        { title: "Estimator"},
                    ],
                    createdRow: function (row, data, dataIndex) {
                        $(row).addClass('dnd-moved');
                    },
                    stateSaveCallback: function(settings,data) {
                      $.ajax( {
                         "url": '<?php echo base_url()?>/project/saveState',
                         "deferRender": true,
                         "data": {"name":"ProjectTable", "state": data} ,//you can use the id of the datatable as key if it's unique
                         "dataType": "json",
                         "type": "POST",
                         "success": function (data) {
                            console.log(data);
                         }
                         });
                    },
                      stateLoadCallback: function(settings) {
                            var o;
                            // Send an Ajax request to the server to get the data. Note that
                            // this is a synchronous request since the data is expected back from the
                            // function
                            $.ajax( {
                                "url": '<?php echo base_url()?>/project/loadState',
                                "deferRender": true,
                                "data":{"name":"ProjectTable"},
                                "async": false,
                                "dataType": "json",
                                "type": "POST",
                                "success": function (json) {
                                    //console.log(data);
                                    o = json;
                                }
                            } );
                            return o;
                        }
                });

            }        
        });
        // alert("here");
        // $("#ProjectTable thead tr").addClass('dnd-moved');
    }
     setInterval(function(){ $("#ProjectTable thead tr").addClass('dnd-moved'); }, 3000);

});
    function sendMail(){
        $('#sendmailModal').modal('show');        
    }
    function sendText(){
        $('#sendSmsModal').modal('show');        
    }

    function statusModal(projectId){
        $('#changeStatus').modal('show');   
        $(".projectid").val(projectId);     
    }

    function sendMessages(){
            var text = CKEDITOR.instances['msg'].getData();     
            email_from  = "<?php echo $this->session->userdata['name'];?>";
            //Get check by class
            var allCheckedCbx = [];
            $.each($("input[name='CalChkBox']:checked"), function(){            
                allCheckedCbx.push($(this).val());
            });
            //alert("My favourite sports are: " + allCheckedCbx.join(", "));
            var allChkLeads= allCheckedCbx.join(",");

            //Check check all
            if($('#select_all').prop("checked") == true){
                var isAll = 1;
            }else{
                var isAll = 2;
            }

            console.log(isAll+" = "+allChkLeads);

            if(text != '' && allChkLeads != ""){
                jQuery.ajax({
                    url: "<?php echo base_url(); ?>sendMail",
                    data: {text:text, email_from:email_from, allChkLeads:allChkLeads, isAll:isAll } ,
                    type: 'post', 
                    dataType: 'json',
                    beforeSend: function () {
                        jQuery('#loader').html('<div class="text-center mrgA padA"><i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></div>');
                    },           
                    success: function (data) {
                        jQuery('#loader').hide();
                       
                        if(data.status == true) { 
                            swal({title: "Mail Sent", text: "Your Message  has been sent!", type: "success"},
                               function(){ 
                                   location.reload();
                               }
                            );
                        }else if(data.status == false) { 
                            swal({title: "failed!", text: "No Data available to Send Message!", type: "error"},
                               function(){ 
                                   location.reload();
                               }
                            );
                        }
                    }        
                });
            } else{
                swal("please select at least one project or enter Mail Message.");
                return false;
            }      
    }

    function sendSms(){
        sms_message = $("#sms").val();
        sms_sender = $(".sms_sender").val();

        //Get check by class
        var allCheckedCbx = [];
        $.each($("input[name='CalChkBox']:checked"), function(){            
            allCheckedCbx.push($(this).val());
        });
        //alert("My favourite sports are: " + allCheckedCbx.join(", "));
        var allChkLeads= allCheckedCbx.join(",");
        //alert(allChkLeads);

        //Check check all
        if($('#select_all').prop("checked") == true){
            var isAll = 1;
        }else{
            var isAll = 2;
        }

        console.log(isAll+" = "+allChkLeads);

        //sms_recipient = '+91 '+$("#number").val();
        sms_from  = "<?php echo $this->session->userdata['name'];?>";
        if(sms_message != '' && allChkLeads !=""){
            jQuery.ajax({
                url: "<?php echo base_url(); ?>sendSms",
                data: { sms_sender : sms_sender,sms_message:sms_message,sms_from:sms_from,allChkLeads:allChkLeads, isAll:isAll } ,
                type: 'post', 
                dataType: 'json',
                beforeSend: function () {
                    jQuery('#smsloader').html('<div class="text-center mrgA padA"><i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></div>');
                },            
                success: function (data) {
                     jQuery('#smsloader').hide();
                    if(data.status == true) { 
                        swal({title: "Meesage Sent", text: "Your Message  has been sent!", type: "success"},
                           function(){ 
                               location.reload();
                           }
                        );
                    }else if(data.status == false) { 
                        swal({title: "failed!", text: "No Data available to Send Message!", type: "error"},
                           function(){ 
                               location.reload();
                           }
                        );
                    }
                }        
            }); 
        } else{
            swal("Please select at least one project or enter message");
            return false;
        }    
    } 

    function changeStatus(){
        var stage_val = $("#stage_Id").val();
        var projectid = $(".projectid").val();
        jQuery.ajax({
                url: "<?php echo base_url(); ?>project/changeProjectStatus",
                data: {projectid:projectid,stage:stage_val} ,
                type: 'post', 
                dataType: 'json',
                beforeSend: function () {
                    jQuery('#status_loader').html('<div class="text-center mrgA padA"><i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></div>');
                },           
                success: function (data) {
                    jQuery('#status_loader').hide();
                   
                    if(data.status == true) { 
                        swal({title: "Change Status", text: "Project Status is changed", type: "success"},
                           function(){ 
                               location.reload();
                           }
                        );
                    }else if(data.status == false) { 
                        swal({title: "failed!", text: "Project Status is not changed", type: "error"},
                           function(){ 
                               location.reload();
                           }
                        );
                    }
                }        
            });
    }
    </script>
    
<style type="text/css">
    .sweet-alert .sa-icon.sa-success::before{
        width: 100px;
        transform: rotate(90deg);
    }
    .dataTables_length {
        display: block;
    }
    .table.dataTable{
        font-size: 13px;
    }
    .table td {
        padding: 3px;
    }
</style>

<script type="text/javascript">
    function getEmailText(emailText){
        //alert(emailText);
        //$("#msg").val(emailText);
        CKEDITOR.instances['msg'].setData(emailText);
    }
</script>

<script type="text/javascript">
    $('#datepicker2').datepicker( { 
        changeYear: false, 
        dateFormat: 'mm/dd',
     });
</script>

<style type="text/css">
    .ui-datepicker-year
        {
         display:none;   
        }
        .ui-helper-hidden-accessible{
            background: red !important;
        }
</style>


<script type="text/javascript">
    function selectAllChkbox(clickType) {
        var select_all = document.getElementById("select_all"); //select all checkbox
        var checkboxes = document.getElementsByClassName("checkbox"); //checkbox items

        //select all checkboxes
        select_all.addEventListener("change", function(e){
            for (i = 0; i < checkboxes.length; i++) { 
                checkboxes[i].checked = select_all.checked;
            }
        });


        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].addEventListener('change', function(e){ //".checkbox" change 
                //uncheck "select all", if one of the listed checkbox item is unchecked
                if(this.checked == false){
                    select_all.checked = false;
                }
                //check "select all" if all checkbox items are checked
                if(document.querySelectorAll('.checkbox:checked').length == checkboxes.length){
                    select_all.checked = true;
                }
            });
        }
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

        // autocomplete = new google.maps.places.Autocomplete(
        //     (document.getElementById('autocomplete')),
        //     {types: ['geocode']}
        // );

        var variableAuto=document.getElementsByClassName('address-auto-complete');
        for(var j=0;j<variableAuto.length;j++){
        new google.maps.places.Autocomplete(
            (variableAuto[j]), {
                types: ['geocode']
            });
        }

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        //autocomplete.addListener('place_changed', fillInAddress);
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
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXnYIF2RRd5COYQasKvQdAK6Pa7jKl5Oc&libraries=places&callback=initAutocomplete" async defer></script> -->