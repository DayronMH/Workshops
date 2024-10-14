<?php
require_once '../models/provinceModel.php';
class LoadProvinces {
    private $provinces;

    public function __construct() {
        $itemModel = new ProvinceModel('provinces');
        $this->provinces = $itemModel->getAllProvinces();
      
    }
    public function getProvinces() {
        return $this->provinces;
    }
}

$loadProvinces = new LoadProvinces();
$provinces = $loadProvinces->getProvinces();
