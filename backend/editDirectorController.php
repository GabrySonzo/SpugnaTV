<?php

include 'connessione.php';

$director = $_POST['director'];
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
    $update = "UPDATE Registi SET nome = ?, cognome = ?, data_nascita = ?, data_morte = ?, descrizione = ?, foto = ? WHERE id = '$director'";

    if ($connessione->prepare($update)->execute([$nome, $cognome, $nascita, $morte, $descrizione, $foto])){
        echo "Edit successful!";
        header("Location: ../frontend/director.php?director=".$director."&succ=1");
    }
}catch(Exception $e)
{
    $message = $e->getMessage();
    echo $message;
    header("Location: ../frontend/director.php?director=".$director."&error=1");
}

?>