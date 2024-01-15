<!DOCTYPE html>
<html>
<head>
    <title>Film Page</title>
</head>
<?php
//prova
    include '../backend/connessione.php';
    $film = $connessione->query("SELECT * FROM Film WHERE id = '" . $_GET['film'] . "'")->fetch_assoc();
    $directors = $connessione->query("SELECT * FROM Registi INNER JOIN Dirige ON Registi.id = Dirige.registi_id WHERE film_id = '" . $_GET['film'] . "'");
    $actors = $connessione->query("SELECT * FROM Attori INNER JOIN Recita ON Attori.id = Recita.attori_id WHERE film_id = '" . $_GET['film'] . "'");
?>
<body>
    <h1><?php echo $film['titolo'] ?></h1>
    <p><?php echo $film['anno']." - ". intval(intval($film['durata'])/60) ."h ". intval($film['durata'])%60 ."min" ?></p>
    <p><?php echo $film['genere'] ?></p>
    <p><?php echo $film['trama'] ?></p>
    <div>
        Registi:
        <?php
            while ($director = $directors->fetch_assoc()) {
                echo "<a href='director.php?director=".$director['id']."'><p>- " . $director['nome'] ." ".$director['cognome'] . "</p></a>";
            }
        ?>
    </div>
    <div>
        Attori:
        <?php
            while ($actor = $actors->fetch_assoc()) {
                echo "<p>- " . $actor['nome'] ." ".$actor['cognome'] . "</p>";
            }
        ?>
    </div>
    <div>
        <?php
            echo "<a href='../backend/addToList.php?film=".$_GET['film']."'><button>Aggiungi alla lista</button></a>";
        ?>
    </div>
    <select id="liste" name="liste">
        <?php
        while ($list = $lists->fetch_assoc()) {
            echo "<option value='" . $list['id'] . "'>" . $list['nome'] . "</option>";
        }
        ?>
    </select>
    <input type="button" value="Vai alla lista" onclick="location.href='../backend/addToList.php?list='+document.getElementById('liste').value">
    <br>
    <a href="home.php"><button>Torna indietro</button></a>
    <br>
</body>
</html>
