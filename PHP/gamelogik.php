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

//$Spiel_ID = $_SESSION['SpielId'];

$Spiel_ID = 3; //zum testen für die partiebeitreten funktion

$feld = "Feld5";

echo "spielerid: " . $userid;
echo "<br>";
echo "spieloffen: " . $Spiel_ID;

//spieleroeffnen($Spieler1_ID, $Spieler2_ID, $AmZug);
partiebeitreten($Spiel_ID, $userid);
//setfeld($Spiel_ID, $feld, $Spieler_ID);
//gebepartienaus();
//spielfeldausgabe($Spiel_ID);

//eröffnet ein spiel
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

//setzt ein feld in der Spielfeld datenbank
function setfeld($Spiel_ID, $feld, $Spieler_ID)
{
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

    $Spieler1 = $Partie['Spieler1'];
    $Spieler2 = $Partie['Spieler2'];
    $AmZug = $Partie['AmZug'];
    $anspruchfeld = $Partie[$feld];

    echo $feld;

    //überprüft ob der aufrufende spieler am zug ist
    if ($AmZug == $Spieler_ID) {
        global $NeuerZug;
        if ($Spieler_ID == $Spieler1) {
            $NeuerZug = $Spieler2;
        }
        if ($Spieler_ID == $Spieler2) {
            $NeuerZug = $Spieler1;
        }

        //prüft ob schon belegt ist
        if($anspruchfeld != $Spieler1 && $anspruchfeld != $Spieler2) {

            //ändere das gesetzte Feld
            $db_Befehl = "UPDATE `spielfeld` SET " . $feld . "=?, AmZug = ? WHERE SpielID = ?";
            $statement = $mysqli->prepare($db_Befehl);
            $statement->bind_param('iii', $Spieler_ID, $NeuerZug, $Spiel_ID);
            $statement->execute();
            echo "<br>Zug erfolgt";

            //hier muss noch eine abfrage rein ob ein feld mit "$feld" +7 frei ist
        }else{
            echo "schon belegt";
        }

    } else if ($AmZug != $Spieler_ID) {
        echo "<br>nicht dein Zug";
    } else {
        echo "Fehler beim Spieler zuweißen";
    }
}

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
    if($Partie['Spieler2'] != 0){
        echo "<br><br>Spiel schon voll";

    // prüft ob aufrufender spieler schon in der partie ist
    }else if ($Partie['Spieler1'] == $userid || $Partie['Spieler2'] == $userid){
        echo "<br><br>schon im Spiel";

    // fügt aufrufenden spieler der partie als spieler 2 hinzu
    }else {
        $db_Befehl = "UPDATE `spielfeld` SET Spieler2 = ? WHERE SpielID = ?";
        $statement = $mysqli->prepare($db_Befehl);
        $statement->bind_param('ii', $userid, $Spiel_ID);
        $statement->execute();

        echo "<br><br>erfolgreich beigetreten";
    }
}

//konzept zum ausgeben der partien
function gebepartienaus()
{
    $mysqli = new mysqli("localhost", "root", "", "database");
    if ($mysqli->connect_errno) {
        die("Fehler bei der Netzwerkverbindung" . $mysqli->connect_errno);
    }

    $db_Befehl = "SELECT * FROM spielfeld";
    $statement = $mysqli->prepare($db_Befehl);
    $statement->execute();

    $result = $statement->get_result();

    //iteriert über alle bestehenden spiele und gibt dabei id, spiler und am zug aus
    while ($row = $result->fetch_assoc()) {
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
        echo "<a href='test.html?" . $row['SpielID'] . "'>Beitreten</a>";
    }
}

