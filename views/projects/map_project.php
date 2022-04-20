<?php
$address = $leadInfo->address;
?>

<style>
    .disabledbutton { pointer-events: none; opacity: 0.4;}
    .disabledbuttoncall { pointer-events: none; opacity: 0.4;}
    .disabledbuttonemail { pointer-events: none; opacity: 0.4;}
    .sweet-alert .sa-icon.sa-success::before { width: 100px; transform: rotate(90deg);}
</style>
<script>
    setTimeout(function() {
    $('.alert').fadeOut('fast');
}, 20000); // <-- time in milliseconds
</script>
    <div class="dashboard-wrapper" id="page-content-wrapper">
        <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">
                <div class="editViewLeadClass1">
                    <div class="row">
                        <div class="col-lg-12"> 
                            <div id="map" style="width:100%; height:600px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7_NfvBxKc8FpOZgAlRLlW0SApkVbidb4&libraries=places&callback=initAutocomplete" async defer></script>

<!---------------- View on Map ---------------->
<style>
    #map-address {height: 100%;}
    html, body {height: 100%;margin: 0;padding: 0;}
    #floating-panel { position: absolute;top: 10px;left: 25%;z-index: 5;background-color: #fff; padding: 5px;border: 1px solid #999; text-align: center;font-family: 'Roboto','sans-serif';line-height: 30px;padding-left: 10px;}
</style>
<?php 
//get lat long
    $getLatLong = $this->map_model->getLatLong($address);
    if(!empty($getLatLong)){
        $getLatLongArr = explode("@", $getLatLong);
    }
?>
 <script type="text/javascript">

    $(document).ready(function() {
        var address = "<?php echo $address; ?>";
        var lat = "<?php echo $getLatLongArr[0]; ?>";
        var long = "<?php echo $getLatLongArr[1]; ?>";
        viewonMap(address,lat,long);
    });

     function viewonMap(address,lat,long){ 
        if(lat!='' && long!=''){
            var locations = [
              [address, lat,long, 4]];

            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 12,
              center: new google.maps.LatLng(lat, long),
              mapTypeId: google.maps.MapTypeId.SATELLITE
            });

            var infowindow = new google.maps.InfoWindow();

            var marker, i;

            for (i = 0; i < locations.length; i++) {  
              marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
              });

              google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                  infowindow.setContent(locations[i][0]);
                  infowindow.open(map, marker);
                }
              })(marker, i));
            }
        }
     }
 </script>