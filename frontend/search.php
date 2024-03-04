
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
            <label for="film">Film</label>
            <input type="radio" id="director" name="filter" value="director" />
            <label for="director">Regista</label>
        </div>
        <br>
        <input type="text" name="search" placeholder="Cerca">
        <button type="submit">Cerca</button>
    </form>
    
    <?php
        if (isset($_GET['search']) && isset($_GET['filter']) && $_GET['search'] != "" && ($_GET['filter'] == "film" || $_GET['filter'] == "director")){
            
            $searchQuery = $_GET['search'];
            $filter = $_GET['filter'];

            if($filter == "director"){
                $query = "SELECT * FROM Registi WHERE nome LIKE ? OR cognome LIKE ?";
            }
            else if($filter == "film"){
                $query = "SELECT * FROM Film WHERE titolo LIKE ?";
            }
            
            $stmt = $connessione->prepare($query);
            $searchQuery = "%".$searchQuery."%";
            if($filter == "director"){
                $stmt->bind_param("ss",$searchQuery, $searchQuery);
            }else if($filter == "film"){
                $stmt->bind_param("s", $searchQuery);
            }
            $stmt->execute();
            $results = $stmt -> get_result();
            
            if($results->num_rows){
                echo "<h2>Risultati ricerca</h2>";
                if($filter == "director"){
                    foreach ($results as $result) {
                        echo "<a href='director.php?director=".$result['id']."'><p>{$result['nome']} {$result['cognome']}</p></a>";
                    }
                }
                else if($filter == "film"){
                    foreach ($results as $result) {
                        echo "<a href='film.php?film=".$result['id']."'><p>{$result['titolo']}</p></a>";
                    }    
                }
                
            }
            else{
                echo "<p>Nessun risultato trovato</p>";
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
