<?php

header ('Content-Type: application/json');
// import jwt
require_once '../vendor/autoload.php';
use \Firebase\JWT\JWT;


include '../backend/connessione.php';

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
        $row = $result->fetch_assoc();
        $secret = "mysecret";
        $data = array(
            'profile' => 
                    [
                        "email" => $row["email"],
                        "name" => $row["username"],
                    ],
            "role" => $row["ruolo"],
        );
        $token = JWT::encode($data, $secret, 'HS256');
        
        echo json_encode(array("error" => false, "msg" => "Login successful", "token" => $token));
        
    } else {
        echo json_encode(array("error" => true, "msg" => "Invalid email or password"));
    }
} catch (Exception $e) {
    
    echo json_encode(array("error" => true, "msg" => "Login failed"));
}

?>