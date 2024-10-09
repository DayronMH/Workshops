<?php
require_once '../controllers/TableController.php'; 
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Usuarios</title>
    <link rel="stylesheet" href="../public/table.css"> <!-- Incluye tu CSS -->
</head>
<body>
    <h1>Lista de Usuarios</h1>
   
    <?php
    $show = new showData();
    ?>
    

</body>
</html>