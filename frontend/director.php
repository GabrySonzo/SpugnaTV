<!DOCTYPE html>
<html>
<head>
    <title>Film Page</title>
</head>
<?php
    include '../backend/connessione.php';
    $director = $connessione->query("SELECT * FROM Registi WHERE id = '" . $_GET['director'] . "'")->fetch_assoc();
    $films = $connessione->query("SELECT * FROM Film INNER JOIN Dirige ON Film.id = Dirige.film_id WHERE registi_id = '" . $_GET['director']  . "'");
?>
<body>
    <h1><?php echo $director['nome']. " " . $director['cognome']?></h1>
    <p><?php echo $director['data_nascita']." - ". $director['data_morte']?></p>
    <p><?php echo $director['descrizione'] ?></p>
    <br>
    <div>
        Film diretti dal regista:
        <?php
            while ($film = $films->fetch_assoc()) {
                echo "<a href='film.php?film=".$film['id']."'><p>- " . $film['titolo'] . "</p></a>";
            }
        ?>
    </div>
    <br>
    <a href="editDirector.php?director=<?php echo $_GET['director'] ?>"><button>Modifica regista</button></a>
    <br>
    <a href="home.php"><button>Torna indietro</button></a>
    <br>
</body>
</html>
