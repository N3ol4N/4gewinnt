<?php
/**
 * Created by PhpStorm.
 * User: Heiko
 * Date: 04.08.17
 * Time: 12:07
 */


session_start();

if (!isset($_SESSION['userid'])) {
    die('Bitte zuerst <a href="login.php">einloggen</a>');
}
$mysqli = new mysqli("localhost", "root", "", "database");
if ($mysqli->connect_errno) {
    die("Fehler bei der Netzwerkverbindung" . $mysqli->connect_errno);
}

//Abfrage der Nutzer ID vom Login
$username = $_SESSION['username'];
$userid = $_SESSION['userid'];

$Spiel_ID = $_GET['SpielID'];
echo "Sie wollen dem Spiel $Spiel_ID beitreten";

partiebeitreten($Spiel_ID, $userid);


//lässt aufrufenden Spieler einer partie beitreten
function partiebeitreten($Spiel_ID, $userid)
{


    $mysqli = new mysqli("localhost", "root", "", "database");
    if ($mysqli->connect_errno) {
        die("Fehler bei der Netzwerkverbindung" . $mysqli->connect_errno);
    }

    $_SESSION['SpielId'] = $Spiel_ID;

    $db_Befehl = "SELECT * FROM spielfeld WHERE SpielID = ?";
    $statement = $mysqli->prepare($db_Befehl);
    $statement->bind_param('i', $Spiel_ID);
    $statement->execute();

    $result = $statement->get_result();
    $Partie = $result->fetch_assoc();

    //prüft ob noch platz in der partie ist
    if ($Partie['Spieler2'] != 0) {
        echo "<br><br>Spiel schon voll <br>";
        echo "<a href=\"lobby.php\">Zurück zur Lobby</a>";

        // prüft ob aufrufender spieler schon in der partie ist
    } else if ($Partie['Spieler1'] == $userid || $Partie['Spieler2'] == $userid) {
        echo "<br><br>schon im Spiel. Zuweißung verweigert! <br>";
        echo "<a href=\"lobby.php\">Zurück zur Lobby</a>";

        // fügt aufrufenden spieler der partie als spieler 2 hinzu
    } else {
        $db_Befehl = "UPDATE `spielfeld` SET Spieler2 = ? WHERE SpielID = ?";
        $statement = $mysqli->prepare($db_Befehl);
        $statement->bind_param('ii', $userid, $Spiel_ID);
        $statement->execute();

        echo "<br><br>erfolgreich beigetreten<br>";
        echo '<a href="lobby.php">Zurück zur Lobby</a>';
    }
}


?>