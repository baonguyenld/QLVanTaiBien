<?php
//Lớp này là lớp truy cập đến các controller
//Muốn vào controller phải thông qua lớp này
class App{
    //$__controller là biến chứa tên file(Lớp)
    //$__action là biến chứa tên phương thức của lớp
    //$__params chứa các tham số của phương thức
    private $__controller, $__action, $__params, $__route;
   
    public static $app;
    //Hàm khởi tạo các giá trị mặc định
    function __construct(){
        //Biến routes là biến nằm ngoài class nên phải global nó để sử dụng trong phương thức
        global $routes, $config;
        self::$app = $this;
        $this->__route = new Route();
        //Kiểm tra $routes['default_controller'] có tồn tại không,
        //giá trị này nằm ở file routes
        if(!empty($routes['default_controller']))
        {
            $this->__controller = $routes['default_controller'];
        }
        $this->__action = 'index';     
        $this->__params = [];
        $this->handlerUrl();
    }

    //Hàm này lấy đường dẫn sau đường dẫn root root
    function getUrl() {
        if(!empty($_SERVER['PATH_INFO'])){
            $url = $_SERVER['PATH_INFO'];
        }
        else {
            $url = '/';
        }
        return $url;
    }

    //Hàm này xử lý lại url nhằm truy cập vào các phương thức của các controller
    public function handlerUrl() {
        $url = $this->getUrl();

        $url = $this->__route->handleRoute($url);

        //Tách chuỗi url ra thành mảng, và loại bỏ ký tự không hợp lệ
        $urlArr = array_filter(explode("/",$url));

        //Sắp xếp lại thứ tự key của mảng
        $urlArr = array_values($urlArr);

        $urlCheck = '';
        if(!isset($_SESSION['username']) && isset($urlArr[0]) && $urlArr[0] =='admin')
        {       
         
            $loginPath = __WEB_ROOT."Home/admin_login";
            header("Location: $loginPath");
            exit;
        }
        else {
            if(isset($urlArr[0]) && $urlArr[0] =='admin' && empty($urlArr[1]))
            {
                if(!isset($_SESSION['username']))
                {
                    $loginPath = __WEB_ROOT."Home/admin_login";
                    header("Location: $loginPath");
                    exit;
                }
                else
                {
                    $loginPath = __WEB_ROOT."admin/home";
                    header("Location: $loginPath");
                    exit;
                }
            }
        }
        if(!empty($urlArr))
        {
            foreach($urlArr as $key=>$item)
            {
                $urlCheck .= $item.'/';
                $fileCheck = rtrim($urlCheck, '/');
                $fileArray = explode('/',$fileCheck);
                $fileArray[count($fileArray)-1] = ucfirst(strtolower( $fileArray[count($fileArray)-1]));
                $fileCheck = implode('/', $fileArray);
                if(!empty($urlArr[$key-1]))
                {
                    unset($urlArr[$key-1]);
                }
                if(file_exists("app/controllers/".$fileCheck.".php"))
                {
                    $urlCheck = $fileCheck;
                    break;
                }
            }
            $urlArr = array_values($urlArr);
        }

        //Kiểm tra phần tử đầu tiên của url có tồn tại không
        if(!empty($urlArr[0]))
        {
            //Viết lại phần tử đầu của url theo định dạng chữ cái đầu viết hoa
            $this->__controller = ucfirst(strtolower($urlArr[0]));
        }
        else {
            //Nếu không tồn tại thì dùng đường dẫn mặc định là trang Home(Controller)
            $this->__controller = ucfirst($this->__controller);
        }
        //Tạo ra biến giữ đường dẫn truy cập đến controller
        if(empty($urlCheck))
        {
            $urlCheck = $this->__controller;
        }
        $pathFile = 'controllers/'.$urlCheck.'.php'; 
        //Kiểm tra đường dẫn tồn tại hay không
        if(file_exists("app/".$pathFile))
        {
            require_once $pathFile;
            //Kiểm tra lớp có tồn tại không
            if(class_exists($this->__controller))
            {
                //Khởi tạo đối tượng 
                $this->__controller = new $this->__controller();
                //Loại bỏ phần tử đầu tiên của mảngg
                unset($urlArr[0]);
            }
            //Nếu không tồn tại thì in ra lỗi
            else {
                $this->loadError();
            }
        }
        else {
            $this->loadError(); 
        }
            //Xử lý action
        if(!empty($urlArr[1]))
        {
            $this->__action = $urlArr[1];
            unset($urlArr[1]);
        }

            //Xử lý params
        $this->__params = array_values($urlArr);

        //Kiểm tra hàm có tồn tại
        if(method_exists($this->__controller, $this->__action))
        {
            //Gọi hàm $this->__action của lớp $this->__controller với parameters là params
            call_user_func_array([$this->__controller, $this->__action],$this->__params);   
        }
        else {
            $this->loadError();
        }
    }   

    //Hàm load lỗi
    public function loadError($name='404', $data=[]){
        extract($data);
        require_once 'errors/'.$name.'.php';
    }

}
?>