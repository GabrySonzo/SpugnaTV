<!DOCTYPE html>
<html>
<head>
    <title>List Page</title>
</head>
<?php
    include '../backend/connessione.php';
    session_start();
    if (!isset($_SESSION["id"])) {
        header("Location: login.php");
    }
    $list = $connessione->query("SELECT * FROM Liste WHERE id = '" . $_GET['list'] . "'")->fetch_assoc();
?>

<script>

    function showFilms(){
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../backend/apiRead.php", true);
        xhr.send(JSON.stringify({type: "listFilm", list: <?php echo $_GET['list'] ?>}));
        xhr.onload = function() {

            if (this.status == 200 && this.readyState == 4) {
                let films = JSON.parse(this.responseText);
                if(films['error'] == true){
                    console.log(films['msg']);
                }else{
                    films["data"].forEach(film => {
                        var div = document.createElement("div");
                        div.id = film['id'];
                        var p = document.createElement("p");
                        p.innerHTML = "<a href=\"film.php?film=" + film['id'] + "\">" + film['titolo'] + "</a>  " + "<button type=\"button\" onclick=\"removeFilm(" + film['id'] + ")\">Rimuovi</button>";
                        div.appendChild(p);
                        document.getElementById("films").appendChild(div);
                    });
                }
            }
        }
    }

    function removeFilm(film) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../backend/apiRemove.php", true);
        xhr.send(JSON.stringify({type: "listFilm", film: film, list: <?php echo $_GET['list'] ?>}));
        xhr.onload = function() {

            if (this.status == 200 && this.readyState == 4) {
                let actors = JSON.parse(this.responseText);
                if(actors['error'] == true){
                    console.log(actors['msg']);
                }else{
                    document.getElementById(film).remove();
                }
            }
        }
    }

</script>

<body>
    <h1><?php echo $list['nome'] ?></h1>
    <div>
        Film nella lista:
        <div id="films">
            <script>showFilms();</script>
        </div>
    </div>
    <?php if ($list['tipo'] == "custom"): ?>
        <br>
        <a href="../backend/removeList.php?list=<?php echo $_GET['list'] ?>"><button>Elimina lista</button></a>
        <a href="editList.php?list=<?php echo $_GET['list'] ?>"><button>Modifica nome lista</button></a>
        <br><br>
    <?php endif; 
    
    if(isset($_GET['error'])){
        if($_GET['error'] == 1){
            echo "<p>Errore durante l'eliminazione della lista</p>";
        } else if($_GET['error'] == 2){
            echo "<p>Errore durante la modifica della lista</p>";
        }
    }
    if(isset($_GET['succ'])){
        if($_GET['succ'] == 1){
            echo "<p>Modifica effettuata con successo</p>";
        }
    }
    
    ?>

    <button onclick="window.history.back()">Torna indietro</button> <a href="home.php"><button>Torna alla home</button></a>
    <br>
    
</body>
</html>
