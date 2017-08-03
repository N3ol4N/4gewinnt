<?php
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

//Abfrage der Parie
//$_SESSION['partyid'] = $spielfeld['SpielID'];
//$Spielid = $_SESSION['partyid'];

$Spieler1_ID = $userid;
$Spieler2_ID = 0;
$AmZug = $userid;
$LetzterZug = $userid;

$Spieler_ID = $Spieler1_ID;
$Spiel_ID = $_SESSION['SpielId'];

$feld = "Feld2";

echo "spielerid: ".$userid;
echo "<br>";
echo "spieloffen: ".$Spiel_ID;

    //spieleroeffnen($Spieler1_ID, $Spieler2_ID, $AmZug);
    //setfeld($Spiel_ID, $feld, $Spieler_ID);
    //partiebeitreten($Spiel_ID, $userid);
    //gebepartienaus();


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

function setfeld($Spiel_ID, $feld, $Spieler_ID){
    $mysqli = new mysqli("localhost", "root", "", "database");
    if ($mysqli->connect_errno) {
        die("Fehler bei der Netzwerkverbindung" . $mysqli->connect_errno);
    }

    //prüfen wer am Zug ist
    $db_Befehl = "SELECT * FROM spielfeld WHERE SpielID = ?";
    $statement = $mysqli->prepare($db_Befehl);
    $statement->bind_param('i', $Spiel_ID);
    $statement->execute();

    $result = $statement->get_result();
    $Partie = $result->fetch_assoc();

    $Spieler1 = $Partie['Spieler2'];
    $Spieler2 = $Partie['Spieler1'];
    $AmZug = $Partie['AmZug'];

    if($AmZug == $Spieler1){
        $NeuerZug = $Spieler2;

        //ändere das gesetzte Feld
        $db_Befehl = "UPDATE `spielfeld` SET ".$feld."=?, AmZug = ? WHERE SpielID = ?";
        $statement = $mysqli->prepare($db_Befehl);
        $statement->bind_param('iii', $Spieler_ID, $NeuerZug, $Spiel_ID);

        $statement->execute();

    } else if($AmZug == $Spieler2){
    echo "nicht dein Zug";
    } else {echo "Fehler beim Spieler zuweißen";}

    //ändere das gesetzte Feld
    $db_Befehl = "UPDATE `spielfeld` SET ".$feld."=?, AmZug = ? WHERE SpielID = ?";
    $statement = $mysqli->prepare($db_Befehl);
    $statement->bind_param('iii', $Spieler_ID, $NeuerZug, $Spiel_ID);

    $statement->execute();
}

function partiebeitreten($Spiel_ID, $userid) {
    $mysqli = new mysqli("localhost", "root", "", "database");
    if ($mysqli->connect_errno) {
        die("Fehler bei der Netzwerkverbindung" . $mysqli->connect_errno);
    }

    $db_Befehl = "UPDATE `spielfeld` SET Spieler2 = ? WHERE SpielID = ?";
    $statement = $mysqli->prepare($db_Befehl);
    $statement->bind_param('ii', $userid, $Spiel_ID);

    $statement->execute();

}

function gebepartienaus(){
    $mysqli = new mysqli("localhost", "root", "", "database");
    if ($mysqli->connect_errno) {
        die("Fehler bei der Netzwerkverbindung" . $mysqli->connect_errno);
    }

    $db_Befehl = "SELECT * FROM spielfeld";
    $statement = $mysqli->prepare($db_Befehl);
    $statement->execute();

    $result = $statement->get_result();

    while($row = $result->fetch_assoc()){
        echo "<br>";
        echo "SpielID :  ";
        echo $row['SpielID'];
        echo "      ";
        echo "Spieler1 : ";
        echo $row['Spieler1'];
        echo "      ";
        echo "Spieler2 : ";
        echo $row['Spieler2'];
        echo "      ";
        echo "Am Zug : ";
        echo $row['AmZug'];
    }
}
?>