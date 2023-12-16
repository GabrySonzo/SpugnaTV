<!DOCTYPE html>
<html>
<head>
    <title>Register film Page</title>
</head>
<body>
    <h2>Registra film</h2>
    <form method="POST" action="../backend/filmController.php">

        <label for="titolo">Titolo:</label>
        <input type="text" id="titolo" name="titolo" required><br><br>
        
        <label for="anno">Anno:</label>
        <input type="number" id="anno" name="anno" required><br><br>
        
        <label for="durata">Durata (in minuti):</label>
        <input type="number" id="durata" name="durata" required><br><br>
        
        <label for="genere">Genere:</label>
        <input type="text" id="genere" name="genere" ><br><br>
        
        <label for="trama">Trama:</label>
        <input type="text" id="trama" name="trama" ><br><br>
        
        <label for="locandina">Locandina(URL):</label>
        <input type="text" id="locandina" name="locandina" ><br><br>
        
        <label for="banner">Banner(URL):</label>
        <input type="text" id="banner" name="banner" ><br><br>
        
        <input type="submit" value="Registra Film">
        
    </form>
    <br>
    <a href="index.php"><button>Torna indietro</button></a>
    <br>
    <?php
    
    ?>
</body>
</html>