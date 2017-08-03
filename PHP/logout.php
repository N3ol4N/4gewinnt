<?php
session_start();
session_destroy();

echo "Logout erfolgreich";
?>

<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged out</title>
</head>
<body>
<br>
<a href="registrieren.php">Zur Registrierung</a>
<br>
<a href="login.php">Zum Login</a>
</body>
</html>