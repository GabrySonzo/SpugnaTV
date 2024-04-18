<?php
    include 'connessione.php';

    $film = $_GET['film'];

    $remove = "DELETE FROM Film WHERE id = ?";
    if($connessione->prepare($remove)->execute([$film])){
        $connessione->prepare("DELETE FROM Dirige WHERE film_id = ?")->execute([$film]);
        $connessione->prepare("DELETE FROM Recita WHERE film_id = ?")->execute([$film]);
        $connessione->prepare("DELETE FROM Recensioni WHERE film_id = ?")->execute([$film]);
        header("Location: ../frontend/home.php?succ=4");
    }else{
        header("Location: ../frontend/film.php?film=". $film . "&error=4");
    }
?>