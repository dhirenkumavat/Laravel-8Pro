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

                <div class="custom-card"><h5 class="card-header"> Create New Sysytem Template
                </h5>
            </div>
                    <div class="card-body">
                        <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <?php $this->load->helper("form"); ?>
                            <form role="form" id="addSysytemTemplate" action="<?php echo base_url() ?>addNewSystemTemplate" method="post" role="form">
                                <div class="form-row">
                                    <div class="form-group col-xl-12 mb-4">
                                        <label for="subject">Sysytem Template Subject *</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('subject'); ?>" id="subject" name="subject" placeholder="Subject">
                                    </div>
                                    <div class="form-group col-xl-12 mb-4">
                                       <label for="body">Sysytem Template Body *</label>
                                         <!-- <input type="test" class="form-control required" id="body" value="<?php echo set_value('body'); ?>" name="body" placeholder="Body"> -->
                                         <textarea id="body" name="body" rows="4" cols="50"><?php echo set_value('body'); ?></textarea>
                                    </div>

                                    <div class="col-lg-3 offset-lg-4 col-md-6 offset-md-3">
                                        <input type="submit" class="btn btn-rounded btn-block bg-info" value="Submit" />
                                    </div>
                                </div>
                            </form> 
                        </div>
                        </div>                       
                    </div>
            </div>
            <!-- Filter Criteria Form end -->
</div>
<script src="<?php echo base_url(); ?>assets/js/addSystemTemplate.js" type="text/javascript"></script>
<script src="//cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
 CKEDITOR.replace( 'body' );
</script>