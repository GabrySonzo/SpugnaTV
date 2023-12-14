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
        <h1>Welcome <?php echo $connessione->query("SELECT username FROM Utenti WHERE email = '" . $_SESSION['id'] . "'")->fetch_assoc()['username']; ?></h1>
        <?php if ($_SESSION['admin'] == true): ?>
            <a href="registerFilm.php"><button>inserisci film</button></a>
        <?php endif; ?>
        <a href="logout.php"><button>Logout</button></a>
        <?php
            echo $_SESSION['admin']."<br>";
        ?>
        
    </body>
</html>
