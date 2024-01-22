<?php

//connect to db
include 'connessione.php';

// Get the JSON data from the request body
$jsonData = file_get_contents('php://input');

// Decode the JSON data into a PHP associative array
$data = json_decode($jsonData, true);

if(isset($data['type']) && $data['type'] == "director"){
    if (isset($data['film'])){
        $directors = $connessione->query("SELECT * FROM Registi INNER JOIN Dirige ON Registi.id = Dirige.registi_id WHERE film_id = '" . $data['film'] . "'");
        $ret = array();
        while ($row = $directors->fetch_assoc()) {
            $ret[] = $row;
        }
        $json = json_encode($ret);
        echo $json;
    } else {
        $json = json_encode(array("error" => true, "msg" => "Missing parameters"));
        echo $json;
    }    
}