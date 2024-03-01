
<?php 
define('__DIR_ROOT',__DIR__);
//Xử lý đường dẫn http và https;
if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']=="on")
{
    $web_root = 'https://'.$_SERVER['HTTP_HOST'];
}
else
{
    $web_root = 'http://'.$_SERVER['HTTP_HOST'];
}

$documentRoot = str_replace("\\","/",__DIR_ROOT);
$folder = str_replace(strtolower($_SERVER['DOCUMENT_ROOT']),'',strtolower($documentRoot));

$web_root=$web_root.$folder."/";

define('__WEB_ROOT', $web_root);

$configs_dir = scandir('configs');
if(!empty($configs_dir))
{
    foreach($configs_dir as $item) {
        if($item != '.' && $item != '..' && file_exists('configs/'.$item))
        {
            require_once 'configs/'.$item;
        }
    }
}
require_once 'core/Route.php';
require_once 'app/App.php';
$db_config = array_filter($config['database']);
if(!empty($config['database']))
{
    $db_config = array_filter($config['database']);
    if(!empty($db_config))
    {
        require_once 'core/Connection.php';
        require_once 'core/Database.php';
    }

}
require_once 'core/Model.php';
require_once 'core/Controller.php';
require_once 'core/libs/sendmail.php';
require_once 'core/Request.php';
?>