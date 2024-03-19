<html>

<head>
    <title>Edit Profile Page</title>
</head>

<?php
    include '../backend/connessione.php';
    session_start();
    $user = $connessione->query("SELECT * FROM Utenti WHERE email = '" . $_SESSION['id'] . "'")->fetch_assoc();
?>

<script>

    function editProfile(){
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../backend/apiEdit.php", true);
        xhr.send(JSON.stringify({type: "editProfile", id: <?php echo $_SESSION['id'] ?>, username: document.getElementById("username").value, password: document.getElementById("password").value}));
        xhr.onload = function() {

            if (this.status == 200 && this.readyState == 4) {
                let response = JSON.parse(this.responseText);
                if(response['error'] == true){
                    console.log(response['msg']);
                }else{
                    window.location.href = "home.php";
                }
            }
        }
    }

</script>

<body>
    <h1>Edit Profile</h1>
    <div>
        <form>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo $user['username'] ?>"><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?php echo $user['password'] ?>"><br>
            <button type="button" onclick="editProfile()">Modifica</button>
        </form>
    </div>

</body>
</html>