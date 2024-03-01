<?php 
class ContractModel extends Model{
    private $table = "hopdong";
    private $trangthai = "status";
    function getList(){
        $data = $this->db->query("SELECT mahopdong,tenkhachhang,ngaylap,sdt,email,$this->trangthai,noidung FROM hopdong join khachhang on hopdong.makhachhang = khachhang.makhachhang
        join khachhang_sdt on khachhang.makhachhang = khachhang_sdt.makhachhang ")->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($data)){
            for($i = 0; $i<count($data); $i++){
                $date=date_create($data[$i]["ngaylap"]);
                $date = date_format($date,"d/m/Y");
                $data[$i]["ngaylap"] =  $date;
                $data[$i]['noidung'] = str_replace('#', '',  $data[$i]['noidung']);
            }
        }
        return $data;
    }


     function setTable(){
    }   
     function setField(){
    }
    function searchData(){
        $data = $this->db->query("SELECT mahopdong, tenkhachhang, ngaylap,sdt,email,status,noidung FROM hopdong join khachhang on hopdong.makhachhang = khachhang.makhachhang
        join khachhang_sdt on khachhang.makhachhang = khachhang_sdt.makhachhang")->fetchAll(PDO::FETCH_ASSOC);
          if(!empty($data)){
            for($i = 0; $i<count($data); $i++){
                $date=date_create($data[$i]["ngaylap"]);
                $date = date_format($date,"d/m/Y");
                $data[$i]["ngaylap"] =  $date;
            }
        }
        return $data;
    }
    public function getListSeaport()
    {
        $data = $this->db->query("select macang from cang")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function getDataById($id)
    {
        $data = $this->db->query("SELECT mahopdong,hopdong.makhachhang,ngaylap,sdt,email,$this->trangthai,noidung FROM hopdong join khachhang on hopdong.makhachhang = khachhang.makhachhang
        join khachhang_sdt on khachhang.makhachhang = khachhang_sdt.makhachhang where hopdong.mahopdong = '$id'")->fetch(PDO::FETCH_ASSOC);
         if(!empty($data)){
             $date=date_create($data["ngaylap"]);
             $date = date_format($date,"d/m/Y");
             $data["ngaylap"] =  $date;
    }
       return $data;
    }
    function updateData($param,$condition){
        $data = $this->db->update($this->table, $param, $condition);
    }
    function deleteData($condition)
    {
        $data = $this->db->delete($this->table, $condition);
    }
    function insertData($param)
    {   

        $param['mahopdong'] = $this->generateContractCode($param['makhachhang']);
        $data = $this->db->insert($this->table, $param);

    }
    function exportData($param)
    {
        $sql = "SELECT mahopdong, makhachhang, ngaylap, status from hopdong where ".(empty($param['khachhang'])?"":"makhachhang = '".$param['khachhang']."' and")." ngaylap BETWEEN '".$param['tungay']."' AND '".$param['denngay']."' and status = '".$param['trangthai']."'";
        $data['record'] = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $data['rowcount'] = $this->db->rowCount();
        if(!empty($data) && !empty($data['record'])){
            foreach($data['record'] as $k => $v){
            $date=date_create($v["ngaylap"]);
            $date = date_format($date,"d/m/Y");
            $data["record"][$k]["ngaylap"] =  $date;
        }
        return $data;
    }}
    function getListContractId(){
        $data = $this->db->query("SELECT mahopdong from hopdong ")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function generateContractCode($customerId) {
        $currentDate = date('Ymd');
        $baseCode = strtoupper(substr($customerId, 0, 3) . substr($currentDate, 2, 4));
        $uniqueCode = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3);
        $contractCode = $baseCode . $uniqueCode;
        return $contractCode;
    }
}
?>