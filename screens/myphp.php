<html>

<head>
<title> findagig </title>

<link rel='stylesheet' type="text/css" href="styles.css"/>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> 
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script> 

</head>

<body>

<?php
set_time_limit(300);

$destination = $_POST["destination"];
$startloc= (string) $_POST["startloc"];




	$db_host = "localhost";
	$db_username = "root";
	$db_pass = "manchester";
	$db_name = "Path-Mapper";


@mysql_connect("$db_host","$db_username","$db_pass") or die ("Could not connect to MySQL");
@mysql_select_db("$db_name") or die ("No Database of that name");
//echo $destination;

//$var1="CTR";
	// Add current location to first row of database
 //$query = mysql_query("INSERT IGNORE INTO $table_name_2 (ID,Artists,Venue,Geo_lat,Geo_long, URL,Date) VALUES ('$my_distance','My Location','blank','$my_lat','$my_long','blank',0000) ") or die(mysql_error());
$result = mysql_query("SELECT Latitude, Longitude 
FROM  `coordinates` 
WHERE cID =( SELECT pID
FROM  `paths` 
WHERE Destination =  '".$destination."' ) ") or die(mysql_error());
  
  while($row = mysql_fetch_array($result))
   {  
	  $latitude = $row['Latitude'];
	  $longitude = $row['Longitude'];
	  echo  $latitude; echo  $longitude; echo '</br>';

   }

?>



</html>
</body>
</html> 