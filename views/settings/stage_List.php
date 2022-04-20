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
                            <h2 class="pageheader-title"> System Settings </h2>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->

            <!-- Table start -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="blue-btn"><a href="<?php echo base_url(); ?>userListing" class="btn btn-rounded bg-info"> Manage Users </a></div>
                        </div>
                    </div>
                    <!-- <div class="card m-t-20">
                        <div class="custom-card">
                            <h5 class="card-header"> 
                                <div class="row">
                                    <div class="col-lg-6 pt-2 pl-0">Project Pipeline Stages:</div>
                                    <div class="col-lg-6 text-right"><a href="<?php echo base_url(); ?>addNewStage" class="btn btn-rounded bg-info"> <i class="fa fa-plus"></i> Create </a></div>
                                </div>
                            </h5>
                        </div>
                       
                        <div class="table-responsive">
                            <table class="table table-striped table-tb-0">
                                <thead>
                                    <tr>
                                        <th> Stage Name </th>
										<th> &nbsp; </th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(!empty($stageList))
                                        {
                                            foreach($stageList as $record)
                                            {
                                        ?>
                                    <tr>
                                        <td><?php echo $record->stageName ?></td>
                                        <td><?php //echo $record->color ?></td>  
										<td> </td>
                                        <td class="text-center">    
                                            <a title="Edit" href="<?php echo base_url().'editOldStage/'.$record->stageId; ?>" class="btn btn-rounded bg-warning btn-sm"> <i class="fa fa-pencil-alt"></i> </a>
                                            <a title="Dalete" href="#" data-stageid="<?php echo $record->stageId; ?>" onClick="delete_stage(<?php echo $record->stageId; ?>)" class="btn btn-rounded bg-danger deleteStage btn-sm"> <i class="fa fa-trash-alt"></i> </a>
                                            <a title="Up" href="#" id="upOrder" data-stageid="<?php echo $record->stageId; ?>" data-orderid="<?php echo $record->stageOrder; ?>" onClick="upOrder(<?php echo $record->stageId; ?>,<?php echo $record->stageOrder; ?>)" class="btn btn-rounded bg-secondary upOrder btn-sm"> <i class="fa fa-arrow-up"></i> </a>
                                            <a title="Down" href="#"  onClick="downOrder(<?php echo $record->stageId; ?>,<?php echo $record->stageOrder; ?>,<?php echo $count;?>)" data-stageid="<?php echo $record->stageId; ?>" data-orderid="<?php echo $record->stageOrder; ?>" class="btn btn-rounded bg-info downOrder btn-sm"> <i class="fa fa-arrow-down"></i> </a>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                  
                    </div> -->

                    <!-- MailChimp Integration start -->
                    <!-- <div class="card m-t-20">
                        <div class="custom-card">
                            <h5 class="card-header"> MailChimp Integration: </h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                    </div>
                                    <div class="col-lg-2 text-right">
                                        <label class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" id="mailchamp" class="custom-control-input"><span class="custom-control-label"> Enable </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                    </div>
                                    <div class="col-lg-2 text-right">
                                        <label><strong> API Key: </strong></label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" disabled="disabled" id="mailchampkey" placeholder="xgHdhgsyUD11275DbSDXZs" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- MailChimp Integration end -->

                    <!-- Phone System Integration start -->
                    <div class="card m-t-20">
                        <div class="custom-card">
                            <h5 class="card-header"> Phone System Integration: </h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                    </div>
                                    <div class="col-lg-9">
                                        <!-- <label class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" name="phoneSystem" id="phoneSystem" class="custom-control-input"<?php if(isset($phoneSystem) && !empty($phoneSystem) && $phoneSystem==1) { echo "checked"; } ?>><span class="custom-control-label"> Enable </span> -->
                                            <p><b>Phone system integration using BROWSER PLUGIN.</b></p>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                    </div>
                                    <div class="col-lg-2 text-right">
                                        <label><strong> API Key: </strong></label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="phoneSystemkey" id="phoneSystemkey" placeholder="call api key" value="<?php if(isset($phoneSystemkey) && !empty($phoneSystemkey)) { echo $phoneSystemkey; } ?>">
                                        <br />
                                        <a href="javascript:void(0);" onclick="savePhoneCallAPI();" class="btn btn-rounded bg-info"> <i class="fa"></i> Save </a>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <!-- Phone System Integration end -->

                    <!-- Phone System Integration start -->
                    <div class="card m-t-20">
                        <div class="custom-card">
                            <h5 class="card-header"> File System Base URL: </h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                    </div>
                                    <div class="col-lg-3 text-right">
                                        <label><strong> Base URL: </strong></label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="fs_url" id="fs_url" placeholder="Base Url" value="<?php if(isset($fs_url) && !empty($fs_url)) { echo $fs_url; } ?>">
                                        <br />
                                        <a href="javascript:void(0);" onclick="saveFsUrl();" class="btn btn-rounded bg-info"> <i class="fa"></i> Save </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Phone System Integration end -->

                    <!-- Referral Types start -->
                    <!-- <div class="card m-t-20">
                        <div class="custom-card">
                            <h5 class="card-header"> 
                                <div class="row">
                                    <div class="col-lg-6 pt-2 pl-0">Referral Types:</div>
                                    <div class="col-lg-6 text-right"><a href="<?php echo base_url(); ?>addNewRef" class="btn btn-rounded bg-info"> <i class="fa fa-plus"></i> Create </a></div>
                                </div>
                            </h5>
                        </div>
             
                        <div class="table-responsive">
                            <table class="table table-striped table-tb-0">
                                <thead>
                                    <tr>
                                        <th> Name </th>
										<th> &nbsp; </th>
										<th> &nbsp; </th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php
                                        if(!empty($referralList))
                                        {
                                            foreach($referralList as $record)
                                            {
                                        ?>
                                    <tr>
                                        <td><?php echo $record->referralName ?></td>
										<td></td>
										<td></td>
                                        <td class="text-center">    
                                            <a title="Edit" href="<?php echo base_url().'editOldReferral/'.$record->referralId; ?>" class="btn btn-rounded bg-warning btn-sm"> <i class="fa fa-pencil-alt"></i> </a>
                                            <a title="Delete" href="#" onClick="delete_referral(<?php echo $record->referralId; ?>)" class="btn btn-rounded bg-danger btn-sm"> <i class="fa fa-trash-alt"></i> </a>
                                            <a title="Up" href="#" id="upOrder" onClick="upReferralOrder(<?php echo $record->referralId; ?>,<?php echo $record->referralOrder; ?>)" class="btn btn-rounded bg-secondary btn-sm"> <i class="fa fa-arrow-up"></i> </a>
                                            <a title="Down" href="#"  onClick="downReferralOrder(<?php echo $record->referralId; ?>,<?php echo $record->referralOrder; ?>,<?php echo $refcount;?>)" class="btn btn-rounded bg-info btn-sm"> <i class="fa fa-arrow-down"></i> </a>
                                        </td>
                                    </tr>
                                 <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                       
                    </div> -->
                    <!-- Referral Types end -->

                    <!-- Google Custom Audiences start -->
                    <!-- <div class="card m-t-20">
                        <div class="custom-card">
                            <h5 class="card-header"> Google Custom Audiences: </h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                    </div>
                                    <div class="col-lg-2 text-right">
                                        <label class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" id="audiance" class="custom-control-input"><span class="custom-control-label"> Enable </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                    </div>
                                    <div class="col-lg-2 text-right">
                                        <label><strong> API Key: </strong></label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" disabled="disabled"  id="audiancekey" placeholder="xgHdhgsyUD11275DbSDXZs" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- Google Custom Audiences end -->

                    <!-- Facebook Integration (Audiences) start -->
                    <!-- <div class="card m-t-20">
                        <div class="custom-card">
                            <h5 class="card-header"> Facebook Integration (Audiences): </h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                    </div>
                                    <div class="col-lg-2 text-right">
                                        <label class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" id="fbaudiance" class="custom-control-input"><span class="custom-control-label"> Enable </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                    </div>
                                    <div class="col-lg-2 text-right">
                                        <label><strong> API Key: </strong></label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" disabled="disabled"  id="fbaudiancekey" placeholder="xgHdhgsyUD11275DbSDXZs" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- Facebook Integration (Audiences) end -->

                    <!-- Lead Tags start -->
                    <div class="card m-t-20">
                        <div class="custom-card">
                            <h5 class="card-header"> 
                                <div class="row">
                                    <div class="col-lg-6 pt-2 pl-0">Lead Tags:</div>
                                    <div class="col-lg-6 text-right"><a href="<?php echo base_url(); ?>addNewTag" class="btn btn-rounded bg-info"> <i class="fa fa-plus"></i> Create </a></div>
                                </div>
                            </h5>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-tb-0">
                                <thead>
                                    <tr>
                                        <th> Name </th>
										<th> &nbsp; </th>
										<th> &nbsp; </th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(!empty($tagList))
                                        {
                                            foreach($tagList as $record)
                                            {
                                        ?>
                                    <tr>
                                        <td><?php echo $record->tagName ?></td>
										<td> </td>
										<td> </td>
                                        <td class="text-center">    
                                            <a title="Edit" href="<?php echo base_url().'editOldTag/'.$record->id; ?>" class="btn btn-rounded bg-warning btn-sm"> <i class="fa fa-pencil-alt"></i> </a>
                                            <a title="Delete" href="#" onClick="delete_tag(<?php echo $record->id; ?>)" class="btn btn-rounded bg-danger btn-sm"> <i class="fa fa-trash-alt"></i> </a>
                                            <a title="Up" href="#" id="upOrder" onClick="upTagOrder(<?php echo $record->id; ?>,<?php echo $record->tagOrder; ?>)" class="btn btn-rounded bg-secondary btn-sm"> <i class="fa fa-arrow-up"></i> </a>
                                            <a title="Down" href="#"  onClick="downTagOrder(<?php echo $record->id; ?>,<?php echo $record->tagOrder; ?>,<?php echo $tagcount;?>)" class="btn btn-rounded bg-info btn-sm"> <i class="fa fa-arrow-down"></i> </a>
                                        </td>
                                    </tr>
                                 <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>                            
                    </div>

                    <!-- Job Type start -->
                    <div class="card m-t-20">
                        <div class="custom-card">
                            <h5 class="card-header"> 
                                <div class="row">
                                    <div class="col-lg-6 pt-2 pl-0">Job Type:</div>
                                    <div class="col-lg-6 text-right"><a href="<?php echo base_url(); ?>addjobtype" class="btn btn-rounded bg-info"> <i class="fa fa-plus"></i> Create </a></div>
                                </div>
                            </h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-tb-0">
                                <thead>
                                    <tr>
                                        <th>Job Type</th>
                                        <th> &nbsp; </th>
                                        <th> Color </th>
                                        <th> &nbsp; </th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(!empty($jobtypeList))
                                        {
                                            foreach($jobtypeList as $record)
                                            {
                                        ?>
                                    <tr>
                                        <td><?php echo $record->jobType ?></td>
                                        <td> </td>
                                        <th><span class="job_color"><i style="background-color: <?php echo $record->color; ?>;">&nbsp;</i></span> <?php //echo $record->color; ?> </th>
                                        <td> </td>
                                        <td class="text-center">    
                                            <a title="Edit" href="<?php echo base_url().'editjobtype/'.$record->id; ?>" class="btn btn-rounded bg-warning btn-sm"> <i class="fa fa-pencil-alt"></i> </a>
                                            <a title="Delete" href="javascript:void(0)" onClick="delete_jobtype(<?php echo $record->id; ?>)" class="btn btn-rounded bg-danger btn-sm"> <i class="fa fa-trash-alt"></i> </a>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>                            
                    </div>

                    <!-- Phone SMTP Integration start -->
                    <form  method="post" role="form" id="smtp_form">
                        <div class="card m-t-20">
                            <div class="custom-card"><h5 class="card-header"> SMTP Configuration: </h5></div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3 text-right">
                                            <label><strong> Mail Server *: </strong></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input required="" type="text" class="form-control" name="mail_server" id="mail_server" placeholder="Mail Server" value="<?php echo $smtpDetail['mail_server'];?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 text-right">
                                            <label><strong> Username *: </strong></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input required="" type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $smtpDetail['username'];?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 text-right">
                                            <label><strong> Password *: </strong></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <input required="" type="text" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $smtpDetail['password'];?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 text-right"></div>
                                        <div class="col-lg-4">
                                            <input type="hidden" name="smtpid" value="<?php if($smtpDetail['id'] != ""){echo $smtpDetail['id']; }else{echo "0";}?>">
                                            <input type="hidden" name="userid" value="<?php echo $this->session->userdata['userId'];?>">
                                            <input type="submit" value="Save" class="btn btn-rounded bg-info saveSMTP">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Phone System Integration end -->

                    <!-- Data Import Functionality -->
                    <form  method="post" role="form" id="dataImport" enctype="multipart/form-data">
                        <div class="card m-t-20">
                            <div class="custom-card"><h5 class="card-header"> Data Import: </h5></div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="col-lg-3 text-right"></div>
                                            <div class="col-lg-6 p-0">
                                                
                                                <div class="file-chooser btn-info btn-file btnBrowssrBtn">
                                                   <i class="fa fa-upload"></i> &nbsp;&nbsp; Upload XLS File: &nbsp;<span>Browse </span>
                                                   <input class="file-chooser__input" type="file" name="import_data" required="" >
                                                </div>
                                                <div class="ScrollClassDynamic1">
                                                    <div class="fileClass file-uploader__message-area"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 text-right"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 text-right"></div>
                                        <div class="col-lg-4">
                                            <input type="submit" value="Import" class="btn btn-rounded bg-info import">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Phone System Integration end -->
                </div>
            </div>
            <!-- Table end -->            
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

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">

    $('#mailchamp').change(function(){
       $("#mailchampkey").prop("disabled", !$(this).is(':checked'));
    });

    $('#audiance').change(function(){
       $("#audiancekey").prop("disabled", !$(this).is(':checked'));
    });
    $('#fbaudiance').change(function(){
       $("#fbaudiancekey").prop("disabled", !$(this).is(':checked'));
    });
    
    function upOrder(stageId,stageOrder){

        swal({
              title: "Are you sure to Up this stage?",
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
            url : "<?php echo base_url(); ?>upOrder",
            data : { stageId : stageId,orderId:stageOrder } 
            }).done(function(data){
                if(data.status = true) { 
                    swal({title: "Updated", text: "Your stage  has been updated!", type: "success"},
                       function(){ 
                           location.reload();
                       }
                    );
                }
                else if(data.status = false) { 
                    swal("failed!", "stage updation failed.", "error");
                }                    
            });
          
        });           
    }

    function upTagOrder(tagId,tagOrder){
        swal({
              title: "Are you sure to Up this tag?",
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
            url : "<?php echo base_url(); ?>upTagOrder",
            data : { tagId : tagId,orderId:tagOrder } 
            }).done(function(data){
                if(data.status = true) { 
                   swal({title: "Updated", text: "Your tag  has been updated!", type: "success"},
                       function(){ 
                           location.reload();
                       }
                    );
                }
                else if(data.status = false) { 
                    swal("failed!", "tag updation failed.", "error");
                }                    
            });          
        });              
    }

    function upSellingOrder(sellingId,sellingOrder){
        swal({
              title: "Are you sure to Up this selling?",
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
            url : "<?php echo base_url(); ?>upSellingOrder",
            data : { sellingId : sellingId,orderId:sellingOrder } 
            }).done(function(data){
                if(data.status = true) { 
                    swal({title: "Updated", text: "Your selling  has been updated!", type: "success"},
                       function(){ 
                           location.reload();
                       }
                    );
                }
                else if(data.status = false) { 
                    swal("failed!", "selling updation failed.", "error");
                }                    
            });          
        });              
    }


    function upReferralOrder(refId,refOrder){
        swal({
              title: "Are you sure to Up this Referral?",
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
            url : "<?php echo base_url(); ?>upReferralOrder",
            data : { refId : refId,orderId:refOrder } 
            }).done(function(data){
                if(data.status = true) { 
                    swal({title: "Updated", text: "Your Referral  has been updated!", type: "success"},
                       function(){ 
                           location.reload();
                       }
                    );
                }
                else if(data.status = false) { 
                    swal("failed!", "Referral updation failed.", "error");
                }                    
            });          
        });              
    }

    function downOrder(stageId,stageOrder,count){
    
        swal({
              title: "Are you sure to down this stage?",
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
            url : "<?php echo base_url(); ?>downOrder",
            data : { stageId : stageId,orderId:stageOrder,count:count } 
            }).done(function(data){
                if(data.status = true) { 
                    swal({title: "Updated", text: "Your Stage  has been updated!", type: "success"},
                       function(){ 
                           location.reload();
                       }
                    );
                }
                else if(data.status = false) { 
                    swal("failed!", "Stage updation failed.", "error");
                }                    
            });          
        });           
    }

    function downTagOrder(tagId,tagOrder,count){
        
        swal({
              title: "Are you sure to down this tag?",
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
            url : "<?php echo base_url(); ?>downTagOrder",
            data : { tagId : tagId,orderId:tagOrder,count:count } 
            }).done(function(data){
                if(data.status = true) { 
                    swal({title: "Updated", text: "Your tag  has been updated!", type: "success"},
                       function(){ 
                           location.reload();
                       }
                    );
                }
                else if(data.status = false) { 
                    swal("failed!", "tag updation failed.", "error");
                }                    
            });          
        }); 
    }

    function downSellingOrder(sellingId,sellingOrder,count){
        
        swal({
              title: "Are you sure to down this selling?",
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
            url : "<?php echo base_url(); ?>downSellingOrder",
            data : { sellingId : sellingId,orderId:sellingOrder,count:count } 
            }).done(function(data){
                if(data.status = true) { 
                    swal({title: "Updated", text: "Your selling  has been updated!", type: "success"},
                       function(){ 
                           location.reload();
                       }
                    );
                }
                else if(data.status = false) { 
                    swal("failed!", "selling updation failed.", "error");
                }                    
            });          
        }); 
    }


    function downReferralOrder(refId,refOrder,count){
        swal({
              title: "Are you sure to down this referral?",
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
            url : "<?php echo base_url(); ?>downReferralOrder",
            data : { refId : refId,orderId:refOrder,count:count } 
            }).done(function(data){
                if(data.status = true) { 
                    swal({title: "Updated", text: "Your referral  has been updated!", type: "success"},
                       function(){ 
                           location.reload();
                       }
                    );
                }
                else if(data.status = false) { 
                    swal("failed!", "referral updation failed.", "error");
                }                    
            });          
        });                
    }

    function delete_stage(stageId){
        swal({
              title: "Are you sure to delete stage?",
              text: "Your will not be able to recover this stage!",
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
                url : "<?php echo base_url(); ?>deleteStage",
                data : { stageId : stageId } 
                }).done(function(data){
                    if(data.status = true) { 
                        swal({title: "Deleted", text: "Your stage  has been deleted!", type: "success"},
                           function(){ 
                               location.reload();
                           }
                        );
                    }
                    else if(data.status = false) { 
                        swal("failed!", "stage deletion failed.", "error");
                    }                    
                });
              
            });               
    }

    function delete_tag(tagId){
        swal({
              title: "Are you sure to delete tag?",
              text: "Your will not be able to recover this tag!",
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
            url : "<?php echo base_url(); ?>deleteTag",
            data : { tagId : tagId } 
            }).done(function(data){
                if(data.status = true) { 
                    swal({title: "Deleted", text: "Your tag  has been deleted!", type: "success"},
                           function(){ 
                               location.reload();
                           }
                    );
                }
                else if(data.status = false) { 
                    swal("failed!", "tag deletion failed.", "error");
                }                    
            });
          
        });              
    }


    //Delete Job Type
    function delete_jobtype(jobTypeId){
        swal({
              title: "Are you sure to delete Job Type?",
              text: "Your will not be able to recover this Job Type!",
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
            url : "<?php echo base_url(); ?>deleteJobType",
            data : { jobTypeId : jobTypeId } 
            }).done(function(data){
                if(data.status = true) { 
                    swal({title: "Deleted", text: "Your job type  has been deleted!", type: "success"},
                           function(){ 
                               location.reload();
                           }
                    );
                }
                else if(data.status = false) { 
                    swal("failed!", "Job type deletion failed.", "error");
                }                    
            });
          
        });              
    }


    function delete_selling(sellingId){
        swal({
              title: "Are you sure to delete selling?",
              text: "Your will not be able to recover this selling!",
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
            url : "<?php echo base_url(); ?>deleteSelling",
            data : { sellingId : sellingId } 
            }).done(function(data){
                if(data.status = true) { 
                    swal({title: "Deleted", text: "Your selling  has been deleted!", type: "success"},
                           function(){ 
                               location.reload();
                           }
                    );
                }
                else if(data.status = false) { 
                    swal("failed!", "selling deletion failed.", "error");
                }                    
            });
          
        });              
    }

    function delete_referral(refId){

        swal({
              title: "Are you sure to delete ref?",
              text: "Your will not be able to recover this ref!",
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
            url : "<?php echo base_url(); ?>deleteReferral",
            data : { refId : refId } 
            }).done(function(data){
                if(data.status = true) { 
                    swal({title: "Deleted", text: "Your ref  has been deleted!", type: "success"},
                           function(){ 
                               location.reload();
                           }
                    );
                }
                else if(data.status = false) { 
                    swal("failed!", "ref deletion failed.", "error");
                }                    
            });
          
        });              
    }
