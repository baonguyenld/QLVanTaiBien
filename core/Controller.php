<?php
//Base Controller chứa các phương thức cung cấp cho các controller khác
class Controller {
    public $data = [];
    //Hàm này giúp tối ưu việc khởi tạo model
    public function model($model){
        //Lấy đường dẫn đến model
        $pathModel =  __DIR_ROOT.'/app/models/'.$model.'.php';
        //Kiểm tra file có tồn tại không
        if(file_exists($pathModel))
        {
            require_once $pathModel;
            //Kiểm tra lớp này có tồn tại không
            if(class_exists($model))
            {
                $model = new $model();
                return $model;
            }
        }
        return false;
    }

    public function render($view, $data=[]) {
        
        //Chuyển đổi keys thành các tên biến, values thành các value của biến
        extract($data);
        //Lấy đường dẫn đến view
        $pathView =  __DIR_ROOT.'/app/views/'.$view.'.php';
        
        //Kiểm tra có tồn tại file này không
        if(file_exists($pathView))
        {
            require_once $pathView;
        }
    }
}
?>