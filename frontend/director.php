<!DOCTYPE html>
<html>
<head>
    <title>Director Page</title>
</head>
<?php
    include '../backend/connessione.php';
    session_start();
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
    <?php
        if ($_SESSION['admin'] == true){
            echo "<a href='editDirector.php?director=".$_GET['director']."'><button>Modifica regista</button></a>";
        }
        if(isset($_GET['succ']) && $_GET['succ'] == 1){
            echo "<p>Modifica avvenuta con successo</p>";
        }
        if(isset($_GET['error']) &&$_GET['error'] == 1){
            echo "<p>Errore nella modifica</p>";
        }
    ?>
    <br>
    <br>
    <button onclick="window.history.back()">Torna indietro</button> <a href="home.php"><button>Torna alla home</button></a>
    <br>
</body>
</html>
