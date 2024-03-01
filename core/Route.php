<?php
class Route{
    function handleRoute($url)
    {
        global $routes;
        unset($routes['default_controller']);
        $url = trim($url,"/");
        $handleUrl = $url;
        if(!empty($routes)) {
            foreach($routes as $key=>$value)
            {
                if(preg_match("/".$key."/i",$url))
                {
                    $handleUrl = preg_replace("/".$key."/i", $value, $url);
                }
            }
        }
        return $handleUrl;
    }
}