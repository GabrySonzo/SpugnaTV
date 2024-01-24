<?php

include 'connessione.php';
session_start();

$list = $_GET['lista'];
$film = $_GET['film'];

try{
    $register = "insert into Comprende (lista_id, film_id) values (?, ?)";
    if($connessione->prepare($register)->execute([$list, $film])){
        header("Location: ../frontend/film.php?film=". $film . "&succ=1");
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