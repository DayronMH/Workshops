<?php
require_once '../models/registerModel.php';

class Register {
    public function __construct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['action'] == 'save') {
                $this->addUser();
            }
        }
    }

    public function addUser() {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
        $direction = filter_input(INPUT_POST, 'direction', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $province_id = $this->getProvince();

        if (empty($username)) $mistakes[] = 'El nombre de usuario no puede estar vacío.';
        if (empty($password) || strlen($password) < 8) $mistakes[] = 'La contraseña debe tener más de 8 caracteres.';
        if (empty($name)) $mistakes[] = 'El nombre no puede estar vacío.';
        if (empty($lastname)) $mistakes[] = 'El apellido no puede estar vacío.';
        if (empty($phone) || !preg_match('/^[0-9]{8}$/', $phone)) $mistakes[] = 'El número de teléfono debe tener 8 dígitos.';
        if (empty($direction)) $mistakes[] = 'La dirección no puede estar vacía.';

        if (empty($mistakes)) {
            $loginModel = new RegisterModel('login');
            $registerModel = new RegisterModel('data');
            $hashedPassword = md5($password);

            $loginId = $loginModel->createLogin($username, $hashedPassword);

            if ($loginId) {
                $registerModel->createUser($name, $lastname, $phone, $province_id, $direction, $loginId);
                echo '<div class="alert alert-success">Usuario registrado correctamente.</div>';
                header('Location:http://userpractice.com/');
                exit();
            } else {
                $mistakes[] = 'Error al registrar el usuario.';
            }
        }

        if (!empty($mistakes)) {
            foreach ($mistakes as $error) {
               echo "<script>alert('Error: {$error}');
                    window.location.href = 'http://userpractice.com/app/views/register.php';    
               </script>";
            }
            exit();
        }
    }
    private function getProvince() {
        $province_id = filter_input(INPUT_POST, 'province', FILTER_VALIDATE_INT);

        if ($province_id && $province_id >= 1 && $province_id <= 7) {
            return $province_id; 
        } else {
            return null; 
        }
    }
}

$regis = new Register();

