<?php

//establish database-connection
require("datenbank.php");

session_start();
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];

//check for get-values of request
if (isset($_GET['gameID'])) {
    $gameid = $_GET['gameID'];

    //selectiong party with matching gameid
    $db_Befehl = "SELECT * FROM parties WHERE SpielID = ?";
    $statement = $my_db->prepare($db_Befehl);
    $statement->bind_param('i', $gameid);
    $statement->execute();

    $result = $statement->get_result();
    $Partie = $result->fetch_assoc();

    //checks for empty place
    if ($Partie['Spieler2'] != 0) {
        echo "<br><br>Game is full. look for an empty game!<br>";

        //checks if a user is already in that game and changes his current game id to that
    } else if ($Partie['Spieler1'] == $username || $Partie['Spieler2'] == $username) {
        echo "<br><br>You are already in this game<br>";
        $_SESSION['SpielId'] = $Partie['SpielID'];

        //adds user to the game
    } else {
        $db_Befehl = "UPDATE `parties` SET Spieler2 = ? WHERE SpielID = ?";
        $statement = $my_db->prepare($db_Befehl);
        $statement->bind_param('si', $username, $gameid);
        $statement->execute();

        echo "<br><br>You have been added to game $gameid<br>";
        $_SESSION['SpielId'] = $Partie['SpielID'];
    }
}

?>