<?php
$tagId = $tagInfo->id;
$tag_name = $tagInfo->tagName;

?>

 <div class="dashboard-wrapper" id="page-content-wrapper">
    <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">
                <!-- ============================================================== -->
                <div class="ecommerce-widget">            
                <!-- Filter Criteria Form start -->
                <div class="card editViewLeadClass1">
                    <div class="custom-card"><h5 class="card-header"> Edit Tag List </h5></div>
                        <div class="card-body">
                            <div class="row">
                            <div class="col-sm-6 offset-3">
                            <form role="form" action="<?php echo base_url() ?>editTag" method="post" id="editTag" role="form">
                                <div class="form-row">
                                    <div class="col-xl-10 offset-xl-1 mb-4">
										<label for="tag_name">Tag Name</label>
                                        <input type="text" class="form-control" id="tag_name" placeholder="" name="tag_name" value="<?php echo $tag_name; ?>" maxlength="128">
                                        <input type="hidden" value="<?php echo $tagId; ?>" name="tagId" id="tagId" /> 
                                    </div>                                                                   
                                </div>
                                 
								<div class="col-xl-10 offset-xl-1 text-center">
								   <input type="submit" class="btn btn-rounded bg-info" value="Update"> &nbsp;&nbsp;
								   <a href="<?php echo base_url(); ?>settings" class="btn btn-rounded bg-warning"> Cancel </a>
								</div>
                            </form>
                            </div>
                            </div>
                            <div class="col-md-4">
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
                </div>
            </div>
            <!-- Filter Criteria Form end -->
    </div>
</div>


<script src="<?php echo base_url(); ?>assets/js/editTag.js" type="text/javascript"></script>