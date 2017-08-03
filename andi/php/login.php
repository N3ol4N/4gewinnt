<?php
session_start();
if ((isset($_GET['username'])) && (isset($_GET['passwort']))) {
    require('db.php');
    $username = $_GET['username'];

    $sql = "SELECT * FROM Userverwaltung WHERE username = '" . $username . "';";
    echo "<hr>" . $sql . "<hr>";
    $res = mysqli_query($my_db, $sql) or die (mysqli_error($my_db));
    if ($text = mysqli_fetch_assoc($res)) {
        if (password_verify($_GET['passwort'], $text['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $text['password'];
            header("Location: ../lobby.html");
        } else {
            echo "Eingabe überprüfen1<BR>";
        }
    } else {
        echo "Eingabe überprüfen2<BR>";
    }
} else {
    echo "Eingabe überprüfen3<BR>";
}
?>
