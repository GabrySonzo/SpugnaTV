<!DOCTYPE html>
<html>
<head>
    <title>Edit review Page</title>
    <?php
    include '../backend/connessione.php';
    session_start();
    if (!isset($_SESSION["id"])) {
        header("Location: login.php");
    }
    $review = $connessione -> query("SELECT * FROM Recensioni WHERE id = '" . $_GET['review'] . "'") -> fetch_assoc();
    ?>
</head>
<body>
    <h2>Modifica recensione</h2>
    <form method="POST" action="../backend/addReviewController.php">

        <input type="hidden" name="edit" value="true" />
        
        <input type="hidden" name="review" value="<?php echo $_GET['review']?>" />
        <input type="hidden" name="film" value="<?php echo $review["film_id"]?>" />

        <label for="rating">Numero stelle:</label>
        <input type="number" id="rating" name="rating" min="1" max="5" value = "<?php echo $review['nStelle']?>" required><br><br>
        
        <label for="commento">Commento:</label>
        <input type="text" id="commento" name="commento" value = "<?php echo $review['commento']?>" ><br><br>
        
        <input type="submit" value="Modifica recensione">
    </form>
    <br>
    <button onclick="window.history.back()">Torna indietro</button> <a href="home.php"><button>Torna alla home</button></a>
    <br>
</body>
</html>