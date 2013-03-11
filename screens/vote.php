<?php

session_start();
$x = $_SESSION['varname'];

$likeval = $_POST['likeval'];
$unlikeval = $_POST['unlikeval'];

$db_host = "localhost";
$db_username = "root";
$db_pass = "root";
$db_name = "path_mapper";


@mysql_connect("$db_host", "$db_username", "$db_pass") or die("Could not connect to MySQL");
@mysql_select_db("$db_name") or die("No Database of that name");

$semi_result = mysql_query("SELECT destination,source,yea,nay 
FROM  `paths` 
WHERE id =  " . $x . " ") or die(mysql_error());
$row = mysql_fetch_array($semi_result);
$source = $row['source'];
$dest = $row['destination'];
$yay = $row['yea'];
$no = $row['nay'];
$diffplus = $yay + $likeval;
$diffminus = $no + $unlikeval;
$result = mysql_query("UPDATE `paths` SET yea= '" . $diffplus . "', nay= '" . $diffminus . "' WHERE id =  '" . $x . "' ") or die(mysql_error());
//$result2 = mysql_query("UPDATE `paths` SET nay= '". $diffminus ."' WHERE id =  '".$x."' ") or die(mysql_error());
?>