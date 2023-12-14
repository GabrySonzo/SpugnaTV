<?php

include 'connessione.php';

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

$password = md5($password);
try{
    $register = "insert into Utenti (email,username,password) values ('$email','$username','$password')";

    if ($connessione->query($register)){
        echo "Registration successful!";
        header("Location: login.php");
    }
}catch(Exception $e)
{
    $message = $e->getMessage();
    echo $message;
    if($message == "Duplicate entry '$email' for key 'PRIMARY'"){
        header("Location: register.php?error=2");
    }
    else{
        echo "Registration failed";
    }
}

?>