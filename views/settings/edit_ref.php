<?php
$refId = $refInfo->referralId;
$referralName = $refInfo->referralName;
?>

 <div class="dashboard-wrapper" id="page-content-wrapper">
    <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">
                <!-- ============================================================== -->
                <div class="ecommerce-widget">            
                <!-- Filter Criteria Form start -->
                <div class="card editViewLeadClass1">
                    <div class="custom-card"><h5 class="card-header"> Edit Referral List </h5></div>
                        <div class="card-body">
                            <div class="row">
                            <div class="col-lg-6 offset-3">
                            <form role="form" action="<?php echo base_url() ?>editReferral" method="post" id="editReferral" role="form">
                                <div class="form-row">
                                    <div class="col-xl-10 offset-xl-1 mb-4">
										<label for="referralName">Referral Name</label>
                                        <input type="text" class="form-control" id="referralName" placeholder="Referral Name" name="referralName" value="<?php echo $referralName; ?>" maxlength="128">
                                        <input type="hidden" value="<?php echo $refId; ?>" name="refId" id="refId" /> 
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


<script src="<?php echo base_url(); ?>assets/js/editRef.js" type="text/javascript"></script>