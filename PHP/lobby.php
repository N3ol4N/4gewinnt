<!DOCTYPE html>
<html>
<head>
    <title>Spielelobby</title>

    <script src="../js/spielscripte.js"></script>
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="../css/stylesheet.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">

</head>
<body>

<?php
session_start();

//prüft ob eine userid vorhanden ist
if (!isset($_SESSION['userid'])) {
    die('Bitte zuerst <a href="login.php">einloggen</a>');
}

//setzt session variabeln für für den user
$username = $_SESSION['username'];
$userid = $_SESSION['userid'];

echo "Hallo und willkommen in der Lobby, &nbsp" . $username;
echo "<br>";
?>

<?php
$mysqli = new mysqli("localhost", "root", "", "database");

if ($mysqli->connect_errno) {
    die("Fehler bei der Netzwerkverbindung" . $mysqli->connect_errno);
}

echo "<br><br>";
echo "laufende Partien";
gebepartienaus();
echo "<br>";

echo "<a href='lobby.php?'>Refresh</a>";

echo '
    <br>
    <br>
    <form action="createpartie.php?createparty=1" method="post">
        <input type="submit" value="Partie_eröffnen">
    </form>
';


//_________________________funktionen______

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
        echo " SpielID :  ";
        echo $row['SpielID'];
        echo "      ";
        echo "&nbsp;&nbsp;&nbsp| Spieler1 : ";
        echo $row['Spieler1'];
        echo "      ";
        echo "&nbsp;&nbsp;&nbsp| Spieler2 : ";
        echo $row['Spieler2'];
        echo "      ";
        echo "&nbsp;&nbsp;&nbsp| Am Zug : ";
        echo $row['AmZug'];
        echo "<a href='partiebeitreten.php?" . "SpielID=" .$row['SpielID'] ."'> Beitreten</a>";
    }
}

?>


</body>
</html>