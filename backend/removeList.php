<?php
    include 'connessione.php';

    $list = $_GET['list'];

    $remove = "DELETE FROM Liste WHERE id = ?";
    if($connessione->prepare($remove)->execute([$list])){
        $connessione->prepare("DELETE FROM Comprende WHERE lista_id = ?")->execute([$list]);
        header("Location: ../frontend/home.php?succ=4");
    }else{
        header("Location: ../frontend/list.php?list=". $list . "&error=1");
    }
?>