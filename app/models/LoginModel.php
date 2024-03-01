<?php 
class LoginModel extends Model{
    private $table = "taikhoan";
     function setTable(){
        return $this->table;
    }   
     function setField(){
        return '*';
    }
    function checkAccount($id){
        $data = $this->db->query("SELECT * FROM $this->table where hoadon.mahoadon = '$id'")->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
}
?>