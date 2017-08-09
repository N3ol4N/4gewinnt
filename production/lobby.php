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

<div class="container">

<div>
    <?php
    session_start();

    //checks for a valid login
    if (!isset($_SESSION['userid'])) {
        die('<a href="index.php">Please log in first</a>');
    }

    //greetings to user
    $user = $_SESSION['username'];
    echo "Hallo " . $user . "! ";
    ?>
    <div id="Optionen">
        <button onclick="logout()">Logout</button>
        <a href="accountmanagement.php">Accountmanagement</a>
    </div>
</div>

<br>
<?php
//checks for a valid gameid
if (isset($_SESSION['SpielId']))
    echo '<a href="gametable.php">active game</a>'
?>
<br>

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

<?php
//load impressum for contact
require("impressum.php");
?>
</div>

</body>
</html>
