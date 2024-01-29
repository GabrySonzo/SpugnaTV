<?php

include 'connessione.php';

$email = $_POST['email'];
$password = $_POST['password'];

$password = md5($password);

try {
    $query = "SELECT * FROM Utenti WHERE email = ? AND password = ?";
    $stmt = $connessione->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt -> get_result();

    if ($result->num_rows > 0) {
        
        echo "Login successful!";
        session_start();
        $_SESSION ["id"] = $email;
        if($_SESSION ["id"] == "gabrisonzo@gmail.com"){
            $_SESSION ['admin'] = true;
        }
        else{
            $_SESSION ['admin'] = false;
        }
        header("Location: ../frontend/home.php");
    } else {
        echo "Invalid email or password";
        header("Location: ../frontend/login.php?error=1");
    }
} catch (Exception $e) {
    $message = $e->getMessage();
    header("Location: ../frontend/login.php?error=2");
}

?>