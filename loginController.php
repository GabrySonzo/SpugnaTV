<?php

include 'connessione.php';

$email = $_POST['email'];
$password = $_POST['password'];

$password = md5($password);

try {
    $query = "SELECT * FROM Utenti WHERE email = '$email' AND password = '$password'";
    $result = $connessione->query($query);

    if ($result->num_rows > 0) {
        // User found
        echo "Login successful!";
        session_start();
        $_SESSION ["id"] = $email;
        if($_SESSION ["id"] == "gabrisonzo@gmail.com"){
            $_SESSION ['admin'] = true;
        }
        else{
            $_SESSION ['admin'] = false;
        }
        // Redirect to home page or any other desired page
        header("Location: index.php");
    } else {
        // User not found
        echo "Invalid email or password";
        header("Location: login.php?error=1");
    }
} catch (Exception $e) {
    $message = $e->getMessage();
    // Redirect to login page or any other desired page
    header("Location: login.php");
}

?>