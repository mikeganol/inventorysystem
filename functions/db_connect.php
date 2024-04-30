<?php
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "db_hypermart_property_custodianship");
$mycon = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (!$mycon) {
    die("Error connecting to database: " . mysql_connect_error());
}
?>
    