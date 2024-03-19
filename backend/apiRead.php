<?php

//connect to db
include 'connessione.php';

// Get the JSON data from the request body
$jsonData = file_get_contents('php://input');

// Decode the JSON data into a PHP associative array
$data = json_decode($jsonData, true);

if(isset($data['type'])){
    if($data['type'] == "director"){
        if (isset($data['film'])){
            $query = "SELECT * FROM Registi INNER JOIN Dirige ON Registi.id = Dirige.registi_id WHERE film_id = '" . $data['film'] . "'";
            $ok = true;
        } else {
            $ok = false;
        }    
    }else if($data['type'] == "actor"){
        if (isset($data['film'])){
            $query = "SELECT * FROM Attori INNER JOIN Recita ON Attori.id = Recita.attori_id WHERE film_id = '" . $data['film'] . "'";
            $ok = true;
        } else {
            $ok = false;
        }    
    }else if($data['type'] == "AllActors"){
        $query = "SELECT * FROM Attori";
        $ok = true;
    }else if($data['type'] == "profiles"){
        $query = "SELECT * FROM Utenti";
        $ok = true;
    }else if($data['type'] == "listFilm"){
        if(isset($data['list'])){
            $query = "SELECT * FROM Film INNER JOIN Comprende ON Film.id = Comprende.film_id WHERE lista_id = '" . $data['list'] . "'";
            $ok = true;
        } else {
            $ok = false;
        }
    }

    if($ok){
        
        if($result = $connessione->query($query)){
            $ret = array();
            while ($row = $result->fetch_assoc()) {
                $ret[] = $row;
            }
            $json = json_encode(array("error" => false, "msg" => "Query succesfull", "data" => $ret));
            echo $json;
        }
        else{
            $json = json_encode(array("error" => true, "msg" => "Query failed", "data" => null));
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