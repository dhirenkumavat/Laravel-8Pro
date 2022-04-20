<?php
$sellingId = $sellingInfo->sellingId;
$ownership = $sellingInfo->ownership;
$policyExp = $sellingInfo->policyExpiration;
$businessOwner = $sellingInfo->businessOwner;

?>

 <div class="dashboard-wrapper" id="page-content-wrapper">
    <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">
                <!-- ============================================================== -->
                <div class="ecommerce-widget">            
                <!-- Filter Criteria Form start -->
                <div class="card editViewLeadClass1">
                    <div class="custom-card"><h5 class="card-header"> Edit Selling List </h5></div>
                        <div class="card-body">
                            <div class="row">
                            <div class="col-sm-6 offset-3">
                            <form role="form" action="<?php echo base_url() ?>editSelling" method="post" id="editSelling" role="form">
                                <div class="form-row">
                                    <div class="col-xl-10 offset-xl-1 mb-3">
										<label for="Ownership">Ownership</label>
                                        <input type="text" class="form-control" id="ownership" placeholder="ownership" name="ownership" value="<?php echo $ownership; ?>" maxlength="128">
                                        <input type="hidden" value="<?php echo $sellingId; ?>" name="sellingId" id="sellingId" /> 
                                    </div>
                                    <div class="col-xl-10 offset-xl-1 mb-3">
										<label for="policyExp">Policy Expiration</label>
                                        <input type="text" class="form-control" value="<?php echo $policyExp?>" id="policyExp" placeholder="Policy Expiration" name="policyExp">
                                    </div>
                                    <div class="col-xl-10 offset-xl-1 mb-4"> 
										<label for="businessOwner">Business Owner</label>
                                        <select class="form-control" id="businessOwner" name="businessOwner">
                                            <option value="0">Please Select </option>
                                            <option value="1" <?php if($businessOwner == "1"){?> selected="selected" <?php }?>>Yes</option>
                                            <option value="2" <?php if($businessOwner == "2"){?> selected="selected" <?php }?>>No</option>
                                        </select>
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="<?php echo base_url(); ?>assets/js/editSelling.js" type="text/javascript"></script>
<script>
  $( function() {
    $( "#policyExp" ).datepicker();
  } );
  </script>