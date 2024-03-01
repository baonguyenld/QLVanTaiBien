<?php
    class Account extends Controller{
    private $accountModel;
    public function __construct() {
       $this->accountModel = $this->model('AccountModel'); 
    }
    public function index() {
      $dataProduct = $this->accountModel->getList();
      $this->data['sub_content']['accountList'] = $dataProduct; 
      $this->data['content'] = 'accounts/index';
      $this->render('layouts/admin/admin_layout',  $this->data);
    }
    public function sendmail($param) {
      $emailSender = new EmailSender();
      $emailSender->sendAccountEmail($param);
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
    public function post_account() {
        $request = new Request();
        if($request->getMethod() == 'post')
        {
          if(isset($_POST['email']))
          {
            $contentSendMail = [
              "username" => $_POST['username'],
              "email" => $_POST['email'],
              "password" => $_POST['password']
            ];
            $this->sendmail($contentSendMail);
          }
          else if(isset($_POST['action']))
          {
          
           if($_POST['action'] == "insert")
            {
              $password =$this->generateRandomPassword(8);
              $param = [
                "username" => $_POST['username'],
                "type" => 'kh',
                "trangthai" => 1,
                "password" => $password
              ];
              $contentSendMail = [
                "username" => $_POST['username'],
                "email" => $_POST['username'],
                "password" => $password
              ];
              $data = $this->accountModel->getItemById($param);
              if(empty($data))
              {
                $condition = "makhachhang = '".$_POST['makhachhang']."'";
                $check = $this->accountModel->saveData($param, $condition);
                echo json_encode(["result"=> $contentSendMail]);
              } 
              else {
                echo json_encode(["result"=> "false"]);
              }       
          }
          else if($_POST["action"] == "ban")
          {
            $check = $this->accountModel->banAccount($_POST["accountEmail"]);
            echo json_encode($check);
          }
          else if($_POST["action"] == "unban")
          {
            $check = $this->accountModel->unbanAccount($_POST["accountEmail"]);
            echo json_encode($check);
          }
          else if($_POST["action"] == "delete")
          {
            $param = [
              "makhachhang" => $_POST['accountId'],
              "email" => $_POST['accountEmail'],
              "status" => $_POST['status'],
            ];
            $check = $this->accountModel->deleteAccount($param);
            echo json_encode(array('result'=> $check));
          }
          }
        }
    }
}

?>