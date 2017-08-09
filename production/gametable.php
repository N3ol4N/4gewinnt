<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Connect Four Lobby</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">

    <script language="javascript" type="text/javascript" src="js/functions.js"></script>
    <script language="JavaScript" type="text/javascript" src="js/jquery-3.2.1.min.js"></script>

    <script language="JavaScript" type="text/javascript">
        colorset = "normal";
    </script>
</head>

<body onload="mail();">

<div>
    <div id="Optionen">
        <button onclick="logout()">Logout</button>
        <form action="accountmanagement.php">
            <input type="submit" value="Accountmanagement">
        </form>
        <form action="lobby.php">
            <input type="submit" value="Back to lobby">
        </form>
    </div>

    <?php
    session_start();

    if (!isset($_SESSION['userid'])) {
        die('<a href="index.php">Please log in first</a>');
    }

    $user = $_SESSION['username'];
    $gameid = $_SESSION['SpielId'];
    echo "Hallo " . $user . "! ";
    echo "<br>";
    echo "gameid: " . $gameid;

    ?>
    <br>
    <div id="colorchanges">
        <form>
            <label>colours:</label><br>
            <input type="radio" checked="checked" name="tablecolors" value="redyellow" onclick="setcolor(this.value)"> Red/Yellow<br>
            <input type="radio" name="tablecolors" value="yellowred" onclick="setcolor(this.value)"> Yellow/Red<br>
            <input type="radio" name="tablecolors" value="blackwhite" onclick="setcolor(this.value)"> Black/White<br>
            <input type="radio" name="tablecolors" value="whiteblack" onclick="setcolor(this.value)"> White/Black<br>
        </form>
    </div>

</div>

<br>
<div id="matchup">

</div>
<div class="container" id="gamecontainer">

</div>


<br>

<br>
<div id="message">

</div>

<script language="javascript">
    getgame(colorset);
</script>

<?php
require("impressum.php");
?>
</body>
</html>