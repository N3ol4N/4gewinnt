<?php
require("datenbank.php");
session_start();
$userid = $_SESSION['userid'];
$challenge = $_GET['challenge'];

if (isset($challenge)) {
    $statement = "SELECT * FROM users WHERE id = $userid";
    $result = mysqli_query($my_db, $statement);
    $user = mysqli_fetch_assoc($result);
    $db_challenge = $user['challenge'];

    if ($challenge == $db_challenge) {
        $statement = $my_db->prepare("UPDATE users SET confirmed = '1' WHERE challenge=?");
        $statement->bind_param('s', $_GET['challenge']);
        $statement->execute();
        $result = $statement->get_result();
        header('Location: ../index.php');
    } else {
        echo "Not authenticated. Wrong challenge used";
        echo '<a href="../index.php">Back to start</a>';
    }
}
?>
