<?php
$sqlhost = "localhost";
$sqlhost = "127.0.0.1";
$sqluser = "dude";
$sqlpass = "";
$dbname = "VierGewinnt";

$my_db = mysqli_connect($sqlhost, $sqluser, $sqlpass, $dbname) or die ("DB-system nicht verfügbar");
?>
