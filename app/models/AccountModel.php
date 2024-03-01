<?php 
class AccountModel extends Model{
    private $table = "taikhoan";
    function getList(){
        $data = $this->db->query("SELECT taikhoan.trangthai,khachhang.username,khachhang.makhachhang, tenkhachhang,khachhang.type,
        sdt, email, diachi, cmnd, macongty FROM `khachhang` left JOIN khachhang_sdt 
        on khachhang_sdt.makhachhang = khachhang.makhachhang 
       LEFT JOIN khachhangsi on khachhangsi.makhachhang = khachhang.makhachhang 
       left JOIN khachhangle on khachhangle.makhachhang = khachhang.makhachhang
       Left join taikhoan on taikhoan.username = khachhang.username
        ")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
     function setTable(){
        return $this->table;
    }   
     function setField(){
        return '*';
    }
    function getItemById($param)
    {
        $data = $this->db->query("SELECT * from $this->table where username = '".$param['username']."'")->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    function banAccount($param)
    {
        $data = $this->db->query("UPDATE $this->table set trangthai = '0' where username = '$param'");
        return $data;
    }
    function unbanAccount($param)
    {
        $data = $this->db->query("UPDATE $this->table set trangthai = '1' where username = '$param'");
        return $data;
    }
    
    
    function saveData($param, $condition)
    {
        $data = $this->db->insert($this->table, $param);
        if(!$data){
            return $data;
        }
        $updateUsernameCustomer = $this->db->update("khachhang", ["username" => $param["username"]], $condition);
         return $updateUsernameCustomer;

    }
    function deleteAccount($param)
    {
        $makhachhang = $param['makhachhang'];
        $data =$this->db->delete("khachhang_sdt", " makhachhang = '$makhachhang' ");
        $data = $this->db->delete("khachhangsi", " makhachhang = '$makhachhang' ");
        $data = $this->db->delete("khachhangle", " makhachhang = '$makhachhang' ");
        $data = $this->db->delete("khachhang", " makhachhang = '$makhachhang' ");
        if($param['status']==1)
        {
            $condition = " username = '".$param['email']."' "; 
            $data = $this->db->delete($this->table, $condition);
        }
        return $data;
    }
    

}
?>