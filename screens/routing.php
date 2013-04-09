<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>Routing to destination</title>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.css" />
        <script src="http://code.jquery.com/jquery-1.4.3.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.js"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?libraries=geometry&sensor=true"></script>
        <script type="text/javascript" src="geometa.js"></script>

        <script>
            var likeval=0;
            var unlikeval=0;

            $(document).ready(function(){
                $('#mybutton').click(function() {
			
                    $('#mybutton span span').html("Upload");
                });
	 

            });
        </script>
    </head>
    <body onload ="initialise()">
        <!-- Home -->
        <div data-role="page" id="page1">
            <div data-theme="c" data-role="header">
                <p style="margin-left:15px;">
                    Routing in progress
                </p>
                <div data-role="controlgroup" data-type="horizontal">
                    <a id ="done_adding" href ="#" data-role="button" data-inline="true" style="margin-left:5px; width:100px;" >Done</a>
                    <a href="startadding.php" rel="external" data-role="button" data-inline="true" style="margin-left:5px; width:100px;">Cancel</a>
                </div>
                <div id="map_canvas" style="width:500px; height:500px"></div>

                <script type="text/javascript">
                    var map;
                    var myInterval = 0;
                    var iFrequency = 5000;
                    var coordinates = [];
                    var destinationText =  "";
                    var sourceText = "";
                    var done_button;
                    var failedAttempts = 0;
                    var maxDistanceWalkable = 10;
                    var myOptions = {
                        zoom: 15,
                        mapTypeControl: true,
                        mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
                        navigationControl: true,
                        navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
                        mapTypeId: google.maps.MapTypeId.HYBRID
                    }
                    var realTimeCoords = new Array();

                    function update_coords(){
                        $.ajax({
                            url: "process_path.php",
                            type: "POST",
                            data: { coordinates: JSON.stringify(coordinates), destination: destinationText, source: sourceText},
                            cache: false,
                            success: function (response) {
                                alert(response);
                            }
                        });
                    }
                    function initialise() {
                        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                        done_button = document.getElementById("done_adding");
                        destinationText =  "<?php echo $_POST["dest"]; ?>";
                        sourceText = "<?php echo $_POST["source"]; ?>";

                        done_button.onclick = function(){
                            $('#done_adding span span').html("Upload");
                            clearInterval(myInterval);
                            done_button.onclick = update_coords;
                            var marker = new google.maps.Marker({
                                position: realTimeCoords[realTimeCoords.length-1],
                                map: map,
                                title:"You are here"
                            });

                            google.maps.event.addListener(marker, 'click', function() {
                                infowindow.open(map,marker);
                            });

                        }
                        prepareGeolocation();
                        doGeolocation();
                        startLoop();
                    }
                    function startLoop() {
                        if (myInterval > 0) clearInterval(myInterval);  // stop
                        myInterval = setInterval("doGeolocation()", iFrequency);  // run
                    }
                    function doGeolocation() {
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(positionSuccess, positionError);
                        } else {
                            positionError(-1);
                        }
                        var flightPath=new google.maps.Polyline({
                            path:realTimeCoords,
                            strokeColor:"#0000FF",
                            strokeOpacity:0.8,
                            strokeWeight:2
                        });

                        flightPath.setMap(map);
                    }
                    function positionError(err) {
                        var msg;
                        switch (err.code) {
                            case err.UNKNOWN_ERROR:
                                msg = "Unable to find your location";
                                break;
                            case err.PERMISSION_DENINED:
                                msg = "Permission denied in finding your location";
                                break;
                            case err.POSITION_UNAVAILABLE:
                                msg = "Your location is currently unknown";
                                break;
                            case err.BREAK:
                                msg = "Attempt to find location took too long";
                                break;
                            default:
                                msg = "Location detection not supported in browser";
                        }
                        document.getElementById('info').innerHTML = msg;
                    }

                    function distanceWalkableSinceLastEpoch(){
                        return (failedAttempts + 1) * maxDistanceWalkable;
                    }

                    function positionSuccess(position) {
                        var coords = position.coords || position.coordinate || position;
                        var latLng = new google.maps.LatLng(coords.latitude, coords.longitude);
                        //if(coordinates.length != 0){
                        //var coordinate = coordinates[coordinates.length - 1];
                        //  if((coordinate[0] != coords.latitude) || (coordinate[1] != coords.longtitude)){
                        var prevPosition;
                        if (realTimeCoords.length == 0){
                            prevPosition = latLng;
                        }
                        else{
                            prevPosition = realTimeCoords[realTimeCoords.length-1];
                        }
                        var distanceWalked = google.maps.geometry.spherical.computeDistanceBetween(prevPosition, latLng);
                        if(distanceWalked <= distanceWalkableSinceLastEpoch()){
                            coordinates.push([coords.latitude, coords.longitude]);
                            map.setCenter(latLng);
                            realTimeCoords.push(latLng);
                            failedAttempts = 0;
                        }
                        else{
                            failedAttempts++;
                        }

                        var infowindow = new google.maps.InfoWindow({
                            content: "<strong>yes</strong>"
                        });
                        if(coordinates.length == 1 && failedAttempts == 0){
                            var marker = new google.maps.Marker({
                                position: latLng,
                                map: map,
                                title:"You are here"
                            });

                            google.maps.event.addListener(marker, 'click', function() {
                                infowindow.open(map,marker);
                            });
                        }
                    }

                    function contains(array, item) {
                        for (var i = 0, I = array.length; i < I; ++i) {
                            if (array[i] == item) return true;
                        }
                        return false;
                    }
                </script>

            </div>
        </div>

    </body>
</html>