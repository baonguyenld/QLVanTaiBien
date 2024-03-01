<?php 
class ShipModel extends Model{
    private $table = "Tau";
    function getList(){
        $data = $this->db->query("SELECT * FROM $this->table")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
     function setTable(){
        return $this->table;
    }   
     function setField(){
        return '*';
    }
    function searchDataById($id){
        $data = $this->db->query("SELECT * FROM $this->table where matau = '$id'")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function getDataById($id){
        $data = $this->db->query("SELECT * FROM $this->table where matau = '$id'")->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    function updateData($param, $condition){
        $data = $this->db->update($this->table, $param, $condition);
    }
    function insertData($param)
    {
        $data = $this->db->insert($this->table, $param);
    }
    function deleteData($condition)
    {
        $data = $this->db->delete($this->table, $condition);
    }
    function getListShipId(){
        $data = $this->db->query("SELECT matau from tau ")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function getListMaxWeight(){
        $data = $this->db->query("SELECT trongluongtoida from tau ")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function getListMaxVolumn(){
        $data = $this->db->query("SELECT thetichtoida from tau ")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}
?>