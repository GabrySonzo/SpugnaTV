<?php
    include 'connessione.php';

    $director = $_GET['director'];

    $remove = "DELETE FROM Registi WHERE id = ?";
    if($connessione->prepare($remove)->execute([$director])){
        $connessione->prepare("DELETE FROM Dirige WHERE registi_id = ?")->execute([$director]);
        header("Location: ../frontend/home.php?succ=4");
    }else{
        header("Location: ../frontend/director.php?director=". $film . "&error=2");
    }
?>