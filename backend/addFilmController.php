<?php

include 'connessione.php';

$titolo = $_POST['titolo'];
$anno = $_POST['anno'];
$durata = $_POST['durata'];
$genere = $_POST['genere'];
$trama = $_POST['trama'];
$locandina = $_POST['locandina'];
$banner = $_POST['banner'];

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
    $register = "insert into Film (titolo, anno, durata, genere, trama, locandina, banner) values (?, ?, ?, ?, ?, ?, ?)";
    if ($connessione->prepare($register)->execute([$titolo, $anno, $durata, $genere, $trama, $locandina, $banner])){
        while($regista = array_pop($registi)){
            $connessione->query("insert into Dirige (registi_id, film_id) values ('$regista', (SELECT id FROM Film WHERE titolo = '$titolo'))");
        }
        while($attore = array_pop($attori)){
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