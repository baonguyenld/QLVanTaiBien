<?php 
class Schedule extends Controller{
    private $scheduleModel;
    public function __construct() {
       $this->scheduleModel = $this->model('ScheduleModel'); 
    }

    public function index() {
      $dataProduct = $this->scheduleModel->getList();
      $listSeaport = $this->scheduleModel->getListSeaport();
      $this->data['sub_content']['scheduleList'] = $dataProduct; 
      $this->data['sub_content']['seaportList'] = $listSeaport; 
      $this->data['content'] = 'schedules/index';
      $this->render('layouts/admin/admin_layout',  $this->data);
  }

  public function getListSchedule(){
    $arr = $this->scheduleModel->getList();
    echo json_encode($arr);
  }
  public function getListScheduleId(){
    $arr = $this->scheduleModel->getListScheduleId();
    echo json_encode($arr);
  }


  public function post_schedule() {
    $request = new Request();
    if($request->getMethod() == 'post')
    {
      if(isset($_POST['action']))
      {
        if($_POST['action'] == "update")
        {
          $param = [
            "tenlichtrinh" => $_POST['tenlichtrinh'],
            "ngayxuatphat" => $_POST['ngayxuatphat'],
          ];
          $id = $_POST['malichtrinh'];
          $listseaport = (isset($_POST['listseaport'])?$_POST['listseaport']:[]);
          $condition = " malichtrinh = '".$_POST['malichtrinh']."'";
          $check = $this->scheduleModel->updateData($param, $condition, $listseaport,$id);
        }
        else if($_POST["action"] == "insert")
        {
          $param = [
            "tenlichtrinh" => $_POST['tenlichtrinh'],
            "ngayxuatphat" => $_POST['ngayxuatphat']
          ];
          $listseaport = (isset($_POST['listseaport'])?$_POST['listseaport']:[]);
          $check = $this->scheduleModel->insertData($param,$listseaport);
        }
        else if($_POST["action"] == "delete")
        {
          $condition = "malichtrinh = '".$_POST['malichtrinh']."'"; 
          $check = $this->scheduleModel->deleteData($condition);       
        }
        else if($_POST['action'] == "search")
        {
          $arrResult = $this->scheduleModel->searchDataById($_POST['mahopdong']); 
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
        if(isset($_POST['typeGetData']))
        {
          if($_POST['typeGetData'] == "change")
          {
              $data = $_POST['id'];
              $returnData = $this->scheduleModel->getDataById($data);
              $returnData['listSeaport'] = $this->scheduleModel->getListSeaportById($data);
              echo json_encode($returnData);
          }else  if($_POST['typeGetData'] == "delete")
          {
              $data = $_POST['id'];
              $returnData = $this->scheduleModel->getDataById($data);
              $returnData['listSeaport'] = $this->scheduleModel->getListSeaportById($data);
              echo json_encode($returnData);
          }
        }
        else {
          $data = $_POST['id'];
          $returnData = $this->scheduleModel->getDataById($data);
          echo json_encode($returnData);
      }

      }
    }
  }
}