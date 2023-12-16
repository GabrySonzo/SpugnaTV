<?php

include 'connessione.php';

$titolo = $_POST['titolo'];
$anno = $_POST['anno'];
$durata = $_POST['durata'];
$genere = $_POST['genere'];
$trama = $_POST['trama'];
$locandina = $_POST['locandina'];
$banner = $_POST['banner'];

try{
    $register = "insert into Film (titolo, anno, durata, genere, trama, locandina, banner) values ('$titolo', '$anno', '$durata', '$genere', '$trama', '$locandina', '$banner')";

    if ($connessione->query($register)){
        echo "Registration successful!";
        header("Location: ../frontend/index.php?succ=2");
    }
}catch(Exception $e)
{
    $message = $e->getMessage();
    echo $message;
    header("Location: ../frontend/index.php?error=2");
}

?>