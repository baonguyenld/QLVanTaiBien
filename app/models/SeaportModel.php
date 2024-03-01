<?php 
class SeaportModel extends Model{
    private $table = "Cang";
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
    function getDataById($id){
        $data = $this->db->query("SELECT * FROM $this->table where macang = '$id'")->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    function getListSeaportId(){
        $data = $this->db->query("SELECT macang FROM $this->table")->fetchAll(PDO::FETCH_ASSOC);
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
    function searchDataById($id){
        $data = $this->db->query("SELECT macang,tencang,quocgia,trangthai,thetichtoida,thetichhienchua FROM $this->table where macang= '$id'")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}
?>