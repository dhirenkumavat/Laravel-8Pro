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
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>
            <div class="card editViewLeadClass">

                <div class="custom-card"><h5 class="card-header"> Create New Task 
                </h5>
            </div>
                    <div class="card-body">
                        <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <?php $this->load->helper("form"); ?>
                            <form role="form" id="addTask" action="<?php echo base_url() ?>addTask" method="post" role="form">
                                <div class="form-row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-4">
                                        <label>Task Name</label>
                                        <input type="text" class="form-control" value="<?php //echo set_value('list_name'); ?>" id="taskName" name="taskName" placeholder="">
                                        <input type="hidden" name="projectId" id="projectId" value="<?php echo $projectId;?>">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-4">
                                        <label>Task Date</label>
                                        <input type="text" class="form-control" id="taskDate" name="taskDate">
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
                                        <label>Task Comment</label>
                                        <textarea name="taskComment" id="taskComment"></textarea>
                                    </div>
                                    
                                    <div class="col-sm-12 text-center">
                                        <div class="blue-btn">
                                            <input type="submit" class="btn btn-rounded bg-info" value="Submit" />
                                        </div>
                                    </div>
                                </div>
                            </form> 
                        </div>
                        </div>                       
                    </div>
            </div>
            <!-- Filter Criteria Form end -->
</div>
<script src="//cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
 CKEDITOR.replace( 'taskComment' );
</script>
<script>
  $( function() {
    $( "#taskDate" ).datepicker();
  } );
  </script>
