<?php

//establish database-connection
require("datenbank.php");
session_start();

//checks for get parameters
if (isset($_GET['row'])) {
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
    $AmZug = $Partie['AmZug'];
    $anspruchfeld = $Partie[$spalte];

    //checks for current active player
    if ($AmZug == $Spieler_ID) {
        global $NeuerZug;

        if ($Spieler_ID == $Spieler1) {
            $NeuerZug = $Spieler2;
        }
        if ($Spieler_ID == $Spieler2) {
            $NeuerZug = $Spieler1;
        }

        //set clicked field on playground
        //das grauen beginnt (<- refaktorn!!)
        if ($anspruchfeld != $Spieler1 && $anspruchfeld != $Spieler2) {
            $db_Befehl = "UPDATE parties SET `" . $spalte . "`=?, AmZug = ? WHERE SpielID = ?";
            $statement = $my_db->prepare($db_Befehl);
            $statement->bind_param('ssi', $Spieler_ID, $NeuerZug, $Spiel_ID);
            $statement->execute();
        } else if ($Partie[$spalte + 7] != $Spieler1 && $Partie[$spalte + 7] != $Spieler2) {
            $spalte = $spalte + 7;
            $db_Befehl = "UPDATE parties SET `" . $spalte . "`=?, AmZug = ? WHERE SpielID = ?";
            $statement = $my_db->prepare($db_Befehl);
            $statement->bind_param('ssi', $Spieler_ID, $NeuerZug, $Spiel_ID);
            $statement->execute();
        } else if ($Partie[$spalte + 14] != $Spieler1 && $Partie[$spalte + 14] != $Spieler2) {
            $spalte = $spalte + 14;
            $db_Befehl = "UPDATE parties SET `" . $spalte . "`=?, AmZug = ? WHERE SpielID = ?";
            $statement = $my_db->prepare($db_Befehl);
            $statement->bind_param('ssi', $Spieler_ID, $NeuerZug, $Spiel_ID);
            $statement->execute();
        } else if ($Partie[$spalte + 21] != $Spieler1 && $Partie[$spalte + 21] != $Spieler2) {
            $spalte = $spalte + 21;
            $db_Befehl = "UPDATE parties SET `" . $spalte . "`=?, AmZug = ? WHERE SpielID = ?";
            $statement = $my_db->prepare($db_Befehl);
            $statement->bind_param('ssi', $Spieler_ID, $NeuerZug, $Spiel_ID);
            $statement->execute();
        } else if ($Partie[$spalte + 28] != $Spieler1 && $Partie[$spalte + 28] != $Spieler2) {
            $spalte = $spalte + 28;
            $db_Befehl = "UPDATE parties SET `" . $spalte . "`=?, AmZug = ? WHERE SpielID = ?";
            $statement = $my_db->prepare($db_Befehl);
            $statement->bind_param('ssi', $Spieler_ID, $NeuerZug, $Spiel_ID);
            $statement->execute();
        } else if ($Partie[$spalte + 35] != $Spieler1 && $Partie[$spalte + 35] != $Spieler2) {
            $spalte = $spalte + 35;
            $db_Befehl = "UPDATE parties SET `" . $spalte . "`=?, AmZug = ? WHERE SpielID = ?";
            $statement = $my_db->prepare($db_Befehl);
            $statement->bind_param('ssi', $Spieler_ID, $NeuerZug, $Spiel_ID);
            $statement->execute();
        } else {
            echo "this row is full, select another row";
        }
    } else if ($AmZug != $Spieler_ID) {
        echo "<br>not your turn";
    } else {
        echo "Error";
    }
}

