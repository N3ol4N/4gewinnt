<?php
session_start();
if (!isset($_SESSION['userid'])) {
    die('Bitte zuerst <a href="login.php">einloggen</a>');
}

//Abfrage der Nutzer ID vom Login
$username = $_SESSION['username'];
$userid = $_SESSION['userid'];
$authentifiziert = $_SESSION['authentifiziert'];

//dient lediglich dem Test dass man variablen über sessions weitergibt
echo "Hallo User: " . $username . "\n";
echo "<br>";

if($authentifiziert == 0){
    echo "<br><a href='authentifizieren.php'>Um Account zu authentifizieren hier klicken. Die Challenge haben sie beim registrieren bekommen</a>";
} else {
    header('Location: ../PHP/lobby.php');
}
?>
