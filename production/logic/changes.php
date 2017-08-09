<?php
session_start();
require ('datenbank.php');
require ('userdata.php');

//checkt ob die textfelder eingegeben sind
if (isset($_GET['change'])) {
    $error = false;
    $newmail = mysqli_real_escape_string($my_db, htmlentities($_REQUEST['changedmail']));
    $newnick = mysqli_real_escape_string($my_db, htmlentities($_REQUEST['changednick']));
    $newname = mysqli_real_escape_string($my_db, htmlentities($_REQUEST['changedname']));
    $newuseralter = mysqli_real_escape_string($my_db, htmlentities($_REQUEST['changedalter']));
    $newgender = mysqli_real_escape_string($my_db, htmlentities($_REQUEST['changedgender']));


    //updated die mail
    if ($newmail) {
        $update = "UPDATE users SET mail = '$newmail' WHERE id = $user";
        mysqli_query($my_db, $update);
        echo "Email successfully changed to : $newmail.<br>";
        $showFormular = false;
    }

    if ($newname) {
        $update = "UPDATE users SET username = '$newname' WHERE id = $user";
        mysqli_query($my_db, $update);
        echo "Name succesfully changed to : $newname.<br>";
        $showFormular = false;
    }

    //updated den nickname
    if ($newnick) {
        $update = "UPDATE users SET nickname = '$newnick' WHERE id = $user";
        mysqli_query($my_db, $update);
        echo "Nickname successfully changed to : $newnick.<br>";
        $showFormular = false;
    }

    //updated des alters
    if ($newuseralter) {
        $update = "UPDATE users SET useralter = '$newuseralter' WHERE id = $user";
        mysqli_query($my_db, $update);
        echo "Age successfully changed to : $newuseralter.<br>";
        $showFormular = false;
    }

    if($newgender) {
        $update = "UPDATE users SET geschlecht = '$newgender' WHERE id = $user";
        mysqli_query($my_db, $update);
        echo "Gender succhessfully changed to : $newgender.<br>";
        $showFormular = false;
    }

    if($showFormular == false) {
        echo '<br><a href="../lobby.php">Back to Lobby</a>';
    }
    echo "<br>";
}


if (isset($_GET['changeavatar'])) {

    $bild_daten_tmpname = $_FILES['changedavatar']['tmp_name'];
    $bild_daten_name = $_FILES['changedavatar']['name'];
    $bild_daten_type = $_FILES['changedavatar']['type'];
    $bild_daten_size = $_FILES['changedavatar']['size'];

    if (($bild_daten_type == "image/gif") || ($bild_daten_type == "image/pjpeg") || ($bild_daten_type == "image/jpeg") || ($bild_daten_type == "image/png")) {

        $sql = "INSERT INTO `avatars` (`imgdata` ,`imgname` ,`imgtype` ,`imgsize`)  VALUES(?,?,?,?)";
        $statement = $my_db->prepare($sql);

        $dateihandle = fopen($bild_daten_tmpname, "r");
        $imgdata = fread($dateihandle, filesize($bild_daten_tmpname));

        $statement->bind_param('sssi', base64_encode($imgdata), $bild_daten_name, $bild_daten_type, $bild_daten_size);
        $statement->execute();

        $avatarID = mysqli_insert_id($my_db);

        $update = "UPDATE users SET avatarid = '$avatarID' WHERE id = $user";
        mysqli_query($my_db, $update);
        $showFormular = false;

        echo "avatar successfully changed.<br>";

    } else {
        echo "<BR>Wrong data format for an avatar; use gif, pjpeg, jpeg or png.<BR>";
    }

}
/*
if (isset($_GET['changeavatar'])) {
$error = false;
$newavatar = $_FILES['changedavatar']['tmp_name'];
$newavatar = $_FILES['changedavatar']['name'];
$newavatar = $_FILES['changedavatar']['type'];
$newavatar = $_FILES['changedavatar']['size'];


if (!$error) {

if($newavatar) {
        $update = "UPDATE users SET geschlecht = '$newgender' WHERE id = $user";
        mysqli_query($my_db, $update);
        echo "Gender succhessfull changed to : $newgender.<br>";
        $showFormular = false;
    }




    //updated des avatars
    if ($newavatar) {
        $update = "UPDATE users SET avatar = '$newavatar' WHERE id = $user";
        mysqli_query($link, $update);
        echo 'Avatar erfolgreich geändert.<br>';
        $showFormular = false;
    }
    echo "<br>";
} else {
    echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
}
}



_________




require_once 'connect.inc.php'; //wird ersetzt durch unsere db

if (array_key_exists('changedavatar',$_FILES)) { //sollte das get changedavatar sein

$tmpname = $_FILES['changedavatar']['tmp_name'];

$type = $_FILES['changedavatar']['type'];

$hndFile = fopen($tmpname, "r");

$data = addslashes(fread($hndFile, filesize($tmpname)));

$strQuery = "INSERT INTO avatars //datenbanktabelle

(imgdata,imgtype) VALUES

('$data','$type')" ;

*/

?>