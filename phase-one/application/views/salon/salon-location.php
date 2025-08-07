<?php include('header.php'); ?>
<style type="text/css">
    .error {
        color: red;
        float: left;
        /*    position: absolute;*/
    }
    #map {
        height: 400px;
        width: 100%;
    }
    .map-btn {
        position: absolute;
        top: 30px;
        right: 12px;
        background-color: transparent !important;
        color: #424242 !important;
        border: none;
        padding: 0px 12px;
        margin: 0px;
        font-size: 25px;
        outline: none !important;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Store Location
                </h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">

                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">

                    </div>
                    <div class="x_content">
                        <div class="container">
                            <form method="post" name="customer_form" id="customer_form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <label>Address<b class="require">*</b></label>
                                        <input autocomplete="off" type="text" class="form-control" name="location" id="location" value="<?php if (!empty($single_logo)) {echo $single_logo->location; } ?>" placeholder="Search Location">
                                        <button type="button" class="btn btn-primary map-btn" onclick="getCurrentLocation()" title="Get Current Location">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </button>
                                        <input type="hidden" name="id" id="id" value="<?php if (!empty($single_logo)) {echo $single_logo->id;} ?>">
                                        <input type="hidden" class="form-control" name="latitude" id="latitude" readonly>
                                        <input type="hidden" class="form-control" name="longitude" id="longitude" readonly>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <div id="map"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12" style="margin-top: 40px;">
                                        <button type="submit" class="btn btn-primary" name="location_btn" id="location_btn">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>

<script>
let map;
let marker;
let autocomplete;
var office_longitude = <?php if(!empty($single_logo)){ echo (float)$single_logo->longitude;}else{ echo 73.8445617; }?>;
var office_latitude = <?php if(!empty($single_logo)){ echo (float)$single_logo->latitude;}else{ echo 18.5314419; }?>;

function initMap() {
    // Initialize the map
    map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: office_latitude, lng: office_longitude },
        zoom: 15,
        mapId: "7d37ada8540acab4",
    });

    // Initialize the marker
    marker = new google.maps.marker.AdvancedMarkerElement({
        map: map,
        position: { lat: office_latitude, lng: office_longitude }, // Set marker position
        draggable: true
    });

    // Add listener for marker position changes
    marker.addListener('dragend', function() {
        let position = marker.position;
        document.getElementById('latitude').value = position.lat;
        document.getElementById('longitude').value = position.lng;
    });

    // Initialize the autocomplete service
    autocomplete = new google.maps.places.Autocomplete(
        document.getElementById('location'),
        { 
            types: ['establishment', 'geocode'], 
            componentRestrictions: { country: 'IN' }
        }
    );

    autocomplete.addListener('place_changed', function() {
        let place = autocomplete.getPlace();
        if (!place.geometry) {
            return;
        }

        // Set the map's viewport to the place's geometry
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(15);
        }

        // Set the marker position
        marker.position = { lat: place.geometry.location.lat(), lng: place.geometry.location.lng() };

        // Set the latitude and longitude values
        document.getElementById('latitude').value = place.geometry.location.lat();
        document.getElementById('longitude').value = place.geometry.location.lng();
    });
}
function getCurrentLocation() {
    if (navigator.geolocation) {
        // Browser supports geolocation
        navigator.geolocation.getCurrentPosition(function(position) {
            // Get current latitude and longitude
            let currentLat = position.coords.latitude;
            let currentLng = position.coords.longitude;

            // Set the map's center to the current location
            map.setCenter({ lat: currentLat, lng: currentLng });

            // Set zoom level for better visibility
            map.setZoom(15);

            // Set marker position
            marker.position = { lat: currentLat, lng: currentLng };

            // Update the latitude and longitude fields
            document.getElementById('latitude').value = currentLat;
            document.getElementById('longitude').value = currentLng;

            // Reverse geocode to get the address
            let geocoder = new google.maps.Geocoder();
            let latlng = { lat: currentLat, lng: currentLng };
            geocoder.geocode({ 'location': latlng }, function(results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        // Set the address in the input field
                        document.getElementById('location').value = results[0].formatted_address;
                    } else {
                        console.error('No results found');
                    }
                } else {
                    console.error('Geocoder failed due to: ' + status);
                }
            });
        }, function(error) {
            // Handle errors
            console.error('Error getting current location:', error);
            alert('Error getting current location. Please try again.');
        });
    } else {
        // Geolocation not supported by browser
        alert('Geolocation is not supported by your browser.');
    }
}
</script>

<script>
    $(document).ready(function() {
        initMap();
        $('#customer_form').validate({
            rules: {
                location: 'required',
            },
            messages: {
                location: 'Please enter address!',
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.salon-location').addClass('active_cc');
    });
</script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyjKElRlcYeCAQQ2TVb4sRxFGcYDFVvYk&callback=initMap&v=weekly&libraries=places,marker"
    async
    defer
></script>
