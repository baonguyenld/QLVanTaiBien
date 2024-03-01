<?php 
class Price extends Controller{
    private $priceModel;
    public function __construct() {
       $this->priceModel = $this->model('PriceModel'); 
    }
    public function index() {
      $dataProduct = $this->priceModel->getList();
      $listLoaiContainer = $this->priceModel->getListContainer();
      $listNhomHang = $this->priceModel->getListNhomHang();
      $listCang = $this->priceModel->getListCang();
      $this->data['sub_content']['priceList'] = $dataProduct; 
      $this->data['sub_content']['listLoaiContainer'] = $listLoaiContainer; 
      $this->data['sub_content']['listNhomHang'] = $listNhomHang; 
      $this->data['sub_content']['listCang'] = $listCang; 
      $this->data['content'] = 'prices/index';
      $this->render('layouts/admin/admin_layout',  $this->data);
  }
  public function getListPrice(){
    $arr = $this->priceModel->getListPriceId();
    echo json_encode($arr);
  }
  public function post_price() {
    $request = new Request();
    if($request->getMethod() == 'post')
    {
      if(isset($_POST['action']))
      {
        if($_POST['action'] == "update")
        {
          $param = [
            "maloai" => $_POST['maloai'],
            "manhomhang" => $_POST['manhomhang'],
            "khoangcach" => $_POST['khoangcach'],
            "gia" => $_POST['gia'],
          ];

          $condition = "mabanggia = '".$_POST['mabanggia']."'";
          $check = $this->priceModel->updateData($param,$condition);
        }
        else if($_POST['action'] == "insert")
        {
          $param = [
            "maloai" => $_POST['maloai'],
            "manhomhang" => $_POST['manhomhang'],
            "khoangcach" => $_POST['khoangcach'],
            "gia" => $_POST['gia'],
          ];
          $check = $this->priceModel->insertData($param);
        }
        else if($_POST['action'] == "delete")
        {
          $condition = "mabanggia = '".$_POST['mabanggia']."'"; 
          $check = $this->priceModel->deleteData($condition);        
        }
        else if($_POST['action'] == "search")
        {
          $arrResult = $this->priceModel->searchDataById($_POST['macang']); 
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
        $returnData = $this->priceModel->getDataById($data);
        echo json_encode($returnData);
      }
    }
  }
}