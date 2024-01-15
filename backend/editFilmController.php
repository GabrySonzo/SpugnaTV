<?php

include 'connessione.php';

$titolo = $_POST['titolo'];
$anno = $_POST['anno'];
$durata = $_POST['durata'];
$genere = $_POST['genere'];
$trama = $_POST['trama'];
$locandina = $_POST['locandina'];
$banner = $_POST['banner'];
$film = $_POST['film'];

print_r($_POST);

$registi = array();
$index = 1;
while(isset($_POST['regista'.$index])){
    $registi[$index-1] = $_POST['regista'.$index];
    $index++;
}

$attori = array();
$index = 1;
while(isset($_POST['attore'.$index])){
    $attori[$index-1] = $_POST['attore'.$index];
    $index++;
}



try{
    $update = "UPDATE Film SET titolo = '$titolo', anno = '$anno', durata = '$durata', genere = '$genere', trama = '$trama', locandina = '$locandina', banner = '$banner' WHERE id = '$film'";
    if ($connessione->query($update)){
        while($regista = array_pop($registi)){
            $connessione->query("insert into Dirige (registi_id, film_id) values ('$regista', (SELECT id FROM Film WHERE titolo = '$titolo'))");
        }
        while($attore = array_pop($attori)){
            $connessione->query("insert into Recita (attori_id, film_id) values ('$attore', (SELECT id FROM Film WHERE titolo = '$titolo'))");
        }
        echo "Edit successful!";
        header("Location: ../frontend/film.php?film=".$film."&succ=2");
    }
}catch(Exception $e)
{
    $message = $e->getMessage();
    echo $message;
    header("Location: ../frontend/home.php?error=3");
}

?>