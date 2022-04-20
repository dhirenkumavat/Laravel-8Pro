 <div class="dashboard-wrapper" id="page-content-wrapper">
        <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">
                <div class="ecommerce-widget">
				<!-- pageheader -->

				</div>         
         <!-- end pageheader -->
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
            <div class="card editViewLeadClass1">

                <div class="custom-card"><h5 class="card-header"> Create New Stage 
                </h5>
            </div>
                    <div class="card-body">
                        <div class="row">
                        <div class="col-lg-6 offset-lg-3">
                            <?php $this->load->helper("form"); ?>
                            <form role="form" id="addStage" action="<?php echo base_url() ?>addStage" method="post" role="form">
                                <div class="form-row">
                                    <div class="col-xl-10 offset-xl-1 mb-3">
                                        <label for="stage_name">Stage Name *</label>
                                        <input type="text" class="form-control required" value="<?php //echo set_value('list_name'); ?>" id="stage_name" name="stage_name" maxlength="128" placeholder="">
                                    </div>
                                   <!--  <div class="col-xl-10 offset-xl-1 mb-4">
                                        <label for="color">Color *</label>
                                         <input type="text" class="form-control required" value="<?php //echo set_value('color'); ?>" id="color" name="color" maxlength="100">
                                    </div> -->
                                    
                                    <div class="col-xl-10 offset-xl-1 text-center m-t-0 m-b-10">
                                        <div class="blue-btn">
                                            <input type="submit" class="btn btn-rounded bg-info" value="Submit" /> &nbsp;
											<a href="<?php echo base_url(); ?>settings" class="btn btn-rounded bg-warning"> Cancel </a>
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
<script src="<?php echo base_url(); ?>assets/js/addStage.js" type="text/javascript"></script>
