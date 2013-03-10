<?php

function process_path($coordinates, $destination, $source) {
    $db_host = "localhost";
    $db_username = "root";
    $db_pass = "root";
    $db_name = "path_mapper";
    $table_path = "paths";
    $table_coordinates = "coordinates";

    @mysql_connect("$db_host", "$db_username", "$db_pass") or die("Could not connect to MySQL");
    @mysql_select_db("$db_name") or die("No Database of that name");
    mysql_query("Insert into $table_path (destination, source, yea, nay) values ('" . $destination . "', '" . $source . "', 0, 0)");
    $id = mysql_result(mysql_query("select id from $table_path where destination = ('" . $destination . "')"), 0);

    foreach($coordinates as $coordinate){
        mysql_query("Insert into $table_coordinates (path_id, latitude, longitude) values ('".$id."', '".$coordinate[0]."', '".$coordinate[1]."' )");

    }
    return "The Path was saved successfully";
}

echo process_path(json_decode($_REQUEST['coordinates']), $_REQUEST['destination'], $_REQUEST['source']);
?>