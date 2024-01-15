<?php

include 'connessione.php';
session_start();

$list = $_GET['lista'];
$film = $_GET['film'];

try{
    if($connessione->query("INSERT INTO Comprende (lista_id, film_id) VALUES ('" . $list . "', '" . $film . "')")){
        header("Location: ../frontend/film.php?film=". $film . "&success=1");
    }
    
}catch(Exception $e)
{
    $message = $e->getMessage();
    $code = $e->getCode();
    echo $message;
    echo $code;
    if($code == 1062){
        header("Location: ../frontend/film.php?film=". $film . "&error=1");
    }
    else{
        header("Location: ../frontend/film.php?film=". $film . "&error=2");
    }
    
}

?>