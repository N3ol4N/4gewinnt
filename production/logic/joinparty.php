<?php

require("datenbank.php");
if ($my_db->connect_errno) {
die("Error while connecting to network!" . $mysqli->connect_errno);
}
session_start();
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];

if(isset($_GET['gameID'])){
    $gameid = $_GET['gameID'];

    $db_Befehl = "SELECT * FROM parties WHERE SpielID = ?";
    $statement = $my_db->prepare($db_Befehl);
    $statement->bind_param('i', $gameid);
    $statement->execute();

    $result = $statement->get_result();
    $Partie = $result->fetch_assoc();

    if ($Partie['Spieler2'] != 0) {
        echo "<br><br>Game is full. look for an empty game!<br>";

    } else if ($Partie['Spieler1'] == $username || $Partie['Spieler2'] == $username) {
        echo "<br><br>You are already in this game<br>";

    } else {
        $db_Befehl = "UPDATE `parties` SET Spieler2 = ? WHERE SpielID = ?";
        $statement = $my_db->prepare($db_Befehl);
        $statement->bind_param('si', $username, $gameid);
        $statement->execute();

        echo "<br><br>You have been added to this game<br>";
        $_SESSION['SpielId'] = $Partie['SpielID'];
    }
}

?>