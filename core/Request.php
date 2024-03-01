<?php 
class Request {
    public function getMethod(){
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        return $method;
    }
}

?>