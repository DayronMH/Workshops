<?php
require_once '../models/provinceModel.php';
require_once '../models/registerModel.php';

class showData
{
    public function __construct()
    {
        if (isset($_POST['action']) && $_POST['action'] === 'logOut') {
            $this->logOut();
            return;
        }
        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            $this->deleteUser($_GET['id']);
        }
        
        $userModel = new registerModel('users');
        $users = $userModel->getAllUsers();
        $provinceModel = new ProvinceModel('provinces');
        $provinces = $provinceModel->getAllProvinces();
        if (isset($_SESSION['login_id'])) {
            $loginId = $_SESSION['login_id'];
            $user = $userModel->getUserByLoginId($loginId);
            $roleId = $user['role_id'];
        } else {
            echo "No se ha encontrado login_id en la sesión.";
        }
        if (!empty($users)) {
            if (!empty($users)) {
                echo "<table border='1'>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Teléfono</th>
                        <th>Provincia</th>
                        <th>Dirección</th>";

                if ($roleId == 1) {
                  echo "<th>Acciones</th>";
                }

                echo "</tr>";

                foreach ($users as $user) {
                    $province = $this->getProvinceName($user['province_id'], $provinces);

                    echo "<tr>
                        <td>" . htmlspecialchars($user["name"]) . "</td>
                        <td>" . htmlspecialchars($user["lastname"]) . "</td>
                        <td>" . htmlspecialchars($user["phone"]) . "</td>
                        <td>" . htmlspecialchars($province) . "</td>
                        <td>" . htmlspecialchars($user["address"]) . "</td>";

                        if ($roleId == 1) {
                            echo "<td>
                                  <a href='../views/editUser.php?id=" . $user['id'] . "'>Editar</a>
                                  <a href='?action=delete&id=" . $user['id'] . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este usuario?\");'>Borrar</a>
                                 </td>";
                        }
                        

                    echo "</tr>";
                }

                echo "</table>";
                echo "<br>";

                echo "<form method='POST'>
                        <button type='submit' name='action' value='logOut'>Salir</button>
                        </form>";
            } else {
                echo "No se encontraron resultados.";
                $_SESSION = [];
            }

            Database::disconnect();
        }
    }
    private function getProvinceName($province_id, $provinces)
    {
        foreach ($provinces as $province) {
            if ($province['id'] == $province_id) {
                return $province['name'];
            }
        }
        return 'Provincia no encontrada';
    }
    private function deleteUser($id) {
        $userModel = new registerModel('users');
        if ($userModel->deleteUser($id)) {
            header("Location: ../controllers/showData.php?message=Usuario eliminado con éxito");
            exit();
        }
 
    }
    private function logOut()
    {

        header("Location: http://userpractice.com");
        exit();
    }
}
