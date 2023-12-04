<?php

include 'connessione.php';

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

$password = md5($password);
try{
    $register = "insert into utenti (email,nome,password) values ('$email','$username','$password')";
    
}catch(Exception $e)
{
    $message = $e->getMessage();
    //redirect to register page
}

?>