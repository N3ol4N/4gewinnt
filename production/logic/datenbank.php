<?php

//connection to database
$sqlhost = "localhost";
$sqlhost = "127.0.0.1";
$sqluser = "root";
$sqlpass = "";
$dbname = "databases";

$my_db = mysqli_connect($sqlhost, $sqluser, $sqlpass, $dbname) or die ("Database not accessible!");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
