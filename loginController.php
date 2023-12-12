<?php

include 'connessione.php';

$email = $_POST['email'];
$password = $_POST['password'];

$password = md5($password);

try {
    $query = "SELECT * FROM Utente WHERE email = '$email' AND password = '$password'";
    $result = $connessione->query($query);

    if ($result->num_rows > 0) {
        // User found
        echo "Login successful!";
        session_start();
        $_SESSION ["id"] = $email;
        // Redirect to home page or any other desired page
        header("Location: home.php");
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