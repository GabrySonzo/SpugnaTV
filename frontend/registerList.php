<!DOCTYPE html>
<html>
<head>
    <title>Register list Page</title>
</head>
<body>
    <h2>Registra lista</h2>
    <form method="POST" action="../backend/listController.php">

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        
        <input type="submit" value="Registra lista">
    </form>
    <br>
    <a href="home.php"><button>Torna indietro</button></a>
    <br>
    <?php
        if (isset($_GET['error']) && $_GET['error'] == 1) {
            echo "<p>Nome non valido</p>";
        }
    ?>
</body>
</html>