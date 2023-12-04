<?php
    session_start();
    if (!isset($_SESSION["id"]) && $_SESSION["username"] != "") {
        header("Location: login.php");
    }
?>
<html>
    <head>
    </head>
    <body>

    </body>
</html>
