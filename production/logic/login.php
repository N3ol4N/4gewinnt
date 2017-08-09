<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Login Check Connect Four</title>
</head>
<body>
<?php
require("datenbank.php");
session_start();

if (isset($_GET['login'])) {
    $login = mysqli_real_escape_string($my_db, htmlentities($_REQUEST['login']));
    $passwort = mysqli_real_escape_string($my_db, htmlentities($_REQUEST['password']));

    $statement = $my_db->prepare("SELECT * FROM users WHERE mail =? OR nickname =?");
    $statement->bind_param('ss', $login, $login);
    $statement->execute();
    $result = $statement->get_result();
    $user = $result->fetch_assoc();

    if ($user !== false && password_verify($passwort, $user['password'])) {
        if ($user['confirmed']) {
            $_SESSION['userid'] = $user['id'];
            $_SESSION['username'] = $user['nickname'];
            header('Location: ../lobby.php');
        } else {
            echo 'You are not verified. You need to check your emails.';
            echo '<a href="authenticate.php?challenge=' . $user['challenge'] . '"> verify email</a>';
        }
    } else {
        echo 'Failure! Wrong login data.';
        echo '<a href="../index.php">Back to Login</a>';

    }
}
?>
</body>
</html>
