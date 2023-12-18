<!DOCTYPE html>
<html>
<head>
    <title>Register actor Page</title>
</head>
<body>
    <h2>Registra attore</h2>
    <form method="POST" action="../backend/actorController.php">

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>
        
        <label for="cognome">Cognome:</label>
        <input type="text" id="cognome" name="cognome" required><br><br>
        
        <label for="foto">Foto(URL):</label>
        <input type="text" id="foto" name="foto" ><br><br>
        
        <input type="submit" value="Registra attore">
    </form>
    <br>
    <a href="home.php"><button>Torna indietro</button></a>
    <br>
    <?php
    
    ?>
</body>
</html>