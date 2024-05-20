<html>

<head>
    <title>Edit Profile Page</title>
</head>

<?php
    include '../backend/connessione.php';
    session_start();
    if (!isset($_SESSION["id"])) {
        header("Location: login.php");
    }
    $user = $connessione->query("SELECT * FROM Utenti WHERE email = '" . $_SESSION['id'] . "'")->fetch_assoc();
?>

<body>
    <h1>Edit Profile</h1>
    <div>
    <form method="POST" action="../backend/editProfileController.php">

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value = "<?php echo $user['username']?>" required><br><br>


        <input type="submit" value="Modifica username">
    </form>
    </div>

</body>
</html>