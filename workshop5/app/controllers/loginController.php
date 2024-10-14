<?php
require_once '../models/loginModel.php';
require_once '../models/registerModel.php';
class loginController {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['action'] == 'login') {
                self::handleLogin();
            } if ($_POST['action'] == 'register') {
                self::routeRegister();
                        
            }
        }
    }
    
    public static function handleLogin() {
        $loginModel = new loginModel('login');
        $registerModel = new RegisterModel('users');
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hashedInputPassword = md5($password);
        $login = $loginModel->getUserByUsername($username);
        $user = $registerModel->getUserById($login['id']);
        if ($login) {
            if ($hashedInputPassword === $login['password'])
            {
                if ($user['status'] == 'active')
                {
                    $_SESSION['user_id'] = $login['id'];
                    $idLogin = $loginModel->getUserByUsername($username);
                    $_SESSION['login_id'] = $idLogin['id'];
                    $loginModel->updateLastLogin($idLogin['id']);
                    echo "<script>
                        alert('Login exitoso');
                        window.location.href = 'http://userpractice.com/app/views/table.php';
                      </script>";
                     exit();
                }
                else{
                    echo "<script>
                            alert('Usuario inactivo');
                            window.location.href = 'http://userpractice.com/app/views/login.php';
                          </script>";
                    exit(); 
                }
            
            } else {
                echo "<script>
                        alert('Contraseña incorrecta');
                        window.location.href = 'http://userpractice.com/app/views/login.php';
                      </script>";
                exit(); 
            }
        } else {
            echo "<script>
                    alert('Usuario no encontrado');
                    window.location.href = 'http://userpractice.com/app/views/login.php';
                  </script>";
            exit(); 
        }
    }

    public static function routeRegister(){
        header('Location:http://userpractice.com/app/views/register.php');
        exit();
    }
    
}

$authController = new loginController(); 
