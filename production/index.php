<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Login Connect Four</title>

    <link rel="stylesheet" href="css/bootstrap-3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">

    <script language="javascript" type="text/javascript" src="js/functions.js"></script>
    <script language="JavaScript" type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
</head>

<body onload="mail();">

<div class="disclaimer">
    <h1>Connect Four</h1>
</div>
<div class="container">
    <h2>Login</h2>
    <form accept-charset="UTF-8" action="logic/login.php?login=1" method="post" enctype='multipart/form-data'>
        <label>E-Mail or Nickame:</label>
        <input type="text" name="login" class="form-control" required>
        <br>
        <label>Password:</label>
        <input type="password" name="password" class="form-control" required>
        <br>
        <button type="submit" class="btn">Login</button>
        <br>
    </form>
    <br>
    <a href="registrierung.php">Register</a>
</div>

<?php
require("impressum.php");
?>

</body>
</html>
