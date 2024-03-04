<?php

//read post param


//connect to db
include 'connessione.php';

// Get the JSON data from the request body
$jsonData = file_get_contents('php://input');

// Decode the JSON data into a PHP associative array
$data = json_decode($jsonData, true);

// Check if the required parameters exist

if(isset($data['type'])){
    if($data['type'] == "director"){
        if (isset($data['film']) && isset($data['director'])) {
            $film = $data['film'];
            $director = $data['director'];
            
            $query = "DELETE FROM Dirige WHERE film_id = '$film' AND registi_id = '$director'";
            $ok = true;

        } else {
            $ok = false;
        }
    
    }else if($data['type'] == "actor"){
        if (isset($data['film']) && isset($data['actor'])) {
            $film = $data['film'];
            $actor = $data['actor'];
        
            $query = "DELETE FROM Recita WHERE film_id = '$film' AND attori_id = '$actor'";
            $ok = true;

        } else {
            $ok = false;
        }

    }else if($data['type'] == "allActors"){
        if (isset($data['actor'])) {
            $actor = $data['actor'];
        
            $query = "DELETE FROM Attori WHERE id = '$actor'";

            $rmRecita = true;
            $ok = true;

        } else {
            $ok = false;
        }

    }else if($data['type'] == "profiles"){
        if (isset($data['profile'])) {
            $profile = $data['profile'];
        
            $query = "DELETE FROM Utenti WHERE email = '$profile'";

            $rmListe = true;
            $ok = true;

        } else {
            $ok = false;
        }
    }

    if($ok){
        if ($connessione->query($query)) {
            
            /*if($rmRecita){
                $connessione->query("DELETE FROM Recita WHERE attori_id = '$actor'");
            }
            if($rmListe){
                $connessione->query("DELETE FROM Liste WHERE utente_mail = '$profile'");
            }*/

            $json = json_encode(array("error" => false, "msg" => "Remove successful!", "data" => null));
            echo $json;
        } else {
            $json = json_encode(array("error" => true, "msg" => "Query error", "data" => null));
            echo $json;
        }
    }else{
        $json = json_encode(array("error" => true, "msg" => "Missing parameters", "data" => null));
        echo $json;
    }
}
else{
    $json = json_encode(array("error" => true, "msg" => "Missing type parameter", "data" => null));
    echo $json;
}