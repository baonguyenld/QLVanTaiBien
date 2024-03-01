<?php 
class CustomerModel extends Model{
    private $table = "Khachhang";
    private $loai = "type";
    function getList(){
        $data = $this->db->query("SELECT macongty,cmnd,khachhang.makhachhang,tenkhachhang,diachi,sdt,email,$this->loai FROM $this->table left join khachhang_sdt on khachhang_sdt.makhachhang=khachhang.makhachhang
        left join khachhangsi on khachhangsi.makhachhang = khachhang.makhachhang left join khachhangle on khachhangle.makhachhang = khachhang.makhachhang")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
     function setTable(){
        return $this->table;
    }   
     function setField(){
        return '*';
    }
    function getDataById($id){
        $data = $this->db->query("SELECT macongty,cmnd,khachhang.makhachhang,tenkhachhang,diachi,sdt,email,$this->loai FROM $this->table left join khachhang_sdt on khachhang_sdt.makhachhang=khachhang.makhachhang
        left join khachhangsi on khachhangsi.makhachhang = khachhang.makhachhang left join khachhangle on khachhangle.makhachhang = khachhang.makhachhang
         where khachhang.makhachhang = '$id' ")->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    function updateData($param, $condition){
   
        
        $oldEmail =$param["oldEmail"];
        unset($param["oldEmail"]);
        $sdt = $param['sdt'];
        $macongty = $param['macongty'];
        $cmnd = $param['cccd'];
        unset($param["sdt"]);
        unset($param["macongty"]);
        unset($param["cccd"]);
    
        $data = $this->db->update($this->table, $param, $condition);
        if($oldEmail!=$param['email']){
            $updateAcAndCus =  $this->db->query(
             "ALTER TABLE khachhang
            DROP FOREIGN KEY FK_TAIKHOAN_KHACHHANG;
            UPDATE taikhoan set username = '".$param['email']."' WHERE username ='".$oldEmail."'; 
            UPDATE khachhang set username = '".$param['email']."' WHERE username ='".$oldEmail."';
            ALTER TABLE khachhang
            ADD CONSTRAINT FK_TAIKHOAN_KHACHHANG
            FOREIGN KEY (username) REFERENCES taikhoan(username)");
         }
         if(!empty($macongty))
         {
             $khachhangsi = $this->db->update("khachhangsi", ["macongty" => $macongty], $condition);
         }
         else {
             $khachhangle = $this->db->update("khachhangle", ["cmnd" => $cmnd], $condition);
         }
         if(empty($sdt))
         {
            $this->db->insert("khachhang_sdt", ["sdt" => $sdt, "makhachhang"=> $param['makhachhang']]);    
         }
         else {
            $khachhangsdt = $this->db->update("khachhang_sdt", ["sdt" => $sdt], $condition);  
         }
    }
    function getAccount($username, $password, $type){
        $data = $this->db->query("SELECT username, password, type FROM $this->table where username = '$username' and password = '$password' and type = '$type'")->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    function getMilis($length = -3)
    {
        $time = microtime(true);
        $milliseconds = round($time * 1000);
        return substr($milliseconds, $length);
    }
    function insertData($param)
    {   
        $dataaccount = [
            "username" => $param['email'],
            "password" => $param['password'],
            "trangthai" => 1,
            "type" => "kh"
        ];
       
        $account = $this->db->insert("taikhoan",$dataaccount);

        $cmnd = $param['cccd'];
        $macongty = $param['macongty'];
        $makhachhang = (empty($cmnd)?"CT".substr($macongty,-3):"CN".substr($cmnd,-3)).substr($param['sdt'],-3).$this->getMilis(-2);
        $param2 = [
            "sdt" => $param['sdt'],
            "makhachhang" => $makhachhang
        ];
        $param['makhachhang'] = $makhachhang;
        unset($param['password']);
        unset($param['sdt']);
        unset( $param['cccd']);
        unset( $param['macongty']);
        $data2 = $this->db->insert($this->table, $param);
        $data = $this->db->insert("khachhang_sdt", $param2);
        if(!empty($cmnd))
        {
            $datakhachhangle = [
                "cmnd" =>  $cmnd,
                "makhachhang" => $param['makhachhang']
            ];
            $khachhangle = $this->db->insert("khachhangle", $datakhachhangle);
        }
        else {
            $datakhachhangsi = [
                "macongty" =>  $macongty,
                "makhachhang" => $param['makhachhang']
            ];
            $khachhangle = $this->db->insert("khachhangsi", $datakhachhangsi);
        }
     
    }
    function deleteData($condition, $conditionAccount)
    {
        $data = $this->db->delete("khachhang_sdt", $condition);
        $data = $this->db->delete("khachhangsi", $condition);
        $data = $this->db->delete("khachhangle", $condition);
        $data = $this->db->delete($this->table, $condition);
        $dataAccount =$this->db->delete("taikhoan", $conditionAccount);
    }
    function searchDataById($id){
        $data = $this->db->query("SELECT khachhang.makhachhang, tenkhachhang,diachi, sdt, email,type FROM $this->table join khachhang_sdt on khachhang.makhachhang = khachhang_sdt.makhachhang where khachhang.makhachhang = '$id'")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function getListCustomerId(){
        $data = $this->db->query("SELECT makhachhang from khachhang ")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}
?>