<?php
require_once '../../config/database.php';
require_once '../models/databaseModel.php';

class showData
{
    public function __construct()
    {
        $dataModel = new dataModel('data');
        $users = $dataModel->getAllItems();
        $provinceModel = new ProvinceModel('provinces');
        $provinces = $provinceModel->getAllProvinces();

        if (!empty($users)) {
            echo "<table border='1'>
            <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Teléfono</th>
                            <th>Provincia</th>
                            <th>Dirección</th>
                        </tr>";

            // Iteramos sobre los usuarios y mostramos cada uno
            foreach ($users as $user) {
                $province = $this->getProvinceName($user['province'], $provinces);

                echo "<tr>
                            <td>" . htmlspecialchars($user["name"]) . "</td>
                            <td>" . htmlspecialchars($user["lastname"]) . "</td>
                            <td>" . htmlspecialchars($user["phone"]) . "</td>
                            <td>" . htmlspecialchars($province) . "</td>
                            <td>" . htmlspecialchars($user["direction"]) . "</td>
                          </tr>";
            }


            echo "</table>";

            echo "<form method='POST'>
            <button type='submit' name='action' value='logOut'>Salir</button>
            </form>";

            if (isset($_POST['action']) && $_POST['action'] === 'logOut') {
                self::logOut();  
            }
        } else {
            // Si no hay usuarios, mostrar un mensaje
            echo "No se encontraron resultados.";
        }

        // Desconectar la base de datos
        Database::disconnect();
    }
    private function getProvinceName($province_id, $provinces)
    {

        foreach ($provinces as $province) {
            if ($province['id'] == $province_id) {
                return $province['name'];
            }
        }
        return 'Provincia no encontrada'; // Si no encontramos la provincia
    }
    public static function logOut()
    {
        header('Location:../views/login.php');
        die();
    }
}


