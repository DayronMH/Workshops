<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <link rel="stylesheet" href="../public/login.css?v=1.0">
    <title>Login</title>
</head>
<body>
    <form method="POST" action="app/controllers/AuthController.php">
        <input type="text" name="username" placeholder="Usuario">
        <input type="password" name="password" placeholder="Contraseña">
        <button type="submit" name="action" value="login">Login</button>
        <p>No tienes usuario?</p>
        <button type="submit" name="action" value="register">Registrarse</button> 
    </form>

</body>
</html>

   
