<?php 
class Ship extends Controller{
    private $shipModel;
    public function __construct() {
       $this->shipModel = $this->model('ShipModel'); 
    }

    public function index() {
      $dataProduct = $this->shipModel->getList();
      $this->data['sub_content']['shipList'] = $dataProduct; 
      $this->data['content'] = 'ships/index';
      $this->render('layouts/admin/admin_layout',  $this->data);
  }
  public function getListShip(){
    $arr = $this->shipModel->getListShipId();
    echo json_encode($arr);
  }
  public function getListMaxWeight(){
    $arr = $this->shipModel->getListMaxWeight();
    echo json_encode($arr);
  }
  public function getListMaxVolumn(){
    $arr = $this->shipModel->getListMaxVolumn();
    echo json_encode($arr);
  }
  public function post_ship() {
    $request = new Request();
    if($request->getMethod() == 'post')
    {
      if(isset($_POST['action']))
      {
        if($_POST['action'] == "update")
        {
          $param = [
            "tentau" => $_POST['tentau'],
            "matau" => $_POST['matau'],
            "trongluongtoida" => $_POST['trongluongtoida'],
            "trongluonghienchua" => $_POST['trongluonghienchua'],
            "thetichtoida" => $_POST['thetichtoida'],
            "thetichhienchua" => $_POST['thetichhienchua']
          ];

          $condition = "tau.matau = '".$param['matau']."'";
          $check = $this->shipModel->updateData($param,$condition);
        }
        else if($_POST['action'] == "insert")
        {
          $param = [
            "tentau" => $_POST['tentau'],
            "matau" => $_POST['matau'],
            "trongluongtoida" => $_POST['trongluongtoida'],
            "trongluonghienchua" => $_POST['trongluonghienchua'],
            "thetichtoida" => $_POST['thetichtoida'],
            "thetichhienchua" => $_POST['thetichhienchua']
          ];
          $check = $this->shipModel->insertData($param);
        }
        else if($_POST['action'] == "delete")
        {
          $condition = "matau = '".$_POST['matau']."'"; 
          $check = $this->shipModel->deleteData($condition);        
        }
        else if($_POST['action'] == "search")
        {
          $arrResult = $this->shipModel->searchDataById($_POST['matau']); 
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
        $data = $_POST['id'];
        $returnData = $this->shipModel->getDataById($data);
        echo json_encode($returnData);
      }
    }
  }
}