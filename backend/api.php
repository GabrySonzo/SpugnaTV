<?php

//read post param


//connect to db
include 'connessione.php';

// Get the JSON data from the request body
$jsonData = file_get_contents('php://input');

// Decode the JSON data into a PHP associative array
$data = json_decode($jsonData, true);

// Check if the required parameters exist
if (isset($data['film']) && isset($data['director'])) {
    $film = $data['film'];
    $director = $data['director'];

    //query
    $remove = "DELETE FROM Dirige WHERE film_id = '$film' AND registi_id = '$director'";

    //execute query
    if ($connessione->query($remove)) {
        echo "Remove successful!";
    } else {
        echo "Remove failed!";
    }
} else {
    echo "Missing parameters!";
}
