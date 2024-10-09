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

