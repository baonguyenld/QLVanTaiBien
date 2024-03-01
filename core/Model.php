<?php 
abstract class Model extends Database {
    protected $db;
    public function __construct() {
        $this->db = new Database();
    }
    abstract function setTable();   
    abstract function setField();
    public function fetchAll()
    {
        $table = $this->setTable();
        $field = $this->setField();
        if (empty($field)) {
            $field = '*';
        }
        $sql = "SELECT $field FROM $table";
        $query = $this->db->query($sql);
        if(!empty($query))
        {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return false;
    }

}