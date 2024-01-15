<!DOCTYPE html>
<html>
<head>
    <title>List Page</title>
</head>
<?php
    include '../backend/connessione.php';
    $list = $connessione->query("SELECT * FROM Liste WHERE id = '" . $_GET['list'] . "'")->fetch_assoc();
    $films = $connessione->query("SELECT * FROM Film INNER JOIN Comprende ON Film.id = Comprende.film_id WHERE lista_id = '" . $_GET['list'] . "'");
?>
<body>
    <h1><?php echo $list['nome'] ?></h1>
    <div>
        Film nella lista:
        <?php
            while ($film = $films->fetch_assoc()) {
                echo "<a href='film.php?film=".$film['id']."'><p>- " . $film['titolo'] . "</p></a>";
            }
        ?>
    </div>
    <a href="home.php"><button>Torna indietro</button></a>
    <br>
    
</body>
</html>
