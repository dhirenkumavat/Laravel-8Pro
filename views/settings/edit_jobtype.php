 <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.6/css/bootstrap-colorpicker.css" rel="stylesheet">
 <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap-colorpicker.js"></script>

<?php
$jobTypeId = $jobTypeInfo->id;
$jobType = $jobTypeInfo->jobType;
$color = $jobTypeInfo->color;
?>

 <div class="dashboard-wrapper" id="page-content-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <div class="ecommerce-widget"></div>
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
            <div class="card editViewLeadClass1">
                <div class="custom-card"><h5 class="card-header"> Edit Job Type</h5> </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3">
                            <?php $this->load->helper("form"); ?>
                            <form role="form" id="addJobType" action="<?php echo base_url() ?>editJobType" method="post" role="form">
                                <div class="form-row">
                                    <div class="col-xl-10 offset-xl-1 mb-4">
                                        <label for="jobType">Job Type Name*</label>
                                        <input type="text" class="form-control required" value="<?php echo $jobType; ?>" id="jobType" name="jobType" maxlength="128" placeholder="">
                                    </div>
                                    <div class="col-xl-10 offset-xl-1 mb-4">
                                        <label for="color"> Color *</label>
                                        <div id="cp2" class="input-group colorpicker-component"> 
                                            <input type="text" class="form-control required" value="<?php echo $color; ?>" id="color" name="color" maxlength="128" placeholder=""/> 
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                    </div>
                                    <input type="hidden" value="<?php echo $jobTypeId; ?>" name="jobTypeId" id="jobTypeId" /> 
                                    <div class="col-xl-10 offset-xl-1 text-center">
										<input type="submit" class="btn btn-rounded bg-info" value="Update" /> &nbsp;&nbsp;
										<a href="<?php echo base_url(); ?>settings" class="btn btn-rounded bg-warning"> Cancel </a>
                                    </div>
                                </div>
                            </form> 
                        </div>
                    </div>                       
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$('#cp2').colorpicker();
</script>