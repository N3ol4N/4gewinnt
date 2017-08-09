<?php

//establish db-connection
session_start();
require("datenbank.php");

//checks for get parameters and generates a game in database
if (isset($_GET['createparty'])) {
    $username = $_SESSION['username'];
    $anzahl_spalten = 7;
    $anzahl_ebenen = 6;

    $Spieler1_ID = $username;
    $AmZug = $username;

    $db_Befehl = "INSERT INTO `parties`(`Spieler1`, `AmZug`) VALUES (?,?)";

    $statement = $my_db->prepare($db_Befehl);
    $statement->bind_param('ss', $Spieler1_ID, $AmZug);

    $statement->execute();

    $SpielID = mysqli_insert_id($my_db);

    $_SESSION['SpielId'] = $SpielID;

}
?>