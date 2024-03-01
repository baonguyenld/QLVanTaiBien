<?php
class OrderModel extends Model
{
    private $table = "vandon";

    function getList()
    {
        $data = $this->db->query("SELECT
            mavandon,
            ngaylap,
            tennguoinhan,
            diachinhan,
            tongcontainer,
            cangdi.tencang AS 'tencangdi',
            cangden.tencang AS 'tencangden'
        FROM
            vandon
        left JOIN
            cang AS cangdi ON vandon.macangdi = cangdi.macang
        left JOIN
            cang AS cangden ON vandon.macangden = cangden.macang")->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($data)) {
            for ($i = 0; $i < count($data); $i++) {
                $date = date_create($data[$i]["ngaylap"]);
                $date = date_format($date, "d/m/Y");
                $data[$i]["ngaylap"] = $date;
            }
        }
        return $data;
    }
    function setTable()
    {
    }
    function setField()
    {
    }
    function deleteData($param,$condition)
    {
        if(!empty($param))
        {
            $this->db->query("UPDATE container set mavandon = null where mavandon = '".$param."'");

        }
        $data = $this->db->delete($this->table, $condition);
    }
    function getListContainerOfOrder($id)
    {
        $data = $this->db->query("SELECT macontainer from container where mavandon = '".$id."'")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function updateData($param,$arraycontainer, $condition){
        $this->db->query("UPDATE container set mavandon = null where mavandon = '".$param['mavandon']."'");
        if(!empty($arraycontainer))
        {
            foreach( $arraycontainer as $value ){
                $this->db->query("UPDATE container set mavandon = '".$param['mavandon']."' where macontainer = '$value'");
            }
        }
        $data = $this->db->update($this->table, $param, $condition);
        return $data;
    }
    function getListContainer()
    {
        $data = $this->db->query("SELECT macontainer from container where mavandon is NULL")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function getListOrderId()
    {
        $data = $this->db->query("SELECT mavandon from vandon ")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
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
    public function getListContainerById($id)
    {
        $data = $this->db->query("SELECT macontainer,mavandon FROM container  where mavandon = '$id' or mavandon is null ")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function getDataById($id)
    {
        $data = $this->db->query("SELECT mavandon,mahopdong,ngaylap,tennguoinhan,machuyentau,diachinhan,tongcontainer FROM vandon  where vandon.mavandon = '$id'")->fetch(PDO::FETCH_ASSOC);
        if (!empty($data)) {
            $date = date_create($data["ngaylap"]);
            $date = date_format($date, "d/m/Y");
            $data["ngaylap"] = $date;
        }
        return $data;
    }
    // function updateData($param){
    //     $data = $this->db->query("UPDATE vandon set  ngaylap ='".$param['ngaylap']."', makhachhang = 
    //     (SELECT makhachhang from khachhang where tenkhachhang = '".$param['tenkhachhang']."'),
    //      status = '".$param['status']."' where mavandon ='".$param['mavandon']."'");     
    // }
    // function deleteData($condition)
    // {
    //     $data = $this->db->delete($this->table, $condition);
    // }
    function generateShippingCode($contractCode )
    {
        $currentTimeMillis = round(microtime(true) * 1000);
        $contractPrefix = substr($contractCode, -5);
  
        $shippingCode = $contractPrefix . substr($currentTimeMillis,-5);

        return $shippingCode;
    }

    function insertData($param, $arraycontainer)
    {
        $listCang = $this->db->query("select noidung from hopdong where mahopdong = '".$param['mahopdong'] ."' ")->fetch(PDO::FETCH_ASSOC);
        preg_match_all('/#(.*?)#/', $listCang['noidung'], $matches);
        $foundTexts = $matches[1];
        $param['macangdi'] = $foundTexts[1];
        $param['macangden'] = $foundTexts[2];
        $param['mavandon'] = $this->generateShippingCode($param['mahopdong']);

        $data = $this->db->query("
        INSERT INTO `vandon`(`mavandon`, `tennguoinhan`, `diachinhan`, `tongcontainer`, `ngaylap`, `machuyentau`, `macangdi`, `macangden`, `mahopdong`) "
        ."VALUES ('".$param['mavandon']."','".$param['tennguoinhan']."','". $param['diachinhan']."','".$param['tongcontainer']."','".$param['ngaylap']."',".(empty($param['machuyentau'])?'null':"'".$param['machuyentau']."'").",'". $param['macangdi']."','". $param['macangden']."','". $param['mahopdong']."')");
        if (!empty($arraycontainer)) {
            foreach ($arraycontainer as $value) {
                $this->db->query("UPDATE container set mavandon = '" . $param['mavandon'] . "' where macontainer = '$value'");
            }
        }
    }
}
?>