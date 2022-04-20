<?php
$system_template_id = $systemTemplateInfo->system_template_id;
$subject = $systemTemplateInfo->subject;
$body = $systemTemplateInfo->body;
?>

 <div class="dashboard-wrapper" id="page-content-wrapper">
    <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">
                <!-- ============================================================== -->
                <div class="ecommerce-widget">            
                <!-- Filter Criteria Form start -->
                <div class="card editViewLeadClass">
                    <div class="custom-card"><h5 class="card-header"> Edit Sysytem Template</h5></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <form role="form" action="<?php echo base_url() ?>saveSystemTemplate" method="post" id="editSystemTemplate" role="form">
                                        <div class="form-row">    
                                             
                                            <div class="form-group col-xl-12 mb-4">
											   <label for="subject">Sysytem Template Subject *</label>
                                               <input type="text" class="form-control" id="subject" placeholder="Subject" name="subject" value="<?php echo $subject; ?>">
                                                <input type="hidden" value="<?php echo $system_template_id; ?>" name="system_template_id" id="system_template_id" />  
                                            </div>
                                                                                
                                            
                                            <div class="form-group col-xl-12 mb-4">
												<label for="body">Sysytem Template Body *</label>
                                               <!-- <input type="text" class="form-control" id="body" placeholder="Body" name="body" value="<?php echo $body; ?>">  -->
                                               <textarea id="body" name="body" rows="4" cols="50"><?php echo $body; ?></textarea>
                                            </div>
                                             
											<div class="col-sm-12 col-md-12 col-lg-12 text-center">
                                                <input type="submit" class="btn btn-rounded bg-info" value="Update"> &nbsp;&nbsp;
                                                <a href="<?php echo base_url(); ?>systemtemplatesListing" class="btn btn-rounded bg-warning"> Cancel </a>
                                            </div>											
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <!-- Filter Criteria Form end -->
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/editSystemTemplate.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/addSystemTemplate.js" type="text/javascript"></script>
<script src="//cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
 CKEDITOR.replace( 'body' );
</script>