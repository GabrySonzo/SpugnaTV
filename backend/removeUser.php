<?php

include 'connessione.php';
session_start();

$remove = "DELETE FROM Utenti WHERE email = '". $_SESSION['id']."'";

if ($connessione->query($remove)) {
    echo "User removed successfully";
    session_destroy();
    session_abort();
    header("Location: ../frontend/home.php");
} else {
    echo "Failed to remove user";
    header("Location: ../frontend/profile.php?error=1");
}
?>
