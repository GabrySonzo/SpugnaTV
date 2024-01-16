<?php

include 'connessione.php';
session_start();

$nome = $_POST['nome'];

if($nome == "Film da vedere" || $nome == "Film visti"){
    header("Location: ../frontend/registerList.php?error=1");
}
try{
    $register = "insert into Liste (nome, utente_mail) values ('".$nome."', '".$_SESSION['id']."')";
    
    if ($connessione->query($register)){
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