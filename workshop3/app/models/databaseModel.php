<?php
require_once '../../config/database.php';
class BaseModel
{
    protected $db;
    protected $table;
    public function __construct($table)
    {
        $this->db = Database::connect('user');//nombre de la base de datos
        $this->table = $table;
    }
}

class dataModel extends BaseModel
{
    public function getAllItems() {
    $queryStr = "SELECT * FROM " . "data";
    $query = $this->db->prepare($queryStr);
    $query->execute();
    Database::disconnect();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}


}
class ProvinceModel extends BaseModel
{  
    public function getAllProvinces($columns = '*') {
    $queryStr = "SELECT " . $columns . " FROM " . $this->table;

    $query = $this->db->prepare($queryStr);
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
    }   
}
    

class loginModel extends BaseModel
{
    public function getUserByUsername($username)
    {
        $conditions = ["username = :username"];
        $query = $this->db->prepare("SELECT * FROM " . $this->table . " WHERE username = :username");
        $query->bindParam(':username', $username);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}

class registerModel extends BaseModel {

    public function __construct($username, $password, $nombre, $apellido, $telefono, $direccion, $provincia) {
        parent::__construct('data'); 
        parent::__construct('login'); 
        $this->db->beginTransaction();

        try {
           
            $this->registerUser($username, $password);
            +
            $this->registerUserDetails($nombre, $apellido, $telefono, $direccion, $provincia);

            $this->db->commit();
            echo 'Usuario registrado exitosamente';
            header('Location: ../views/login.php');
            exit;
        } catch (PDOException $e) {
            $this->db->rollBack();
            die('Error al registrar el usuario: ' . $e->getMessage());
        }
    }
    private function registerUser($username, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO login (username, password) VALUES (:username, :password)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->execute();
    }
    private function registerUserDetails($nombre, $apellido, $telefono, $direccion, $provincia) {
        $query = "INSERT INTO users (nombre, apellido, province, telefono, direccion) 
                  VALUES (:nombre, :apellido, :telefono, :direccion, :provincia)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':provincia', $provincia);
        $stmt->execute();
    }
}

