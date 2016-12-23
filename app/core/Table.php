<?php
namespace app\core;

class Table
{
    protected $use_table;
    protected $db_connect;

    public function __construct($use_table)
    {
        $config = Config::get('database');
        $db_driver = $config['driver'];
        $this->db_connect = $db_driver(); //MySQLDriver
        $this->use_table = $use_table;
    }

    private function where($where){
        $result = [];
        $condition_string = '';
        if(!empty($where)){
            $condition =[];
            $result['condition_string'] = '';
            foreach ($where as $key => $value){
                $condition[] = $key ."=? ";
                $condition_string .= implode('AND ', $condition);
                $result['params_array'][] = $value;
            }
            $result['condition_string'] = " WHERE ". $condition_string;

            return $result;
        }
    }

    public function get($columns = [], $where = []){
        $sql_query = "SELECT ";
        if(!empty($columns)){
            $sql_query .= implode(', ', $columns);
        }else{
            $sql_query .= '*';
        }
        $sql_query .= ' FROM '. $this->use_table;
        $result = $this->where($where);
        $sql_query .= $result['condition_string'];
        return $this->db_connect->executeQuery($sql_query, $result['params_array']);
    }

    public function getAll($columns = []){
        $sql_query = "SELECT ";
        if(!empty($columns)){
            $sql_query .= implode(', ', $columns);
        }else{
            $sql_query .= '*';
        }
        $sql_query .= ' FROM '. $this->use_table;
        return $this->db_connect->executeQuery($sql_query);
    }

    public function insert($data = []){
        $sql_query = "INSERT INTO ". $this->use_table;
        $columns_string = '';
        $values_string = '';
        $params_array = [];
        if(!empty($data)){
            foreach ($data as $key => $value){
                $columns_string .= $key.',';
                $values[] = '?';
                $values_string = implode(',', $values);
                $params_array[] = $value;
            }
        }
        $sql_query .= " (".$columns_string.") VALUES (".$values_string.")";
        return $this->db_connect->executeQuery($sql_query, $params_array);
    }

    public function update($data = [], $where = []){
        $sql_query = "UPDATE $this->use_table SET"; //name=? WHERE id=?
        $columns_string = '';
        $params_array = [];
        if(!empty($data)){
            foreach ($data as $key => $value){
                $column[] = $key."=?";
                $columns_string = implode(',', $column);
                $params_array[] = $value;
            }
            $sql_query .= $columns_string;
        }
        $result = $this->where($where);
        $sql_query .= $result['condition_string'];
        return $this->db_connect->executeQuery($sql_query, $result['params_array']);
    }

    public function delete($where = []){
        $sql_query = "DELETE FROM $this->use_table";
        $result = $this->where($where);
        $sql_query .= $result['condition_string'];
        return $this->db_connect->executeQuery($sql_query, $result['params_array']);
    }
}