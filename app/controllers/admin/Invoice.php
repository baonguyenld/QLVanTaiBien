<?php 
class Invoice extends Controller{
    private $invoiceModel;
    public function __construct() {
       $this->invoiceModel = $this->model('InvoiceModel'); 
    }

    public function index() {
      $dataProduct = $this->invoiceModel->getList();
      $this->data['sub_content']['invoiceList'] = $dataProduct; 
      $this->data['content'] = 'invoices/index';
      $this->render('layouts/admin/admin_layout',  $this->data);
  }
  public function getListInvoice(){
    $arr = $this->invoiceModel->getListInvoiceId();
    echo json_encode($arr);
  }
  public function post_invoice() {
    $request = new Request();
    if($request->getMethod() == 'post')
    {
      if(isset($_POST['action']))
      {
        if($_POST['action'] == "update")
        {
          $param = [
            "mavandon" => $_POST['mavandon'],
            "mahoadon" => $_POST['mahoadon'],
            "tongtien" => $_POST['tongtien'],
            "trangthai" => $_POST['trangthai']
          ];

          $condition = "hoadon.mahoadon = '".$param['mahoadon']."'";
          $check = $this->invoiceModel->updateData($param,$condition);
        }
        else if($_POST["action"] == "insert")
        {
          $param = [
            "mavandon" => $_POST['mavandon'],
            "ngaylaphoadon" => $_POST['ngaylaphoadon'],
            "trangthai" => $_POST['trangthai']
          ];
          $check = $this->invoiceModel->insertData($param);
          // echo json_encode($check);
        }
        else if($_POST["action"] == "delete")
        {
          $condition = "mahoadon = '".$_POST['mahoadon']."'"; 
          $check = $this->invoiceModel->deleteData($condition);       
        }
        else if($_POST['action'] == "search")
        {
          $arrResult = $this->invoiceModel->searchDataById($_POST['mahoadon']); 
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
        $returnData = $this->invoiceModel->getDataById($data);
        echo json_encode($returnData);
      }
    }
  }
  
}