<?php
    include 'connessione.php';

    $director = $_GET['director'];

    $remove = "DELETE FROM Registi WHERE id = '". $director ."'";
    if($connessione->query($remove)){
        header("Location: ../frontend/home.php?succ=4");
    }else{
        header("Location: ../frontend/director.php?director=". $film . "&error=2");
    }
?>