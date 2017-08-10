<?php

    //establish db-connection
    require('datenbank.php');

    //checks for valid id
    if (!isset($_SESSION['userid'])) {
        die('Bitte zuerst <a href="login.php">einloggen</a>');
    }

    //sets variables from session
    $username = $_SESSION['username'];
    $user = $_SESSION['userid'];
    $showFormular = true;

    //selecting user data
    $statement = $my_db->prepare("SELECT * FROM users WHERE id = ?");
    $statement->bind_param('i', $user);
    $statement->execute();
    $result = $statement->get_result();
    $userload = $result->fetch_assoc();
    $userid = $userload['id'];

    //selecting user picture
    $query = mysqli_query($my_db, "SELECT * FROM avatars WHERE avatarid = " . $userload['avatarid']);
    $result23 = mysqli_fetch_object($query);

    //echoing uservalues
    if($result23){
        echo '<div id="userdatacontainer">';
        echo '<div id="avatar"><img src="data:' . $result23->imgtype . ';base64,' . $result23->imgdata . '"/></div>';
    }

    echo "<div id=userdata>";
    echo "Nickname: " . $userload['nickname'] . "<br>";
    echo "E-Mail: " . $userload['mail'] . "<br>";
    echo "Name: " . $userload['username'] . "<br>";
    echo "Alter: " . $userload['useralter'] . "<br>";
    echo "Geschlecht: " . $userload['geschlecht'] . "<br>";
    echo "</div>";

    echo "<br>";

    if($result23){
        echo "</div>";
    }
?>