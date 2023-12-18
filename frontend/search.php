
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
    <a href="home.php"><button>Torna indietro</button></a>
    <br>
    <?php
        if (isset($_GET['search'])) {
        // Get the search query from the form
        $searchQuery = $_GET['search'];

        // Perform the search query in your database or any other data source
        // Replace this with your actual search logic
        $results = $connessione->query("SELECT * FROM Film WHERE titolo LIKE '%$searchQuery%'");

        echo "<h2>Risultati ricerca</h2>";
        // Display the search results
        foreach ($results as $result) {
            echo "<a href='film.php?film=".$result['id']."'><p>{$result['titolo']}</p></a>";
        }
    }
    ?>
</body>
</html>
