<?php
session_start();
if (!isset($_SESSION['userid'])) {
    die('Bitte zuerst <a href="login.php">einloggen</a>');
}

//Abfrage der Nutzer ID vom Login
$username = $_SESSION['username'];
$userid = $_SESSION['userid'];

//dient lediglich dem Test dass man variablen über sessions weitergibt
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

<!--weiterleitung nach dem einloggen-->
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