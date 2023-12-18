<?php
    include '../backend/connessione.php';
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
            <a href="registerDirector.php"><button>inserisci regista</button></a>
        <?php endif; ?>
        <a href="logout.php"><button>Logout</button></a>
        <?php
        //provas
            if(isset($_GET['error']) && $_GET['error'] == 1)
            {
                echo "<br><br>Errore nella registrazione del film!";
            }
            if(isset($_GET['succ']) && $_GET['succ'] == 1)
            {
                echo "<br><br>Film registrato con successo!";
            }
            if(isset($_GET['error']) && $_GET['error'] == 2)
            {
                echo "<br><br>Errore nella registrazione del regista!";
            }
            if(isset($_GET['succ']) && $_GET['succ'] == 2)
            {
                echo "<br><br>Regista registrato con successo!";
            }
        ?>
        
    </body>
</html>
