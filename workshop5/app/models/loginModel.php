<?php
require_once 'databaseModel.php';
class loginModel extends BaseModel
{
    public function createLogin($username, $hashedPassword) {
        $query = "INSERT INTO login (username, password) VALUES (:username, :password)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->execute();

        return $this->db->lastInsertId(); 
    }
    public function getUserByUsername($username)
    {
        $query = $this->db->prepare("SELECT * FROM " . $this->table . " WHERE username = :username");
        $query->bindParam(':username', $username);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function getUserById($id)
    {
        $query = $this->db->prepare("SELECT * FROM " . $this->table . " WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function updateLastLogin($userId) {
        $stmt = $this->db->prepare("UPDATE users SET last_login_datetime = NOW() WHERE id = ?");
        $stmt->execute([$userId]);
    }

}