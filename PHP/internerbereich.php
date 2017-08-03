<?php
session_start();
if (!isset($_SESSION['userid'])) {
    die('Bitte zuerst <a href="login.php">einloggen</a>');
}

//Abfrage der Nutzer ID vom Login
$username = $_SESSION['username'];
$userid = $_SESSION['userid'];

echo "Hallo User: " . $username . "\n";
echo "<br>";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Spielbereich</title>
</head>
<body>
<br>
<br>

<form action="logout.php">
    <input type="submit" value="logout">
</form>

<form action="changes.php">
    <input type="submit" value="changes">
</form>

<form action="lobby.php">
    <input type="submit" value="Lobby">
</form>


</body>
</html>