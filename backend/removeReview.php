<?php

include 'connessione.php';
session_start();

$review = $_GET['review'];

$remove = "DELETE FROM Recensioni WHERE id = ?";
    if($connessione->prepare($remove)->execute([$review])){
        header("Location: ../frontend/film.php?film=".$_GET['film']);
    }else{
        header("Location: ../frontend/film.php?film=".$_GET['film']."&error=7");
    }
?>
