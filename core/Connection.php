<?php 
class Connection {

    private static $instance = null, $conn=null;
    

    private function __construct($config)
    {
      try{
        $dsn = 'mysql:host='.$config['host'].';dbname='.$config['db'];
        $options = [
          PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8',
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        $dbh = new PDO($dsn, $config['user'], $config['password'], $options);
        self::$conn = $dbh;
      }catch(Exception $exception){
          echo "Lỗi kết nối: " .  $exception->getMessage();
      }
    }
   
 
    public static function getInstance($config)
    {
      if (self::$instance == null)
      {
        $connection = new Connection($config);
        self::$instance = self::$conn;
      }
   
      return self::$instance;
    }
  }
   
  