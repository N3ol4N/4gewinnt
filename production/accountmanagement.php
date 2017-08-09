<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Accountmanagement</title>

    <link rel="stylesheet" href="css/bootstrap-3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">

    <script language="javascript" type="text/javascript" src="js/functions.js"></script>
    <script language="JavaScript" type="text/javascript" src="js/jquery-3.2.1.min.js"></script>

</head>
<body>

<?php
require ('logic/changes.php');
if ($showFormular=true) {
    ?>
    <div id="changes">
        <div id="datachanges">
            <form action="logic/changes.php?change=1" method="post">
                new Email : <input type="email" size="40" maxlength="250" name="changedmail"><br>
                new Nickname : <input type="text" size="40" maxlength="250" name="changednick"><br>
                change Name : <input type="text" size="40" maxlength="250" name="changedname"><br>
                change Age : <input type="text" size="40" maxlength="250" name="changedalter"><br>
                <br>
                <label>change Gender:</label>
                <input type="radio" checked="checked" name="changedgender" value="female"> female<br>
                <input type="radio" name="changedgender" value="male"> male<br>
                <input type="radio" name="changedgender" value="apache helicopter">Apache Helicopter<br>
                <br>
                <input type="submit" value="Submit changes">
            </form>
        </div>
            <br>
        <div id="avatarchanges">
            <form action="logic/changes.php?changeavatar=1" method="post" enctype='multipart/form-data'>
                Change Avatar : <input type="file" size="50" name="changedavatar">
                <input type="submit" value="Change Avatar">
            </form>
        </div>
    </div>

    <?php
}
?>

<br><br>
<form action="lobby.php">
    <input type="submit" value="zur Lobby">
</form>

</body>
</html>