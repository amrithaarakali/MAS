<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
    <title>jQuery Mobile Tutorial on Codeforest.net</title>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.css" />
    <script src="http://code.jquery.com/jquery-1.4.3.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.js"></script>
</head>
<body> 
<div data-role="page" id="page1">
    <div data-role="content">
        <ul data-role="listview" data-divider-theme="d" data-inset="true">
		           	
	<?php
set_time_limit(300);

$destination = $_POST["searchloc"];
//$startloc= (string) $_POST["startloc"];



	$db_host = "localhost";
	$db_username = "root";
	$db_pass = "manchester";
	$db_name = "Path-Mapper";


@mysql_connect("$db_host","$db_username","$db_pass") or die ("Could not connect to MySQL");
@mysql_select_db("$db_name") or die ("No Database of that name");

$result = mysql_query("SELECT Latitude, Longitude 
FROM  `coordinates` 
WHERE cID =( SELECT pID
FROM  `paths` 
WHERE Destination =  '".$destination."' ) ") or die(mysql_error());
  
  while($row = mysql_fetch_array($result))
   {  
    $latitude = $row['Latitude'];
	  $longitude = $row['Longitude'];
     echo '  <li data-role="list-divider" role="heading">';
            '</li>';
			
	   echo '<li data-theme="c">  <a href="#" data-transition="slide">' . $latitude;
	   echo '</a></li>';
	  
	  //echo  $latitude; echo  $longitude; echo '</br>';

   }
  

?>
</ul>
</div>
</div>
</body>
</html>