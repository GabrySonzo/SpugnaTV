<!DOCTYPE html>
<html>
<head>
    <title>Edit list Page</title>
</head>
<body>
    <h2>Modifica lista</h2>
    <form method="POST" action="../backend/addListController.php">

        <input type="hidden" name="edit" value="true">
        <input type="hidden" name="id" value="<?php echo $_GET['list'] ?>">

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        
        <input type="submit" value="Modifica lista">
    </form>
    <br>
    <button onclick="window.history.back()">Torna indietro</button> <a href="home.php"><button>Torna alla home</button></a>
    <br>
</body>
</html>