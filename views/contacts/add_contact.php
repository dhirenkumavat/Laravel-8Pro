
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

                <div class="addContact">
                    <?php $this->load->helper("form"); ?>
                    <form role="form" action="<?php echo base_url() ?>save_contact" method="post" id="addContact" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6 editPage">
                                <!-- Customer Data start -->
                                <div class="card">
                                    <div class="custom-card"><h5 class="card-header"> Contact Data </h5></div>
                                    <div class="card-body customerDataEditCard">
                                        <h4>
                                            <div class="row">
                                                <strong class="col-lg-4">Contact Name *:</strong>
                                                <span class="col-lg-8" id="contact_name">                        
                                                    <input class="form-control" type="text" value="<?php echo set_value('contactName'); ?>" required id="contactName" name="contactName">
                                                </span>
                                            </div>
                                        </h4>
                                        <h4>
                                            <div class="row">
                                                <strong class="col-lg-4">Contact Email:</strong>
                                                <span class="col-lg-8" id="contact_email">                          
                                                    <input class="form-control" type="text" value="<?php echo set_value('contactEmail'); ?>" id="contactEmail" name="contactEmail">
                                                </span>
                                            </div>
                                        </h4>
                                        <h4>
                                            <div class="row">
                                                <strong class="col-lg-4">Phone:</strong>
                                                <span class="col-lg-8" id="contact_phone">                          
                                                    <input class="form-control" type="text" value="<?php echo set_value('contactPhone'); ?>" id="contactPhone" name="contactPhone">
                                                </span>
                                            </div>
                                        </h4>

                                        <h4>
                                            <div class="row">
                                                <strong class="col-lg-4">Mobile:</strong>
                                                <span class="col-lg-8" id="contact_phone2">                          
                                                    <input class="form-control" type="text" value="<?php echo set_value('contactPhone2'); ?>" id="contactPhone2" name="contactPhone2">
                                                </span>
                                            </div>
                                        </h4>


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
                                                                    <option data-tokens="<?php echo $user->userId; ?>" value="<?php echo $user->userId; ?>"><?php echo $user->name ?></option>
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

                                        <!-- <h4>
                                            <div class="row">
                                                <strong class="col-lg-4">Business Name:</strong>
                                                <span class="col-lg-8" id="business_name">                             
                                                    <input class="form-control bname" type="text" value="<?php echo set_value('businessName'); ?>" id="businessName" name="businessName">
                                                </span>
                                            </div>
                                        </h4>
 -->
                                        <h4>
                                            <div class="row">
                                                <strong class="col-lg-4">Buisness *: </strong>
                                                <span class="col-lg-6">                
                                                    <select class="form-control" id="clientid" name="clientid" required>
                                                        <option value="">Select Business</option>
                                                            <?php
                                                            if(!empty($clientList))
                                                            {
                                                                foreach ($clientList as $client)
                                                                {
                                                                    ?>
                                                                    <option data-tokens="<?php echo $client->id; ?>" value="<?php echo $client->id; ?>"><?php echo $client->client_name ?></option>
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
                                                    <input class="form-control" type="text" name="client_address" id="contactAddress" value="" readonly=""> 
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
                                        <textarea name="comment" id="comment"></textarea>
                                    </div>
                                </div>
                                <!-- Private Notes & Comments start -->
                            </div>

                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="custom-card"><h5 class="card-header"> Opt-In </h5></div>
                                    <div class="card-body">
                                        <div class="row m-t-10 m-b-10">                      
                                            <div class="col-lg-4">
                                                <label class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" name="optionIn[0]"  value="sms" class="custom-control-input sms"><span class="custom-control-label">SMS</span>
                                                </label>
                                                <div class="blue-btn disabledbutton" id="chksms"><a href="#" onclick="sendText();" class="btn btn-rounded bg-info" style="width: 100%;"> Text </a></div>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox"  value="call" name="optionIn[1]" class="custom-control-input call"><span class="custom-control-label">Call</span>
                                                </label> 
                                                <div class="blue-btn disabledbuttoncall" id="chkcall"><a href="#" class="btn btn-rounded bg-info" style="width: 100%;"> Call </a></div>
                                            </div>  
                                            <div class="col-lg-4">
                                                <label class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox"  value="email" name="optionIn[2]" class="custom-control-input emails"><span class="custom-control-label">Email</span>
                                                </label>
                                                <div class="blue-btn disabledbuttonemail" id="chkemail"><a href="#" onclick="sendMail();" class="btn btn-rounded bg-info" style="width: 100%;"> Email </a></div>    
                                            </div>  
                                            <div class="col-lg-4">
                                                <label class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" name="optionIn[3]" value="other" id="optionIn" class="custom-control-input other"><span class="custom-control-label">Other</span>
                                                </label>    
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card communicationClass">
                                    <div class="custom-card"><h5 class="card-header"> Communications </h5> </div>
                                    <div class="card-body"></div>
                                </div>
                            </div>
                        </div>
                         <div class="col-sm-12 buttonFooter">
                            <div class="col-sm-12 buttonFooterInner">
                                <div class="col-6 m-t-20 m-b-20 bigBtnsDiv">
                                    <input type="submit" class="btn btn-rounded bg-info update_form" value="Save"> 
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
        <h3 class="modal-title"><strong> Business </strong></h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-sm-12 form-group">
                        <label>Business:</label>
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
                        <label>Adress:</label>
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

function validatePhone(phone) {

    phone = phone.replace(/[^0-9]/g,'');
    if (phone.length != 10)
    {
        return false;
    }
}

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

    function SaveClient(){
        var clientName   = $("#clientName").val();
        var addressAutocomplete   = $("#addressAutocomplete").val();
        var buisnessType = $("#buisnessType").val();
        var phNo   = $("#contact_buisness_phone").val();
        
        if(clientName==''){
            $("#clientNameError").show();
        }else if(phNo == ''){
            $("#conatctBuisnessPhError").show();
        }else if(validatePhone(phNo)==false){
            $("#conatctBuisnessPhError").show();
        }else if(addressAutocomplete==''){
            $("#addressError").show();
        }else if(buisnessType == ""){
            $("#buisnessTypeError").show();
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

