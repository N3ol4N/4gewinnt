<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=database', 'root', '');

if (!isset($_SESSION['userid'])) {
    die('Bitte zuerst <a href="login.php">einloggen</a>');
}

//Abfrage der Nutzer ID vom Login
$username = $_SESSION['username'];
$user = $_SESSION['userid'];
$showFormular = true;


$statement = "SELECT * FROM users WHERE id = $user";
$userload = $pdo->query($statement)->fetch();
echo "Nickname: " . $userload['nickname'] . "<br />" . "<br />";
echo "E-Mail: " . $userload['email'] . "<br />";

if (isset($_GET['changemail'])) {
    $error = false;
    $newmail = $_POST['changedmail'];
    $newnick = $_POST['changednick'];

    if (!$error) {
        $link = mysqli_connect("localhost", "root", "", "database");

        if ($newmail) {
            $update = "UPDATE users SET email = '$newmail' WHERE id = $user";
            mysqli_query($link, $update);
            echo 'Email erfolgreich geändert.<br>';
            $showFormular = false;
        }
        if ($newnick) {
            $update = "UPDATE users SET nickname = '$newnick' WHERE id = $user";
            mysqli_query($link, $update);
            echo 'Nick erfolgreich geändert.<br>';
            $showFormular = false;
        }
        echo 'Zurück <a href="lobby.php">zur Lobby.</a>';
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