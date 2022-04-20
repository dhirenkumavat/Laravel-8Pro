
 <div class="dashboard-wrapper" id="page-content-wrapper">
    <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">
                <!-- ============================================================== -->
                <div class="ecommerce-widget">
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
                <!-- Filter Criteria Form start -->
                <div class="card editViewLeadClass">
                    <div class="custom-card"><h5 class="card-header"> Edit Business</h5></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <form role="form" action="<?php echo base_url()."editBuisnessSubmit"?>" method="post" id="editBuisnessSubmit" role="form">
                                        <div class="form-row">    
                                            <input type="hidden" name="buisnessId" id="buisnessId" value="<?php echo $buisnessInfo->id;?>">
                                            <div class="form-group col-xl-12 mb-4">
                                               <label for="subject">Business Name *</label>
                                               <input type="text" class="form-control" required id="buisnessName" placeholder="Business Name" name="buisnessName" value="<?php echo set_value('buisnessName',$buisnessInfo->client_name); ?>">
                                               <span class="error"><?php echo form_error('buisnessName'); ?></span>
                                            </div>

                                            <div class="form-group col-xl-12 mb-4">
                                               <label for="subject">Business Type *</label>
                                               <input type="text" class="form-control" required id="buisnessType" placeholder="Business Type" name="buisnessType" value="<?php echo set_value('buisnessType',$buisnessInfo->buisness_type); ?>">
                                               <span class="error"><?php echo form_error('buisnessType'); ?></span>
                                            </div>

                                            <div class="form-group col-xl-12 mb-4">
                                               <label for="subject">Phone Number *</label>
                                               <input type="text" class="form-control" required id="phNo" placeholder="Phone Number" name="phNo" value="<?php echo set_value('phNo',$buisnessInfo->phone_no); ?>">
                                               <!-- <span class="error"><?php //echo form_error('phNo'); ?></span> -->
                                            </div>

                                            <div class="form-group col-xl-12 mb-4">
                                               <label for="subject">Address *</label>
                                               <input type="text" class="form-control" required id="address" placeholder="Address" name="address" value="<?php echo set_value('address',$buisnessInfo->address); ?>" onFocus="geolocate()">
                                               <span class="error"><?php echo form_error('address'); ?></span>

                                            </div>
                                                                                
                                                                                         
                                            <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                                                <input type="submit" class="btn btn-rounded bg-info" value="Update"> &nbsp;&nbsp;
                                                <a href="<?php echo base_url(); ?>buisnessList" class="btn btn-rounded bg-warning"> Cancel </a>
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
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

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
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('address')),
            {types: ['geocode']});

       

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXnYIF2RRd5COYQasKvQdAK6Pa7jKl5Oc&libraries=places&callback=initAutocomplete" async defer></script>