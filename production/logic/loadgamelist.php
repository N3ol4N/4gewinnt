<?php
/**
 * Created by PhpStorm.
 * User: Heiko
 * Date: 06.08.17
 * Time: 22:57
 */

require("datenbank.php");
if ($my_db->connect_errno) {
    die("Fehler bei der Netzwerkverbindung" . $my_db->connect_errno);
}
session_start();

$db_Befehl = "SELECT * FROM parties";
$statement = $my_db->prepare($db_Befehl);
$statement->execute();

$result = $statement->get_result();

//iteriert über alle bestehenden spiele und gibt dabei id, spieler und am zug aus
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
    echo '<button onclick="joinparty('.$row['SpielID'].')" >join game</button>';
}

?>