//checks for get parameters and generates fieldview
if (isset($_GET['getgame'])) {
    $colorset = $_GET['getgame'];
    $Spiel_ID = $_SESSION['SpielId'];
    $Spieler_ID = $_SESSION['username'];

    $db_Befehl = "SELECT * FROM parties WHERE SpielID = ?";
    $statement = $my_db->prepare($db_Befehl);
    $statement->bind_param('i', $Spiel_ID);
    $statement->execute();

    $result = $statement->get_result();
    $Partie = $result->fetch_assoc();

    $_SESSION['spieler1nick'] = $Partie['Spieler1'];
    $_SESSION['spieler2nick'] = $Partie['Spieler2'];

    echo '<div id="gamecontent">';
    echo '<div id="gamematchup">';
    if ($colorset == "neutral") {
        echo '<div class="spielernamen">'.$_SESSION['spieler1nick'].'</div> <div> VS </div> <div class="spielernamen">'.$_SESSION['spieler2nick'].'</div>';
    }
    if ($colorset == "redyellow") {
        echo '<div class="spielernamen red">'.$_SESSION['spieler1nick'].'</div> VS <div class="spielernamen yellow">'.$_SESSION['spieler2nick'].'</div>';
    }
    if ($colorset == "yellowred") {
        echo '<div class="spielernamen yellow">'.$_SESSION['spieler1nick'].'</div> VS <div class="spielernamen red">'.$_SESSION['spieler2nick'].'</div>';
    }
    if ($colorset == "blackwhite") {
        echo '<div class="spielernamen black">'.$_SESSION['spieler1nick'].'</div> VS <div class="spielernamen white">'.$_SESSION['spieler2nick'].'</div>';
    }
    if ($colorset == "whiteblack") {
        echo '<div class="spielernamen white">'.$_SESSION['spieler1nick'].'</div> VS <div class="spielernamen black">'.$_SESSION['spieler2nick'].'</div>';
    }
    echo "</div>";
    echo "<br>";

    echo '<div>Am Zug : '.$Partie['AmZug'].'</div>';

    echo '<div id="playground">';

    echo "<table>
            <tr>
                <th>
                    <button type=\"button\" onclick=\"spalte(1)\">Insert in this row</button>
                </th>
                <th>
                    <button type=\"button\" onclick=\"spalte(2)\">Insert in this row</button>
                </th>
                <th>
                    <button type=\"button\" onclick=\"spalte(3)\">Insert in this row</button>
                </th>
                <th>
                    <button type=\"button\" onclick=\"spalte(4)\">Insert in this row</button>
                </th>
                <th>
                    <button type=\"button\" onclick=\"spalte(5)\">Insert in this row</button>
                </th>
                <th>
                    <button type=\"button\" onclick=\"spalte(6)\">Insert in this row</button>
                </th>
                <th>
                    <button type=\"button\" onclick=\"spalte(7)\">Insert in this row</button>
                </th>
            </tr>";
    echo "<br>";
    echo "<tr>";

    //checks for colorset
    for ($i = 1; $i <= 42; $i++) {
        if (($i - 1) % 7 == 0) {
            echo "</tr>";
        }
        if ($colorset == "neutral") {
            if ($Partie[$i] == 0) {
                $type = "neutral";
            }
            if ($Partie[$i] == $Partie['Spieler1']) {
                $type = "spieler1";
            }
            if ($Partie[$i] == $Partie['Spieler2']) {
                $type = "spieler2";
            }
        }
        if ($colorset == "redyellow") {
            if ($Partie[$i] == 0) {
                $type = "neutral";
            }
            if ($Partie[$i] == $Partie['Spieler1']) {
                $type = "red";
            }
            if ($Partie[$i] == $Partie['Spieler2']) {
                $type = "yellow";
            }
        }
        if ($colorset == "yellowred") {
            if ($Partie[$i] == 0) {
                $type = "neutral";
            }
            if ($Partie[$i] == $Partie['Spieler1']) {
                $type = "yellow";
            }
            if ($Partie[$i] == $Partie['Spieler2']) {
                $type = "red";
            }
        }
        if ($colorset == "blackwhite") {
            if ($Partie[$i] == 0) {
                $type = "neutral";
            }
            if ($Partie[$i] == $Partie['Spieler1']) {
                $type = "black";
            }
            if ($Partie[$i] == $Partie['Spieler2']) {
                $type = "white";
            }
        }
        if ($colorset == "whiteblack") {
            if ($Partie[$i] == 0) {
                $type = "neutral";
            }
            if ($Partie[$i] == $Partie['Spieler1']) {
                $type = "white";
            }
            if ($Partie[$i] == $Partie['Spieler2']) {
                $type = "black";
            }
        }


        echo ' <td id = "' . $i . '"class="' . $type . '"></td>';
    }
    echo "<tr>";
    echo "</table>";
    echo "</div>";
    echo "</div>";
}


