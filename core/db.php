<?php
require_once "config.php";

$db_connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(!$db_connect){
    die("database connection failed: "  . mysqli_connect_error($db_connect));
}


?>