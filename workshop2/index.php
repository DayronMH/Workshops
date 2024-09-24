<?php
$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "form";

$link = mysqli_connect($servername, $username, $password, $dbname);

if (!$link) {
    die("Conexión fallida: " . mysqli_connect_error());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

     $name = mysqli_real_escape_string($link, $_POST['nombre']);
     $lastname = mysqli_real_escape_string($link, $_POST['apellido']);
     $phone = mysqli_real_escape_string($link, $_POST['telefono']);
     $email = mysqli_real_escape_string($link, $_POST['correo']);
   
    $sendDB = "INSERT INTO user (name, lastname, phone, email) VALUES ('$name', '$lastname', '$phone', '$email')";
  
    if (mysqli_query($link, $sendDB) && isset($_POST['enviar'])){
         echo "Datos insertados correctamente.";
    } else {
        echo "Error: " . mysqli_error($link);
    }
}

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Usuarios</title>
</head>
<body>
    <h1>Ingrese sus datos</h1>
    <form action="" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required><br><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" required><br><br>

        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required><br><br>

        <input type="submit" name="enviar" value="enviar">
    </form>
</body>
</html>
