<!DOCTYPE html>
<html>
<head>
    <title>Register list Page</title>
</head>
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
    <?php
        if (isset($_GET['error']) && $_GET['error'] == 1) {
            echo "<p>Nome non valido</p>";
        }
    ?>
</body>
</html>