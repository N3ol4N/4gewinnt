<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Connect Four Lobby</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">

    <script language="javascript" type="text/javascript" src="js/functions.js"></script>
    <script language="JavaScript" type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
</head>

<body onload="mail();">

<div>
    <?php
    session_start();

    if (!isset($_SESSION['userid'])) {
        die('<a href="index.php">Please log in first</a>');
    }

    $user = $_SESSION['username'];
    echo "Hallo " . $user . "! ";
    /*$login = $_SESSION['login'];
    $sql = "SELECT bild FROM benutzer WHERE id='" .$_SESSION['userid']. "'";
    $res = mysqli_query($my_db, $sql);
    $row = mysqli_fetch_array($res);
    $id = $row['bild'];
    if($id!='0') {
        echo '<img width="4%" height="auto" src="benutzerBild.php">';
    }*/
    ?>
    <div id="Optionen">
        <button onclick="logout()">Logout</button>
        <a href="accountmanagement.php">Accountmanagement</a>
    </div>
</div>

<br>
<a href="gametable.php">active game</a>
<br>
<div class="container">
    <div id="gamelist">

    </div>
    <div id="messages">

    </div>
    <script language="javascript">
        getpartyList();
    </script>
    <br>
    <div >
        <button onclick="createparty()">create new game</button>
    </div>
    <script>
        //create
    </script>
</div>

<div class="container">
    <script language="javascript">
        /*
        var zug = -1;
        var req = null;
        var READY_STATE_COMPLETE = 4;

        function sendRequest(url, params, HTTPMethod) {
            if (!HTTPMethod) {
                HTTPMethod = "GET";
            }
            if (window.XMLHttpRequest) {
                req = new XMLHttpRequest();
            }
            if (req) {
                req.onreadystatechange = onReadyState;
                req.open(HTTPMethod, url, true);
                req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                req.send(params);
            }
        }

        function onReadyState() {
            var ready = req.readyState;
            if (ready == READY_STATE_COMPLETE) {
                if (req.responseText) {
                    var refZiel = document.getElementById("dasDrumHerum");
                    refZiel.innerHTML = req.responseText;
                }
            }
        }

        function getGame(id) {
            var strURL = "spielfeld.php";
            params = "game=" + id;
            if (zug != -1) {
                params += "&column=" + zug;
                zug = -1;
            }
            sendRequest(strURL, params, "POST");
            window.setTimeout("getGame(" + id + ")", 500);
        }

        function getListNeuesSpiel() {
            var strURL = "spielliste.php";
            params = "neu=game";
            sendRequest(strURL, params, "POST");
            window.setTimeout("getList()", 1500);
        }

        function getListBeitreten(id) {
            var strURL = "spielliste.php";
            params = "beitreten=" + id;
            sendRequest(strURL, params, "POST");
            window.setTimeout("getList()", 1500);
        }

        function getList(params) {
            var strURL = "spielliste.php";
            sendRequest(strURL, params, "POST");
            window.setTimeout("getList()", 1500);
        }

        */-->
    </script>
</div>

<div id="dasDrumHerum">
    <?php
    /*
    if (isset($_REQUEST['game'])) {
        $id = mysqli_real_escape_string($my_db, htmlentities($_REQUEST['game']));
        echo "<script>getGame(" . $id . ");</script>";
    } else {
        if (isset($_REQUEST['neu'])) {
            $neu = mysqli_real_escape_string($my_db, htmlentities($_REQUEST['neu']));
            echo "<script>getListNeuesSpiel();</script>";
        } else if (isset($_REQUEST['beitreten'])) {
            $beitreten = mysqli_real_escape_string($my_db, htmlentities($_REQUEST['beitreten']));
            echo "<script>getListBeitreten(" . $beitreten . ");</script>";
        } else {
            echo "<script>getList();</script>";
        }
    }
    */
    ?>
</div>

<?php
require("impressum.php");
?>
</body>
</html>
