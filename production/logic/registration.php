<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Registration Connect Four</title>

    <link rel="stylesheet" href="css/bootstrap-3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">

    <script language="javascript" type="text/javascript" src="js/functions.js"></script>
    <script language="JavaScript" type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
</head>

<body>
<?php
session_start();
//loading database connection
require("datenbank.php");

//checks for requestparameter
if (isset($_GET['registration'])) {

    $error = false;
    //preventing code-injection
    $name = mysqli_real_escape_string($my_db, htmlentities($_REQUEST['username']));
    $email = mysqli_real_escape_string($my_db, htmlentities($_REQUEST['mail']));
    $nickname = mysqli_real_escape_string($my_db, htmlentities($_REQUEST['nickname']));
    $password = mysqli_real_escape_string($my_db, htmlentities($_REQUEST["password"]));
    $password2 = mysqli_real_escape_string($my_db, htmlentities($_REQUEST["passwordWdh"]));
    $userAlter = mysqli_real_escape_string($my_db, htmlentities($_REQUEST['userAlter']));
    $gender = mysqli_real_escape_string($my_db, htmlentities($_REQUEST['geschlecht']));

    //check for password input
    if (strlen($_REQUEST["password"]) == 0) {
        echo "Please insert a Password";
        echo '<br><a href="../registrierung.php">Back to registration</a>';
        $error = true;
    }

    //check for password confirmation
    if ($password != $password2) {
        echo "Passwords must match";
        echo '<br><a href="../registrierung.php">Back to registration</a>';
        $error = true;
    }

    //selects user and checks for duplicate nickname
    if (!$error) {
        $statement = $my_db->prepare("SELECT * FROM users WHERE nickname=?");
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

    //selects user and checks for duplicate email
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

    //inserts userdata into database and generates challenge for authentification
    if (!$error) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $challenge = md5(uniqid(mt_rand(), true));
        $statement = $my_db->prepare("INSERT INTO users (nickname, username, mail, password, userAlter, geschlecht, challenge) VALUES(?,?,?,?,?,?,?)");
        $statement->bind_param('ssssiss', $nickname, $name, $email, $password_hash, $userAlter, $gender, $challenge);
        $statement->execute();

        $statement = $my_db->prepare("SELECT * FROM users WHERE mail = ?");
        $statement->bind_param('s', $email);
        $statement->execute();
        $result = $statement->get_result();
        $user = $result->fetch_assoc();

        if ($result) {

            //setting session variable for comming login
            $_SESSION['userid'] = $user['id'];
            echo "Your Account has been created";
            echo "<br>";
            // mail($user['mail'], "Authentication FourConnect", $user['challenge']);
            echo 'Thanks for registration, to verify please click the following link <br> <a href=authenticate.php?challenge=' . $challenge . '>verify .' . $challenge . '</a>';
        }
    }
}
?>
</body>
</html>
