<?php

include 'connessione.php';

$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$nascita=$_POST['nascita'];
$nascita=date("Y-m-d H:i:s",strtotime($nascita));
if(isset($_POST['morte'])) {
    $morte = $_POST['morte'];
    $morte=date("Y-m-d H:i:s",strtotime($morte));
}
else{
    $morte = null;
}
$descrizione = $_POST['descrizione'];
$foto = $_POST['foto'];

// sistemare la data di morte
echo $morte;

try{
    $register = "insert into Registi (nome, cognome, data_nascita, data_morte, descrizione, foto) values ('$nome', '$cognome', '$nascita', '$morte', '$descrizione', '$foto')";

    if ($connessione->query($register)){
        echo "Registration successful!";
        //header("Location: ../frontend/index.php?succ=2");
    }
}catch(Exception $e)
{
    $message = $e->getMessage();
    echo $message;
    header("Location: ../frontend/index.php?error=$message");
}

?>