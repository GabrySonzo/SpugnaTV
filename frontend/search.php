
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
        <input type="text" name="search" placeholder="Cerca per titolo film">
        <button type="submit">Cerca</button>
    </form>
    <br>
    <br>
    <a href="home.php"><button>Torna indietro</button></a>
    <br>
    <?php
        if (isset($_GET['search'])) {

        $searchQuery = $_GET['search'];

        $results = $connessione->query("SELECT * FROM Film WHERE titolo LIKE '%$searchQuery%'");

        echo "<h2>Risultati ricerca</h2>";

        foreach ($results as $result) {
            echo "<a href='film.php?film=".$result['id']."'><p>{$result['titolo']}</p></a>";
        }
    }
    ?>
</body>
</html>
