<?php
require_once 'databaseModel.php';
class ProvinceModel extends BaseModel
{  
    
    public function getAllProvinces() {
        $queryStr = "SELECT * FROM provinces ORDER BY id" ;

        $query = $this->db->prepare($queryStr);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }   
}
    