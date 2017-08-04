<?php
session_start();
$mysqli = new mysqli('localhost', 'root', '', 'database');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registrierung</title>

    <script src="../js/spielscripte.js"></script>
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>



    <link rel="stylesheet" href="../css/stylesheet.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">

</head>
<body>

<?php
//Variable ob das Registrierungsformular angezeigt werden soll
$showFormular = true;

//prüft ob formular "register" abgeschickt wurde und erstellt diverse POST-variablen
if (isset($_GET['register'])) {
    $error = false;
    $emailpre = $_POST['email'];
    $email = mysqli_real_escape_string($mysqli, htmlentities($emailpre));
    $nicknamepre = $_POST['nickname'];
    $nickname = mysqli_real_escape_string($mysqli, htmlentities($nicknamepre));
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $geschlecht = $_POST['geschlecht'];
    $alter = $_POST['useralter'];

    //prüft ob email format eingehalten wird
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
        $error = true;
    }

    //prüft ob passwort vorhanden ist
    if (strlen($passwort) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }

    //prüft ob passwort richtig wiederholt wurde
    if ($passwort != $passwort2) {
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true;
    }

    //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
    if (!$error) {
        $statement = $mysqli->prepare("SELECT * FROM users WHERE email = ?");
        $statement->bind_param('s', $email);
        $statement->execute();

        $result = $statement->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
            $error = true;
        }
    }

    //Überprüfe, dass die Nickname noch nicht registriert wurde
    if (!$error) {
        $statement = $mysqli->prepare("SELECT * FROM users WHERE nickname = ?");
        $statement->bind_param('s', $nickname);
        $statement->execute();

        $result = $statement->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            echo 'Dieser Nickname ist bereits vergeben<br>';
            $error = true;
        }
    }

    //bei fehlerfreiheit wird der Nutzer registriert
    if (!$error) {
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
        $challenge = md5(uniqid(mt_rand(), true));

        $statement = $mysqli->prepare("INSERT INTO users (nickname, email, passwort, vorname, nachname, geschlecht, useralter, challenge) VALUES (?,?,?,?,?,?,?,?)");
        $statement->bind_param('ssssssis',$nickname, $email, $passwort_hash, $vorname, $nachname, $geschlecht, $alter, $challenge);
        $result = $statement->execute();

        if ($result) {
            echo 'Du wurdest erfolgreich registriert.<br> <a href="login.php">Zum Login</a>';

            echo "<br> dies ist ihre Authentifikationsnummer. bitte kopieren und im Account einfügen für die Authentifizierung";
            echo "<br><br> challenge : <br><br>".$challenge;
            $showFormular = false;
        } else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
        }
    }
}

//zeigt das formular an wenn showFormular auf true ist
if ($showFormular) {
    ?>

    <form action="?register=1" method="post">
        E-Mail *:<br>
        <input type="email" size="40" maxlength="250" name="email" required><br><br>

        Dein Username *:<br>
        <input type="text" size="40" maxlength="250" name="nickname" required><br><br>

        Dein Passwort *:<br>
        <input type="password" size="40" maxlength="250" name="passwort" required><br>

        Passwort wiederholen *:<br>
        <input type="password" size="40" maxlength="250" name="passwort2" required><br><br>

        Vorname :<br>
        <input type="text" size="40" maxlength="250" name="vorname"><br><br>

        Nachname :<br>
        <input type="text" size="40" maxlength="250" name="nachname"><br><br>

        Alter :<br>
        <input type="text" size="40" maxlength="250" name="useralter"><br><br>

        <label>Geschlecht:
            <select name="geschlecht">
                <option>männlich</option>
                <option>weiblich</option>
                <option>keine Angaben</option>
            </select>
        </label>

        <input type="submit" value="Abschicken">
    </form>

    <br>
    <a>Felder mit * sind Pflichtfelder</a>

    <?php
} //Ende von if($showFormular)
?>

</body>
</html>