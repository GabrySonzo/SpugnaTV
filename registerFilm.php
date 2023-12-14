<!DOCTYPE html>
<html>
<head>
    <title>Register film Page</title>
</head>
<body>
    <h2>Registra film</h2>
    <form method="POST" action="filmController.php">

        <label for="titolo">Titolo:</label>
        <input type="year" id="titolo" name="titolo" required><br><br>
        
        <label for="anno">Anno:</label>
        <input type="number" id="anno" name="anno" required><br><br>
        
        <label for="durata">Durata (in minuti):</label>
        <input type="number" id="durata" name="durata" required><br><br>
        
        <label for="genere">Genere:</label>
        <input type="text" id="genere" name="genere" required><br><br>
        
        <label for="trama">Trama:</label>
        <input type="text" id="trama" name="trama" required><br><br>
        
        
        
        <input type="submit" value="Login">
    </form>
    <br>
    <?php

    ?>
</body>
</html>