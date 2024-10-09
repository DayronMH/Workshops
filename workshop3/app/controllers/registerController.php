<?php
ob_start();
require_once '../models/databaseModel.php';

class register{
    public function __construct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['action'] == 'save') {
                self::newUser();
            }
        }
    }

    public function newUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mistakes = [];
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
            $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
            $direction = filter_input(INPUT_POST, 'direction', FILTER_SANITIZE_STRING);
            $province = filter_input(INPUT_POST, 'province', FILTER_SANITIZE_NUMBER_INT);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    
            // Validar datos
            if (empty($username)) {
                $mistakes[] = 'El nombre de usuario no puede estar vacío.';
            }
    
            if (empty($password)) {
                $mistakes[] = 'La contraseña no puede estar vacía.';
            } elseif (strlen($password) < 8) {
                $mistakes[] = 'La contraseña debe tener al menos 8 caracteres.';
            }
    
            if (empty($name)) {
                $mistakes[] = 'El nombre no puede estar vacío.';
            }
    
            if (empty($lastname)) {
                $mistakes[] = 'El apellido no puede estar vacío.';
            }
    
            if (empty($phone)) {
                $mistakes[] = 'El número de teléfono no puede estar vacío.';
            } elseif (!preg_match('/^[0-9]{8}$/', $phone)) {
                $mistakes[] = 'El número de teléfono debe tener 8 dígitos.';
            }
    
            if (empty($direction)) {
                $mistakes[] = 'La dirección no puede estar vacía.';
            }
    
            if (empty($mistakes)) {
                $loginModel = new registerModel($username,$password, $name,$lastname, $phone, $province, $direction);
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
                $loginId = $loginModel->createLogin($username, $hashedPassword);
    
                if ($loginId) {
                    $loginModel->createLogin($username,$hashedPassword);
                    $loginModel->createUser($name, $lastname, $phone, $province, $direction, $loginId);
                    
                    
                } else {
                    
                    $mistakes[] = 'Error al registrar el usuario.';
                   
                }
            }
    
            // Mostrar errores con alertas
            if (!empty($mistakes)) {
                
                echo "<script>
                    setTimeout(function() {
                        window.location.href = '../views/register.php';
                    }, 3000); // 3 second delay
                </script>";
                exit(); // Stop script execution
            }
        }
    }
}    
$regis = new register(); 
ob_end_flush();
