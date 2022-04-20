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

            <!-- Form Table start -->
            <div class="card">
                <!-- <div class="custom-card"><h5 class="card-header"> Pending Tasks </h5></div> -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="blue-btn"><a href="<?php echo base_url(); ?>addEmailTemplate" class="btn btn-rounded bg-info"> Add Email Template </a></div>
                            </div>
                            
                        </div>

                        <!-- <div class="custom-card"><h5 class="card-header"> Pending Tasks </h5></div> -->
						<div class="row">
							<div class="table-responsive"  id="render-list-of-user">
								<table class="table table-striped table-bordered first" id="exampleSalesRepsOne">
									<thead>
										 <tr>
											<th>Subject</th>
											<th>Body</th>
											<th>Created On</th>
											<th class="text-center">Actions</th>
										</tr>
									</thead>                                                
									<tbody>
										<?php
											if (!empty($emailTemplateRecords)) {
											foreach ($emailTemplateRecords as $record) {
										?>
										<tr>
											<td><?php echo $record->subject ?></td>
											<td><?php echo $record->body ?></td>
											<td><?php echo date("m/d/Y", strtotime($record->created_date)) ?></td>
											<td class="text-center">    
												<a title="Edit" href="<?php echo base_url().'editEmailTemplate/'.$record->email_template_id; ?>" class="btn btn-rounded bg-warning btn-sm"> <i class="fa fa-pencil-alt"></i> </a>
												<a title="Delete" href="javascript:void(0);" class="btn btn-rounded bg-danger deleteUser btn-sm" onClick="delete_email_template(<?php echo $record->email_template_id; ?>)" data-userid="<?php echo $record->email_template_id; ?>"> <i class="fa fa-trash-alt"></i> </a>
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
<script type="text/javascript">
$(document).ready(function() {
    $('#exampleSalesRepsOne').dataTable( {
    "lengthMenu": [[20, 40, 60, 80, 100, -1], [20, 40, 60, 80, 100, "All"]],
      "dom": '<"top"i>rt<"bottom"flp><"clear">',
        "sDom": "Rlfrtip",
        "stateSave": true,
        'autoWidth': false,
    } );
});
function delete_email_template(email_template_id){
    swal({
      title: "Are you sure to delete email template?",
      text: "Your will not be able to recover this email template!",
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
        url : "<?php echo base_url(); ?>deleteEmailTemplate",
        data : { email_template_id : email_template_id } 
        }).done(function(data){
            if(data.status = true) { 
                swal({title: "Deleted!", text: "Your Email Template has been deleted.!", type: "success"},
                   function(){ 
                       location.reload();
                   }
                );
            }
            else if(data.status = false) { 
                swal("failed!", "Email Template deletion failed.", "error");
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