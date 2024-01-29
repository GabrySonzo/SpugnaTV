<?php
    include '../backend/connessione.php';
    session_start();
    if (!isset($_SESSION["id"])) {
        header("Location: login.php");
    }

    $daVedere = $connessione->query("SELECT id FROM Liste WHERE nome = 'Film da vedere' AND utente_mail = '" . $_SESSION['id'] . "'")->fetch_assoc()['id'];

?>
<html>
    <head>
    </head>
    <body>
        <h1>Welcome <?php echo $connessione->query("SELECT username FROM Utenti WHERE email = '" . $_SESSION['id'] . "'")->fetch_assoc()['username']; ?></h1>
        <?php if ($_SESSION['admin'] == true): ?>
            <a href="registerFilm.php"><button>inserisci film</button></a>
            <a href="registerDirector.php"><button>inserisci regista</button></a>
            <a href="registerActor.php"><button>inserisci attore</button></a>
            <a href="actors.php"><button>visualizza attori</button></a>
            <a href="profiles.php"><button>visualizza profili</button></a>
            <br><br>
        <?php endif; ?>
        <?php
            echo "<a href='list.php?list=".$daVedere."'><button>Da vedere</button></a>";
        ?>
        <a href="search.php"><button>Cerca film</button></a>
        <a href="profile.php"><button>Profilo</button></a>
        <br><br>
        <?php
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
            if(isset($_GET['error']) && $_GET['error'] == 3)
            {
                echo "<br><br>Errore nella registrazione dell attore!";
            }
            if(isset($_GET['succ']) && $_GET['succ'] == 3)
            { 
                echo "<br><br>Attore registrato con successo!";
            }
            if(isset($_GET["succ"]) && $_GET["succ"] == 4)
            {
                echo "<br><br>Eliminazione avvenuta con successo!";
            }
        ?>
        
    </body>
</html>
