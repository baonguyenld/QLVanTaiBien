<?php 
class ContainerModel extends Model{
    private $table = "Container";
    function getList(){
        $data = $this->db->query("SELECT container.macontainer,tenloai,thetichtoida,thetichhienchua,trongluonghientai FROM $this->table join loaicontainer on loaicontainer.maloaicontainer = container.maloaicontainer")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
     function setTable(){
        return $this->table;
    }   
     function setField(){
        return '*';
    }
    function getChangeDataById($id){
        $data["container"] = $this->db->query("SELECT container.macontainer,tenloai,trongluonghientai,container.maloaicontainer, thetichtoida,thetichhienchua FROM container join loaicontainer on loaicontainer.maloaicontainer = container.maloaicontainer where container.macontainer = '$id'")->fetch(PDO::FETCH_ASSOC);
        $data["typecontainer"] = $this->getListContainer();
        return $data;
    }
    function getListContainer(){
        return $this->db->query("SELECT * FROM loaicontainer")->fetchAll(PDO::FETCH_ASSOC);
    }
    function getDataById($id){
        $data = $this->db->query("SELECT container.macontainer,tenloai,thetichtoida,thetichhienchua,trongluonghientai FROM $this->table join loaicontainer on loaicontainer.maloaicontainer = container.maloaicontainer where container.macontainer = '$id'")->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    function updateData($param, $condition){
        $arr = $param['arrmahanghoa'];
        if(!empty($arr))
        {
            foreach( $arr as $value ){
                $this->db->query("UPDATE hanghoa set macontainer = '".$param['macontainer']."' where mahanghoa = '$value'");
            }
        }
        $this->db->query("UPDATE hanghoa SET macontainer = null WHERE macontainer = '".$param['macontainer']."' ".(empty($arr)?"":"AND mahanghoa NOT IN ('" . implode("','", $arr) . "')"));
        unset($param['arrmahanghoa']);
        $data = $this->db->update($this->table, $param, $condition);
        return $data;
    }

    function generateContainerCode()
    {
        $currentTimeMillis = round(microtime(true) * 1000);
  
        $shippingCode = "C" .date("dmy").substr($currentTimeMillis,-3);

        return $shippingCode;
    }
    function insertData($param)
    {
        $arr = $param['arrmahanghoa'];
        unset($param['arrmahanghoa']);
        $param['macontainer']=$this->generateContainerCode();
        $data = $this->db->insert($this->table, $param);
        if(!empty($arr))
        {
            foreach( $arr as $value ){
                $this->db->query("UPDATE hanghoa set macontainer = '".$param['macontainer']."' where mahanghoa = '$value'");
            }
        }
    }
    function deleteData($param,$condition)
    {
        if(!empty($param))
        {
            $this->db->query("UPDATE hanghoa set macontainer = null where macontainer = '".$_POST['macontainer']."'");

        }
        $data = $this->db->delete($this->table, $condition);
    }
    function searchDataById($id){
        $data = $this->db->query("SELECT macontainer,tenloai,thetichtoida,thetichhienchua,trongluonghientai FROM container join loaicontainer on container.maloaicontainer = loaicontainer.maloaicontainer where macontainer = '$id'")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function getListCargo($id)
    {
        return  $this->db->query("SELECT mahanghoa,tennhomhang,trongluong,macontainer from hanghoa join nhomhang on nhomhang.manhomhang = hanghoa.manhomhang where macontainer = '$id' or macontainer is null")->fetchAll(PDO::FETCH_ASSOC);
    }
    function getListEmptyCargo()
    {
        return  $this->db->query("SELECT mahanghoa,tennhomhang,trongluong,macontainer from hanghoa join nhomhang on nhomhang.manhomhang = hanghoa.manhomhang where  macontainer is null")->fetchAll(PDO::FETCH_ASSOC);

    }
    function getListNotEmptyCargo($id)
    {
        return  $this->db->query("SELECT mahanghoa,tennhomhang,trongluong,macontainer from hanghoa join nhomhang on nhomhang.manhomhang = hanghoa.manhomhang where  macontainer = '$id'")->fetchAll(PDO::FETCH_ASSOC);

    }
    function getListContainerId(){
        $data = $this->db->query("SELECT macontainer from container ")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}
?>