<?php

function process_path($coordinates, $destination) {
    $db_host = "localhost";
    $db_username = "root";
    $db_pass = "root";
    $db_name = "path_mapper";
    $table_path = "paths";
    $table_coordinates = "coordinates";

    @mysql_connect("$db_host", "$db_username", "$db_pass") or die("Could not connect to MySQL");
    @mysql_select_db("$db_name") or die("No Database of that name");
    mysql_query("Insert into $table_path (destination) values ('" . $destination . "')");
    $id = mysql_result(mysql_query("select id from $table_path where destination = ('" . $destination . "')"), 0);
//    echo $id;

    foreach($coordinates as $coordinate){
        mysql_query("Insert into $table_coordinates (cid, Latitude, Longitude) values ('".$id."', '".$coordinate[0]."', '".$coordinate[1]."' )");

//    mysql_query("Insert into coordinates (cid, Latitude, Longitude) values ('1', '2', '3' )");
    }
//    echo $coordinates[0][0];
    return "The Path was saved successfully";
}

echo process_path(json_decode($_REQUEST['coordinates']), $_REQUEST['destination']);
?>
