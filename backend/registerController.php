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
        $register = "insert into Utenti (email,username,password) values ('$email','$username','$password')";
    
        if ($connessione->query($register)){
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