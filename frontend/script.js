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