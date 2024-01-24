<?php

include 'connessione.php';
session_start();

$nome = $_POST['nome'];

if($nome == "Film da vedere" || $nome == "Film visti"){
    header("Location: ../frontend/registerList.php?error=1");
}
try{
    $register = "insert into Liste (nome, utente_mail) values (?, '".$_SESSION['id']."')";
    
    if ($connessione->prepare($register)->execute([$nome])){
        echo "Registration successful!";
        header("Location: ../frontend/profile.php?succ=1");
    }
}catch(Exception $e)
{
    $message = $e->getMessage();
    echo $message;
    header("Location: ../frontend/profile.php?error=2");
}

?>