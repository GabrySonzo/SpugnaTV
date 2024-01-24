<?php

include 'connessione.php';

$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$foto = $_POST['foto'];

try{
    $register = "insert into Attori (nome, cognome, foto) values (?, ?, ?)";

    
    if ($connessione->prepare($register)->execute([$nome, $cognome, $foto])){
        echo "Registration successful!";
        header("Location: ../frontend/home.php?succ=3");
    }
}catch(Exception $e)
{
    $message = $e->getMessage();
    echo $message;
    header("Location: ../frontend/home.php?error=3");
}

?>