<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Connect Four Lobby</title>

    <link rel="stylesheet" href="css/bootstrap-3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">

    <script language="javascript" type="text/javascript" src="js/functions.js"></script>
    <script language="JavaScript" type="text/javascript" src="js/jquery-3.2.1.min.js"></script>

    <script language="JavaScript" type="text/javascript">
        //set neutral color for gametable
        colorset = "neutral";
    </script>
</head>

<body onload="mail();">

<div id="gameheader">
    <div id="playergreeting">
        <?php
            session_start();

            //checks for valid userid
            if (!isset($_SESSION['userid'])) {
                die('<a href="index.php">Please log in first</a>');
            }

            if(!isset($_SESSION['SpielId'])) {
                die('<a href="lobby.php">You need to open a new game or join an open one. click here to get back to lobby</a>');
            }

        //information
            $user = $_SESSION['username'];
            $gameid = $_SESSION['SpielId'];
            echo "Hallo " . $user . "! ";
            echo "<br>";
            echo "gameid: " . $gameid;
            echo "<br>";
        ?>
    </div>
    <br>

    <div id="Optionen">
        <button onclick="logout()">Logout</button>
        <form action="accountmanagement.php">
            <input type="submit" value="Accountmanagement">
        </form>
        <form action="lobby.php">
            <input type="submit" value="Back to lobby">
        </form>
    </div>
</div>

<br>

<div class="container">

    <br>
    <div id="gamerelevantcontent">

    <!-- selection field for gametable colors -->
        <div id="colorchanges">
            <form>
                <label>colours:</label><br>
                <input type="radio" name="tablecolors" checked="checked" value="redyellow" onclick="setcolor(this.value)">
                Red/Yellow<br>
                <input type="radio" name="tablecolors" value="yellowred" onclick="setcolor(this.value)"> Yellow/Red<br>
                <input type="radio" name="tablecolors" value="blackwhite" onclick="setcolor(this.value)"> Black/White<br>
                <input type="radio" name="tablecolors" value="whiteblack" onclick="setcolor(this.value)"> White/Black<br>
            </form>
        </div>
        <br>
        <div id="gamecontainer">

        </div>
        <div id="message">

        </div>
    </div>

    <br>
    <br>

    <script language="javascript">
        //load the gametable into view
        getgame(colorset);
    </script>

    <?php
    //contact info
    require("impressum.php");
    ?>
</div>
</body>
</html>
