<?php
require_once 'databaseModel.php';
class registerModel extends BaseModel{
    public function createLogin($username, $hashedPassword) {
        $query = "INSERT INTO login (username, password) VALUES (:username, :password)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->execute();

        return $this->db->lastInsertId(); 
    }

    public function createUser($name, $lastname, $phone, $province_id, $direction, $loginId) {
        $query = "INSERT INTO data (login_id, name, lastname, phone, province, direction) 
                  VALUES (:login_id, :name, :lastname, :phone, :province, :direction)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':login_id', $loginId);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':province', $province_id);
        $stmt->bindParam(':direction', $direction);
        return $stmt->execute();
    }
}
