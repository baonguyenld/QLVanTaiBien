<?php 
class Container extends Controller{
    private $containerModel;
    public function __construct() {
       $this->containerModel = $this->model('ContainerModel'); 
    }
    public function index() {
      $dataProduct = $this->containerModel->getList();
      $this->data['sub_content']['containerList'] = $dataProduct; 
      $this->data['content'] = 'containers/index';
      $this->render('layouts/admin/admin_layout',  $this->data);
  }
  public function getListContainerId(){
    $arr = $this->containerModel->getListContainerId();
    echo json_encode($arr);
  }
  public function post_container() {
    $request = new Request();
    if($request->getMethod() == 'post')
    {
      if(isset($_POST['action']))
      {
        if($_POST['action'] == "update")
        {
          $param = [
            "macontainer" => $_POST['macontainer'],
            "maloaicontainer" => $_POST['maloaicontainer'],
            "thetichtoida" => $_POST['thetichtoida'],
            "trongluonghientai" => $_POST['trongluonghientai'],
            "thetichhienchua" => $_POST['thetichhienchua'],
            "arrmahanghoa" =>  $_POST['arrmahanghoa']
          ];

          $condition = "container.macontainer = '".$param['macontainer']."'";
          $check = $this->containerModel->updateData($param,$condition);
        }
        else if($_POST['action'] == "insert")
        {
          $param = [
            "maloaicontainer" => $_POST['maloaicontainer'],
            "thetichtoida" => $_POST['thetichtoida'],
            "trongluonghientai" => $_POST['trongluonghientai'],
            "thetichhienchua" => $_POST['thetichhienchua'],
            "arrmahanghoa" =>  $_POST['arrmahanghoa']
          ];
          $check = $this->containerModel->insertData($param);
        }
        else if($_POST["action"] == "delete")
        {
          $condition = "macontainer = '".$_POST['macontainer']."'"; 
          $check = $this->containerModel->deleteData($_POST['macontainer'],$condition);       
        }
        else if($_POST['action'] == "search")
        {
          $arrResult = $this->containerModel->searchDataById($_POST['macontainer']); 
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
            $returnData = $this->containerModel->getListContainer();
          }
          else if($_POST['typeGetData']=='change')
          {      
            $data = $_POST['id'];
            $returnData = $this->containerModel->getChangeDataById($data);
          }
          else if($_POST['typeGetData'] == "cargoData")
          {
            if(!empty($_POST['macontainer']))
            {       
              if(!empty($_POST['flag']) && $_POST['flag'] =='delete' )
              {
                $returnData = $this->containerModel->getListNotEmptyCargo($_POST['macontainer']);
              }
              else {
                $returnData = $this->containerModel->getListCargo($_POST['macontainer']);
              }
            }
       
            else
            {
              $returnData = $this->containerModel->getListEmptyCargo();
            }
          }
       
        }
        else {
          $data = $_POST['id'];
          $returnData = $this->containerModel->getDataById($data);
        }
        echo json_encode($returnData);
      }
    }
  }
}