<?php
/**
 * Created by PhpStorm.
 * User: Heiko
 * Date: 07.08.17
 * Time: 11:33
 */

session_start();
require ("datenbank.php");
//prüft ob das loginformular abgeschickt wurde
if (isset($_GET['createparty'])) {
    $username = $_SESSION['username'];
    $anzahl_spalten = 7;
    $anzahl_ebenen = 6;

    $Spieler1_ID = $username;
    $Spieler2_ID = 0;
    $AmZug = $username;

    if ($my_db->connect_errno) {
        die("Fehler bei der Netzwerkverbindung" . $my_db->connect_errno);
    }

    $db_Befehl = "INSERT INTO `parties`(`Spieler1`, `Spieler2`, `AmZug`) VALUES (?,?,?)";

    $statement = $my_db->prepare($db_Befehl);
    $statement->bind_param('sss', $Spieler1_ID, $Spieler2_ID, $AmZug);

    $statement->execute();

    $SpielID = mysqli_insert_id($my_db);

    $_SESSION['SpielId'] = $SpielID;

    /*
    $db_Befehl = "INSERT INTO playgrounds (spalte, ebene, playgroundID) VALUES (?,?,?)";
    $statement = $my_db->prepare($db_Befehl);

    for ($ebene = 1; $ebene <= $anzahl_ebenen; $ebene++) {
        for ($spalte = 1; $spalte <= $anzahl_spalten; $spalte++) {
            $statement->bind_param('iii', $spalte, $ebene, $SpielID);
            $statement->execute();
        }
    }
    */
}
?>