<?php

include 'connessione.php';
session_start();

$nome = $_POST['nome'];

try{
    if($_POST['edit'] == "true"){
        $list = $_POST['id'];
        $query = "update Liste set nome = ? where id = ". $list;
    } else{
        $query = "insert into Liste (tipo, nome, utente_mail) values ( 'custom', ?, '".$_SESSION['id']."')";
    }
    if ($connessione->prepare($query)->execute([$nome])){
        echo "Registration successful!";
        if($_POST['edit'] == "true"){
            header("Location: ../frontend/list.php?list=".$_POST['id']."&succ=1");
        }else{
            header("Location: ../frontend/profile.php?succ=1");
        }
    }
}catch(Exception $e)
{
    $message = $e->getMessage();
    echo $message;
    if($_POST['edit'] == "true"){
        header("Location: ../frontend/list.php?list=".$_POST['id']."&error=2");
    }else{
        header("Location: ../frontend/profile.php?error=2");
    }
}

?>