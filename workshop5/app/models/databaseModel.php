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