</script>

<script type="text/javascript">
    function savePhoneCallAPI(){
        var phoneSystem     = $('input[name="phoneSystem"]:checked').length;
        var phoneSystemkey  = $("#phoneSystemkey").val();

        if(phoneSystem==1){
            if(phoneSystemkey==''){
                swal("failed!", "Please enter API Key.", "error");
                return false;
            }
        }

         $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>setting/updatePhoneCallAPI",
            data : { phoneSystem : phoneSystem, phoneSystemkey : phoneSystemkey } 
        }).done(function(data){
                if(data.status = true) { 
                    swal({title: "Saved", text: "Call API save successfully!", type: "success"},
                           function(){ 
                               location.reload();
                           }
                    );
                }                 
        });
    }

    function saveFsUrl(){
        var fs_url  = $("#fs_url").val();       
        if(fs_url==''){
            swal("failed!", "Please enter url.", "error");
            return false;
        }
        $.ajax({
            type : "POST",
            url : "<?php echo base_url(); ?>setting/updateFsUrl",
            data : { fs_url : fs_url } 
        }).done(function(data){
                if(data.status = true) { 
                    swal({title: "Saved", text: "url save successfully!", type: "success"},
                           function(){ 
                               location.reload();
                           }
                    );
                }                 
        });
    }

    $(document).ready(function(){
        $(".saveSMTP").click(function(e){
            e.preventDefault();
            if( $('#smtp_form').valid() ) {
                $.ajax({
                type : "POST",
                url : "<?php echo base_url(); ?>setting/saveSMTP",
                data : $("#smtp_form").serialize()
                }).done(function(data){
                    if(data.status = true) { 
                        swal({title: "Saved", text: "SMTP save successfully!", type: "success"},
                               function(){ 
                                   location.reload();
                               }
                        );
                    }                 
                });
            }
        });


        //Import Project Data
        
        $(".import").click(function(e){
            e.preventDefault();
            
            var formData = new FormData($('#dataImport')[0]);
            if( $('#dataImport').valid() ) {
                $("#loadMe").modal({
                    backdrop: "static", //remove ability to close modal with click
                    keyboard: false, //remove option to close with keyboard
                    show: true //Display loader!
                });
                $.ajax({
                    type : "POST",
                    url : "<?php echo base_url(); ?>setting/uploadData",
                    data : formData,
                    async : true,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,   // tell jQuery not to set contentType
                    dataType:"json",
                    }).done(function(data){
                        $("#loadMe").modal('hide');
                        if(data.status == true) { 
                            swal({title: "Import", text: "Data import successfully!", type: "success"},
                               function(){ 
                                   location.reload();
                               }
                            );
                        }else{
                            swal("failed!", "Something is wrong.", "error");
                        }                 
                    });
            }
        });
    });
</script>
<script type="text/javascript">
//jQuery plugin
(function( $ ) {
   $.fn.uploader = function( options ){
        var settings = $.extend({
            MessageAreaText: "No files selected.",
            DefaultErrorMessage: "Unable to open this file.",
            BadTypeErrorMessage: "We cannot accept this file type at this time.",
            acceptedFileTypes: ['xls', 'xlsx']
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