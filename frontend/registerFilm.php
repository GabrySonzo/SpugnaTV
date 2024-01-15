<!DOCTYPE html>
<html>
    <head>
        <title>Register film Page</title>
        <?php
        include '../backend/connessione.php';
        $directors = $connessione->query("SELECT * FROM Registi");
        $actors = $connessione->query("SELECT * FROM Attori");
        ?>
    </head>
    <body>
    <script>
        var indexDirector = 1;
        var indexActor = 1;

        function addSelectDirector() {
            var selectContainer = document.createElement("div");
            selectContainer.innerHTML = `
            <label for="regista">Regista `+indexDirector+`:</label>
            <select id="regista`+indexDirector+`" name="regista`+indexDirector+`">
                <?php
                while ($director = $directors->fetch_assoc()) {
                    echo "<option value='" . $director['id'] . "'>" . $director['nome'] ." ".$director['cognome'] . "</option>";
                }
                ?>
            </select><br><br>
            `;
            document.getElementById("registi").appendChild(selectContainer);
            indexDirector++;
        }

        function addSelectActor() {
            var selectContainer = document.createElement("div");
            selectContainer.innerHTML = `
            <label for="attore">Attore `+indexActor+`:</label>
            <select id="attore`+indexActor+`" name="attore`+indexActor+`">
                <?php
                while ($actor = $actors->fetch_assoc()) {
                    echo "<option value='" . $actor['id'] . "'>" . $actor['nome'] ." ".$actor['cognome'] . "</option>";
                }
                ?>
            </select><br><br>
            `;
            document.getElementById("attori").appendChild(selectContainer);
            indexActor++;
        }

    </script>

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
        
        <div id="registi">
            <button type="button" onclick="addSelectDirector()">Aggiungi Regista</button><br><br>
        </div>

        <div id="attori">
            <button type="button" onclick="addSelectActor()">Aggiungi Attore</button><br><br>
        </div>

        <input type="submit" value="Registra Film">
        
    </form>
    <br>
    <a href="home.php"><button>Torna indietro</button></a>
    <br>
</body>
</html>