<!DOCTYPE html>
<html>
<head>
    <title>Film Page</title>
</head>
<?php
    session_start();
    if (!isset($_SESSION["id"])) {
        header("Location: login.php");
    }
    include '../backend/connessione.php';
    $film = $connessione->query("SELECT * FROM Film WHERE id = '" . $_GET['film'] . "'")->fetch_assoc();
    $directors = $connessione->query("SELECT * FROM Registi INNER JOIN Dirige ON Registi.id = Dirige.registi_id WHERE film_id = '" . $_GET['film'] . "'");
    $actors = $connessione->query("SELECT * FROM Attori INNER JOIN Recita ON Attori.id = Recita.attori_id WHERE film_id = '" . $_GET['film'] . "'");
    $lists = $connessione->query("SELECT * FROM Liste WHERE utente_mail = '" . $_SESSION['id'] . "'");
    $review = $connessione->query("SELECT * FROM Recensioni WHERE film_id = '" . $_GET['film'] . "' AND utente_mail = '" . $_SESSION['id'] . "'")->fetch_assoc();
?>
<body>
    <h1><?php echo $film['titolo'] ?></h1>
    <p><?php echo $film['anno']." - ". intval(intval($film['durata'])/60) ."h ". intval($film['durata'])%60 ."min" ?></p>
    <p><?php echo $film['genere'] ?></p>
    <p><?php echo $film['trama'] ?></p>
    <div>
        Diretto da:
        <?php
            while ($director = $directors->fetch_assoc()) {
                echo "<a href='director.php?director=".$director['id']."'><p>- " . $director['nome'] ." ".$director['cognome'] . "</p></a>";
            }
        ?>
    </div>
    <div>
        Cast:
        <?php
            while ($actor = $actors->fetch_assoc()) {
                echo "<p>- " . $actor['nome'] ." ".$actor['cognome'] . "</p>";
            }
        ?>
    </div>
    <div>
        <select id="liste" name="liste">
            <?php
            while ($list = $lists->fetch_assoc()) {
                echo "<option value='" . $list['id'] . "'>" . $list['nome'] . "</option>";
            }
            
            ?>
        </select>
        <script>
            function init() {
                var value = document.getElementById('liste').value;
                document.getElementById('button').href = "../backend/addToList.php?film=<?php echo $_GET['film'] ?>&lista=" + value;
            }
        </script>
        <?php
            echo "<a id='button' onclick='init()'><button>Aggiungi alla lista</button></a>";
            if(isset($_GET['error'])){
                if($_GET['error'] == 1){
                    echo "<p>Il film è già presente nella lista</p>";
                }
                else if($_GET['error'] == 2){
                    echo "<p>Errore nell' inserimento</p>";
                }
            }
            if(isset($_GET['succ'])){
                if($_GET['succ'] == 1){
                    echo "<p>Inserimento avvenuto con successo</p>";
                }
            }
        ?>
    </div>
    <div id = "review">
        <?php
            if($review != null){
                echo "<p>Il tuo voto: ".$review['nStelle']." stelle</p>";
                echo "<p>".$review['commento']."</p>";
                echo "<a href='editReview.php?review=".$review["id"]."'><button>Modifica recensione</button></a>";
                echo "<a href='../backend/removeReview.php?review=".$review["id"]."&film=".$_GET['film']."'><button>Elimina recensione</button></a>";
            }else{
                echo "<a href='registerReview.php?film=".$_GET['film']."'><button>Lascia una recensione</button></a>";
            }
            if(isset($_GET['error'])){
                if($_GET['error'] == 5){
                    echo "<p>Errore nell'inserimento della recensione'</p>";
                }
                else if($_GET['error'] == 6){
                    echo "<p>Errore nella modifica della recensione'</p>";
                }
                else if($_GET['error'] == 7){
                    echo "<p>Errore nell'eliminazione della recensione'</p>";
                }
            }
        ?>
    </div>
    <br>
        <?php
            if ($_SESSION['admin'] == true){
                echo "<a href='editFilm.php?film=".$_GET['film']."'><button>Modifica film</button></a>"; 
                echo "<a href='../backend/removeFilm.php?film=".$_GET['film']."'><button>Elimina film</button></a>";
            }
            if(isset($_GET['succ']) && $_GET['succ'] == 2){
                echo "<p>Modifica avvenuta con successo</p>";
            }
            if(isset($_GET['error'])){
                if($_GET['error'] == 3){
                    echo "<p>Errore nella modifica</p>";
                }
                else if($_GET['error'] == 4){
                    echo "<p>Errore nell'eliminazione</p>";
                }
            }
        ?>
    <br>
    <br>
    <button onclick="window.history.back()">Torna indietro</button> <a href="home.php"><button>Torna alla home</button></a>
    <br>
</body>
</html>
