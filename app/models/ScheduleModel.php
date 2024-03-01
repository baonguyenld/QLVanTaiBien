<?php 
class ScheduleModel extends Model{
    private $table = "lichtrinh";

    function getList(){
        $data = $this->db->query("SELECT lichtrinh.malichtrinh, lichtrinh.tenlichtrinh, GROUP_CONCAT(danhsachcang.macang SEPARATOR ' - ') AS danhsachcang, ngayxuatphat
        FROM lichtrinh
        LEFT JOIN danhsachcang ON lichtrinh.malichtrinh = danhsachcang.malichtrinh
        GROUP BY lichtrinh.malichtrinh
            ")->fetchAll(PDO::FETCH_ASSOC);
 
        if(!empty($data)){
            for($i = 0; $i<count($data); $i++){
                $date=date_create($data[$i]["ngayxuatphat"]);
                $date = date_format($date,"d/m/Y");
                $data[$i]["ngayxuatphat"] =  $date;
            }
        }
        return $data;
    }
     function setTable(){
    }   
     function setField(){
    }

    function getListSeaport()
    {
        $data = $this->db->query("SELECT macang,tencang from cang")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function getListScheduleId(){
        $data = $this->db->query("SELECT malichtrinh from lichtrinh ")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function getListSeaportById($id)
    {
        $data = $this->db->query("SELECT macang from danhsachcang where malichtrinh = '".$id."'")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function generateScheduleCode($tenlichtrinh)
    {
        $currentTimeMillis = round(microtime(true) * 1000);
        $tenlichtrinh = explode(" - ", $tenlichtrinh);
        $prefixSheduleCode = '';
        foreach($tenlichtrinh as $code)
        {
            $prefixSheduleCode .= $code[0];
        }
        $schedule = $prefixSheduleCode. substr($currentTimeMillis,-8);
        return $schedule;
    }
    function insertData($param, $listseaport)
    {
        $param['malichtrinh'] = $this->generateScheduleCode($param['tenlichtrinh']);
        $this->db->insert($this->table, $param);
        foreach($listseaport as $seaport)
        {
            $this->db->insert("danhsachcang", ["malichtrinh" => $param['malichtrinh'], "macang" => $seaport]);
        }
    }
    // function searchDataById($id){
    //     $data = $this->db->query("SELECT mavandon, tenkhachhang, ngaylap,sdt,email,status,noidung FROM vandon join khachhang on vandon.makhachhang = khachhang.makhachhang
    //     join khachhang_sdt on khachhang.makhachhang = khachhang_sdt.makhachhang where vandon.mavandon = '$id'")->fetchAll(PDO::FETCH_ASSOC);
    //       if(!empty($data)){
    //         for($i = 0; $i<count($data); $i++){
    //             $date=date_create($data[$i]["ngaylap"]);
    //             $date = date_format($date,"d/m/Y");
    //             $data[$i]["ngaylap"] =  $date;
    //         }
    //     }
    //     return $data;
    // }
    public function getDataById($id)
    {
        $data = $this->db->query("SELECT * from lichtrinh where malichtrinh = '".$id."'")->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    function updateData($param, $condition, $listseaport, $id){
        $data = $this->db->update($this->table, $param, $condition);
        $this->db->delete("danhsachcang", $condition);
        foreach($listseaport as $seaport)
        {
            $this->db->insert("danhsachcang", ["malichtrinh" => $id, "macang" => $seaport]);
        }
    }
    function deleteData($condition)
    {
        $this->db->delete("danhsachcang", $condition);
        $this->db->query("update chuyentau set malichtrinh = null where $condition");
        $this->db->delete($this->table, $condition);
    }

}
?>