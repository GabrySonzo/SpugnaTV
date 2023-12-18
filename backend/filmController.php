<?php

include 'connessione.php';

$titolo = $_POST['titolo'];
$anno = $_POST['anno'];
$durata = $_POST['durata'];
$genere = $_POST['genere'];
$trama = $_POST['trama'];
$locandina = $_POST['locandina'];
$banner = $_POST['banner'];
$regista = $_POST['regista'];
$attore = $_POST['attore'];

try{
    $register = "insert into Film (titolo, anno, durata, genere, trama, locandina, banner) values ('$titolo', '$anno', '$durata', '$genere', '$trama', '$locandina', '$banner')";
    if ($connessione->query($register)){
        if(isset($regista)){
            $connessione->query("insert into Dirige (registi_id, film_id) values ('$regista', (SELECT id FROM Film WHERE titolo = '$titolo'))");
        }
        if(isset($attore)){
            $connessione->query("insert into Recita (attori_id, film_id) values ('$attore', (SELECT id FROM Film WHERE titolo = '$titolo'))");
        }
        echo "Registration successful!";
        header("Location: ../frontend/home.php?succ=1");
    }
}catch(Exception $e)
{
    $message = $e->getMessage();
    echo $message;
    header("Location: ../frontend/home.php?error=1");
}

?>