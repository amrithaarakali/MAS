<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>Pathway Mapper</title>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.css" />
        <script src="http://code.jquery.com/jquery-1.4.3.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.js"></script>
        <script>
            function displaymaps(var1)
            {

                var urlString = "searchview.php?id="+var1;

                window.location = urlString;

            }
        </script>
    </head>
    <body>
        <div data-role="page" id="page1">
            <div data-role="content">
                <ul data-role="listview" data-divider-theme="d" data-inset="true">
                    From:
                    <?php
                    set_time_limit(300);
                    $destination = $_POST["searchloc"];
                    $db_host = "localhost";
                    $db_username = "root";
                    $db_pass = "root";
                    $db_name = "path_mapper";


                    @mysql_connect("$db_host", "$db_username", "$db_pass") or die("Could not connect to MySQL");
                    @mysql_select_db("$db_name") or die("No Database of that name");

                    $result = mysql_query("SELECT source,id,yea,nay
FROM  `paths` 
WHERE destination =  '" . $destination . "'  ") or die(mysql_error());

                    while ($row = mysql_fetch_array($result)) {
                        $source = $row['source'];
                        $ids = $row['id'];
                        $yea = $row['yea'];
                        $nay = $row['nay'];
                        $format = "%s Yeas!: %s Nays!: %s";
                        $label_string = sprintf($format, $source, $yea, $nay);

                        echo '<input
    type="button"
    name="ids"
    id="ids"
    data-icon="arrow-r"
    data-iconpos="right" 
    data-theme="c" 
	onclick="displaymaps(' . $ids . ')"
    value="' . $label_string . '" /> ';
                        //  echo '</li>';
                        //echo  $latitude; echo  $longitude; echo '</br>';
                    }
                    ?>
                </ul>
            </div>
            <a data-role="button" rel="external" href="homepage.html">
                Cancel
            </a>
        </div>
    </body>
</html>