// gewinner check

function horizontal($position, $count, $Spiel_ID)
{
    require ("datenbank.php");

    $db_Befehl = "SELECT * FROM parties WHERE SpielID = ?";
    $statement = $my_db->prepare($db_Befehl);
    $statement->bind_param('i', $Spiel_ID);
    $statement->execute();

    $result = $statement->get_result();
    $Partie = $result->fetch_assoc();

    if($Partie[$position] != "0") {

        if ($count == 4) {
            echo "<h3>winner horizontal : " . $Partie[$position]."</h3><br>";

        } else if ((floor(($position - 1) / 7) == floor(($position) / 7))) {
            if ($Partie[$position] == $Partie[$position + 1]) {
                $count++;
                if ($position < 43) {
                    horizontal($position + 1, $count, $Spiel_ID);
                }
            }
        }
    }
}

function vertical($position, $count, $Spiel_ID)
{
    require ("datenbank.php");

    $db_Befehl = "SELECT * FROM parties WHERE SpielID = ?";
    $statement = $my_db->prepare($db_Befehl);
    $statement->bind_param('i', $Spiel_ID);
    $statement->execute();

    $result = $statement->get_result();
    $Partie = $result->fetch_assoc();

    if ($Partie[$position] != "0") {

        if ($count == 4) {
            echo "<h3>winner vertical : " . $Partie[$position]."</h3><br>";

        } else if ($Partie[$position] == $Partie[$position + 7]) {
            $count++;
            if ($position < 35) {
                vertical($position + 7, $count, $Spiel_ID);
            }
        }
    }
}

function diagonalrechts($position, $count, $Spiel_ID)
{
    require ("datenbank.php");

    $db_Befehl = "SELECT * FROM parties WHERE SpielID = ?";
    $statement = $my_db->prepare($db_Befehl);
    $statement->bind_param('i', $Spiel_ID);
    $statement->execute();

    $result = $statement->get_result();
    $Partie = $result->fetch_assoc();

    if ($Partie[$position] != "0") {

        if ($count == 4) {
            echo "winner diagonal right : " . $Partie[$position]."<br>";

        } else if ($Partie[$position] == $Partie[$position + 8]) {
            $count++;
            if (($position + 8) < 42) {
                diagonalrechts($position + 8, $count, $Spiel_ID);
            }
        }
    }
}

function diagonallinks($position, $count, $Spiel_ID)
{
    require ("datenbank.php");

    $db_Befehl = "SELECT * FROM parties WHERE SpielID = ?";
    $statement = $my_db->prepare($db_Befehl);
    $statement->bind_param('i', $Spiel_ID);
    $statement->execute();

    $result = $statement->get_result();
    $Partie = $result->fetch_assoc();

    if ($Partie[$position] != "0") {

        if ($count == 4) {
            echo "winner diagonal left: " . $Partie[$position]."<br>";

        } else if ($Partie[$position] == $Partie[$position + 6]) {
            $count++;
            if (($position + 6) < 42) {
                diagonallinks($position + 6, $count, $Spiel_ID);
            }
        }
    }
}


//prüft für jedes feld ob ein gewinner feststeht
for($i = 1 ; $i < 42 ; $i++) {
    horizontal ($i, 1, $Spiel_ID);
    vertical($i, 1, $Spiel_ID);
    diagonalrechts($i, 1, $Spiel_ID);
    diagonallinks($i, 1, $Spiel_ID);
}

?>
