<?php 
class Cargo extends Controller{
    private $cargoModel;
    public function __construct() {
       $this->cargoModel = $this->model('CargoModel'); 
    }
    public function index() {
      $dataProduct = $this->cargoModel->getList();
      $this->data['sub_content']['cargoList'] = $dataProduct; 
      $this->data['content'] = 'cargoes/index';
      $this->render('layouts/admin/admin_layout',  $this->data);
  }
  public function getListCargo(){
    $arr = $this->cargoModel->getListCargoId();
    echo json_encode($arr);
  }
  public function post_cargo() {
    $request = new Request();
    if($request->getMethod() == 'post')
    {
      if(isset($_POST['action']))
      {
        if($_POST['action'] == "update")
        {
          $param = [
            "mahanghoa" => $_POST['mahanghoa'],
            "tenhanghoa" => $_POST['tenhanghoa'],
            "manhomhang" => $_POST['manhomhang'],
            "trongluong" => $_POST['trongluong'],
          ];
          $condition = "hanghoa.mahanghoa = '".$param['mahanghoa']."'";
          $check = $this->cargoModel->updateData($param,$condition);
          echo json_encode($check);
        }
        else if($_POST['action'] == "insert")
        {
          $param = [
            "mahopdong" => $_POST['mahopdong'],
            "tenhanghoa" => $_POST['tenhanghoa'],
            "manhomhang" => $_POST['manhomhang'],
            "trongluong" => $_POST['trongluong'],
          ];
          $check = $this->cargoModel->insertData($param);

        }
        else if($_POST["action"] == "delete")
        {
          $condition = "mahanghoa = '".$_POST['mahanghoa']."'"; 
          $check = $this->cargoModel->deleteData($condition);       
        }
        else if($_POST['action'] == "search")
        {
          $arrResult = $this->cargoModel->searchDataById($_POST['mahanghoa']); 
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
        $returnData = [];
        if(isset($_POST['typeGetData']))
        {
          if($_POST['typeGetData']=='insert')
          {
            $returnData = $this->cargoModel->getListNhomHang();
          }
          else if($_POST['typeGetData']=='change')
          {      
            $data = $_POST['id'];
            $returnData = $this->cargoModel->getChangeDataById($data);
          }
        }
        else {
          $data = $_POST['id'];
          $returnData = $this->cargoModel->getDataById($data);
        }
        echo json_encode($returnData);
      }
    }
  }
  
}