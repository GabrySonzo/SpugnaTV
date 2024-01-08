<?php

include 'connessione.php';
session_start();

$daVedere = $connessione->query("SELECT id FROM Liste WHERE nome = 'Film da vedere' AND utente_mail = '" . $_SESSION['id'] . "'")->fetch_assoc()['id'];
$film = $_GET['film'];

$connessione->query("INSERT INTO Comprende (lista_id, film_id) VALUES ('" . $daVedere . "', '" . $film . "')");

?>