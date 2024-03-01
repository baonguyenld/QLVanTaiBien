<?php 
class Contract extends Controller{
    private $contractModel;
    public function __construct() {
       $this->contractModel = $this->model('ContractModel'); 
    }

    public function index() {
      $dataProduct = $this->contractModel->getList();
      $this->data['sub_content']['contractList'] = $dataProduct; 
      $this->data['sub_content']['seaportList'] =  $this->contractModel->getListSeaport(); 
      $this->data['content'] = 'contracts/index';
      $this->render('layouts/admin/admin_layout',  $this->data);

  }
  public function getListContract(){
    $arr = $this->contractModel->getListContractId();
    echo json_encode($arr);
  }
  public function post_contract() {
    $request = new Request();
    if($request->getMethod() == 'post')
    {
      if(isset($_POST['action']))
      {
        if($_POST['action'] == "update")
        {
          $param = [
            "mahopdong" => $_POST['mahopdong'],
            "status" => $_POST['status'],
            "noidung" => $_POST['noidung']
          ];

          $condition = "mahopdong = '".$param['mahopdong']."'";
          $check = $this->contractModel->updateData($param,$condition);
        }
        else if($_POST["action"] == "insert")
        {
          $param = [
            "makhachhang" => $_POST['makhachhang'],
            "ngaylap" => $_POST['ngaylap'],
            "status" => $_POST['status'],
            "noidung" =>  $_POST['noidung']
          ];
          $check = $this->contractModel->insertData($param);
        }
        else if($_POST["action"] == "delete")
        {
          $condition = "mahopdong = '".$_POST['mahopdong']."'"; 
          $check = $this->contractModel->deleteData($condition);       
        }
        else if($_POST["action"] == "report")
        {
          $param = [
            "khachhang" => $_POST['khachhang'],
            "tungay" => $_POST['tungay'],
            "denngay" => $_POST['denngay'],
            "trangthai" => $_POST['trangthai']
          ];      
          $check = $this->contractModel->exportData($param);  
          echo json_encode($check);

        }
        else if($_POST['action'] == "search")
        {
          $arrResult = $this->contractModel->searchData(); 
          if(!empty($arrResult))
          {
            foreach($arrResult as $key => $value)
            {
              $arrResult[$key]["webroot"] = __WEB_ROOT;
            }
          }
          echo json_encode($arrResult); 
        }
      }
      else {
        $data = $_POST['id'];        $returnData = $this->contractModel->getDataById($data);
        echo json_encode($returnData);
      }
    }
  }
}