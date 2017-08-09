<?php
/**
 * Created by PhpStorm.
 * User: Heiko
 * Date: 07.08.17
 * Time: 12:06
 */

require ("datenbank.php");
session_start();

if(isset($_GET['row'])) {
    $spalte = $_GET['row'];
    $Spiel_ID = $_SESSION['SpielId'];
    $Spieler_ID = $_SESSION['username'];

    $db_Befehl = "SELECT * FROM parties WHERE SpielID = ?";

    $statement = $my_db->prepare($db_Befehl);
    $statement->bind_param('i', $Spiel_ID);
    $statement->execute();

    $result = $statement->get_result();
    $Partie = $result->fetch_assoc();

    $Spieler1 = $Partie['Spieler1'];
    $Spieler2 = $Partie['Spieler2'];
    //$playgroundID = $Partie['playgroundID'];
    $AmZug = $Partie['AmZug'];
    $anspruchfeld = $Partie[$spalte];

/*
    $db_Befehl2 = "SELECT * FROM playgrounds WHERE playgroundID=? ";
    $statement2 = $my_db->prepare($db_Befehl2);
    $statement2->bind_param('i', $playgroundID);
    $statement2->execute();

    $result2 = $statement->get_result();
    $playground = $result->fetch_assoc();
*/

    if ($AmZug == $Spieler_ID) {
        global $NeuerZug;

        if ($Spieler_ID == $Spieler1) {
            $NeuerZug = $Spieler2;
        }
        if ($Spieler_ID == $Spieler2) {
            $NeuerZug = $Spieler1;
        }

        //das grauen beginnt (<- refaktorn!!)
        if ($anspruchfeld != $Spieler1 && $anspruchfeld != $Spieler2) {
            $db_Befehl = "UPDATE parties SET `".$spalte."`=?, AmZug = ? WHERE SpielID = ?";
            $statement = $my_db->prepare($db_Befehl);
            $statement->bind_param('ssi', $Spieler_ID, $NeuerZug, $Spiel_ID);
            $statement->execute();
            echo "chip is set in 1st row, field :".$spalte.", enemies turn";
        } else if ($Partie[$spalte+7] != $Spieler1 && $Partie[$spalte+7] != $Spieler2) {
            $spalte = $spalte + 7;
            $db_Befehl = "UPDATE parties SET `" . $spalte . "`=?, AmZug = ? WHERE SpielID = ?";
            $statement = $my_db->prepare($db_Befehl);
            $statement->bind_param('ssi', $Spieler_ID, $NeuerZug, $Spiel_ID);
            $statement->execute();
            echo "chip is set in 2n row, field :".$spalte.", enemies turn";
        } else if ($Partie[$spalte+14] != $Spieler1 && $Partie[$spalte+14] != $Spieler2) {
            $spalte = $spalte + 14;
            $db_Befehl = "UPDATE parties SET `" . $spalte . "`=?, AmZug = ? WHERE SpielID = ?";
            $statement = $my_db->prepare($db_Befehl);
            $statement->bind_param('ssi', $Spieler_ID, $NeuerZug, $Spiel_ID);
            $statement->execute();
            echo "chip is set in 3rd row, field :".$spalte.", enemies turn";
        } else if ($Partie[$spalte+ 21] != $Spieler1 && $Partie[$spalte+ 21] != $Spieler2) {
            $spalte = $spalte+21;
            $db_Befehl = "UPDATE parties SET `" .$spalte. "`=?, AmZug = ? WHERE SpielID = ?";
            $statement = $my_db->prepare($db_Befehl);
            $statement->bind_param('ssi', $Spieler_ID, $NeuerZug, $Spiel_ID);
            $statement->execute();
            echo "chip is set in 4th row, field :".$spalte.", enemies turn";
        } else if ($Partie[$spalte+ 28] != $Spieler1 && $Partie[$spalte+ 28] != $Spieler2) {
            $spalte = $spalte+28;
            $db_Befehl = "UPDATE parties SET `" .$spalte. "`=?, AmZug = ? WHERE SpielID = ?";
            $statement = $my_db->prepare($db_Befehl);
            $statement->bind_param('ssi', $Spieler_ID, $NeuerZug, $Spiel_ID);
            $statement->execute();
            echo "chip is set in 5th row, field :".$spalte.", enemies turn";
        } else if ($Partie[$spalte+ 35] != $Spieler1 && $Partie[$spalte+ 35] != $Spieler2) {
            $spalte = $spalte+35;
            $db_Befehl = "UPDATE parties SET `" .$spalte. "`=?, AmZug = ? WHERE SpielID = ?";
            $statement = $my_db->prepare($db_Befehl);
            $statement->bind_param('ssi', $Spieler_ID, $NeuerZug, $Spiel_ID);
            $statement->execute();
            echo "your chip is set in 6th row, field :".$spalte.", enemies turn";
        } else {
            echo "this row is full, select another row";
        }
    } else if ($AmZug != $Spieler_ID) {
        echo "<br>not your turn";
    } else {
        echo "Error";
    }
}

if(isset($_GET['getgame'])){
    $colorset=$_GET['getgame'];
    $Spiel_ID = $_SESSION['SpielId'];
    $Spieler_ID = $_SESSION['username'];

    $db_Befehl = "SELECT * FROM parties WHERE SpielID = ?";
    $statement = $my_db->prepare($db_Befehl);
    $statement->bind_param('i', $Spiel_ID);
    $statement->execute();

    $result = $statement->get_result();
    $Partie = $result->fetch_assoc();

    echo"<table>
        <tr>
            <th>
                <button type=\"button\" onclick=\"spalte(1)\">Insert into first row</button>
            </th>
            <th>
                <button type=\"button\" onclick=\"spalte(2)\">Insert into second row</button>
            </th>
            <th>
                <button type=\"button\" onclick=\"spalte(3)\">Insert into third row</button>
            </th>
            <th>
                <button type=\"button\" onclick=\"spalte(4)\">Insert into fourth row</button>
            </th>
            <th>
                <button type=\"button\" onclick=\"spalte(5)\">Insert into fifth row</button>
            </th>
            <th>
                <button type=\"button\" onclick=\"spalte(6)\">Insert into sixth row</button>
            </th>
            <th>
                <button type=\"button\" onclick=\"spalte(7)\">Insert into seventh row</button>
            </th>
        </tr>";
    echo "<tr>";

    for($i=1; $i<=42; $i++){
        if(($i-1)%7 == 0){
            echo "</tr>";
        }
        if($colorset == "neutral"){
            if($Partie[$i] == 0) {$type = "neutral";}
            if($Partie[$i] == $Partie['Spieler1']){$type= "spieler1";}
            if($Partie[$i] == $Partie['Spieler2']){$type= "spieler2";}
        }
        if($colorset == "redyellow"){
            if($Partie[$i] == 0) {$type = "neutral";}
            if($Partie[$i] == $Partie['Spieler1']){$type= "red";}
            if($Partie[$i] == $Partie['Spieler2']){$type= "yellow";}
        }
        if($colorset == "yellowred"){
            if($Partie[$i] == 0) {$type = "neutral";}
            if($Partie[$i] == $Partie['Spieler1']){$type= "yellow";}
            if($Partie[$i] == $Partie['Spieler2']){$type= "red";}
        }


        echo ' <td><div id = "'.$i.'"class="'.$type.'">'.$Partie[$i].'</div></td>';
    }
    echo "<tr>";
    echo "</table>";
}

?>
