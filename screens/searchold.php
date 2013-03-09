<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<!-- #BeginEditable "doctitle" -->
<title></title>
<!-- #EndEditable -->
<link href="styles/style2.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />
<style type="text/css">
.auto-style1 {
	margin-left: 15px;
}
</style>
</head>

<body>

<!-- Begin Container -->
<div id="container" style="left: 0px; top: 0px; height: 500px">
	<!-- Begin Masthead -->
	<div id="masthead" style="height: 105px">
		<p>&nbsp;&nbsp;&nbsp; Routing in progress</p>
	</div>
		

<!-- End Container -->
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
  
 echo'<ul>';
  while($row = mysql_fetch_array($result))
   {  
    $latitude = $row['Latitude'];
	  $longitude = $row['Longitude'];
     
	   echo '<li>' . $latitude;
	   echo '</li>';
	  
	  //echo  $latitude; echo  $longitude; echo '</br>';

   }
   echo "</ul>";

?>

</body>


</html>

