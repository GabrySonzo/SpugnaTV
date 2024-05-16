<!DOCTYPE html>
<html>
<head>
    <title>Profiles Page</title>
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
        function showProfile(){
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../backend/apiRead.php", true);
            xhr.send(JSON.stringify({type: "profiles"}));
            xhr.onload = function() {

                if (this.status == 200 && this.readyState == 4) {
                    let profiles = JSON.parse(this.responseText);
                    if(profiles['error'] == true){
                        console.log(profiles['msg']);
                    }else{
                        profiles["data"].forEach(profile => {
                            var div = document.createElement("div");
                            div.id = profile['email'];
                            var p = document.createElement("p");
                            p.innerHTML = profile['username'] + " " + profile['email'] + " " + "<button type=\"button\" onclick=\"removeProfile('" + profile['email'] + "')\">Rimuovi</button>";
                            div.appendChild(p);
                            document.getElementById("profiles").appendChild(div);
                        });
                    }
                }
            }
        }

        function removeProfile(id){
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../backend/apiRemove.php", true);
            xhr.send(JSON.stringify({type: "profiles", profile: id}));
            xhr.onload = function() {

                if (this.status == 200 && this.readyState == 4) {
                    let profiles = JSON.parse(this.responseText);
                    if(profiles['error'] == true){
                        console.log(profiles['msg']);
                    }else{
                        document.getElementById(id).remove();
                    }
                }
            }
        }

    </script>
    <h1>Profili</h1>
    <div id="profiles">
        <script>showProfile();</script>

    </div>

    <button onclick="window.history.back()">Torna indietro</button> <a href="home.php"><button>Torna alla home</button></a>
    <br>
    
</body>
</html>
