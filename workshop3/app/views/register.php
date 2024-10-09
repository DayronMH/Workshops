<?php
require_once '../controllers/ProvinceController.php'; 
$loadProvinces = new LoadProvinces();
$provinces = $loadProvinces->getProvinces();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/register.css">
    <title>Registro de Usuario</title>
</head>
<body>
    <h2>Registro de Usuario</h2>
    <form action="../controllers/registerController.php" method="POST">
        <label for="username">Nombre de Usuario:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <label for="province">Provincia:</label><br>
        <select id="provincia" name="provincia">
            <?php
            foreach ($provinces as $province):
                $province_id = $province['id'];
                $province_name = $province['name'];
                ?>
                <option value="<?php echo $province_id; ?>"><?php echo $province_name; ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <label for="phone">Número de teléfono:</label><br>
        <input type="text" id="phone" name="phone" required><br><br>
        <label for="direction">Direccion:</label><br>
        <input type="text" id="direction" name="direction" required><br><br>
        <button type="submit" name="action" value="save">Registrar</button>
    </form>
</body>

</html>