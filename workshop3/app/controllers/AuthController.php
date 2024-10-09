<?php
session_start();
require_once '../models/loginModel.php';
class AuthController {
    public function __construct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['action'] == 'login') {
                self::handleLogin();
            } if ($_POST['action'] == 'register') {
                header('Location: ../views/register.php');
                exit(); 
            }
        }
    }
    
    public static function handleLogin() {
        $userModel = new loginModel('login');
        $username = $_POST['username'];
        $password = trim($_POST['password']);
        
        $user = $userModel->getUserByUsername($username);
        if ($user) {
            echo 'Usuario encontrado';
            if ($password === $user['password']) {
                $_SESSION['user_id'] = $user['id'];
                echo 'Login exitoso';
                header('Location: ../views/table.php');
            } else {
                echo 'Contraseña incorrecta';

            }
        } else {
            echo 'Usuario no encontrado';
            header('Location:../views/login.php');
        }
        
    }
    
}

$authController = new AuthController(); 
