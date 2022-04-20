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

                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->


           <!-- Filter Criteria Form start -->
           <div class="card">
              <!-- <div class="custom-card"><h5 class="card-header"> Pending Tasks </h5></div> -->
              <div class="card-body">
                 <form role="form" id="repListFrm" name="repListFrm" action="<?php echo base_url() ?>taskListing" method="post" role="form">
                     <div class="form-row">
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-4">
                           <label>Choose a User</label>
                           <select class="form-control" id="repListId" name="repListId">
                                <option value="0">Select User:</option>
                                <?php
                                if(!empty($getAllUserListingRecords)){
                                    foreach ($getAllUserListingRecords as $rl){
                                    ?>
                                       <option value="<?php echo $rl->userId; ?>" <?php if(isset($repListId) && !empty($repListId)){ if($repListId==$rl->userId){ echo 'selected=selected'; } }?>><?php echo $rl->name; ?></option>
                                    <?php
                                    }
                                }
                                ?>
                           </select>
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
                        
                        <!-- <div class="custom-card"><h5 class="card-header"> Pending Tasks </h5></div> -->
						<div class="row">
							<div class="table-responsive"  id="render-list-of-user">
								<table class="table table-striped table-bordered first" id="exampleSalesRepsOne">
									<thead>
										 <tr>
											<th>Project Name</th>
                                            <th>County</th>
											<th>Task Details</th>
											<th>User</th>
                                            <th>Due Date</th>
											<th class="text-center">Actions</th>
										</tr>
									</thead>                                                
									<tbody>
										<?php
											if (!empty($getAllTaskListingRecords)) {

											     foreach ($getAllTaskListingRecords as $record) {
                              $projectFullName = ucfirst($record->projectName);
										?>
										<tr>
											<td>
                                            <a title="Edit" href="<?php echo base_url().'editProject/'.$record->projectId; ?>"><?php echo $projectFullName; ?></a>
                                          </td>
                                          <td><?php echo $record->county; ?></td>
											<td><?php echo $record->name; ?></td>
                                            <td><?php echo $record->refName; ?></td>
											<td><?php echo date("m/d/Y", strtotime($record->eventDate)) ?></td>
											<td class="text-center">

                                                <a title="Complete" href="javascript:void(0);" class="btn btn-rounded bg-danger btn-sm" onClick="complete_taskListJs(<?php echo $record->taskId; ?>)" data-taskid="<?php echo $record->taskId; ?>"> <i class="fa fa-check"></i> </a>

												<a title="Edit" href="<?php echo base_url().'editTaskList/'.$record->taskId; ?>" class="btn btn-rounded bg-warning btn-sm"> <i class="fa fa-pencil-alt"></i> </a>

												<a title="Delete" href="javascript:void(0);" class="btn btn-rounded bg-danger deleteUser btn-sm" onClick="delete_taskListJs(<?php echo $record->taskId; ?>)" data-taskid="<?php echo $record->taskId; ?>"> <i class="fa fa-trash-alt"></i> </a>
											</td>                                                        
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
            <!-- Form Table end -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#repListId").select2();

    $('#repListId').on('change', function() {
         document.forms['repListFrm'].submit();
    });
    $('#exampleSalesRepsOne').dataTable( {
    "lengthMenu": [[20, 40, 60, 80, 100, -1], [20, 40, 60, 80, 100, "All"]],
      "dom": '<"top"i>rt<"bottom"flp><"clear">',
        "sDom": "Rlfrtip",
        "stateSave": true,
        'autoWidth': false,
    } );
});
</script>
<script type="text/javascript">
function delete_taskListJs(taskId){
    swal({
      title: "Are you sure to delete task list?",
      text: "Your will not be able to recover this task list!",
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
        url : "<?php echo base_url(); ?>deleteTaskList",
        data : { taskId : taskId } 
        }).done(function(data){
            if(data.status = true) { 
                swal({title: "Deleted!", text: "Your Task List has been deleted.!", type: "success"},
                   function(){ 
                       location.reload();
                   }
                );
            }
            else if(data.status = false) { 
                swal("failed!", "Task List deletion failed.", "error");
            }                    
        });
      
    });         
}

function complete_taskListJs(taskId){
    swal({
      title: "Are you sure to complete task list?",
      text: "Your will not be able to recover this complete task list!",
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
        url : "<?php echo base_url(); ?>completeTaskList",
        data : { taskId : taskId } 
        }).done(function(data){
            if(data.status = true) { 
                swal({title: "Completed!", text: "Your Task List has been completed.!", type: "success"},
                   function(){ 
                       location.reload();
                   }
                );
            }
            else if(data.status = false) { 
                swal("failed!", "Task List completed failed.", "error");
            }                    
        });
      
    });         
}
</script>
<style type="text/css">
.dataTables_length {
        display: block;
    }
</style>