<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<?php


$db_host = "localhost";
	$db_username = "root";
	$db_pass = "root";
	$db_name = "path_mapper";

$id = $_GET["id"];
@mysql_connect("$db_host","$db_username","$db_pass") or die ("Could not connect to MySQL");
@mysql_select_db("$db_name") or die ("No Database of that name");


$result = mysql_query("SELECT latitude, longitude 
FROM  `coordinates`
WHERE path_id = " . $id . "
") or die(mysql_error());
 echo($result);
 $coordinates = array();
 while ($row = mysql_fetch_assoc($result)) {
    echo $row['id'];
    array_push($coordinates, array($row['latitude'], $row['longitude']));
}
$encoded_result= json_encode(json_encode($coordinates));

 /* while($row = mysql_fetch_array($result))
   {  
    $latitude = $row['latitude'];
    $longitude = $row['longitude'];
   }
*/
?>
	<title>Pathway display</title>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.css" />
	<script src="http://code.jquery.com/jquery-1.4.3.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBDr01oMpABaGg10WW96W1_5CaYLIlLXVg&sensor=false"></script>

	<script>
		var likeval=0;
		var unlikeval=0;

			$(document).ready(function(){
		    $('#yea').click(function() {
			likeval++;
		    alert(likeval);
		});
		 $('#nay').click(function() {
			unlikeval++;
		    alert(unlikeval);
		});
				 

		});
	</script>
	<script>
		function initialize_map()
		{
			var myOptions = {
			      zoom: 15,
			      mapTypeControl: true,
			      mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
			      navigationControl: true,
			      navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
			      mapTypeId: google.maps.MapTypeId.HYBRID      
			    }	
			map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
			displaypath();		
		}

		function displaypath()
		{
			//alert("in javascript ");
			var realTimeCoords = new Array();
			var pathPoints = jQuery.parseJSON(<?php echo $encoded_result; ?>);
			//var tcoords= {latitude= 33.777364, longitude = -84.408574};
			var coords= pathPoints.pop();
			var pos=new google.maps.LatLng(coords[0],coords[1]);
			var marker = new google.maps.Marker({
			    position: pos,
			    map: map,
			    title:"Destination"
			});
			google.maps.event.addListener(marker, 'click', function() {
			  infowindow.open(map,marker);
			});
			realTimeCoords.push(pos);
			
			while(pathPoints.length > 0)
			{				
				coords= pathPoints.pop();
				pos=new google.maps.LatLng(parseFloat(coords[0]),parseFloat(coords[1]));
				realTimeCoords.push(pos);
			}
			var marker = new google.maps.Marker({
			    position: pos,
			    map: map,
			    title:"Start point"
			});
			google.maps.event.addListener(marker, 'click', function() {
			  infowindow.open(map,marker);
			});
			map.setCenter(pos);

			var pathWay=new google.maps.Polyline({
			  path:realTimeCoords,
			  strokeColor:"#0000FF",
			  strokeOpacity:0.8,
			  strokeWeight:2
			  });
			pathWay.setMap(map);	
		}

	</script>

</head>

<body onload="initialize_map()"> 
	<!-- Home -->
	<div data-role="page" id="page1">
	    <div data-theme="c" data-role="header">
		<input
		    type="button"
		    name="yea"
		    id="yea"
		    data-icon="plus" 
		    data-iconpos="right" 
		    data-theme="c" 
		    value="Yea!" />
		<h3>
		    Showing route
		</h3>
		
		<input
		    type="button"
		    name="nay"
		    id="nay"
		    data-icon="minus" 
		    data-iconpos="left" 
		    data-theme="c" 
		    value="Nay!" />
	    </div>
	 

 <div data-role="content" id="map_canvas" style="height:500px; width:500px">
 </div>
</div>

</body>
</html>
