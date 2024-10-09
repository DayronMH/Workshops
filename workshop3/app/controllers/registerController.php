<?php
require_once '../models/databaseModel.php';

class register{
    public function __construct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['action'] == 'save') {
                self::newUser();
            }
        }
    }

    public function newUser(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];
            $provincia = $_POST['provincia'];  

            $registerModel = new registerModel($username,$password,
            $nombre, $apellido, $telefono, $direccion, $provincia );

            $registerModel->registerUser($username, $password);

            $registerModel->registerUserDetails($nombre, $apellido, $telefono, $direccion, $provincia);
        }
    }
    }
$regis = new register(); 
