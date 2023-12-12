<?php
    include 'connessione.php';
    session_start();
    if (!isset($_SESSION["id"])) {
        header("Location: login.php");
    }
?>
<html>
    <head>
    </head>
    <body>
        <h1>Welcome <?php echo $connessione->query("SELECT username FROM Utente WHERE email = '" . $_SESSION['id'] . "'")->fetch_assoc()['username']; ?></h1>

        <a href="logout.php"><button>Logout</button></a>
    </body>
</html>
