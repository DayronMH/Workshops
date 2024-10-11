<?php
require_once '../models/databaseModel.php';

class showData
{
    public function __construct()
    {
        if (isset($_POST['action']) && $_POST['action'] === 'logOut') {
            $this->logOut();  
            return;  
        }
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
                echo "<br>";

                echo "<form method='POST'>
                    <button type='submit' name='action' value='logOut'>Salir</button>
                    </form>";
            } else {
                echo "No se encontraron resultados.";
            }
            
            Database::disconnect();
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
    private function logOut()
    {
    
        header("Location: http://userpractice.com");
        exit();
    }
  
    }

