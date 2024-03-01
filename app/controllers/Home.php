<?php
class Home extends Controller{
    private $homeModel;
    public function __construct() {
       $this->homeModel = $this->model('HomeModel'); 
    }

    public function logout(){
        if(isset($_SESSION['user_client']))
        {
            unset($_SESSION['user_client']);
            $path = __WEB_ROOT;
            header("Location: $path");
            exit;
        }
    }

    public function validate_mailcode(){
        if(isset($_SESSION["code_mail"]))
        {
            $param = [
                "code" => $_SESSION["code_mail"],
                "url" => __WEB_ROOT."home/success_validate",
            ];
            echo json_encode($param);
        }
        else {
            $param = [
                "code" => "",
            ];
            echo json_encode($param);
        }
    }
    public function index() {
      $this->data['sub_content'][] = []; 
      $this->data['content'] = 'Home/index';
      $this->render('layouts/client/client_layout',  $this->data);
    }
    public function authen() {
        if(isset($_POST['signupSubmit']))
        {
            $param = [
                'tenkhachhang' => $_POST['input_name'],
                'email' => $_POST['input_email'],
                'sdt' => $_POST['input_phone'],
                'diachi' => $_POST['input_address'],
                'type' =>  $_POST['input_type'],
                'cccd' => $_POST['input_cccd'],
                'macongty' => $_POST['input_id_company'],
            ];  
            $_SESSION['SIGNUPINFO'] = $param;
            $this->sendmail($param);
            $this->data['sub_content'][] = []; 
            $this->data['content'] = 'client_authentication/index';
            $this->render('layouts/client/client_layout',  $this->data);
        }
        else {
            $path = __WEB_ROOT."Home/signup";
            header("Location: $path");
            exit;
        }
    }


    public function getListContractOfCustomer(){
        $arr = $this->homeModel->getListContractOfCustomer();
        echo json_encode($arr);
      }


    public function sendmail($param) {
        $emailSender = new EmailSender();
        $emailSender->sendEmail($param);
        $code = $emailSender->randomNumber;
        $_SESSION['code_mail'] = $code;
    }
    public function client_search()
    {
        if(isset($_SESSION['user_client']))
        {
            $dataProduct = $this->homeModel->getListContractOfCustomer();
            $this->data['sub_content']['listContract'] = $dataProduct; 
            $this->data['content'] = 'client_search/index';
            $this->render('layouts/client/client_layout',  $this->data);
        }
        else
        {
            $this->signin();
        }
    }

    public function client_submit_contract()
    {
       if(isset($_SESSION['request_contract']))
        {
            unset($_SESSION['request_contract']);
            $this->data['sub_content'][] = []; 
            $this->data['content'] = 'client_submit_contract/index';
            $this->render('layouts/client/client_layout',  $this->data);
        }
        else {
            $this->client_contract();
        }
    }

    public function client_contract()
    {
        if(isset($_SESSION['user_client']))
        {
            $listCang = $this->homeModel->getListCangDi();  
            $this->data['sub_content']['listCang'] = $listCang; 
            // $this->data['sub_content']['listCangDen'] = ; 
            $this->data['content'] = 'client_contract/index';
            $this->render('layouts/client/client_layout',  $this->data);
        }
        else
        {
            $this->signin();
        }
    }
    public function admin_login() {

        if(isset($_POST['adminLoginSubmit']))
        {
            $type = $_POST['loai'];
            $username = $_POST['input_username'];
            $password = $_POST['input_password'];
            $data = $this->homeModel->getAccount($username,$password , $type);
            if($data!=false)
            {
                $_SESSION['username'] = $username;
                $path = __WEB_ROOT."admin/home";
                header("Location: $path");
                exit;
            }
            else {
                $error = [
                    'admin_login' => 'Tài khoản hoặc mật khẩu không đúng'
                ];
                $this->data['error'] = $error; 
                $this->render('admin_login/index', $this->data);
            }
        }
        else {
            $this->render('admin_login/index');
        }
    
    }

    public function admin_logout() {
        session_unset();
        $path = __WEB_ROOT."admin";
        header("Location: $path");
        exit;
    }
    public function signin() {
        $this->data['sub_content'][] = []; 
        $this->data['content'] = 'client_signin/index';
        $this->render('layouts/client/client_layout',  $this->data);
    }
    public function validate_login_client()
    {
        $param = [
            'type' => isset($_POST['type'])?$_POST['type']:"",
            'username' =>isset($_POST['username'])?$_POST['username']:"",
            'password' =>isset($_POST['password'])?$_POST['password']:"",
        ];

     
        $data = $this->homeModel->getAccount($param['username'],$param['password'] , $param['type']);
        if($data!=false && $data['trangthai']!=0)
        {
            $_SESSION['user_client'] = $param['username'];
            $param = [
                'url' => __WEB_ROOT
            ];
        }
        else if($data!=false && $data['trangthai'] == 0)
        {
            $param = [
                'banned' => 1
            ];
        }

        echo json_encode($param);

    }

    public function success_validate()
    {
        if(isset($_SESSION['code_mail']))
        {
            unset($_SESSION['code_mail']);
            if(isset($_SESSION['SIGNUPINFO']))
            {
                $this->homeModel->sendInfoToSever($_SESSION['SIGNUPINFO']);
                unset($_SESSION['SIGNUPINFO']);
            }
            $this->data['sub_content'][] = []; 
            $this->data['content'] = 'client_confirm/index';
            $this->render('layouts/client/client_layout',  $this->data);
        }
        else {
            $path = __WEB_ROOT;
            header("Location: $path");
            exit;
        }
    }
    public function client_login($error)
    {
        if(!empty($error)) {
            $this->data['error'] = $error; 
            $this->render('client_signin/index', $this->data);
        }
        else {
            $this->render('client_signin/index');
        } 
    }
    public function signUp() {
        $this->data['sub_content'][] = []; 
        $this->data['content'] = 'client_signup/index';
        $this->render('layouts/client/client_layout',  $this->data);
    }

    function requestService()   {
        $request = new Request();
        if($request->getMethod() == 'post')
        {
            $param = [
              "noidung" => $_POST['content']  
            ];
            $data = $this->homeModel->sendRequestService($param);
            if($data)
            {
                $_SESSION['request_contract'] = "success";
                echo json_encode(["url" => __WEB_ROOT."home/client_submit_contract"]);
            }
        }
    }
}
?>