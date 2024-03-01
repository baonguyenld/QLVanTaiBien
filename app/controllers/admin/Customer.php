<?php 
class Customer extends Controller{
    private $customerModel;
    public function __construct() {
       $this->customerModel = $this->model('CustomerModel'); 
    }
    public function index() {
      $dataProduct = $this->customerModel->getList();
      $this->data['sub_content']['customerList'] = $dataProduct; 
      $this->data['content'] = 'customers/index';
      $this->render('layouts/admin/admin_layout',  $this->data);
  }
  public function getList(){
    $arr = $this->customerModel->getList();
    echo json_encode($arr);
  }
  public function getListCustomer(){
    $arr = $this->customerModel->getListCustomerId();
    echo json_encode($arr);
  }
  public function post_customer() {
    $request = new Request();
    if($request->getMethod() == 'post')
    {
      if(isset($_POST['action']))
      {
        if($_POST['action'] == "update")
        {
          $param = [
            "makhachhang" => $_POST['makhachhang'],
            "tenkhachhang" => $_POST['tenkhachhang'],
            "sdt" => $_POST['sdt'],
            "email" => $_POST['email'],
            "diachi" => $_POST['diachi'],
            "macongty" => $_POST["macongty"],
            "cccd" => $_POST["cccd"],
            "type" => $_POST['type'],
            "oldEmail" => $_POST["oldEmail"],
          ];
          $condition = "makhachhang = '".$param['makhachhang']."'";
           $this->customerModel->updateData($param,$condition);
        }
        else if($_POST['action'] == "insert")
        {
          $param = [
            "tenkhachhang" => $_POST['tenkhachhang'],
            "sdt" => $_POST['sdt'],
            "email" => $_POST['email'],
            "diachi" => $_POST['diachi'],
            "type" => $_POST['type'],
            "cccd" => $_POST["cccd"],
            "username" => $_POST['email'],
            "macongty" => $_POST["macongty"],
            "password" => $this->generateRandomPassword(8)
          ];
          $check = $this->customerModel->insertData($param);
        }
        else if($_POST['action'] == "delete")
        {
          $condition = "makhachhang = '".$_POST['makhachhang']."'"; 
          $conditionAccount = "username = '".$_POST['email']."'"; 
          $check = $this->customerModel->deleteData($condition, $conditionAccount);        
        }
        else if($_POST['action'] == "search")
        {
          $arrResult = $this->customerModel->searchDataById($_POST['makhachhang']); 
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
        $returnData = $this->customerModel->getDataById($data);
        echo json_encode($returnData);
      }
    }
  }
  function generateRandomPassword($length = 12) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $charLength = strlen($characters);
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, $charLength - 1)];
    }

    return $password;
}
  
}