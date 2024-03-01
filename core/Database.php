<?php
class Database
{
    private $__conn;
    private $__num_row;

    function __construct()
    {
        global $db_config;
        $this->__conn = Connection::getInstance($db_config);
        $this->__num_row = 0;
    }


    public function query($sql)
    {
        try {
            $stmt = $this->__conn->prepare($sql);
            $stmt->execute();
            $this->__num_row = $stmt->rowCount();
            return $stmt;
        } catch (Exception $e) { {
                $message =$e->getMessage();
                $data['message'] = $message;
                App::$app->loadError('database', $data);
                die();
            }
        }
    }
    public function rowCount()
    {
        return $this->__num_row;
    }
    public function insert($table, $param = array())
    {

            if (!empty($param)) {
                $field = '';
                $values = '';
                foreach ($param as $key => $value) {
                    $field .= $key . ',';           
                    $values .= "'" . $value . "',";                     
                }
                $field = rtrim($field, ',');
                $values = rtrim($values, ',');
                $sql = "INSERT INTO $table($field) VALUES ($values)";
                $status = $this->query($sql);
                if ($status) {
                    return true;
                }
                return false;
            }

    }
    public function update($table, $param = array(), $condition = '')
    {
        if (!empty($param)) {
            $update = '';
            foreach ($param as $key => $value) {
                $update .= "$key='$value',";
            }
            $update = rtrim($update,",");
            if (!empty($condition)) {
                $sql = "UPDATE $table SET $update WHERE $condition";
            } else {
                $sql = "UPDATE $table SET $update";
            
            }
            $status = $this->query($sql);

            if ($status) {
                return true;
            }
        }
        return false;
    }
    public function delete($table, $condition = '')
    {
        if (!empty($condition)) {
            $sql = 'DELETE FROM ' . $table . ' WHERE ' . $condition;
        } else {
            $sql = 'DELETE FROM ' . $table;
        }
        $status = $this->query($sql);
        if ($status) {
            return true;
        }
        return false;

    }
    public function getQuery($query, $params)
    {
        $keys = array();
        foreach ($params as $key => $value) {
            if (is_string($key)) {
                $keys[] = '/:' . $key . '/';
            } else {
                $keys[] = '/[?]/';
            }
        }

        $query = preg_replace($keys, $params, $query, 1, $count);
        return $query;
    }
    function lastInsertId()
    {
        return $this->__conn->lastInsertId();
    }
}
?>