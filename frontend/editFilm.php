<!DOCTYPE html>
<html>
    <head>
        <title>Edit film Page</title>
        <?php
        include '../backend/connessione.php';
        $directors = $connessione->query("SELECT * FROM Registi ORDER BY nome");
        $actors = $connessione->query("SELECT * FROM Attori ORDER BY nome");
        $film = $connessione -> query("SELECT * FROM Film WHERE id = '" . $_GET['film'] . "'") -> fetch_assoc();
        ?>
    </head>
    <body>
        <script>
        var indexDirector = 1;  
        var indexActor = 1;
        var indexNewDirector = 1;
        var indexNewActor = 1;
        
        function directorRow() {
            indexDirector = 1;
            var film = <?php echo $_GET['film']?>;

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../backend/apiRead.php", true);
            xhr.send(JSON.stringify({film: film, type: "director"}));

            xhr.onload = function() {
            if (this.status == 200 && this.readyState == 4) {
                let registi = JSON.parse(this.responseText);
                if(registi['error'] == true){
                    console.log(registi['msg']);
                }else{
                    registi["data"].forEach(regista => {
                        var p = document.createElement("p");
                        p.innerHTML = "Regista " +indexDirector+ ": " + regista['nome'] + " " + regista['cognome'] + " <button type=\"button\" onclick=\"removeDirector(" + regista['id'] + ")\">Remove</button>";
                        document.getElementById("regista").appendChild(p);
                        indexDirector++;
                    });
                }
            }
            }
        }

        function addSelectDirector() {
            var selectContainer = document.createElement("div");
            selectContainer.innerHTML = `
            <label for="regista">Regista `+indexDirector+`:</label>
            <select id="regista`+indexNewDirector+`" name="regista`+indexNewDirector+`">
            <option value=null> -- scegli il regista -- </option>
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

        function actorRow() {
            indexActor = 1;
            var film = <?php echo $_GET['film']?>;

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../backend/apiRead.php", true);
            xhr.send(JSON.stringify({film: film, type: "actor"}));

            xhr.onload = function() {
            if (this.status == 200 && this.readyState == 4) {
                let attori = JSON.parse(this.responseText);
                if(attori['error'] == true){
                    console.log(attori['msg']);
                }else{
                    attori["data"].forEach(attore => {
                        var p = document.createElement("p");
                        p.innerHTML = "Attore " +indexActor+ ": " + attore['nome'] + " " + attore['cognome'] + " <button type=\"button\" onclick=\"removeActor(" + attore['id'] + ")\">Remove</button>";
                        document.getElementById("attore").appendChild(p);
                        indexActor++;
                    });
                }
            }
            }
        }

        function addSelectActor() {
            var selectContainer = document.createElement("div");
            selectContainer.innerHTML = `
            <label for="attore">Attore `+indexActor+`:</label>
            <select id="attore`+indexNewActor+`" name="attore`+indexNewActor+`">
            <option value=null> -- scegli l'attore -- </option>
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

        function removeDirector(id){
            var film = <?php echo $_GET['film']?>;
            var director = id;

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../backend/apiRemove.php", true);
            xhr.send(JSON.stringify({film: film, director: director, type: "director"}));

            xhr.onload = function() {
                if (this.status == 200 && this.readyState == 4) {
                    let response = JSON.parse(this.responseText);
                    if(response['error'] == true){
                        console.log(response['msg']);
                    }else{
                        indexDirector--;
                        document.getElementById("regista").innerHTML = "";
                        directorRow();
                    }
                } else {
                    console.log("Errore nella richiesta api");
                }
            };
        }

        function removeActor(id){
            var film = <?php echo $_GET['film']?>;
            var actor = id;
            //richiesta all api per rimozione di film da database
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../backend/apiRemove.php", true);
            xhr.send(JSON.stringify({film: film, actor: actor, type: "actor"}));

            xhr.onload = function() {
                //controllo che la richiesta sia andata a buon fine
                if (this.status == 200 && this.readyState == 4) {
                    //modifiche al dom
                    let response = JSON.parse(this.responseText);
                    if(response['error'] == true){
                        console.log(response['msg']);
                    }else{
                        indexActor--;
                        document.getElementById("attore").innerHTML = "";
                        actorRow();
                    }
                } else {
                    console.log("Errore nella richiesta api");
                }
            };
        }

    </script>

    <h2>Modifica film</h2>
    <form id="form" method="POST" action="../backend/addFilmController.php">

        <input type="hidden" name="edit" value="true" />
        
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
            <div id="regista">
                <script>directorRow()</script>
            </div>
        </div>

    
        <div id="attori">
            <button type="button" onclick="addSelectActor()">Aggiungi Attore</button><br>
            <div id="attore">
                <script>actorRow()</script>
            </div>
        </div>


        <input type="submit" value="Modifica Film">
        
    </form>
    <br>
    <button onclick="window.history.back()">Torna indietro</button> <a href="home.php"><button>Torna alla home</button></a>
    <br>
</body>
</html>