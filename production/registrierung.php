<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Registration ConnectFour</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">

    <script language="javascript" type="text/javascript" src="js/functions.js"></script>
    <script language="JavaScript" type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
</head>
<body onload="mail();">
<div class="disclaimer">
    <h1>Connect Four</h1>
</div>
<div class="container" id="registrierungscontainer">
    <h2>Registrierung</h2>
    <form accept-charset="UTF-8" role="form" action="logic/registration.php?registration=1" method="post"
          enctype='multipart/form-data'>
        <label for="mail">E-Mail:</label>
        <input type="email" name="mail" class="form-control" required>
        <br>
        <label>Benutzername:</label>
        <input type="text" name="userName" class="form-control" required>
        <br>
        <label>Passwort:</label>
        <input type="password" name="password" class="form-control" required>
        <br>
        <label>Passwort wiederholen:</label>
        <input type="password" name="passwordWdh" class="form-control" required>
        <br>
        <label>Name:</label>
        <input type="text" name="name" class="form-control" required>
        <br>
        <label>Alter:</label>
        <input type="text" name="userAlter" class="form-control">
        <br>
        <label>Geschlecht:</label><br>
        <input type="radio" checked="checked" name="geschlecht" value="female"> female<br>
        <input type="radio" name="geschlecht" value="male"> male<br>
        <input type="radio" name="geschlecht" value="apache">Apache Helicopter<br>
        <br>
        <button type="submit" class="btn">Create Account</button>
    </form>
    <a href="logic/login.php">Back to Login</a>
</div>
<?php
require("impressum.php");
?>
</body>
</html>
