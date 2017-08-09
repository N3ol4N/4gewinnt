<?php

//establish database connection
require("datenbank.php");

session_start();

//selection ongoing parties
$db_Befehl = "SELECT * FROM parties";
$statement = $my_db->prepare($db_Befehl);
$statement->execute();

$result = $statement->get_result();

//echoing all games
while ($row = $result->fetch_assoc()) {
    echo "<br>";
    echo " SpielID :  ";
    echo $row['SpielID'];
    echo "&nbsp;&nbsp;&nbsp| Spieler1 : ";
    echo $row['Spieler1'];
    echo "&nbsp;&nbsp;&nbsp| Spieler2 : ";
    echo $row['Spieler2'];
    echo "&nbsp;&nbsp;&nbsp| Am Zug : ";
    echo $row['AmZug'];
    echo "&nbsp;&nbsp;&nbsp";
    echo '<button onclick="joinparty(' . $row['SpielID'] . ')" >join game</button>';
}

?>