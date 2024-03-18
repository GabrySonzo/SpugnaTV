<?php

include 'connessione.php';

$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$email = $_POST['email'];

if($password != $password2){
    header("Location: ../frontend/register.php?error=1");
}
else{
    $password = md5($password);
    try{
        $register = "INSERT into Utenti (email,username,password) values (?, ?, ?)";
    
        if ($connessione->prepare($register)->execute([$email, $username, $password])){ 
            $connessione->prepare("INSERT into Liste (nome, utente_mail) values ('Film visti', ?)")->execute([$email]);
            $connessione->prepare("INSERT into Liste (nome, utente_mail) values ('Film da vedere', ?)")->execute([$email]);
            echo "Registration successful!";
            header("Location: ../frontend/login.php");
        }
    }catch(Exception $e)
    {
        $message = $e->getMessage();
        echo $message;
        if($message == "Duplicate entry '$email' for key 'PRIMARY'"){
            header("Location: ../frontend/register.php?error=2");
        }
        else{
            echo "Registration failed";
        }
    }
}


?>