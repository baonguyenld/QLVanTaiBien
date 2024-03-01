<?php 
class PriceModel extends Model{
    private $table = "banggia";
     function setTable(){
        return $this->table;
    }   
     function setField(){
        return '*';
    }
    function getList(){
        $data = $this->db->query("SELECT mabanggia, tennhomhang, tenloai, khoangcach, gia FROM $this->table join loaicontainer on loaicontainer.maloaicontainer = banggia.maloai join nhomhang on nhomhang.manhomhang = banggia.manhomhang")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function getListPriceId(){
        $data = $this->db->query("SELECT mabanggia from banggia ")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function getListContainer(){
        $data = $this->db->query("SELECT maloaicontainer,tenloai from loaicontainer")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function getListNhomHang(){
        $data = $this->db->query("SELECT manhomhang,tennhomhang from nhomhang")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function getListCang(){
        $data = $this->db->query("SELECT macang from cang")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function insertData($param)
    {
        $data = $this->db->insert($this->table, $param);
    }
    public function getDataById($id)
    {
        $data = $this->db->query("SELECT * from banggia where mabanggia = '".$id."'")->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    function updateData($param, $condition){
        $data = $this->db->update($this->table, $param, $condition);
    }
    function deleteData($condition)
    {
        $data = $this->db->delete($this->table, $condition);
    }
}
?>