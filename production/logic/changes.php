<?php

session_start();

//establish db-connection
require('datenbank.php');

//display userdata
require('userdata.php');

//checks for a send datachange
if (isset($_GET['change'])) {

    echo "<br>";
    echo '<div class="changemessages">';

    $error = false;

    //prevent code injection
    $newmail = mysqli_real_escape_string($my_db, htmlentities($_REQUEST['changedmail']));
    $newnick = mysqli_real_escape_string($my_db, htmlentities($_REQUEST['changednick']));
    $newname = mysqli_real_escape_string($my_db, htmlentities($_REQUEST['changedname']));
    $newuseralter = mysqli_real_escape_string($my_db, htmlentities($_REQUEST['changedalter']));
    $newgender = mysqli_real_escape_string($my_db, htmlentities($_REQUEST['changedgender']));

    //checks for email changes
    if ($newmail) {
        $update = "UPDATE users SET mail = '$newmail' WHERE id = $user";
        mysqli_query($my_db, $update);
        echo "Email successfully changed to : $newmail.<br>";
        $showFormular = false;
    }

    //checks for username changes
    if ($newname) {
        $update = "UPDATE users SET username = '$newname' WHERE id = $user";
        mysqli_query($my_db, $update);
        echo "Name succesfully changed to : $newname.<br>";
        $showFormular = false;
    }

    //checks for nickname changes
    if ($newnick) {
        $update = "UPDATE users SET nickname = '$newnick' WHERE id = $user";
        mysqli_query($my_db, $update);
        echo "Nickname successfully changed to : $newnick.<br>";
        $showFormular = false;
    }

    //checks for userage changes
    if ($newuseralter) {
        $update = "UPDATE users SET useralter = '$newuseralter' WHERE id = $user";
        mysqli_query($my_db, $update);
        echo "Age successfully changed to : $newuseralter.<br>";
        $showFormular = false;
    }

    //checks for gender changes, in case someone converts into an apache helicopter
    if ($newgender) {
        $update = "UPDATE users SET geschlecht = '$newgender' WHERE id = $user";
        mysqli_query($my_db, $update);
        echo "Gender succhessfully changed to : $newgender.<br>";
        $showFormular = false;
    }

    echo "</div>";
    echo "<br>";
}

//checks for changed picture
if (isset($_GET['changeavatar'])) {

    echo "<br>";
    echo '<div class="changemessages">';

    echo "<link rel=\"stylesheet\" href=\"../css/bootstrap-3.3.7/css/bootstrap.min.css\">
          <link rel=\"stylesheet\" href=\"../css/styles.css\">
    
          <script language=\"javascript\" type=\"text/javascript\" src=\"../js/functions.js\"></script>
          <script language=\"JavaScript\" type=\"text/javascript\" src=\"../js/jquery-3.2.1.min.js\"></script>";
    $bild_daten_tmpname = $_FILES['changedavatar']['tmp_name'];
    $bild_daten_name = $_FILES['changedavatar']['name'];
    $bild_daten_type = $_FILES['changedavatar']['type'];
    $bild_daten_size = $_FILES['changedavatar']['size'];

    //checks for datatype of send picture and saves it into avatar-db
    if (($bild_daten_type == "image/gif") || ($bild_daten_type == "image/pjpeg") || ($bild_daten_type == "image/jpeg") || ($bild_daten_type == "image/png")) {


        $dateihandle = fopen($bild_daten_tmpname, "r");
        $imgdata = fread($dateihandle, filesize($bild_daten_tmpname));
        $stmt = mysqli_stmt_init($my_db);
        $sql = "INSERT INTO `avatars` (`imgdata` ,`imgname` ,`imgtype` ,`imgsize`)  VALUES(?,?,?,?)";
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 'sssi', base64_encode($imgdata), $bild_daten_name, $bild_daten_type, $bild_daten_size);
        mysqli_stmt_execute($stmt);

        $avatarID = mysqli_insert_id($my_db);

        $update = "UPDATE users SET avatarid = '$avatarID' WHERE id = $user";
        mysqli_query($my_db, $update);
        $showFormular = false;

        echo "avatar successfully changed.<br>";

    } else {
        echo "<br>Wrong data format for an avatar; use gif, pjpeg, jpeg or png.<br>";
    }

    echo "</div>";
}

//hides formular on changes and shows link back to lobby instead
if ($showFormular == false) {
    echo "<br>";
    echo '<div class="changemessages">';
    echo '<br><a href="../lobby.php">Back to Lobby</a>';
    echo "</div>";

}

?>
