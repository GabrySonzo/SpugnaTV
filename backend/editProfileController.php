<?php

include 'connessione.php';
session_start();

$nome = $_POST['username'];

try{
    $query = "update Utenti set username = ? where email = '".$_SESSION['id']."'";
    echo $query;
    if ($connessione->prepare($query)->execute([$nome])){
        echo "Registration successful!";
        header("Location: ../frontend/profile.php");
    }
}
catch(Exception $e)
{
    $message = $e->getMessage();
    echo $message;
    header("Location: ../frontend/profile.php?error=3");
}

?>