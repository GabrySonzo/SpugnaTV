<!DOCTYPE html>
<html>
<head>
    <title>Register list Page</title>
</head>
<?php
    session_start();
    if (!isset($_SESSION["id"])) {
        header("Location: login.php");
    }
?>
<body>
    <h2>Registra lista</h2>
    <form method="POST" action="../backend/addListController.php">

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        
        <input type="submit" value="Registra lista">
    </form>
    <br>
    <button onclick="window.history.back()">Torna indietro</button> <a href="home.php"><button>Torna alla home</button></a>
    <br>
</body>
</html>