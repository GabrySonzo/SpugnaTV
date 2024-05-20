<?php

    include 'connessione.php';
    session_start();
    
    $rating = $_POST['rating'];
    $commento = $_POST['commento'];
    
    try{
        if($_POST['edit'] == "true"){
            $review = $_POST['review'];
            $query = "update Recensioni set nStelle = ?, commento = ? where id = ". $review;
        } else{
            $query = "insert into Recensioni (nStelle, commento, utente_mail, film_id) values (?, ?, '".$_SESSION['id']."', '".$_POST['film']."')";
        }
        if ($connessione->prepare($query)->execute([$rating, $commento])){
            echo "Registration successful!";
            if($_POST['edit'] == "true"){
                header("Location: ../frontend/film.php?film=".$_POST['film']);
            }else{
                header("Location: ../frontend/film.php?film=".$_POST['film']);
            }
        }
    }catch(Exception $e)
    {
        $message = $e->getMessage();
        echo $message;
        if($_POST['edit'] == "true"){
            //header("Location: ../frontend/film.php?film=".$_POST['film']."&error=5");
        }else{
            header("Location: ../frontend/film.php?film=".$_POST['film']."&error=6");
        }
    }
?>