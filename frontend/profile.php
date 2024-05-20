<!DOCTYPE html>
<html>
<head>
    <title>User Page</title>
</head>
<?php
    include '../backend/connessione.php';
    session_start();
    if (!isset($_SESSION["id"])) {
        header("Location: login.php");
    }
    
    $user = $connessione->query("SELECT * FROM Utenti WHERE email = '" . $_SESSION['id'] . "'")->fetch_assoc();
    $lists = $connessione->query("SELECT * FROM Liste WHERE utente_mail = '" . $_SESSION['id'] . "'");
    $filmDaVedere = $connessione->query("SELECT COUNT(*) FROM (((Utenti INNER JOIN Liste ON Utenti.email = Liste.utente_mail)
                INNER JOIN Comprende ON Comprende.lista_id = Liste.id)
                INNER JOIN Film ON Film.id = Comprende.film_id)
                WHERE Utenti.email = '" . $_SESSION['id'] . "' AND Liste.nome = 'Film da vedere'");
    $FilmVisti = $connessione->query("SELECT COUNT(*) FROM (((Utenti INNER JOIN Liste ON Utenti.email = Liste.utente_mail)
                INNER JOIN Comprende ON Comprende.lista_id = Liste.id)
                INNER JOIN Film ON Film.id = Comprende.film_id)
                WHERE Utenti.email = '" . $_SESSION['id'] . "' AND Liste.nome = 'Film visti'");
    $oreTotali = $connessione->query("SELECT SUM(durata) FROM (((Utenti INNER JOIN Liste ON Utenti.email = Liste.utente_mail)
                INNER JOIN Comprende ON Comprende.lista_id = Liste.id)
                INNER JOIN Film ON Film.id = Comprende.film_id)
                WHERE Utenti.email = '" . $_SESSION['id'] . "' AND Liste.nome = 'Film visti'")->fetch_assoc()['SUM(durata)'];
    $NfilmDaVedere = $filmDaVedere->fetch_assoc()['COUNT(*)'];
    $nFilmVisti = $FilmVisti->fetch_assoc()['COUNT(*)'];
?>
<body>
    <h1><?php echo $user['username']?></h1>
    <p><?php echo $user['email']?></p>
    <br>
    <div>
        Statistiche:
        <p>Numero di film visti: <?php echo $nFilmVisti?></p>
        <p>Numero di film da vedere: <?php echo $NfilmDaVedere?></p>
        <p>Ore totali gurardate: <?php echo intval(intval($oreTotali)/60) ."h ". intval($oreTotali)%60 ."min"?></p>
    </div>
    <div>
        Liste:
        <select id="liste" name="liste">
                <?php
                while ($list = $lists->fetch_assoc()) {
                    echo "<option value='" . $list['id'] . "'>" . $list['nome'] . "</option>";
                }
                ?>
        </select>
        <input type="button" value="Vai alla lista" onclick="location.href='list.php?list='+document.getElementById('liste').value">
    </div>
    <br>
    <a href="registerList.php"><button>Crea lista</button></a>
    <br>
    <br>
    <a href="editProfile.php"><button>Cambia nome profilo</button></a>
    <br>
    <br>
    <button onclick="window.history.back()">Torna indietro</button> <a href="home.php"><button>Torna alla home</button></a>
    <br>
    <br>
    <input type="button" value="Logout" onclick="location.href='../backend/logout.php'">
    <input type="button" value="Elimina utente" onclick="location.href='../backend/removeUser.php'">
    <br>
    <?php
        if (isset($_GET['error']) && $_GET['error'] == 1) {
            echo "<p>Errore durante l'eliminazione dell'utente</p>";
        }
        if (isset($_GET['error']) && $_GET['error'] == 2) {
            echo "<p>Errore durante la creazione della lista</p>";
        }
        if (isset($_GET['error']) && $_GET['error'] == 3) {
            echo "<p>Errore nell'aggiornamento dell'username</p>";
        }
        if (isset($_GET['succ']) && $_GET['succ'] == 1) {
            echo "<p>Lista creata con successo</p>";
        }
    ?>
</body>
</html>
