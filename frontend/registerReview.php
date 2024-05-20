<!DOCTYPE html>
<html>
<head>
    <title>Rate film Page</title>
    <?php
        session_start();
        if (!isset($_SESSION["id"])) {
            header("Location: login.php");
        }
    ?>
</head>
<body>
    <h2>Inserisci una recensione</h2>
    <form method="POST" action="../backend/addReviewController.php">

        <input type="hidden" name="edit" value="false">
        <input type="hidden" name="film" value="<?php echo $_GET['film'] ?>">
        
        <label for="rating">Numero stelle:</label>
        <input type="number" id="rating" name="rating" min="1" max="5" value="1" required><br><br>
        
        <label for="commento">Commento:</label>
        <input type="text" id="commento" name="commento"><br><br>
        
        <input type="submit" value="Lascia recensione">
    </form>
    <br>
    <button onclick="window.history.back()">Torna indietro</button> <a href="home.php"><button>Torna alla home</button></a>
    <br>
    <?php
    
    ?>
</body>
</html>