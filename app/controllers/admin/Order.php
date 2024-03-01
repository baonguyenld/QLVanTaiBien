<?php 
class Order extends Controller{
    private $orderModel;
    public function __construct() {
       $this->orderModel = $this->model('OrderModel'); 
    }

    public function index() {
      $dataProduct = $this->orderModel->getList();
      $this->data['sub_content']['orderList'] = $dataProduct; 
      $this->data['content'] = 'orders/index';
      $this->render('layouts/admin/admin_layout',  $this->data);
  }

  public function getListOrder(){
    $arr = $this->orderModel->getListOrderId();
    echo json_encode($arr);
  }
  public function post_order() {
    $request = new Request();
    if($request->getMethod() == 'post')
    {
      if(isset($_POST['action']))
      {
        if($_POST['action'] == "update")
        {
          $param = [
            "mahopdong" => $_POST['mahopdong'],
            "mavandon" => $_POST['mavandon'],
            "tennguoinhan" => $_POST['tennguoinhan'],
            "diachinhan" => $_POST['diachinhan'],
            "machuyentau" => $_POST['machuyentau'],
            "tongcontainer" => $_POST['tongcontainer'],
          ];
          $arraycontainer = (isset($_POST['arrcontainer'])?$_POST['arrcontainer']:[]);
          $condition = " mavandon = '".$param['mavandon']."' ";
          $check = $this->orderModel->updateData($param,$arraycontainer,$condition);
        }
        else if($_POST["action"] == "insert")
        {
          $param = [
            "tennguoinhan" => $_POST['tennguoinhan'],
            "mahopdong" => $_POST['mahopdong'],
            "ngaylap" => date("Y-m-d"),
            "diachinhan" => $_POST['diachinhan'],
            "machuyentau" => (empty($_POST['machuyentau'])?null:$_POST['machuyentau']),
            "tongcontainer" => $_POST['tongcontainer'],
          ];
          $arraycontainer = (isset($_POST['arrcontainer'])?$_POST['arrcontainer']:[]);
          $check = $this->orderModel->insertData($param, $arraycontainer);

        }
        else if($_POST["action"] == "delete")
        {
          $condition = "mavandon = '".$_POST['mavandon']."'"; 
          $check = $this->orderModel->deleteData($_POST['mavandon'],$condition);       
        }
        else if($_POST['action'] == "search")
        {
          $arrResult = $this->orderModel->searchDataById($_POST['mahopdong']); 
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
        if(isset($_POST["typeGetData"]))
        {
          if($_POST["typeGetData"]=="containerData")
          {
            $data = $this->orderModel->getListContainer();
            echo json_encode($data);
          }
          else  if($_POST["typeGetData"]=="changeContainerData")
          {
            $data = $_POST['id'];
            $returnData = $this->orderModel->getDataById($data);
            $returnData['listContainer'] = $this->orderModel->getListContainerById($data);
            echo json_encode($returnData);
          }
          else  if($_POST["typeGetData"]=="deleteContainerData")
          {
            $data = $_POST['id'];
            $returnData = $this->orderModel->getDataById($data);
            $returnData['listContainer'] = $this->orderModel->getListContainerOfOrder($data);
            echo json_encode($returnData);
          }
        }
        else {
          $data = $_POST['id'];
          $returnData = $this->orderModel->getDataById($data);
          echo json_encode($returnData);
        }

      }
    }
  }
}