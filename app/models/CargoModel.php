<?php 
class CargoModel extends Model{
    private $table = "HangHoa";
    function getList(){
        $data = $this->db->query("SELECT mahopdong,hanghoa.mahanghoa,tenhanghoa,tennhomhang,trongluong FROM hanghoa join nhomhang on nhomhang.manhomhang = hanghoa.manhomhang")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
     function setTable(){
        return $this->table;
    }   
     function setField(){
        return '*';
    }
    function getDataById($id){
        $data = $this->db->query("SELECT hanghoa.mahanghoa,tenhanghoa,tennhomhang,trongluong FROM hanghoa join nhomhang on nhomhang.manhomhang = hanghoa.manhomhang where hanghoa.mahanghoa = '$id'")->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    function getListNhomHang()
    {
       return $this->db->query("SELECT * FROM nhomhang")->fetchAll(PDO::FETCH_ASSOC);
    }
    function getChangeDataById($id){
        $data["cargo"] = $this->db->query("SELECT mahopdong, hanghoa.mahanghoa,tenhanghoa,tennhomhang,trongluong,hanghoa.manhomhang FROM hanghoa join nhomhang on nhomhang.manhomhang = hanghoa.manhomhang where hanghoa.mahanghoa = '$id'")->fetch(PDO::FETCH_ASSOC);
        $data["typecargo"] = $this->getListNhomHang();
        return $data;
    }
    function deleteData($condition)
    {
        $data = $this->db->delete($this->table, $condition);
    }
    function updateData($param, $condition){
        $data = $this->db->query("UPDATE hanghoa set tenhanghoa ='".$param['tenhanghoa']."', manhomhang = '".$param['manhomhang']."',
        trongluong = '".$param['trongluong']."' where $condition");
        return $data;
    }
    function generateProductCode($contractNumber) {
        $contractSuffix = substr($contractNumber, -4);
        $ngayThangNamHienTai = date('Y-m-d H:i:s');
        $timestamp = strtotime($ngayThangNamHienTai);
        $milisecond = $timestamp * 1000;
        $time = substr($milisecond, -3);
        $randomChars = $this->generateRandomChars(3);
        $productCode = $contractSuffix . $time . $randomChars;
        return strtoupper($productCode);
    }
    
    function generateRandomChars($length) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomChars = '';
    
        for ($i = 0; $i < $length; $i++) {
            $randomChars .= $characters[rand(0, strlen($characters) - 1)];
        }
    
        return $randomChars;
    }
    function searchDataById($id){
        $data = $this->db->query("SELECT hanghoa.mahanghoa,tenhanghoa,tennhomhang,trongluong FROM hanghoa join nhomhang on nhomhang.manhomhang = hanghoa.manhomhang where hanghoa.mahanghoa = '$id'")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function insertData($param)
    {
        $param['mahanghoa'] = $this->generateProductCode($param['mahopdong']);
        $data = $this->db->insert($this->table, $param);
        return $param;
    }
    function getListCargoId(){
        $data = $this->db->query("SELECT mahanghoa from hanghoa ")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}
?>