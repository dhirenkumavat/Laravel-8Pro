<?php
$email_template_id = $emailTemplateInfo->email_template_id;
$subject = $emailTemplateInfo->subject;
$body = $emailTemplateInfo->body;
?>

 <div class="dashboard-wrapper" id="page-content-wrapper">
    <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">
                <!-- ============================================================== -->
                <div class="ecommerce-widget">            
                <!-- Filter Criteria Form start -->
                <div class="card editViewLeadClass">
                    <div class="custom-card"><h5 class="card-header"> Edit Email Template</h5></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <form role="form" action="<?php echo base_url() ?>saveEmailTemplate" method="post" id="editEmailTemplate" role="form">
                                        <div class="form-row">    
                                             
                                            <div class="form-group col-xl-12 mb-4">
											   <label for="subject">Email Template Subject *</label>
                                               <input type="text" class="form-control" id="subject" placeholder="Subject" name="subject" value="<?php echo $subject; ?>">
                                                <input type="hidden" value="<?php echo $email_template_id; ?>" name="email_template_id" id="email_template_id" />  
                                            </div>
                                                                                
                                            
                                            <div class="form-group col-xl-12 mb-4">
												<label for="body">Email Template Body *</label>
                                               <!-- <input type="text" class="form-control" id="body" placeholder="Body" name="body" value="<?php echo $body; ?>">  -->
                                               <textarea id="body" name="body" rows="4" cols="50"><?php echo $body; ?></textarea>
                                            </div>
                                             
											<div class="col-sm-12 col-md-12 col-lg-12 text-center">
                                                <input type="submit" class="btn btn-rounded bg-info" value="Update"> &nbsp;&nbsp;
                                                <a href="<?php echo base_url(); ?>emailtemplatesListing" class="btn btn-rounded bg-warning"> Cancel </a>
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
<script src="<?php echo base_url(); ?>assets/js/editEmailTemplate.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/addEmailTemplate.js" type="text/javascript"></script>
<script src="//cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
 CKEDITOR.replace( 'body' );
</script>