<?php 
class HomeModel extends Model{
    private $table = "Taikhoan";

     function setTable(){
        return $this->table;
    }   
     function setField(){
        return '*';
    }
    function getAccount($username, $password, $type){
        $data = $this->db->query("SELECT trangthai, username, password, type FROM $this->table where username = '$username' and password = '$password' and type = '$type'")->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    function getMilis($length = -3)
    {
        $time = microtime(true);
        $milliseconds = round($time * 1000);
        return substr($milliseconds, $length);
    }

    function getListContractOfCustomer()
    {
        $data = $this->db->query("SELECT hopdong.mahopdong, hopdong.ngaylap, sdt, email, hopdong.status, diachinhan from hopdong join khachhang on hopdong.makhachhang = khachhang.makhachhang left join khachhang_sdt on khachhang_sdt.makhachhang = khachhang.makhachhang left join vandon on vandon.mahopdong = hopdong.mahopdong where email = '".$_SESSION['user_client']."' group by (hopdong.mahopdong)")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function getListCangDi()
    {
        $data = $this->db->query("SELECT macang from cang")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function getListCangDen()
    {
        $data = $this->db->query("SELECT macang from cang")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function sendInfoToSever($param){
        // $password = $this->generateRandomPassword(8);
        // $taikhoan = [
        //     'username' => $param['email'],
        //     'password' => $password,
        //     'type' => "kh",
        //     'trangthai' => 0
        // ];
        // $account = $this->db->insert("taikhoan", $taikhoan);
        $sdt = trim($param['sdt']);
        $cmnd = trim($param['cccd']);
        $macongty = trim($param['macongty']);
        unset($param['sdt']);
        unset($param['cccd']);
        unset($param['macongty']);
        $makhachhang = (empty($cmnd)?"CT".substr($macongty,-3):"CN".substr($cmnd,-3)).substr($sdt,-3).$this->getMilis(-2);
        $param['makhachhang'] = $makhachhang;
        $customer = $this->db->insert("khachhang", $param);
        if(empty($cmnd))
        {
            $khachhangsi = $this->db->insert("khachhangsi", ["makhachhang" => $makhachhang,"macongty" => $macongty]);
        }
        else {
            $khachhangle = $this->db->insert("khachhangle", ["makhachhang" => $makhachhang,"cmnd" => $cmnd]);

        }

        $khachhang_sdt = $this->db->insert("khachhang_sdt", ["makhachhang" => $makhachhang, "sdt" => $sdt] );
    }
    function generateContractId($makhachhang)
    {

    }
    function sendRequestService($param)
    {
        if(isset($_SESSION['user_client']))
        {
            $email = $_SESSION['user_client'];
            $data= $this->db->query("SELECT makhachhang from khachhang where username = '$email'")->fetch(PDO::FETCH_ASSOC);
            if($data)
            {
                $makhachhang = $data['makhachhang'];
                $param['makhachhang'] = $makhachhang;
                $param['status'] = 0;
                $param['ngaylap'] = date('Y-m-d');
                $param['mahopdong'] = $this->generateContractCode($makhachhang);
                $this->db->insert("hopdong", $param);
            }
           return $param;
        }
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