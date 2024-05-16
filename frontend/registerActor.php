<!DOCTYPE html>
<html>
<head>
    <title>Register actor Page</title>
</head>
<?php
    session_start();
    if (!isset($_SESSION["id"])) {
        header("Location: login.php");
    }
    if ($_SESSION["admin"] == false) {
        header("Location: home.php");
    }
?>
<body>
    <h2>Registra attore</h2>
    <form method="POST" action="../backend/addActorController.php">

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>
        
        <label for="cognome">Cognome:</label>
        <input type="text" id="cognome" name="cognome" required><br><br>
        
        <label for="foto">Foto(URL):</label>
        <input type="text" id="foto" name="foto" ><br><br>
        
        <input type="submit" value="Registra attore">
    </form>
    <br>
    <button onclick="window.history.back()">Torna indietro</button> <a href="home.php"><button>Torna alla home</button></a>
    <br>
    <?php
    
    ?>
</body>
</html>