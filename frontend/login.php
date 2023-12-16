<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="../backend/loginController.php">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
    <br>
    <a href="register.php"><button>Register</button></a>
    <?php
        if (isset($_GET['error']) && $_GET['error'] == 1) {
            echo "<br><br>Invalid email or password";
        }
        if (isset($_GET['error']) && $_GET['error'] == 2) {
            echo "<br><br>Errore nel login";
        }
    ?>
</body>
</html>