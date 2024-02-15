
<!DOCTYPE html>
<html>
<head>
    <title>Search Page</title>
</head>
<?php
    include '../backend/connessione.php';
?>
<body>
    <h1>Pagina di ricerca</h1>

    <form action="search.php" method="GET">
        
        <div>
            <p>Cerca per:</p>
            <input type="radio" id="film" name="filter" value="film" checked/>
            <label for="film">Titolo</label>
            <input type="radio" id="director" name="filter" value="director" />
            <label for="director">Regista</label>
            <input type="radio" id="actor" name="filter" value="actor" />
            <label for="actor">Attore</label>
        </div>
        <br>
        <input type="text" name="search" placeholder="Cerca">
        <button type="submit">Cerca</button>
    </form>
    
    <?php
        if (isset($_GET['search']) && isset($_GET['filter']) && $_GET['search'] != "" && $_GET['filter'] != ""){
            
            $searchQuery = $_GET['search'];
            $filter = $_GET['filter'];

            if($filter == "director"){
                $query = "SELECT * FROM Film INNER JOIN Dirige ON Film.id = Dirige.film_id INNER JOIN Registi ON Dirige.registi_id = Registi.id WHERE Registi.nome LIKE  ?  OR Registi.cognome LIKE  ? ";
                $results = $connessione->prepare($query)->execute([$searchQuery, $searchQuery]);
            }
            else if($filter == "actor"){
                $query = "SELECT * FROM Film INNER JOIN Recita ON Film.id = Recita.film_id INNER JOIN Attori ON Recita.attori_id = Attori.id WHERE Attori.nome LIKE '% ? %' OR Attori.cognome LIKE '% ? %'";
                $results = $connessione->prepare($query)->execute([$searchQuery, $searchQuery]);
            }
            else if($filter == "film"){
                $query = "SELECT * FROM Film WHERE titolo LIKE '%?%'";
                $results = $connessione->prepare($query)->execute([$searchQuery]);
            }
            
            echo "<h2>Risultati ricerca</h2>";
            
            foreach ($results as $result) {
                echo "<a href='film.php?film=".$result['Film.id']."'><p>{$result['film.titolo']}{$result['id']}</p></a>";
            }
        }
        else {
            echo "<h2>Tutti i film</h2>";
            
            $results = $connessione->query("SELECT * FROM Film ORDER BY titolo");
            
            foreach ($results as $result) {
                echo "<a href='film.php?film=".$result['id']."'><p>{$result['titolo']}</p></a>";
            }
        }
    ?>
    <br>
    <button onclick="window.history.back()">Torna indietro</button> <a href="home.php"><button>Torna alla home</button></a>
</body>
</html>
