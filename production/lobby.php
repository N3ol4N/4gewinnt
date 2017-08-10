<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Connect Four Lobby</title>

    <link rel="stylesheet" href="css/bootstrap-3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">

    <script language="javascript" type="text/javascript" src="js/functions.js"></script>
    <script language="JavaScript" type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
</head>

<body onload="mail();">

<div>
    <?php
    session_start();

    //checks for a valid login
    if (!isset($_SESSION['userid'])) {
        die('<a href="index.php">Please log in first</a>');
    }
    ?>
    <div id="lobbyheader">
        <?php
        //greetings to user
        $user = $_SESSION['username'];
        echo "Hallo " . $user . "! ";

        ?>
        <div id="Optionen">
            <button onclick="logout()">Logout</button>
            <form action="accountmanagement.php">
                <input type="submit" value="Accountmanagement">
            </form>
        </div>
    </div>
</div>

<br>
<br>

<div class="container">

<br>

<div id="lobbycontent">
    <form action="gametable.php">
        <input type="submit" value="active game">
    </form>

    <div id="gamelist">

    </div>
    <div id="messages">

    </div>
    <script language="javascript">
        getpartyList();
    </script>
    <br>
    <div>
        <button onclick="createparty()">Create new game</button>
    </div>
</div>
<br>

<?php
//load impressum for contact
require("impressum.php");
?>
</div>

</body>
</html>
