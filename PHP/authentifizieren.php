<?php
/**
 * Created by PhpStorm.
 * User: Heiko
 * Date: 04.08.17
 * Time: 14:52
 */

session_start();
$mysqli = new mysqli('localhost', 'root', '', 'database');

$userid = $_SESSION['userid'];
$challege = $_SESSION['challenge'];
global $showFormular;
$showFormular = true;


if (isset($_GET['authenticate'])) {
    $error = false;
    $challengeeingabe = $_POST['challengeeingabe'];

    if (!$error) {
        $link = mysqli_connect("localhost", "root", "", "database");

        //prüft challenge
        if ($challengeeingabe){
            authentifizieren($userid, $challengeeingabe);
        }else{
            echo "falscher Code <br>";
        }

    }
}

echo "<br>";

echo '
    <form action="?authenticate=1" method="post">
        Authentifikationscode : <input type="text" size="40" maxlength="250" name="challengeeingabe"><br>
        <input type="submit" value="Challenge_abschicken">
    </form>
';


//_______________funktionen______


function authentifizieren($userid, $challengeeingabe)
{
    $link = mysqli_connect("localhost", "root", "", "database");

    $mysqli = new mysqli("localhost", "root", "", "database");
    if ($mysqli->connect_errno) {
        die("Fehler bei der Netzwerkverbindung" . $mysqli->connect_errno);
    }
    $statement = "SELECT * FROM users WHERE id = $userid";
    $result = mysqli_query($link,$statement);
    $user = mysqli_fetch_assoc($result);

    $challenge = $user['challenge'];


    if($challenge = $challengeeingabe) {
        $update = "UPDATE users SET authentifiziert = '1' WHERE id = $userid";

        mysqli_query($link, $update);

        $_SESSION['challenge'] = $challenge;

        echo "erfolgreich authentifiziert";

        //leitet zurück zur Lobby
        header('Location: ../HTML/Index.html');
        return;
    }
}

?>