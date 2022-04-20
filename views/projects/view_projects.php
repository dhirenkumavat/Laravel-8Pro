 <div class="dashboard-wrapper" id="page-content-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <div class="ecommerce-widget">
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


            <!-- Filter Criteria Form start -->
            <div class="card">
                <!-- <div class="custom-card"><h5 class="card-header"> Pending Tasks </h5></div> -->
                    <div class="card-body">
                        <form role="form" id="" action="<?php echo base_url() ?>viewleadListing" method="post" role="form">
                            <div class="form-row">
                                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-4">
                                    <label>Job #</label>
                                    <input type="hidden" class="form-control" value="<?php echo $lead_id; ?>"  id="" name="projectId" placeholder="Project ID">
                                    <input type="text" class="form-control" value="<?php echo $filesystem_id; ?>"  id="" name="filesystem_id" placeholder="Job #">
                                </div>
                                
                                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-4">
                                    <label>Project Name</label>
                                    <input type="text" class="form-control" value="<?php echo $projectName; ?>" name="projectName" id="" placeholder="Project Name">
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-4">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control" value="<?php echo $phone_no; ?>" name="phoneNo" id="" placeholder="phone Number">
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-4">
                                    <label>Email Address</label>
                                    <input type="text" class="form-control" value="<?php echo $email; ?>" name="email" id="" placeholder="Email Address">
                                </div>
                                <div class="form-group col-xl-2 mb-4">
                                    <label>Sales Rep</label>
                                    <select class="form-control required" id="sales_rep" name="sales_rep">
                                        <option value="0">Select Rep</option>
                                        <?php                                    
                                            if(!empty($sales_repList))
                                            {
                                                foreach ($sales_repList as $rl)
                                                {

                                                    ?>
                                                    <option value="<?php echo $rl->userId ?>" <?php if($rl->userId == $sales_rep) {echo "selected=selected";} ?>><?php echo $rl->name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                    </select>
                                </div>
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
                                                <option value="<?php echo $rl->stageId ?>"  <?php if($rl->stageId == $stageId) {echo "selected=selected";} ?>><?php echo $rl->stageName ?></option>
                                                <?php
                                            }
                                        }
                                        ?>        
                                    </select>
                                </div>
                               <!--  <h3>*More Fields will be here in the software, All fields visible from edit lead*</h3> -->
                            </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6 offset-md-3">
                                       <div class="inputButtonClass">
                                           <input type="submit" class="btn btn-rounded btn-block bg-info"  value="Submit" />
                                       </div>
                                    </div>
                                </div>
                        </form> 
                    </div>
            </div>
            <!-- Filter Criteria Form end -->


            <!-- Form Table start -->
             <div class="card">
                <!-- <div class="custom-card"><h5 class="card-header"> Pending Tasks </h5></div> -->
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-6 col-md-3">
                                <div class="blue-btn"><a href="<?php echo base_url(); ?>addNewProject" class="btn btn-rounded bg-info"> Create New Project </a></div>
                            </div>
                            <div class="col-lg-6 col-md-3 text-right">
                                <div class="blue-btn"><a href="<?php echo base_url() ?>projectListing" class="btn btn-rounded bg-info"> View List </a></div>
                            </div>
                        </div>

                       <div class="row m-t-40">
                            <!-- Stage 1 start -->
                            <table class="table table-striped table-bordered first"  cellspacing="0" width="100%">
                                <thead> 
                                    <div class="lead-scrollsection project_grid">
                                         <?php foreach($stages as $key=>$record)
                                                        {
                                                    ?>
                                                    <div class="lead-coloumwidth">
                                            <div class="card">
                                                <div class="custom-card">
                                                    <h5 class="card-header"> <?php echo isset($record->stageName)?$record->stageName:''; //if(in_array($record->stageId,$stageIdAll)) echo $record->stageName ?> </h5>
                                                </div>
                                                <div id="<?php echo $record->stageId?>" ondrop="drop(event)" ondragover="allowDrop(event)" style="min-height: 600px;">
                                                <?php if(isset($leadRecords) && !empty($leadRecords)) {

                                                     foreach($leadRecords as $leadRecordsVal){ 
                                                         if(isset($leadRecordsVal->stageId) && !empty($leadRecordsVal->stageId))    
                                                            if($leadRecordsVal->stageId==$record->stageId) { 

                                                    //Check task
                                                    $checkLeadTaskSatatus = 0;
                                                    if(isset($leadRecordsVal->projectId) && !empty($leadRecordsVal->projectId))    
                                                        $checkLeadTaskSatatus = $this->project_model->checkLeadTaskSatatus($leadRecordsVal->projectId);

                                                    //echo $leadRecordsVal->projectId." = ".$checkLeadTaskSatatus;
                                                    ?>
                                                <div class="card-body" draggable="true" ondragstart="drag(event)" id="drag-<?php echo $leadRecordsVal->projectId."~".$leadRecordsVal->stageId; ?>" >
                                                    <div class="card campaign-card text-center">
                                                        <div class="card-body">
                                                            <div class="campaign-info">
                                                                <h3 class="mb-1"> <?php echo $leadRecordsVal->projectName; ?> </h3>
                                                                <p class="mb-3"><?php echo $leadRecordsVal->phoneNo1; ?></p>
                                                                <h4> <?php echo $leadRecordsVal->email; ?> </h4>
                                                                <p class="text-right">
                                                                    <?php if($checkLeadTaskSatatus>0) { ?>
                                                                        <a href="<?php echo base_url().'editProject/'.$leadRecordsVal->projectId; ?>"> 
                                                                            <i class="fas fa-exclamation-circle fa-lg" title="All task not completed"></i> 
                                                                        </a>
                                                                    <?php } else{ ?>
									                                   <a href="<?php echo base_url().'editProject/'.$leadRecordsVal->projectId; ?>"> 
                                                                            <i class="fas fa-check-circle successLead  fa-lg" title="All task has been completed"></i> 
                                                                        </a>
                                                                    <?php } ?>

                                                                    <a onclick ="sendCall('<?php echo $leadRecordsVal->projectId; ?>')" href="javascript:void(0)" > <i class="fas fa-phone-square fa-lg"></i> </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php } } }  ?>
                                            </div>
                                            </div>
                                        </div>
                                            <?php }?>
                                    </div>
                                </thead>
                            </table>
                           
                            <!-- Stage 1 end -->

                        </div>
                    </div>
            </div>
            <!-- Form Table end -->

           
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
                    </select>
                    <span style="color: red; display: none;" id="contactListCallError">Please select contact.</span>
                    <input type="hidden" id="project_id" value="">
                </div>
            </div>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
            <a href="javascript:void(0);" onclick="conectCallAPI(document.getElementById('project_id').value,document.getElementById('contact_list_call').value);" class="confirm btn btn-sm btn-danger">Call</a>
            <button type="button" class="btn bg-warning btn-sm" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
