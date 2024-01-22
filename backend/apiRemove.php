<?php

//read post param


//connect to db
include 'connessione.php';

// Get the JSON data from the request body
$jsonData = file_get_contents('php://input');

// Decode the JSON data into a PHP associative array
$data = json_decode($jsonData, true);

// Check if the required parameters exist
if(isset($data['type']) && $data['type'] == "director"){
    if (isset($data['film']) && isset($data['director'])) {
        $film = $data['film'];
        $director = $data['director'];
    
        //query
        $remove = "DELETE FROM Dirige WHERE film_id = '$film' AND registi_id = '$director'";
    
        //execute query
        if ($connessione->query($remove)) {
            //echo "Remove successful!";
        } else {
            $json = json_encode(array("error" => true, "msg" => "Query error"));
            echo $json;
        }
    } else {
        $json = json_encode(array("error" => true, "msg" => "Missing parameters"));
        echo $json;
    }
}else if(isset($data['type']) && $data['type'] == "actor"){
    if (isset($data['film']) && isset($data['actor'])) {
        $film = $data['film'];
        $actor = $data['actor'];
    
        //query
        $remove = "DELETE FROM Recita WHERE film_id = '$film' AND attori_id = '$actor'";
    
        //execute query
        if ($connessione->query($remove)) {
            //echo "Remove successful!";
            $filmActors = $connessione->query("SELECT * FROM Attori INNER JOIN Recita ON Attori.id = Recita.attori_id WHERE film_id = '" . $film . "'");
            $ret = array();
            while ($row = $filmActors->fetch_assoc()) {
                $ret[] = $row;
            }
            $json = json_encode($ret);
            echo $json;
        } else {
            $json = json_encode(array("error" => true, "msg" => "Query error"));
            echo $json;
        }
    } else {
        $json = json_encode(array("error" => true, "msg" => "Missing parameters"));
        echo $json;
    }
}
