<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=database', 'root', '');

//fragt ob die id gesetzt ist
if (!isset($_SESSION['userid'])) {
    die('Bitte zuerst <a href="login.php">einloggen</a>');
}

//Abfrage der Nutzer ID vom Login
$username = $_SESSION['username'];
$user = $_SESSION['userid'];
$showFormular = true;

//zeige den Nicknamen und die Email an
$statement = "SELECT * FROM users WHERE id = $user";
$userload = $pdo->query($statement)->fetch();

echo "Nickname: " . $userload['nickname'] . "<br />";
echo "E-Mail: " . $userload['email'] . "<br />";
echo "Alter: ".$userload['useralter']. "<br />";

//checkt ob die textfelder eingegeben sind
if (isset($_GET['changemail'])) {
    $error = false;
    $newmail = $_POST['changedmail'];
    $newnick = $_POST['changednick'];
    $newuseralter = $_POST['changedalter'];
    $newavatar = $_POST['changedavatar'];

    if (!$error) {
        $link = mysqli_connect("localhost", "root", "", "database");

        //updated die mail
        if ($newmail) {
            $update = "UPDATE users SET email = '$newmail' WHERE id = $user";
            mysqli_query($link, $update);
            echo 'Email erfolgreich geändert.<br>';
            $showFormular = false;
        }

        //updated den nickname
        if ($newnick) {
            $update = "UPDATE users SET nickname = '$newnick' WHERE id = $user";
            mysqli_query($link, $update);
            echo 'Nick erfolgreich geändert.<br>';
            $showFormular = false;
        }

        //updated des alters
        if ($newuseralter) {
            $update = "UPDATE users SET useralter = '$newuseralter' WHERE id = $user";
            mysqli_query($link, $update);
            echo 'Alter erfolgreich aktualisiert.<br>';
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

?>

<!DOCTYPE html>
<html>
<head>
    <title>Accountmanagement</title>
</head>
<body>
<br>

<?php
if ($showFormular) {
    ?>
    <form action="?changemail=1" method="post">
        neue Email : <input type="email" size="40" maxlength="250" name="changedmail"><br><br>
        neuer Nickname : <input type="text" size="40" maxlength="250" name="changednick"><br><br>
        alter nachbearbeiten : <input type="text" size="40" maxlength="250" name="changedalter"><br><br>
        Avatarbild verändern : <input type="file" size="50" name="changedavatar"><br><br>
        <input type="submit" value="Abschicken">
    </form>

    <?php
}
?>

<br><br>
<form action="lobby.php">
    <input type="submit" value="zur Lobby">
</form>

</body>
</html>