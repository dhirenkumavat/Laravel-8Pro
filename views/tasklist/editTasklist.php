<?php
$taskId = $getTaskListInfo->taskId;
$message = $getTaskListInfo->name;
$eventDate = date("m/d/Y", strtotime($getTaskListInfo->eventDate));
?>
 <div class="dashboard-wrapper" id="page-content-wrapper">
    <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">
                <!-- ============================================================== -->
                <div class="ecommerce-widget">            
                <!-- Filter Criteria Form start -->
                <div class="card editViewLeadClass">
                    <div class="custom-card"><h5 class="card-header"> Edit Task List</h5></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <form role="form" action="<?php echo base_url() ?>saveTaskList" method="post" id="editTaskList" role="form">
                                        <div class="form-row">    
                                             
                                            <div class="form-group col-xl-12 mb-4">
											   <label for="message">Message *</label>
                                               <input type="text" class="form-control" id="message" placeholder="Message" name="message" value="<?php echo $message; ?>">
                                                <input type="hidden" value="<?php echo $taskId; ?>" name="taskId" id="taskId" />  
                                            </div>
                                                                                
                                            
                                            <div class="form-group col-xl-12 mb-4">
												<label for="eventDate">Task Date *</label>
                                               <input type="text" class="form-control" id="eventDate" placeholder="Event Date" name="eventDate" value="<?php echo $eventDate; ?>"> 
                                            </div>
                                             
											<div class="col-sm-12 col-md-12 col-lg-12 text-center">
                                                <input type="submit" class="btn btn-rounded bg-info" value="Update"> &nbsp;&nbsp;
                                                <a href="<?php echo base_url(); ?>taskListing" class="btn btn-rounded bg-warning"> Cancel </a>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script type="text/javascript">
$(document).ready(function() {
    //Task expiry date
    $('#eventDate').datepicker({  
        minDate:new Date(),
        beforeShow: function (input, inst) {
            var rect = input.getBoundingClientRect();
            setTimeout(function () {
            //Set your datepicker possition
                inst.dpDiv.css({ top: rect.top + 40, left: rect.left + 0 });
            }, 0);
        }            
    });
});
</script>