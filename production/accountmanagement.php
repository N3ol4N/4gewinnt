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
<div id="accountheader">
<?php
//checks for changes in formular and hides formular if necessary
require('logic/changes.php');
if ($showFormular = true) {
    ?>
    <div>
        <br>
        <form action="lobby.php" style="text-align: right; padding-right: 3%">
            <input type="submit" value="back to lobby">
        </form>
    </div>
    </div>
        <br>
        <div class="container">
            <div id="changes">
                <div id="datachanges">
                    <p>Enter your Accountchanges below :</p>
                    <form action="logic/changes.php?change=1" method="post">
                        new Email : <input type="email" size="40" maxlength="250" name="changedmail" class="form-control"><br>
                        new Nickname : <input type="text" size="40" maxlength="250" name="changednick" class="form-control"><br>
                        change Name : <input type="text" size="40" maxlength="250" name="changedname" class="form-control"><br>
                        change Age : <input type="text" size="40" maxlength="250" name="changedalter" class="form-control"><br>
                        <br>
                        <label>change Gender:</label>
                        <br>
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
                        Change your Avatar : <input type="file" size="50" name="changedavatar">
                        <input type="submit" value="Change Avatar">
                    </form>
                </div>
                <br>
            </div>
        </div>

    <?php
}
?>

<br><br>


</div>
</body>
</html>