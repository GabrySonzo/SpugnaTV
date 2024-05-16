<!DOCTYPE html>
<html>
<head>
    <title>Register director Page</title>
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
    <h2>Registra regista</h2>
    <form method="POST" action="../backend/addDirectorController.php">

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>
        
        <label for="cognome">Cognome:</label>
        <input type="text" id="cognome" name="cognome" required><br><br>
        
        <label for="nascita">Data di nascita:</label>
        <input type="date" id="nascita" name="nascita" required><br><br>
        
        <label for="morte">Data di morte:</label>
        <input type="date" id="morte" name="morte" ><br><br>
        
        <label for="descrizione">Descrizione:</label>
        <input type="text" id="descrizione" name="descrizione" ><br><br>
        
        <label for="foto">Foto(URL):</label>
        <input type="text" id="foto" name="foto" ><br><br>
        
        <input type="submit" value="Registra regista">
    </form>
    <br>
    <button onclick="window.history.back()">Torna indietro</button> <a href="home.php"><button>Torna alla home</button></a>
    <br>
    <?php
    
    ?>
</body>
</html>