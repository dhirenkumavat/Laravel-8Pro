<?php 
//print_r($clientAddress);die;
$id = $contactInfo->id;
$clientID = $contactInfo->clientId;
$assigned_to = $contactInfo->assigned_to;
$contact_name = $contactInfo->contact_name;
$contact_email = $contactInfo->contact_email;
$contact_phone = $contactInfo->contact_phone;
$contact_phone2 = $contactInfo->contact_phone2;
$business_name = $contactInfo->business_name;
$comment = $contactInfo->comment;
?>
<style>
    .disabledbutton { pointer-events: none; opacity: 0.4;}
    .disabledbuttoncall { pointer-events: none; opacity: 0.4;}
    .disabledbuttonemail { pointer-events: none;opacity: 0.4;}
    .sweet-alert .sa-icon.sa-success::before {width: 100px;transform: rotate(90deg);}
    .pac-container { z-index: 10000 !important; }
</style>
<script>
    setTimeout(function() {
        $('.alert').fadeOut('fast');
    }, 20000); // <-- time in milliseconds
</script>
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

                        <div class="col-md-12">
                            <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                        </div> 
                    </div>
                </div>

                <div class="editViewLeadClass1">
                    <?php $this->load->helper("form"); ?>
                    <form role="form" action="<?php echo base_url() ?>editContactSubmit" method="post" id="editContact" enctype="multipart/form-data">
                        <input type="hidden" value="<?php echo $id; ?>" name="contactId" id="contactId" />
                        <div class="row">
                            <div class="col-lg-6 editPage">
                                <!-- Customer Data start -->
                                <div class="card">
                                    <div class="custom-card"><h5 class="card-header"> Contact Data </h5></div>
                                    <div class="card-body customerDataEditCard">
                                        <h4>
                                            <div class="row">
                                                <strong class="col-lg-4">Contact Name *:</strong>
                                                <span class="col-lg-8" id="contact_name"><?php echo $contact_name; ?>                               
                                                    <input class="form-control cname" type="hidden" value="<?php echo $contact_name; ?>" id="contactName" name="contactName">
                                                    <i class="fas fa-pencil-alt p-l-10" id="cname"></i>
                                                </span>
                                            </div>
                                        </h4>
                                        <h4>
                                            <div class="row">
                                                <strong class="col-lg-4">Contact Email:</strong>
                                                <span class="col-lg-8" id="contact_email"><?php echo $contact_email; ?>                               
                                                    <input class="form-control cemail" type="hidden" value="<?php echo $contact_email; ?>" id="contactEmail" name="contactEmail">
                                                    <i class="fas fa-pencil-alt p-l-10" id="cemail"></i>
                                                </span>
                                            </div>
                                        </h4>
                                        <h4>
                                            <div class="row">
                                                <strong class="col-lg-4">Phone:</strong>
                                                <span class="col-lg-8" id="contact_phone"><?php echo $contact_phone; ?>                               
                                                    <input class="form-control cphone" type="hidden" value="<?php echo $contact_phone; ?>" id="contactPhone" name="contactPhone">
                                                    <i class="fas fa-pencil-alt p-l-10" id="cphone"></i>
                                                </span>
                                            </div>
                                        </h4>

                                        <h4>
                                            <div class="row">
                                                <strong class="col-lg-4">Mobile:</strong>
                                                <span class="col-lg-8" id="contact_phone2"><?php echo $contact_phone2; ?>                               
                                                    <input class="form-control cphone2" type="hidden" value="<?php echo $contact_phone2; ?>" id="contactPhone2" name="contactPhone2">
                                                    <i class="fas fa-pencil-alt p-l-10" id="cphone2"></i>
                                                </span>
                                            </div>
                                        </h4>

                                        <!-- <h4>
                                            <div class="row">
                                                <strong class="col-lg-4">Business Name:</strong>
                                                <span class="col-lg-8" id="business_name"><?php echo $business_name; ?>                               
                                                    <input class="form-control bname" type="hidden" value="<?php echo $business_name; ?>" id="businessName" name="businessName">
                                                    <i class="fas fa-pencil-alt p-l-10" id="bname"></i>
                                                </span>
                                            </div>
                                        </h4> -->
                                        <h4>
                                            <div class="row">
                                                <strong class="col-lg-4">Assigned To: </strong>
                                                <span class="col-lg-8">                
                                                    <select class="form-control" id="assigned_to" name="assigned_to">
                                                        <option value="">Select Assigned To</option>
                                                            <?php
                                                            if(!empty($userList))
                                                            {

                                                                foreach ($userList as $user)
                                                                {
                                                                    //print_r($user);
                                                                    ?>
                                                                    <option data-tokens="<?php echo $user->userId; ?>" <?php if($user->userId == $assigned_to){ echo "selected"; } ?> value="<?php echo $user->userId; ?>"><?php echo $user->name ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                    </select>
                                                </span>
                                                <!-- <span class="col-md-2 text-right">
                                                    <p><i class="fas fa-plus-circle fa-2x" onclick="AddClientPop();"></i></p>
                                                </span> -->
                                            </div>
                                        </h4>
                                        <h4>
                                            <div class="row">
                                                <strong class="col-lg-4">Buisness *: </strong>
                                                <span class="col-lg-6">                
                                                    <select class="form-control" id="clientid" name="clientid" required>
                                                        <option value="">Select Buisness</option>
                                                            <?php
                                                            if(!empty($clientList))
                                                            {
                                                                foreach ($clientList as $client)
                                                                {
                                                                    ?>
                                                                    <option data-tokens="<?php echo $client->id; ?>" <?php if($client->id == $clientID){ echo "selected"; } ?> value="<?php echo $client->id; ?>"><?php echo $client->client_name ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                    </select>
                                                </span>
                                                <span class="col-md-2 text-right">
                                                    <p><i class="fas fa-plus-circle fa-2x" onclick="AddClientPop();"></i></p>
                                                </span>
                                            </div>
                                        </h4>
                                        <h4>
                                            <div class="row">
                                                <strong class="col-lg-4">Address:</strong>
                                                <span class="col-lg-8" id="address">                              
                                                    <input class="form-control" type="text" name="client_address" id="contactAddress" value="<?php echo $clientAddress->address;?>" readonly=""> 
                                                        <span style="color: red; display: none;" id="contactAddressError">Please enter Address.</span>
                                                </span>
                                            </div>
                                        </h4>
                                    </div>
                                </div>
                                 <!-- Customer Data end -->

                                <!-- Private Notes & Comments start -->
                                <div class="card">
                                    <div class="custom-card">
                                        <h5 class="card-header"> Private Notes & Comments </h5>
                                    </div>
                                    <div class="card-body">
                                        <textarea name="comment" id="comment"><?php echo $comment; ?></textarea>
                                    </div>
                                </div>
                                <!-- Private Notes & Comments start -->
                            </div>

                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="custom-card"><h5 class="card-header"> Opt-In </h5></div>
                                    <div class="card-body">
                                        <div class="row m-t-10 m-b-10">                      
                                            <?php if(!empty($optionData) &&  $optionData[0]['sms']!=''){?>
                                            <div class="col-lg-4">
                                                <label class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" name="optionIn[0]" value="sms" checked="checked" class="custom-control-input sms"><span class="custom-control-label">SMS</span>
                                                </label>
                                                <div class="blue-btn " id="chksms"><a href="#" onclick="sendText();" class="btn btn-rounded bg-info <?php if(isset($contact_phone) && !empty($contact_phone)) { echo ""; } else { echo "disabledbuttoncall"; } ?>" style="width: 100%;"> Text </a></div>
                                           </div>
                                           <?php }else{?>
                                            <div class="col-lg-4">
                                                <label class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" name="optionIn[0]"  value="sms" class="custom-control-input sms"><span class="custom-control-label">SMS</span>
                                                </label>
                                                <div class="blue-btn disabledbutton" id="chksms"><a href="#" onclick="sendText();" class="btn btn-rounded bg-info" style="width: 100%;"> Text </a></div>
                                            </div>
                                           <?php }  if(!empty($optionData) &&  $optionData[0]['calls'] != ''){ ?>
                                            <div class="col-lg-4">
                                                <label class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" value="call" checked="checked" name="optionIn[1]" class="custom-control-input call"><span class="custom-control-label">Call</span>
                                                </label> 
                                                <div class="blue-btn" id="chkcall">
                                                    <a href="javascript:void(0)" onclick="sendCalls('<?php echo $id; ?>');" class="btn btn-rounded bg-info <?php if(isset($contact_phone) && !empty($contact_phone)) { echo ""; } else { echo "disabledbuttoncall"; } ?>" style="width: 100%;"> Call </a>
                                                </div>
                                            </div>                              
                                           <?php }else{?>
                                            <div class="col-lg-4">
                                                <label class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox"  value="call" name="optionIn[1]" class="custom-control-input call"><span class="custom-control-label">Call</span>
                                                </label> 
                                                <div class="blue-btn disabledbuttoncall" id="chkcall"><a href="#" class="btn btn-rounded bg-info" style="width: 100%;"> Call </a></div>
                                            </div>  
                                           <?php } if(!empty($optionData) &&  $optionData[0]['email']!=''){?>
                                            <div class="col-lg-4">
                                                <label class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" value="email" name="optionIn[2]" checked="checked" class="custom-control-input emails"><span class="custom-control-label">Email</span>
                                                </label>  
                                                <div class="blue-btn " id="chkemail"><a href="#" onclick="sendMail();" class="btn btn-rounded bg-info <?php if(isset($contact_email) && !empty($contact_email)) { echo ""; } else { echo "disabledbuttoncall"; } ?>" style="width: 100%;"> Email </a></div> 
                                            </div>                            
                                           <?php } else{ ?>
                                            <div class="col-lg-4">
                                                <label class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox"  value="email" name="optionIn[2]" class="custom-control-input emails"><span class="custom-control-label">Email</span>
                                                </label>
                                                <div class="blue-btn disabledbuttonemail" id="chkemail"><a href="#" onclick="sendMail();" class="btn btn-rounded bg-info" style="width: 100%;"> Email </a></div>    
                                            </div>  
                                           <?php } ?>
                                            <div class="col-lg-4">
                                                <label class="custom-control custom-checkbox custom-control-inline">
                                                    <?php if(!empty($optionData) &&  $optionData[0]['other']!=''){?>
                                                        <input checked="checked" type="checkbox" name="optionIn[3]" value="other" id="optionIn" class="custom-control-input other"><span class="custom-control-label">Other</span>
                                                    <?php }else{?>
                                                        <input type="checkbox" name="optionIn[3]" value="other" id="optionIn" class="custom-control-input other"><span class="custom-control-label">Other</span>
                                                    <?php }?>
                                                </label>    
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card communicationClass">
                                    <div class="custom-card"><h5 class="card-header"> Communications </h5> </div>
                                    <div class="card-body">
                                        <div class="ScrollClassDynamic" style="max-height: 240px; min-height: 240px;">
                                                <?php
                                                if(!empty($communication))
                                                {
                                                    foreach ($communication as $rl)
                                                    { ?>
                                                    <div class="row">
                                                        <div class="col-sm-12 p-0">
                                                            <div class="row">
                                                                <div class="col-sm-2 text-left pr-0">
                                                                <?php if($rl->type==1 || $rl->type == 3){ ?>
                                                                    <i class="fas fa-phone fa-lg"></i>
                                                                <?php }else if($rl->type==2){ ?>
                                                                    <i class="fas fa-envelope fa-lg"></i>
                                                                <?php } else{ ?>
                                                                    <i class="fas fa-comments fa-lg"></i>
                                                                <?php }  ?>
                                                                </div>
                                                                <div class="col-sm-4 checkbox-a pl-0">
                                                                    <?php if($rl->type == 3){ ?>
                                                                    <a href="javascript:void(0)"><?= $rl->tosend ?></a>
                                                                    <?php } else { ?>
                                                                    <a href="#" onclick="commShowDetails('<?php echo $rl->type;?>','<?php echo $rl->communicationId;?>');"><?php echo $rl->froms;?></a>
                                                                    <?php } ?>
                                                                </div>
                                                                <div class="col-sm-4 pl-0">
                                                                    <p><?php echo date("m/d/Y H:i:s", strtotime($rl->createdDtm)) ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <?php }
                                                }else{?>
                                                    <div class="row">
                                                    
                                                    <div class="col-sm-12">
                                                    <div class="">
                                                        
                                                        <div class="col-lg-12" id="notAvail">
                                                            <p>No communication available.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                  
                                            </div>
                                            <?php }
                                                ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="col-sm-12 buttonFooter">
                            <div class="col-sm-12 buttonFooterInner">
                                <div class="col-6 m-t-20 m-b-20 bigBtnsDiv">
                                    <input type="submit" class="btn btn-rounded bg-info update_form" value="Update"> 
                                </div>
                                <div class="col-6 m-t-20 m-b-20 bigBtnsDiv">
                                   <a href="<?php echo base_url(); ?>contacts" class="btn btn-rounded bg-warning"> Cancel </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!---------Mapping Popup---------->
<!-- The Modal -->
<div class="modal" id="myModalClients">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h3 class="modal-title"><strong> Buisness </strong></h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-sm-12 form-group">
                        <label>Buisness:</label>
                        <input class="form-control" type="text" name="client_name" id="clientName" required=""> 
                        <span style="color: red; display: none;" id="clientNameError">Please enter message.</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-sm-12 form-group">
                        <label>Business Type:</label>
                        <input class="form-control" required type="text" value="" id="buisnessType" name="buisness_type">
                        <span style="color: red; display: none;" id="buisnessTypeError">Please enter buisness type.</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-sm-12 form-group">
                        <label>Phone Number:</label>
                        <input class="form-control" required type="text" value="" id="contact_buisness_phone" name="contact_buisness_phone">
                        <span style="color: red; display: none;" id="conatctBuisnessPhError">please enter valid phone number.</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-sm-12 form-group">
                        <label>Business Address:</label>
                        <input class="form-control" required type="text" value="" id="addressAutocomplete" name="buisnessAddress" onFocus="geolocate()">
                        <span style="color: red; display: none;" id="addressError">Please enter address.</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
            <a href="javascript:void(0);" onclick="SaveClient();" class="confirm btn btn-sm btn-danger">Save</a>
            <button type="button" class="btn btn-sm btn-default bg-warning" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>



<div class="modal" id="sendSmsModal">
    <div class="modal-dialog" id="editsmsloader">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="modal-title"><strong> Message </strong></h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">                                                
                        <textarea class="form-control" id="sms" rows="4" name="sms" required></textarea>
                        <span style="color: red; display: none;" id="smsError">Please enter message.</span>
                    </div>
                </div>
            </div>
            <?php 
                $ci = get_instance(); // CI_Loader instance
                $ci->load->config('twilio');
                $sms_sender = $ci->config->item('number');
            ?>
            <!-- Modal footer -->
            <div class="modal-footer">
                <input type="hidden" name="sms_sender" class="sms_sender" value="<?php echo $sms_sender; ?>">
                <a href="javascript:void(0);" onclick="sendSms();" class="confirm btn btn-sm btn-danger">Send</a>
                <button type="button" class="btn bg-warning btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- The email Modal -->
<div class="modal" id="sendmailModal">
    <div class="modal-dialog" id="loader">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="modal-title"><strong> Email </strong></h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body p-0">
                <div class="row">
                    <div class="col-lg-12">                        
                        <select name="emailTemplates" id="emailTemplates" class="form-control valid" onchange="getEmailText(this.value);">
                            <option value="">Select Template</option>
                            <?php if($emailTemplates) {
                                foreach($emailTemplates as $emailTemplatesVal){
                                ?>
                                 <option value="<?php echo $emailTemplatesVal->body; ?>"><?php echo $emailTemplatesVal->subject; ?></option>
                                <?php
                                }
                            } ?>
                        </select>
                        <br />
                    </div>
                </div>
            </div>
              
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 p-0">                        
                        <textarea  id="mail" name="mail"></textarea>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <a href="javascript:void(0);" onclick="sendMessages();" class="confirm btn btn-sm btn-danger">Send</a>
                <button type="button" class="btn bg-warning btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- call Modal -->
<div class="modal fade" id="callModal" tabindex="-1" role="dialog" aria-labelledby="callModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <button type="button" class="close callingModalClose" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      <div class="modal-body text-center callingModal">
        <h3 class="call_number"></h3>
        <p>Using your phone browser plugin, Click on the above.</p>
        <div class="col-sm-12 callingphone">
            <i class="fa fa-phone"></i>
            <img src="<?php echo base_url(); ?>assets/images/phoneloader.svg">
        </div>
      </div>
     <!-- <div class="modal-footer callingModalFooter">
        <button type="button" class="btn btn-default bg-warning btn-sm" data-dismiss="modal">Close</button>
      </div> -->
    </div>
  </div>
</div>

<!-- Communication Details -->
<div class="modal fade" id="ComDetailsModal" tabindex="-1" role="dialog" aria-labelledby="ComDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><strong> <span id="ComDetailsTitle"></span> Details</strong></h3>
            <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body text-center">
        <div class="col-sm-12" id="ComDetailsID">
           <img src="<?php echo base_url(); ?>assets/images/loader.svg">
        </div>
      </div>
    </div>
  </div>
</div>


<script src="<?php echo base_url(); ?>assets/js/editLead.js" type="text/javascript"></script>
<script src="//cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/select2/css/select2.css">
<script src="<?php echo base_url(); ?>assets/vendor/select2/js/select2.min.js"></script>

<script>
    CKEDITOR.replace( 'comment' );
    CKEDITOR.replace('mail');

    function getEmailText(emailText){
        CKEDITOR.instances['mail'].setData(emailText);
    }
</script>
<script>
var placeSearch, autocomplete;
     var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name',
        administrative_area_level_2: 'short_name'
      };
function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        

        addressAutocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('addressAutocomplete')),
            {types: ['geocode']});

        // autocomplete2 = new google.maps.places.Autocomplete(document.getElementById('autocomplete2'), { types: [ 'geocode' ] });
        // google.maps.event.addListener(autocomplete2, 'place_changed', function() {
        //   fillInAddress();
        // });

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        addressAutocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() { 
        // Get the place details from the autocomplete object.
        var place = addressAutocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>

    <!-- AIzaSyB7_NfvBxKc8FpOZgAlRLlW0SApkVbidb4 -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXnYIF2RRd5COYQasKvQdAK6Pa7jKl5Oc&libraries=places&callback=initAutocomplete"
        async defer></script>
<script>

$('#clientid').on('change', function() {
  var clientId = this.value;
   $.ajax({
            type        : "POST",
            url         : "<?php echo base_url(); ?>project/getAddressInfo",
            data        : {  clientId : clientId} 
            }).done(function(data){
                //console.log(data);
                $('#contactAddress').val(data);
        });
});

function AddClientPop(){
    $('#myModalClients').modal('show'); 
    //Assign fields values
    $("#clientName").val('');
    //Hide error msg

    $("#clientNameError").hide(); 
    $("#buisnessType").val('');
        $("#buisnessTypeError").hide();
    $("#addressAutocomplete").val('');
    $("#contact_buisness_phone").val('');
    $("#conatctBuisnessPhError").hide(); 
    $("#addressError").hide(); 
}

function validatePhone(phone) {

    phone = phone.replace(/[^0-9]/g,'');
    if (phone.length != 10)
    {
        return false;
    }
}

function SaveClient(){
    var clientName   = $("#clientName").val();
    var addressAutocomplete   = $("#addressAutocomplete").val();
    var buisnessType   = $("#buisnessType").val();
    var phNo   = $("#contact_buisness_phone").val();
    if(clientName==''){
        $("#clientNameError").show();
    }else if(phNo == ''){
        $("#conatctBuisnessPhError").show();
    }else if(validatePhone(phNo)==false){
            $("#conatctBuisnessPhError").show();
    }else if(buisnessType == ""){
            $("#buisnessTypeError").show();
        }else if(addressAutocomplete==''){
            $("#addressError").show();
        }else{
        jQuery.ajax({
            url: "<?php echo base_url(); ?>contact/saveClient",
            data: { clientName : clientName,buisnessType:buisnessType,phNo:phNo,address : addressAutocomplete} ,
            type: 'post', 
            dataType: 'json',
            'async': false,
            beforeSend: function () {
                //jQuery('#editsmsloader').html('<div class="text-center mrgA padA"><i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></div>');
            },            
            success: function (data) {
                //jQuery('#editsmsloader').hide();
                if(data.status == true) { 
                    clientId = data.result;
                    $('select#clientid option').removeAttr("selected");
                    $('#clientid').append('<option selected data-tokens="'+clientId+'" value="'+clientId+'">'+clientName+'</option>');
                    $('#contactAddress').val(addressAutocomplete);
                    $('#buisnessType').val(buisnessType);
                    $('#myModalClients').modal('hide'); 
                }else if(data.status == false) { 
                   clientId = "";
                }
            }        
        });
    }
}
</script>

<script>
    $(document).ready(function(){
        // Initialize select2
        $("#clientid").select2();   
        $("#assigned_to").select2();     
    });
</script>

<script type="text/javascript">
    function sendText(){
        $("#contactListError").hide();
        $("#smsError").hide();
        $('#sendSmsModal').modal('show');        
    }
    function sendMail(){
        $("#contactListEmailError").hide();
        $('#sendmailModal').modal('show');        
    }
    function sendCall(){
        $("#contactListCallError").hide();
        $('#sendcallModal').modal('show');      
    }


    function sendSms(){
        sms_message = $("#sms").val();
        sms_sender = $(".sms_sender").val();
        sms_recipient = $("#contactPhone").val();
        contactId = '<?php echo $id;?>';
        sms_from  = "<?php echo $this->session->userdata['name'];?>";
        sms_to = $("#contactPhone").val();
       
        if(sms_to==''){
            $("#contactListError").show();
        }else if(sms_message == ""){
              $("#smsError").show();
        }else{
            jQuery.ajax({
                url: "<?php echo base_url(); ?>contact/sendSms",
                data: { sms_sender : sms_sender,sms_message:sms_message,sms_recipient:sms_recipient,contactId:contactId,sms_from:sms_from,sms_to:sms_to} ,
                type: 'post', 
                dataType: 'json',
                beforeSend: function () {
                    jQuery('#editsmsloader').html('<div class="text-center mrgA padA"><i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></div>');
                },            
                success: function (data) {
                    jQuery('#editsmsloader').hide();
                    if(data.status == true) { 
                        swal({title: "Meesage Sent", text: "Your Message has been sent!", type: "success"},
                           function(){ 
                               location.reload();
                           }
                        );
                    }else if(data.status == false) { 
                        swal({title: "failed", text: "failed", type: "error"},
                           function(){ 
                               location.reload();
                           }
                        );

                    }
                }        
            });
        }    
    }

    function sendMessages(){
        var text    = CKEDITOR.instances['mail'].getData();    
        var email   = $("#contactEmail").val(); 
        var contactId  = '<?php echo $id;?>';
        var email_from  = "<?php echo $this->session->userdata['name'];?>";
        var email_to    = $("#contactEmail").val();

        if(email_to == ''){
            $("#contactListEmailError").show();
        }else{
            jQuery.ajax({
                url: "<?php echo base_url(); ?>contact/sendEmail",
                data: { text : text,email:$.trim(email),contactId:contactId,email_from:email_from,email_to:email_to } ,
                type: 'post', 
                dataType: 'json',
                beforeSend: function () {
                    jQuery('#loader').html('<div class="text-center mrgA padA"><i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></div>');
                },           
                success: function (data) {
                    jQuery('#loader').hide();
                    if(data.status = true) { 
                        swal({title: "Mail Sent", text: "Your Message  has been sent!", type: "success"},
                           function(){ 
                               location.reload();
                           }
                        );
                    }else if(data.status = false) { 
                            swal("failed!", "failed.", "error");
                    }
                }        
            });  
        }  
    }

    function sendCalls(contactId){ 
        phoneNumber  = $("#contactPhone").val();
        if(phoneNumber == ''){
            $("#contactListCallError").show();
        }else{
            conectCallAPI(contactId,phoneNumber);
        }
    }
</script>

<script type="text/javascript">
    function commShowDetails(ComType,comId){   
        if(ComType==0){
            var title="SMS ";
        }else if(ComType==1){
            var title="Call ";
        }else{
            var title="Email ";
        }  
        
        $.ajax({
            type        : "POST",
            url         : "<?php echo base_url(); ?>contact/getCommunicationDetails",
            data        : {  comId : comId} 
            }).done(function(data){
                $('#ComDetailsTitle').html(title);
                $('#ComDetailsID').html(data);
        });

        $('#ComDetailsModal').modal('show');
    }
</script>

<script type="text/javascript">
    $("#cname").click(function () {
        var cnameVal = $('input[name="contactName"]').val();
        $("#contact_name").replaceWith('<span class="col-lg-6"><input required class="form-control cname" type="text" value="'+cnameVal+'" id="contactName" name="contactName"></span>');
        $("#cname").remove();
    });

    $("#cemail").click(function () {
        var cemailVal = $('input[name="contactEmail"]').val();
        $("#contact_email").replaceWith('<span class="col-lg-6"><input class="form-control cemail" type="text" value="'+cemailVal+'" id="contactEmail" name="contactEmail"></span>');
        $("#cemail").remove();
    });

    $("#cphone").click(function () {
        var cphoneVal = $('input[name="contactPhone"]').val();
        $("#contact_phone").replaceWith('<span class="col-lg-6"><input class="form-control cphone" type="text" value="'+cphoneVal+'" id="contactPhone" name="contactPhone"></span>');
        $("#cphone").remove();
    });

    $("#cphone2").click(function () {
        var cphoneVal2 = $('input[name="contactPhone2"]').val();
        $("#contact_phone2").replaceWith('<span class="col-lg-6"><input class="form-control cphone2" type="text" value="'+cphoneVal2+'" id="contactPhone2" name="contactPhone2"></span>');
        $("#cphone2").remove();
    });

    $("#bname").click(function () {
        var bnameeVal = $('input[name="businessName"]').val();
        $("#business_name").replaceWith('<span class="col-lg-6"><input class="form-control bname" type="text" value="'+bnameeVal+'" id="businessName" name="businessName"></span>');
        $("#bname").remove();
    });
</script>

<script type="text/javascript">
    function conectCallAPI(contactId,phoneNumber){
        //$("#sendcallModal").modal("hide");

        var callLink = '<a href="javascript:void(0);" onclick="addCommData()">'+phoneNumber+'</a>';
        $(".call_number").html(callLink);
        $('#callModal').modal('show');
    }

    function addCommData(){ 
       var mobile  = $("#contactPhone").val();
       var contactId = '<?php echo $id; ?>';
        $.ajax({
            type : "POST",
            dataType : "json",
            url : "<?php echo base_url(); ?>contact/addCallData",
            data : { mobile : mobile,contactId: contactId },
            success : function(response){

                if (response.status == 200) {
                    var html = '<div class="row"><div class="col-sm-2 text-left pr-0"><i class="fas fa-phone fa-lg"></i></div><div class="col-sm-4 checkbox-a pl-0"><a href="javascript:void(0)">'+response.to+'</a></div><div class="col-sm-4 pl-0"><p>'+ response.createdDtm +'</p></div></div>';

                    $('.ScrollClassDynamic').append(html);
                    $('#notAvail').empty();
                }

            } 
        });
    }
</script>
