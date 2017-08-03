<?php
require('db.php');

if ((!empty($_GET['nickname'])) && (!empty($_GET['email'])) && (!empty($_GET['passwort']))) {
    $nick_save = mysqli_real_escape_string($my_db, htmlentities($_GET['nickname']));
    $email_save = mysqli_real_escape_string($my_db, htmlentities($_GET['email']));
}

$password = password_hash($_GET['passwort'], PASSWORD_DEFAULT);

//$challenge = md5(rand() . time());

if (!empty($nick_save) && !empty($email_save) && !empty($password)) {

    //echo "Fehler beim User anlegen";
    $sql = "INSERT INTO Userverwaltung (username, password, email, activated) VALUES (";
    $sql .= "'$nick_save', '$password', '$email_save', '1');";
    //echo "<hr>$sql</hr>";
    mysqli_query($my_db, $sql) or die(mysqli_error($my_db));
    if (1 == mysqli_affected_rows($my_db)) {
        //echo "Erfolgreich<BR>";
        header("Location: ../index.html");
        //echo "<A HREF=\"confirm.php?email=$email_save&challenge=$challenge\">Anmeldung bestätigen</A><BR>";
        //echo "<B>\"confirm.php?email=$email_save&challenge=$challenge\"</B>";
    } else {
        echo "Fehler beim User anlegen";
    }
} else {
    echo "Eingaben überprüfen<BR>";


}
?>
