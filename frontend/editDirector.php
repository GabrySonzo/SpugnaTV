<!DOCTYPE html>
<html>
<head>
    <title>Edit director Page</title>
    <?php
        include '../backend/connessione.php';
        $director = $connessione->query("SELECT * FROM Registi WHERE id = '" . $_GET['director'] . "'")->fetch_assoc();
        ?>
</head>
<body>
    <h2>Modifica regista</h2>
    <form method="POST" action="../backend/editDirectorController.php">

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $director['nome'] ?>" required><br><br>
        
        <label for="cognome">Cognome:</label>
        <input type="text" id="cognome" name="cognome" value="<?php echo $director['cognome'] ?>" required><br><br>
        
        <label for="nascita">Data di nascita:</label>
        <input type="date" id="nascita" name="nascita" value="<?php echo $director['data_nascita'] ?>" required><br><br>
        
        <label for="morte">Data di morte:</label>
        <input type="date" id="morte" name="morte" value="<?php echo $director['data_morte'] ?>"><br><br>
        
        <label for="descrizione">Descrizione:</label>
        <input type="text" id="descrizione" name="descrizione"  value="<?php echo $director['descrizione'] ?>"><br><br>
        
        <label for="foto">Foto(URL):</label>
        <input type="text" id="foto" name="foto" value="<?php echo $director['foto'] ?>"><br><br>
        
        <input type="submit" value="Modifica regista">
    </form>
    <br>
    <a href="home.php"><button>Torna indietro</button></a>
    <br>
    <?php
    
    ?>
</body>
</html>