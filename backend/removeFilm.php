<?php
    include 'connessione.php';

    $film = $_GET['film'];

    $remove = "DELETE FROM Film WHERE id = '". $film ."'";
    if($connessione->query($remove)){
        header("Location: ../frontend/home.php?succ=4");
    }else{
        header("Location: ../frontend/film.php?film=". $film . "&error=4");
    }
?>