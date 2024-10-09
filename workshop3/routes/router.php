<?php
class Router{
    private $controller;
    private $method;

    public function __construct(){
        $this->matchRoute();
    }
    public function matchRoute(){
        $this->controller = '../app/controllers/AuthController.php'; 
        $this->method = 'login';

        $controllerPath = '../app/controllers/AuthController.php';
        if (file_exists($controllerPath)) {
            require_once($controllerPath);
        } else {
            die("Error: Controlador no encontrado.");
        }
    
    }
    public function run(){
       $controller = new $this->controller();
       $method = $this->method;
       $controller->$method();
    }

}