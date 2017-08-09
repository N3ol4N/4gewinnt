<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Registration Connect Four</title>
</head>

<body>
<?php
session_start();
require("datenbank.php");

if (isset($_GET['registration'])) {

    $error = false;
    $name = mysqli_real_escape_string($my_db, htmlentities($_REQUEST['name']));
    $email = mysqli_real_escape_string($my_db, htmlentities($_REQUEST['mail']));
    $nickname = mysqli_real_escape_string($my_db, htmlentities($_REQUEST['userName']));
    $password = mysqli_real_escape_string($my_db, htmlentities($_REQUEST["password"]));
    $password2 = mysqli_real_escape_string($my_db, htmlentities($_REQUEST["passwordWdh"]));
    $userAlter = mysqli_real_escape_string($my_db, htmlentities($_REQUEST['userAlter']));
    $gender = mysqli_real_escape_string($my_db, htmlentities($_REQUEST['geschlecht']));

    if (strlen($_REQUEST["password"]) == 0) {
        echo "Please insert a Password";
        echo '<br><a href="../registrierung.php">Back to registration</a>';
        $error = true;
    }

    if ($password != $password2) {
        echo "Passwords must match";
        echo '<br><a href="../registrierung.php">Back to registration</a>';
        $error = true;
    }

    if (!$error) {
        $statement = $my_db->prepare("SELECT * FROM users WHERE username=?");
        $statement->bind_param('s', $nickname);
        $statement->execute();
        $result = $statement->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            echo "This nickname is already taken";
            echo '<br><a href="../registrierung.php">Back to registration</a>';
            $error = true;
        }
    }

    if (!$error) {
        $statement = $my_db->prepare("SELECT * FROM users WHERE mail=?");
        $statement->bind_param('s', $email);
        $statement->execute();
        $result = $statement->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            echo "This email is already taken";
            echo '<br><a href="../registrierung.php">Back to registration</a>';
            $error = true;
        }
    }

    if (!$error) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $challenge = md5(uniqid(mt_rand(), true));
        $statement = $my_db->prepare("INSERT INTO users (nickname, username, mail, password, userAlter, geschlecht, challenge) VALUES(?,?,?,?,?,?,?)");
        $statement->bind_param('ssssiss', $nickname, $name, $email, $password_hash, $userAlter, $gender, $challenge);
        $statement->execute();

        $statement = $my_db->prepare("SELECT * FROM users WHERE mail = ?");
        $statement ->bind_param('s', $email);
        $statement->execute();
        $result = $statement->get_result();
        $user = $result->fetch_assoc();

        if ($result) {
            $_SESSION['userid'] = $user['id'];
            echo "Your Account has been created";
            echo 'Thanks for registration, to verify please click the following link <a href=authenticate.php?challenge=' . $challenge . '>verify.' . $challenge . '</a>';
        }
    }
}
?>
</body>
</html>
