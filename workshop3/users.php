<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Datos</title>
</head>
<body>
    <h1>Datos:</h1>

    <form method="POST">
        <input type="submit" value="Mostrar Datos">
    </form>

    <?php
    $servername = "localhost";
    $username = "root"; 
    $password = "";
    $dbname = "user";
    
    $link = mysqli_connect($servername, $username, $password, $dbname);

    if (!$link) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $sql = "SELECT name, lastname, phone, city, direction FROM data";
        $result = $link->query($sql);

        if (!$result) {
            die("Error en la consulta: " . $link->error);
        }

        if ($result->num_rows > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Teléfono</th>
                        <th>Provincia</th>
                        <th>Dirección</th>
                    </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row["name"]) . "</td>
                        <td>" . htmlspecialchars($row["lastname"]) . "</td>
                        <td>" . htmlspecialchars($row["phone"]) . "</td>
                        <td>" . htmlspecialchars($row["city"]) . "</td>
                        <td>" . htmlspecialchars($row["direction"]) . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron resultados.";
        }
    }
    mysqli_close($link);
    ?>
</body>
</html>


