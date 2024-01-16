<!DOCTYPE html>
<html>
    <head>
        <title>Edit film Page</title>
        <?php
        include '../backend/connessione.php';
        $directors = $connessione->query("SELECT * FROM Registi");
        $actors = $connessione->query("SELECT * FROM Attori");
        $film = $connessione -> query("SELECT * FROM Film WHERE id = '" . $_GET['film'] . "'") -> fetch_assoc();
        ?>
        <script src="script.js"></script>
    </head>
    <body>
    <script>
        var indexDirector = 1;
        var indexActor = 1;
        var indexNewDirector = 1;
        var indexNewActor = 1;
        
        function directorRow(nome, cognome) {
            var p = document.createElement("p");
            p.innerHTML = "Regista "+ indexDirector +": "+ nome + " " + cognome;
            document.getElementById("registi").appendChild(p);
            indexDirector++;
        }

        function addSelectDirector() {
            var selectContainer = document.createElement("div");
            selectContainer.innerHTML = `
            <label for="regista">Regista `+indexDirector+`:</label>
            <select id="regista`+indexNewDirector+`" name="regista`+indexNewDirector+`">
                <?php
                while ($director = $directors->fetch_assoc()) {
                    echo "<option value='" . $director['id'] . "'>" . $director['nome'] ." ".$director['cognome'] . "</option>";
                }
                ?>
            </select><br><br>
            `;
            document.getElementById("registi").appendChild(selectContainer);
            indexDirector++;
            indexNewDirector++;
        }

        function actorRow(nome, cognome) {
            var p = document.createElement("p");
            p.innerHTML = "Attore "+ indexActor +": "+ nome + " " + cognome;
            document.getElementById("attori").appendChild(p);
            indexActor++;
        }

        function addSelectActor() {
            var selectContainer = document.createElement("div");
            selectContainer.innerHTML = `
            <label for="attore">Attore `+indexActor+`:</label>
            <select id="attore`+indexNewActor+`" name="attore`+indexNewActor+`">
                <?php
                while ($actor = $actors->fetch_assoc()) {
                    echo "<option value='" . $actor['id'] . "'>" . $actor['nome'] ." ".$actor['cognome'] . "</option>";
                }
                ?>
            </select><br><br>
            `;
            document.getElementById("attori").appendChild(selectContainer);
            indexActor++;
            indexNewActor++;
        }

    </script>

    <h2>Modifica film</h2>
    <form method="POST" action="../backend/editFilmController.php">

        <input type="hidden" name="film" value="<?php echo $_GET['film']?>" />

        <label for="titolo">Titolo:</label>
        <input type="text" id="titolo" name="titolo" value = "<?php echo $film['titolo']?>" required><br><br>
        
        <label for="anno">Anno:</label>
        <input type="number" id="anno" name="anno" value = "<?php echo $film['anno']?>" required><br><br>
        
        <label for="durata">Durata (in minuti):</label>
        <input type="number" id="durata" name="durata" value = "<?php echo $film['durata']?>" required><br><br>
        
        <label for="genere">Genere:</label>
        <input type="text" id="genere" name="genere" value = "<?php echo $film['genere']?>" ><br><br>
        
        <label for="trama">Trama:</label>
        <input type="text" id="trama" name="trama" value = "<?php echo $film['trama']?>" ><br><br>
        
        <label for="locandina">Locandina(URL):</label>
        <input type="text" id="locandina" name="locandina" value = "<?php echo $film['locandina']?>" ><br><br>
        
        <label for="banner">Banner(URL):</label>
        <input type="text" id="banner" name="banner" value = "<?php echo $film['banner']?>" ><br><br>
        
    
        <div id="registi">
            <button type="button" onclick="addSelectDirector()">Aggiungi Regista</button><br>
            <?php 
                $filmDirectors = $connessione->query("SELECT * FROM Registi INNER JOIN Dirige ON Registi.id = Dirige.registi_id WHERE film_id = '" . $_GET['film'] . "'");
                while ($director = $filmDirectors->fetch_assoc()) {
                    echo '<script>directorRow("'.$director['nome'].'", "'.$director['cognome'].'")</script>';
                }
            ?>
        </div>

    
        <div id="attori">
            <button type="button" onclick="addSelectActor()">Aggiungi Attore</button><br>
            <?php 
                $filmActors = $connessione->query("SELECT * FROM Attori INNER JOIN Recita ON Attori.id = Recita.attori_id WHERE film_id = '" . $_GET['film'] . "'");
                while ($actor = $filmActors->fetch_assoc()) {
                    echo '<script>actorRow("'.$actor['nome'].'", "'.$actor['cognome'].'")</script>';
                }
            ?>
        </div>


        <input type="submit" value="Modifica Film">
        
    </form>
    <br>
    <button onclick="window.history.back()">Torna indietro</button> <a href="home.php"><button>Torna alla home</button></a>
    <br>
</body>
</html>