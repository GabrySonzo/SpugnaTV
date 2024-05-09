<?php
//  	Connessione al DBMS e selezione del database.
//
// 	nome dell'host
//
//$host = "localhost";
$host = "ep-young-union-a2ktk9wm.eu-central-1.pg.koyeb.app";
//
// 	username dell'utente in connessione
//
//$user = "root";
$user = "koyeb-adm";
//
// 	password dell'utente
//
$password = "NAo4uwaGm5hE";
//
// nome del database
//
$db = "SpugnaTV";
//
// 	Istanza dell'oggetto della classe MySQLi
//
$connessione = new mysqli($host, $user, $password, $db);
//
// 	Verifica su eventuali errori di connessione
//
if ($connessione->connect_errno)
{
    echo("Connessione fallita: ".$connessione->connect_error.".");
    exit();
}
?>
