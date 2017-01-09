<?php


namespace app\core;

class Table
{
    protected $use_table;
    protected $db_connect;

    public function __construct($use_table = 'training')
    {
        $db_driver = Config::get('database/driver');
        $this->db_connect = new $db_driver(); //MySQLDriver
        $this->use_table = $use_table;
    }

    private function action($action, $where = null){
        $values = [];
        $condition = [];
        if(is_array($where)) {
            $oparators = ['=', '<', '>', '>=', '<='];
            if (count($where) === 3) {
                $field = $where[0];
                $oparator = $where[1];
                $value = $where[2];
                if (in_array($oparator, $oparators)) {
                    $condition[] = $field . $oparator . '?';
                    $values[] = $value;
                }
            } else {
                return false;
            }

        }
        $condition_string = implode(' AND ', $condition);
        $result['sql'] = "{$action} FROM {$this->use_table} WHERE $condition_string";
        $result['params'] = $values;
        $query_result = $this->db_connect->executeQuery($result['sql'], $result['params']);
        return $query_result;
    }

    public function get($column = '*', $where = []){
        if(is_string($column)){
            $result = $this->action("SELECT {$column}", $where);
            return $result;
        }else{
            return false;
        }
    }

    public function getAll($column = '*'){
        if(is_string($column)){
            $sql_query = "SELECT {$column} FROM {$this->use_table}";
            $query_result = $this->db_connect->executeQuery($sql_query);
            return $query_result;
        }else{
            return false;
        }
    }

    public function insert($data = []){
        $sql_query = "INSERT INTO ". $this->use_table;
        $columns = [];
        $columns_string = '';
        $values_string = '';
        $params_array = [];
        if(!empty($data)){
            foreach ($data as $key => $value){
                $columns[] = $key;
                $values[] = '?';
                $values_string = implode(',', $values);
                $columns_string = implode('`, `', $columns);
                $params_array[] = $value;
            }
        }
        $sql_query .= " (`".$columns_string."`) VALUES (".$values_string.")";
        $query_result = $this->db_connect->executeQuery($sql_query, $params_array);
        return $query_result;
    }

    public function update($data = [], $where = []){
        $sql_query = "UPDATE $this->use_table SET "; //name=? WHERE id=?
        $params_array = [];
        $column = '';
        $condition = '';
        if(!empty($data)){
            foreach ($data as $key => $value){
                $column[] = $key."=?";
                $params_array[] = $value;
            }
            $columns_string = implode(',', $column);
            $sql_query .= $columns_string;
        }
        if(!empty($where)){
            foreach ($where as $key => $value){
                $condition .= $key ."=". $value;
            }
            $sql_query .= " WHERE {$condition}";
        }else{
            return false;
        }
        $query_result = $this->db_connect->executeQuery($sql_query, $params_array);
        return $query_result;
    }

    public function delete($where = []){
        $result = $this->action("DELETE ", $where);
        return $result;
    }
}