//konzept zum ausgeben des Spielfeldes
function spielfeldausgabe($Spiel_ID)
{
    $mysqli = new mysqli("localhost", "root", "", "database");
    if ($mysqli->connect_errno) {
        die("Fehler bei der Netzwerkverbindung" . $mysqli->connect_errno);
    }

    $db_Befehl = "SELECT * FROM spielfeld WHERE SpielID = ?";
    $statement = $mysqli->prepare($db_Befehl);
    $statement->bind_param('i', $Spiel_ID);
    $statement->execute();

    $result = $statement->get_result();

    //gibt spieler vs spieler aus
    while ($row = $result->fetch_assoc()) {

        echo "<br>";
        echo "<br>";
        echo $row['Spieler1'];
        echo "  vs  ";
        echo $row['Spieler2'];
        echo "<br><br>";

        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
             <meta charset="UTF-8">
             <title>Spielfeld</title>

            <script src="../js/spielscripte.js"></script>
            <link rel="stylesheet" href="../css/stylesheet.css">
        </head>
        <body>';

        echo "<br>";
        echo '<table>
        <tr>
            <th><button type="button" onclick="spalte(1)">erste spalte</button></th>
            <th><button type="button" onclick="spalte(2)">zweite spalte</button></th>
            <th><button type="button" onclick="spalte(3)">dritte spalte</button></th>
            <th><button type="button" onclick="spalte(4)">vierte spalte</button></th>
            <th><button type="button" onclick="spalte(5)">fünfte spalte</button></th>
            <th><button type="button" onclick="spalte(6)">sechste spalte</button></th>
            <th><button type="button" onclick="spalte(7)">siebte spalte</button></th>
        </tr>';

        echo '
       
        <tr>
            <td><div id="1" class="neutral">leer1</div></td>
            <td><div id="2" class="neutral">leer2</div></td>
            <td><div id="3" class="neutral">leer3</div></td>
            <td><div id="4" class="neutral">leer4</div></td>
            <td><div id="5" class="neutral">leer5</div></td>
            <td><div id="6" class="neutral">leer6</div></td>
            <td><div id="7" class="neutral">leer7</div></td>
        </tr>
        <tr>
            <td><div id="8" class="neutral">leer1</div></td>
            <td><div id="9" class="neutral">leer2</div></td>
            <td><div id="10" class="neutral">leer3</div></td>
            <td><div id="11" class="neutral">leer4</div></td>
            <td><div id="12" class="neutral">leer5</div></td>
            <td><div id="13" class="neutral">leer6</div></td>
            <td><div id="14" class="neutral">leer7</div></td>
        </tr>
        <tr>
            <td><div id="15" class="neutral">leer1</div></td>
            <td><div id="16" class="neutral">leer2</div></td>
            <td><div id="17" class="neutral">leer3</div></td>
            <td><div id="18" class="neutral">leer4</div></td>
            <td><div id="19" class="neutral">leer5</div></td>
            <td><div id="20" class="neutral">leer6</div></td>
            <td><div id="21" class="neutral">leer7</div></td>
        </tr>
        <tr>
            <td><div id="22" class="neutral">leer1</div></td>
            <td><div id="23" class="neutral">leer2</div></td>
            <td><div id="24" class="neutral">leer3</div></td>
            <td><div id="25" class="neutral">leer4</div></td>
            <td><div id="26" class="neutral">leer5</div></td>
            <td><div id="27" class="neutral">leer6</div></td>
            <td><div id="28" class="neutral">leer7</div></td>
        </tr>
        <tr>
            <td><div id="29" class="neutral">leer1</div></td>
            <td><div id="30" class="neutral">leer2</div></td>
            <td><div id="31" class="neutral">leer3</div></td>
            <td><div id="32" class="neutral">leer4</div></td>
            <td><div id="33" class="neutral">leer5</div></td>
            <td><div id="34" class="neutral">leer6</div></td>
            <td><div id="35" class="neutral">leer7</div></td>
        </tr>
        <tr>
            <td><div id="36" class="neutral">leer1</div></td>
            <td><div id="37" class="neutral">leer2</div></td>
            <td><div id="38" class="neutral">leer3</div></td>
            <td><div id="39" class="neutral">leer4</div></td>
            <td><div id="40" class="neutral">leer5</div></td>
            <td><div id="41" class="neutral">leer6</div></td>
            <td><div id="42" class="neutral">leer7</div></td>
        </tr>

    </table>';

    echo '</body>
    </html>';
    }
}

?>