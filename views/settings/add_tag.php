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
                <div class="custom-card"><h5 class="card-header"> Create New Tag 
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3">
                            <?php $this->load->helper("form"); ?>
                            <form role="form" id="addTag" action="<?php echo base_url() ?>addTag" method="post" role="form">
                                <div class="form-row">
                                    <div class="col-xl-10 offset-xl-1 mb-4">
                                        <label for="tagName">Tag name *</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('tagName'); ?>" id="tagName" name="tagName" maxlength="128" placeholder="">
                                    </div>
                                    <div class="col-xl-10 offset-xl-1 text-center">
										<input type="submit" class="btn btn-rounded bg-info" value="Submit" /> &nbsp;&nbsp;
										<a href="<?php echo base_url(); ?>settings" class="btn btn-rounded bg-warning"> Cancel </a>
                                    </div>
                                </div>
                            </form> 
                        </div>
                    </div>                       
                </div>
            </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/addTag.js" type="text/javascript"></script>
