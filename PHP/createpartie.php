<?php
/**
 * Created by PhpStorm.
 * User: Heiko
 * Date: 04.08.17
 * Time: 12:21
 */

session_start();
$mysqli = new mysqli('localhost', 'root', '', 'database');

//prüft ob das loginformular abgeschickt wurde
if (isset($_GET['createparty'])) {
    $farben = $_POST['Farbe'];
    $username = $_SESSION['username'];
    $userid = $_SESSION['userid'];

    $Spieler1_ID = $userid;
    $Spieler2_ID = 0;
    $AmZug = $userid;

    //ruft funktion auf
    spieleroeffnen($Spieler1_ID, $Spieler2_ID, $AmZug);

    //leitet zurück zur Lobby
    header('Location: lobby.php');

    //eröffnet ein spiel

}

//_______________funktionen______

function spieleroeffnen($Spieler1_ID, $Spieler2_ID, $AmZug)
{
    $mysqli = new mysqli("localhost", "root", "", "database");
    if ($mysqli->connect_errno) {
        die("Fehler bei der Netzwerkverbindung" . $mysqli->connect_errno);
    }

    $db_Befehl = "INSERT INTO `spielfeld`(`Spieler1`, `Spieler2`, `AmZug`) VALUES (?,?,?)";

    $statement = $mysqli->prepare($db_Befehl);
    $statement->bind_param('iii', $Spieler1_ID, $Spieler2_ID, $AmZug);

    $statement->execute();

    $SpielID = mysqli_insert_id($mysqli);

    $_SESSION['SpielId'] = $SpielID;

    return;
}

?>