</div>



<script>
function addCommData(mobile,projectId){
    $.ajax({
        type : "POST",
        dataType : "json",
        url : "<?php echo base_url(); ?>project/addCallData",
        data : { mobile : mobile,projectId: projectId },
        success : function(response){

            if (response.status == 200) {
                var html = '<div class="row"><div class="col-sm-2 text-left pr-0"><i class="fas fa-phone fa-lg"></i></div><div class="col-sm-4 checkbox-a pl-0"><a href="javascript:void(0)">'+response.to+'</a></div><div class="col-sm-4 pl-0"><p>'+ response.createdDtm +'</p></div></div>';

                //$('.ScrollClassDynamic').append(html);
                //$('#notAvail').empty();
            }

        } 
    });
}



function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    var getTarget = ev.target.id;
    //console.log(getTarget);
    
    //Get new stage
    if(getTarget.indexOf("drag") != -1){
        var result = getTarget.split('~');
        var newStage = getTarget;
    }else{
        var result = getTarget.split('-');
        var newStage = getTarget;
    }


    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");

    //console.log(data);    //drag-2(id of lead)~4(From stage) 

    ev.target.appendChild(document.getElementById(data));

    //Get old stage
    var result1 = data.split('~');
    var oldStage = result1[1];

    //Get projectId
    var result3 = result1[0].split('-');
    var projectId = result3[1];

    //alert("New stage:"+newStage+" Lead id:"+projectId+" Old stage"+oldStage);
    //sreturn false;

    //Update lead stage
    if(newStage!='' && projectId!=''){
        var newStage = newStage.substr(newStage.indexOf("~") + 1)
        $.ajax({
        type : "POST",
        dataType : "json",
        url : "<?php echo base_url(); ?>lead/leadChangeStage",
        data : { projectId : projectId, newStage : newStage} 
        }).done(function(data){
            //alert(data);
            /*
            if(data.status = true) { 
                swal("Deleted!", "Your Lead  has been deleted.", "success");
                location.reload();
            }
            else if(data.status = false) { 
                swal("failed!", "Lead deletion failed.", "error");
            }                    
            */
        });
    }
}
</script>

<script type="text/javascript">

    function sendCall(projectId){
        $("#contactListCallError").hide();
        $('#contact_list_call').empty();
        $.ajax({
            type        : "POST",
            dataType    : "json",
            url         : "<?php echo base_url(); ?>project/getProjectContact",
            data        : {  projectId : projectId},
            'async': false,
            }).done(function(data){
                if(data.status == true) { 
                    var ContactDtl = data.result;
                    $.each( ContactDtl, function( key, value ) {
                        contactName = value.contact_name;
                        conatctPh = value.contact_phone;
                        if(conatctPh != ""){
                            $('#contact_list_call').append('<option value="'+conatctPh+'">'+contactName+'</option>');
                        }
                    });
                    $("#project_id").val(projectId);
                    $('#sendcallModal').modal('show');
                }else if(data.status == false) { 
                    swal("failed!", "Please check any contact is exist ?.", "error");
                }
        });
    }


    function conectCallAPI(projectId,phoneNumber){ 
        $('#sendcallModal').modal('hide');
        var callLink = "<a href='javascript:void(0);' onclick='addCommData("+phoneNumber+")'>"+phoneNumber+"</a>";
        $(".call_number").html(callLink);
        $('#callModal').modal('show');

        $.ajax({
        type        : "POST",
        dataType    : "json",
        url         : "<?php echo base_url(); ?>project/conectCallAPI",
        data        : {  projectId : projectId, phoneNumber : phoneNumber} 
        }).done(function(data){
            console.log(data);
        });

    }
</script>