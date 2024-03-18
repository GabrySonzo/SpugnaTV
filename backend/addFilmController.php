<?php

include 'connessione.php';

$titolo = $_POST['titolo'];
$anno = $_POST['anno'];
$durata = $_POST['durata'];
$genere = $_POST['genere'];
$trama = $_POST['trama'];
$locandina = $_POST['locandina'];
$banner = $_POST['banner'];

print_r($_POST);

$registi = array();
$index = 1;
while(isset($_POST['regista'.$index])){
    if(!in_array($_POST['regista'.$index], $registi)){
        $registi[] = $_POST['regista'.$index];
    }
    $index++;
}


$attori = array();
$index = 1;
while(isset($_POST['attore'.$index])){
    if(!in_array($_POST['attore'.$index], $attori)){
        $attori[] = $_POST['attore'.$index];
    }
    $index++;
}



try{
    if(isset($_POST['edit'])){
        $film = $_POST['film'];
        echo $film;
        $query = "UPDATE Film SET titolo = ?, anno = ?, durata = ?, genere = ?, trama = ?, locandina = ?, banner = ? WHERE id = '$film'";
    }else{
        $query = "INSERT INTO Film (titolo, anno, durata, genere, trama, locandina, banner) values (?, ?, ?, ?, ?, ?, ?)";
    }
    if ($connessione->prepare($query)->execute([$titolo, $anno, $durata, $genere, $trama, $locandina, $banner])){
        if(isset($_POST['edit'])){
            $id = $film;
        }else{
            $id = $connessione -> insert_id;
        }
        while($regista = array_pop($registi)){
            if($regista != 'null'){
                $connessione->query("insert into Dirige (registi_id, film_id) values ('$regista', '$id')");
            }
        }
        while($attore = array_pop($attori)){
            if($attore != 'null'){
                $connessione->query("insert into Recita (attori_id, film_id) values ('$attore', '$id')");
            }
                
        }
        echo "Registration successful!";
        if(isset($_POST['edit'])){
            header("Location: ../frontend/film.php?film=".$film."&succ=2");
        }else{
            header("Location: ../frontend/home.php?succ=1");
        }
    }
}catch(Exception $e)
{
    $message = $e->getMessage();
    $code = $e->getCode();
    echo $message;
    echo $code;
    if(isset($_POST['edit'])){
        header("Location: ../frontend/film.php?film=".$film."&error=3");
    }else{
        header("Location: ../frontend/home.php?error=1");
    }
}

?>