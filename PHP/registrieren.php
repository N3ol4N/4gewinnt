<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=database', 'root', ''); //pdo ist alternative zu mysqli
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registrierung</title>
</head>
<body>

<?php
//Variable ob das Registrierungsformular angezeigt werden soll
$showFormular = true;

//prüft ob formular "register" abgeschickt wurde und erstellt diverse POST-variablen
if (isset($_GET['register'])) {
    $error = false;
    $email = $_POST['email'];
    $nickname = $_POST['nickname'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $geschlecht = $_POST['geschlecht'];

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
        $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();

        if ($user !== false) {
            echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
            $error = true;
        }
    }

    //Überprüfe, dass die Nickname noch nicht registriert wurde
    if (!$error) {
        $statement = $pdo->prepare("SELECT * FROM users WHERE nickname = :nickname");
        $result = $statement->execute(array('nickname' => $nickname));
        $user = $statement->fetch();

        if ($user !== false) {
            echo 'Dieser Nickname ist bereits vergeben<br>';
            $error = true;
        }
    }

    //bei fehlerfreiheit wird der Nutzer registriert
    if (!$error) {
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
        $challenge = md5(rand() . time());

        $statement = $pdo->prepare("INSERT INTO users (nickname, email, passwort, vorname, nachname, geschlecht, challenge) VALUES (:nickname, :email, :passwort, :vorname, :nachname, :geschlecht, :challenge)");
        $result = $statement->execute(array('nickname' => $nickname, 'email' => $email, 'passwort' => $passwort_hash, 'vorname' => $vorname, 'nachname' => $nachname, 'geschlecht' => $geschlecht, 'challenge' => $challenge));

        if ($result) {
            echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
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

        Vorname:<br>
        <input type="text" size="40" maxlength="250" name="vorname"><br><br>

        Nachname:<br>
        <input type="text" size="40" maxlength="250" name="nachname"><br><br>

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