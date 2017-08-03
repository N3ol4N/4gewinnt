<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=database', 'root', '');

if (isset($_GET['login'])) {
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];

    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email OR nickname = :email");
    $result = $statement->execute(array('email' => $email));
    $user = $statement->fetch();

    //Überprüfung des Passworts
    if ($user !== false && password_verify($passwort, $user['passwort'])) {
        $_SESSION['userid'] = $user['id'];
        $_SESSION['username'] = $user['nickname'];

        die('Login erfolgreich. Weiter zu <a href="internerbereich.php">internem Bereich</a>');
    } else {
        $errorMessage = "E-Mail oder Passwort war ungültig<br>";
    }

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<?php
if (isset($errorMessage)) {
    echo $errorMessage;
}
?>

<form action="?login=1" method="post">
    E-Mail oder Name:<br>
    <input type="text" size="40" maxlength="250" name="email"><br><br>

    Dein Passwort:<br>
    <input type="password" size="40" maxlength="250" name="passwort"><br>

    <input type="submit" value="Abschicken">
</form>
</body>
</html>