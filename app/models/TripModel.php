<?php 
class TripModel extends Model{
    private $table = "Chuyentau";
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
        $data = $this->db->query("SELECT * FROM $this->table where machuyentau = '$id'")->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    function searchDataById($id){
        $data = $this->db->query("SELECT * FROM $this->table where machuyentau = '$id'")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function updateData($param, $condition){
        $data = $this->db->update($this->table, $param, $condition);
    }
    function generateTripCode($matau)
    {
        $currentTimeMillis = round(microtime(true) * 1000);
        $prefixCode = substr($matau, -2);
        $tripCode = "CT".$prefixCode. substr($currentTimeMillis,-6);
        return $tripCode;
    }
    function insertData($param)
    {
        $param['machuyentau'] = $this->generateTripCode($param['matau']);
        $data = $this->db->insert($this->table, $param);
    }
    function deleteData($condition)
    {
        $data = $this->db->query("SELECT mavandon FROM vandon where  $condition")->fetch(PDO::FETCH_ASSOC);
        if($data)
        {
            return $data['mavandon'];
        }
        else {
            $data = $this->db->delete($this->table, $condition);
            return false;
        }

   
    }
    function getListTripId(){
        $data = $this->db->query("SELECT machuyentau from chuyentau ")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}
?>