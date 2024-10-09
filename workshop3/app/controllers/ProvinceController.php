<?php
require_once '../models/databaseModel.php'; // Asegúrate de incluir el archivo necesario para tu modelo

class LoadProvinces {
    private $provinces;

    public function __construct() {
        $itemModel = new ProvinceModel('provinces');
        $this->provinces = $itemModel->getAllProvinces('name');
      
    }
    public function getProvinces() {
        return $this->provinces;
    }
}

$loadProvinces = new LoadProvinces();
$provinces = $loadProvinces->getProvinces();
