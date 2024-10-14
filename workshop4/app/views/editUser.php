<?php
require_once '../models/registerModel.php';
require_once '../models/provinceModel.php';

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $userModel = new registerModel('users');
    $provinceModel = new ProvinceModel('provinces');

    $user = $userModel->getUserById($userId);
    if (!$user) {
        echo "Usuario no encontrado.";
        exit;
    }

    $provinces = $provinceModel->getAllProvinces();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $phone = $_POST['phone'];
        $province_id = $_POST['province_id'];
        $address = $_POST['address'];
        $userModel->updateUser($userId, $name, $lastname, $phone, $province_id, $address);
        echo "<script>
                        alert('Usuario guardado');
                        window.location.href = 'http://userpractice.com/app/views/table.php';
                      </script>";
        exit();
    }
} else {
    echo "No se ha proporcionado un ID de usuario.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://userpractice.com/public/editUser.css">
    <title>Editar Usuario</title>
</head>
<body>
    <h1>Editar Usuario</h1>

    <form method="POST">
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($user['name']); ?>" required><br>

        <label for="lastname">Apellido:</label>
        <input type="text" name="lastname" id="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>" required><br>

        <label for="phone">Teléfono:</label>
        <input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required><br>

        <label for="province_id">Provincia:</label>
        <select name="province_id" id="province_id" required>
            <?php foreach ($provinces as $province): ?>
                <option value="<?php echo $province['id']; ?>" <?php if ($province['id'] == $user['province_id']) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($province['name']); ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="address">Dirección:</label>
        <input type="text" name="address" id="address" value="<?php echo htmlspecialchars($user['address']); ?>" required><br>

        <button type="submit">Actualizar</button>
    </form>

    <a href="../controllers/showData.php">Volver a la tabla de usuarios</a>
</body>
</html>