<?php 
class Seaport extends Controller{
    private $seaportModel;
    public function __construct() {
       $this->seaportModel = $this->model('SeaportModel'); 
    }

    public function index() {
      $dataProduct = $this->seaportModel->getList();
      $this->data['sub_content']['seaportList'] = $dataProduct; 
      $this->data['content'] = 'ports/index';
      $this->render('layouts/admin/admin_layout',  $this->data);
  }

  public function getListSeaport()
  {
    $data = $this->seaportModel->getListSeaportId();
    echo json_encode($data);
  }
  public function post_seaport() {
    $request = new Request();
    if($request->getMethod() == 'post')
    {
      if(isset($_POST['action']))
      {
        if($_POST['action'] == "update")
        {
          $param = [
            "macang" => $_POST['macang'],
            "tencang" => $_POST['tencang'],
            "quocgia" => $_POST['quocgia'],
            "trangthai" => $_POST['trangthai'],
            "thetichtoida" => $_POST['thetichtoida'],
            "thetichhienchua" => $_POST['thetichhienchua']
          ];

          $condition = "cang.macang = '".$param['macang']."'";
          $check = $this->seaportModel->updateData($param,$condition);
        }
        else if($_POST['action'] == "insert")
        {
          $param = [
            "macang" => $_POST['macang'],
            "tencang" => $_POST['tencang'],
            "quocgia" => $_POST['quocgia'],
            "trangthai" => $_POST['trangthai'],
            "thetichtoida" => $_POST['thetichtoida'],
            "thetichhienchua" => $_POST['thetichhienchua']
          ];
          $check = $this->seaportModel->insertData($param);
        }
        else if($_POST['action'] == "delete")
        {
          $condition = "macang = '".$_POST['macang']."'"; 
          $check = $this->seaportModel->deleteData($condition);        
        }
        else if($_POST['action'] == "search")
        {
          $arrResult = $this->seaportModel->searchDataById($_POST['macang']); 
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
        $returnData = $this->seaportModel->getDataById($data);
        echo json_encode($returnData);
      }
    }
  }
  
}