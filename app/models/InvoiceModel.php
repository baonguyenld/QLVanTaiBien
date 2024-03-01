<?php 
class InvoiceModel extends Model{
    private $table = "hoadon";
    function getList(){
        $data = $this->db->query("SELECT * FROM $this->table")->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($data)){
            for($i = 0; $i<count($data); $i++){
                $date=date_create($data[$i]["ngaylaphoadon"]);
                $date = date_format($date,"d/m/Y");
                $data[$i]["ngaylaphoadon"] =  $date;
            }
        }
        return $data;
    }
    function searchDataById($id){
        $data = $this->db->query("SELECT * FROM hoadon  where mahoadon = '$id'")->fetchAll(PDO::FETCH_ASSOC);
          if(!empty($data)){
            for($i = 0; $i<count($data); $i++){
                $date=date_create($data[$i]["ngaylaphoadon"]);
                $date = date_format($date,"d/m/Y");
                $data[$i]["ngaylaphoadon"] =  $date;
            }
        }
        return $data;
    }
     function setTable(){
        return $this->table;
    }   
     function setField(){
        return '*';
    }
    function getDataById($id){
        $data = $this->db->query("SELECT * FROM $this->table where hoadon.mahoadon = '$id'")->fetch(PDO::FETCH_ASSOC);
        if(!empty($data)){
            $date=date_create($data["ngaylaphoadon"]);
            $date = date_format($date,"d/m/Y");
            $data["ngaylaphoadon"] =  $date;
        }
        return $data;
    }
    function updateData($param, $condition){
        $data = $this->db->update($this->table, $param, $condition);
     
    }
    function deleteData($condition)
    {
        $data = $this->db->delete($this->table, $condition);
    }
    function generateOrderCode($mavandon) {
        $currentDate = date('Ymd');
        $baseCode = strtoupper(substr($mavandon, 0, 3) . substr($currentDate, 2, 4));
        $uniqueCode = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3);
        $mavandon = $baseCode . $uniqueCode;
        return $mavandon;
    }
    function insertData($param)
    {
        $param['mahoadon'] = $this->generateOrderCode($param['mavandon']);
        $cang = $this->db->query("select macangdi, macangden from vandon where mavandon = '".$param['mavandon']."'")->fetch(PDO::FETCH_ASSOC);
        $khoangcach1 = $cang['macangdi']." - ".$cang['macangden'];
        $khoangcach2 = $cang['macangden']." - ".$cang['macangdi'];
        $khoangcach = "'$khoangcach1'" .", " . "'$khoangcach2'";
        $danhsachcontainer = $this->db->query("select maloaicontainer, manhomhang from container join hanghoa on container.macontainer = hanghoa.macontainer where mavandon = '".$param['mavandon']."'")->fetchAll(PDO::FETCH_ASSOC);
        $sum = 0;
        for($i= 0; $i<count($danhsachcontainer) ; $i++)
        {
            $gia = $this->db->query("select gia from banggia where maloai = '".$danhsachcontainer[$i]['maloaicontainer']."' and manhomhang = '".$danhsachcontainer[$i]['manhomhang']."' and khoangcach in ($khoangcach)")->fetch(PDO::FETCH_ASSOC);
            if(!empty($gia))
            {
                $sum += $gia["gia"];
            }
        }
        $param['tongtien'] = $sum;
        $data = $this->db->insert($this->table, $param);
    }
    function getListInvoiceId(){
        $data = $this->db->query("SELECT mahoadon from hoadon ")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

}
?>