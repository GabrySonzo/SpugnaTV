<!DOCTYPE html>
<html>
<head>
    <title>Actors Page</title>
</head>
<?php
    include '../backend/connessione.php';

    session_start();
    if (!isset($_SESSION["id"])) {
        header("Location: login.php");
    }
    if ($_SESSION["admin"] == false) {
        header("Location: home.php");
    }
?>
<body>
    <script>
        function showActors(){
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../backend/apiRead.php", true);
            xhr.send(JSON.stringify({type: "AllActors"}));
            xhr.onload = function() {

                if (this.status == 200 && this.readyState == 4) {
                    let actors = JSON.parse(this.responseText);
                    if(actors['error'] == true){
                        console.log(actors['msg']);
                    }else{
                        actors["data"].forEach(actor => {
                            var div = document.createElement("div");
                            div.id = actor['id'];
                            var p = document.createElement("p");
                            p.innerHTML = actor['nome'] + " " + actor['cognome'] + " " + "<button type=\"button\" onclick=\"removeActor(" + actor['id'] + ")\">Rimuovi</button>";
                            div.appendChild(p);
                            document.getElementById("actors").appendChild(div);
                        });
                    }
                }
            }
        }

        function removeActor(id){
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../backend/apiRemove.php", true);
            xhr.send(JSON.stringify({type: "allActors", actor: id}));
            xhr.onload = function() {

                if (this.status == 200 && this.readyState == 4) {
                    let actors = JSON.parse(this.responseText);
                    if(actors['error'] == true){
                        console.log(actors['msg']);
                    }else{
                        document.getElementById(id).remove();
                    }
                }
            }
        }

    </script>
    <h1>Attori</h1>
    <div id="actors">
        <script>showActors();</script>

    </div>

    <button onclick="window.history.back()">Torna indietro</button> <a href="home.php"><button>Torna alla home</button></a>
    <br>
    
</body>
</html>
