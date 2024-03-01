<?php
class Home extends Controller{
    public function index() {
        $this->data['sub_content'] = []; 
        $this->data['content'] = 'admin_home/index';
        $this->render('layouts/admin/admin_layout',  $this->data);
    }
}
?>