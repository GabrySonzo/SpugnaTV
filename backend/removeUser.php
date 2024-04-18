<?php

include 'connessione.php';
session_start();

$remove = "DELETE FROM Utenti WHERE email = '". $_SESSION['id']."'";

if ($connessione->query($remove)) {
    echo "User removed successfully";
    $connessione->query("DELETE FROM Liste WHERE utente_mail = '". $_SESSION['id']."'");
    $connessione->query("DELETE FROM Recensioni WHERE utente_mail = '". $_SESSION['id']."'");
    session_destroy();
    session_abort();
    header("Location: ../frontend/home.php");
} else {
    echo "Failed to remove user";
    header("Location: ../frontend/profile.php?error=1");
}
?>
