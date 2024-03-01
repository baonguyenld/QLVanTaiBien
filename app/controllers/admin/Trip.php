<?php 
class Trip extends Controller{
    private $tripModel;
    public function __construct() {
       $this->tripModel = $this->model('TripModel'); 
    }

    public function index() {
      $dataProduct = $this->tripModel->getList();
      $this->data['sub_content']['tripList'] = $dataProduct; 
      $this->data['content'] = 'trips/index';
      $this->render('layouts/admin/admin_layout',  $this->data);
  }
  public function getListTrip(){
    $arr = $this->tripModel->getListTripId();
    echo json_encode($arr);
  }
  public function post_trip() {
    $request = new Request();
    if($request->getMethod() == 'post')
    {
      if(isset($_POST['action']))
      {
        if($_POST['action'] == "update")
        {
          $param = [
            "malichtrinh" => $_POST['malichtrinh'],
            "matau" => $_POST['matau'],
            "machuyentau" => $_POST['machuyentau'],
            "thoigiantrihoan" => $_POST['thoigiantrihoan']
          ];

          $condition = "chuyentau.machuyentau = '".$param['machuyentau']."'";
          $check = $this->tripModel->updateData($param,$condition);
        }
        else if($_POST['action'] == "insert")
        {
          $param = [
            "malichtrinh" => $_POST['malichtrinh'],
            "matau" => $_POST['matau'],
            "thoigiantrihoan" => $_POST['thoigiantrihoan']
          ];
          $check = $this->tripModel->insertData($param);
        }
        else if($_POST['action'] == "delete")
        {
          $condition = "machuyentau = '".$_POST['machuyentau']."'"; 
          $check = $this->tripModel->deleteData($condition);        
          echo json_encode(["message" => $check]);
        }
        else if($_POST['action'] == "search")
        {
          $arrResult = $this->tripModel->searchDataById($_POST['machuyentau']); 
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
        $returnData = $this->tripModel->getDataById($data);
        echo json_encode($returnData);
      }
      }
}
}