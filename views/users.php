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
                <div class="row  mb-2">
                        <div class="col-8">
                                <div class="page-header mb-2">
                                    <h2 class="pageheader-title">Filter Criteria </h2>
                                </div>
                            </div>
                            <div class="col-4 text-right">
                                <a class="btn btn-rounded bg-warning btn-sm" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                    </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
            <div class="card collapse show" id="collapseExample">
            <!-- <div class="custom-card"><h5 class="card-header"> Pending Tasks </h5></div> -->
                <div class="card-body">
                   
                        <div class="form-row">
                            
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-3">
                                <label>Name</label>
                                <input type="text" name="username" value="<?php //echo $first_name; ?>" class="form-control" id="username" placeholder="Name">
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-3">
                                <label>Email Address</label>
                                <input type="text" name="email" value="<?php //echo $email; ?>"  class="form-control" id="email" placeholder="Email Address">
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-3">
                                <label>Phone Number</label>
                                <input type="number" name="phone_no" maxlength="10" value="<?php //echo $phone_no; ?>" class="form-control" id="phone_no" placeholder="phone Number">
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                               <label for="role">Role</label>
                                <select class="form-control required" id="role" name="role">
                                    <option value="0">Select Role</option>
                                    <?php
                                    if(!empty($roles))
                                    {
                                        foreach ($roles as $rl)
                                        {
                                            ?>
                                            <option value="<?php echo $rl->roleId ?>" <?php if($rl->roleId == set_value('role')) {echo "selected=selected";} ?>><?php echo $rl->role ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                                                       
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                <label class="clearfix">&nbsp;</label> <br>
                                <button name="filter_order_filter" type="button" class="btn btn-rounded bg-info" id="filter-order-filter" value="filter"><i class="fa fa-search fa-fw"></i></button>                                
                            </div>
                        </div>
                    
                </div>
        </div>
            <!-- Form Table start -->
            <div class="card">
                <!-- <div class="custom-card"><h5 class="card-header"> Pending Tasks </h5></div> -->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="blue-btn"><a href="<?php echo base_url(); ?>addNewUser" class="btn btn-rounded bg-info"> Add User </a></div>
                            </div>
                            
                        </div>
                    <div class="card-body">

                        <!-- <div class="custom-card"><h5 class="card-header"> Pending Tasks </h5></div> -->
						<div class="row">
							<div class="table-responsive"  id="render-list-of-user">
								<table class="table table-striped table-bordered first" id="exampleSalesRepsOne">
									<thead>
										 <tr>
											<th>Name</th>
											<th>Email</th>
											<th>Mobile</th>
											<th>Role</th>
											<th>Created On</th>
											<th class="text-center">Actions</th>
										</tr>
									</thead>                                                
									<tbody>
										<?php
											if (!empty($userRecords)) {
											foreach ($userRecords as $record) {
										?>
										<tr>
											<td><?php echo $record->name ?></td>
											<td><?php echo $record->email ?></td>
											<td><?php echo $record->mobile ?></td>
											<td><?php echo $record->role ?></td>
											<td><?php echo date("m/d/Y", strtotime($record->createdDtm)) ?></td>
											<td class="text-center">    
												<a title="Edit" href="<?php echo base_url().'editUser/'.$record->userId; ?>" class="btn btn-rounded bg-warning btn-sm"> <i class="fa fa-pencil-alt"></i> </a>
												<a title="Delete" href="#" class="btn btn-rounded bg-danger deleteUser btn-sm" onClick="delete_user(<?php echo $record->userId; ?>)" data-userid="<?php echo $record->userId; ?>"> <i class="fa fa-trash-alt"></i> </a>
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
								<?php //echo $this->pagination->create_links(); ?>
							</div>
					</div>
                                    
                             
                    </div>
            </div>
            <!-- Form Table end -->
</div>
<script type="text/javascript">
    function delete_user(userId){


            swal({
              title: "Are you sure to delete user?",
              text: "Your will not be able to recover this user!",
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
                url : "<?php echo base_url(); ?>deleteUser",
                data : { userId : userId } 
                }).done(function(data){
                    if(data.status = true) { 
                        swal("Deleted!", "Your User has been deleted.", "success");
                        location.reload();
                    }
                    else if(data.status = false) { 
                        swal("failed!", "User deletion failed.", "error");
                    }                    
                });
              
            });         
    }
    $(document).ready(function() {
            $('#exampleSalesRepsOne').dataTable( {
            "lengthMenu": [[20, 40, 60, 80, 100, -1], [20, 40, 60, 80, 100, "All"]],
              "dom": '<"top"i>rt<"bottom"flp><"clear">',
                "sDom": "Rlfrtip",
                "stateSave": true,
                'autoWidth': false,
            } );
    });


     // render date datewise
    jQuery(document).on('click','#filter-order-filter', function(){
        var username = $("#username").val(); 
        var phone_no = $("#phone_no").val();
        var email = $("#email").val();
        var role = $("#role").val();
        var data = {username:username, phone_no:phone_no, email:email,role:role};
        generateUserTable(data);
    });
    // generate Order Table
    function generateUserTable(element){ 

        jQuery.ajax({
            url: "<?php echo site_url('user/searchuserList')?>",
            data: {'username' : element.username,'phone_no':element.phone_no,'email':element.email,'role':element.role},
            type: 'post', 
            dataType: 'json',
            beforeSend: function () {
                jQuery('#render-list-of-user').html('<div class="text-center mrgA padA"><i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></div>');
            },           
            success: function (html) {
                var dataTable='<table id="user-datatable" class="table table-bordered table-striped" cellspacing="0" width="100%"></table>';
                jQuery('#render-list-of-user').html(dataTable);        
                var table = $('#user-datatable').DataTable({
                    data: html.data,
                    "lengthMenu": [[20, 40, 60, 80, 100, -1], [20, 40, 60, 80, 100, "All"]],
                    "bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": false,
                    "bInfo": true,
                    "bAutoWidth": true,
                    columns: [
                        { title: "Name"},
                        { title: "Email"},
                        { title: "Mobile"},
                        { title: "Role"},                 
                        { title: "Created On"},
                        { title: "Action"}
                    ],              
                });
            }        
        });
    }
</script>
<style type="text/css">
.dataTables_length {
        display: block;
    }
</style>