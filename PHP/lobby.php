<!DOCTYPE html>
<html>
<head>
    <title>Registrierung</title>
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

echo "Hallo und willkommen in der Lobby User: " . $username;
?>

<?php
$pdo = new PDO('mysql:host=localhost;dbname=database', 'root', '');

if (isset($_GET['createparty']))

    $statement = $pdo->prepare("INSERT INTO lobby (Spieler1) VALUES (:Spieler1)");
$statement->execute(array('Spieler1' => 'userid'));

?>

<br>
<br>
<a>Farben auswählen</a>
<form action="?createparty=1" method="post">
    <fieldset>
        <input type="radio" id="rg" name="Farbe" value="ROTGELB" checked="checked">
        <label for="rg"> ROT/GELB</label><br>
        <input type="radio" id="sw" name="Farbe" value="SCHWARZWEISS">
        <label for="sw"> SCHWARZ/WEISS</label><br>
        <input type="radio" id="gb" name="Farbe" value="GRUENBRAUN">
        <label for="gb"> GRUEN/BRAUN</label>
    </fieldset>
    <input type="submit" value="Partie eröffnen">

</form>

</body>
</html>