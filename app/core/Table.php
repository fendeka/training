<?php


namespace core;

class Table
{
    protected $dbconnection;
    protected $use_table;

    protected $select;
    protected $insert;
    protected $delete;
    protected $update;
    protected $from;
    protected $orderBy;
    protected $where;
    protected $limit;

    /**
     * Table constructor.
     * @param $settings array
     */

    public function __construct($settings)
    {
        $this->dbconnection = new $settings['driver'](); //MySQLDriver
        $this->dbconnection->connect($settings);
        $this->use_table = 'training';
    }

    /**
     * @param null $field string
     * @param null $params array
     */

    public function get($field = null, $params = null){
        if($field === null && $params === null){
            $this->select = $this->getAll();
        }else{
            $this->select = "SELECT $field FROM $this->use_table . $this->where($params)";
        }
    }

    /**
     * @param null $param string
     * @return $this
     */

    public function getAll($param = null){
        if($param === null){
            $this->select = "SELECT * FROM $this->use_table";
        }else{
            $this->select = "SELECT $param FROM $this->use_table";
        }
        return $this;
    }

    /**
     * @param $properties array
     * @return $this
     */

    public function insert($properties){
        $columns = "";
        $values = "";
        foreach ($properties as $key => $value){
            $columns .= $key.", ";
            $values .= "'".$value."', ";
        }
        $columns = rtrim($columns, ", ");
        $values = rtrim($values, ", ");
        $this->insert = "INSERT INTO $this->use_table ($columns)VALUES ($values) ";
        return $this;
    }

    /**
     * @param $properties array
     * @return $this
     */

    public function update($properties){
        $property_string = "";
        foreach ($properties as $key => $value){
            $property_string .= $key."='".$value."', ";
        }
        $property_string = rtrim($property_string, ", ");
        $this->update = "UPDATE $this->use_table SET $property_string ";
        return $this;
    }

    /**
     * @return $this
     */

    public function from(){
        $this->from = "FROM $this->use_table ";
        return $this;
    }

    /**
     * @param $param array
     * @return $this
     */

    public function where($param){
        $columns = "";
        $values = "";
        $property_string = "";
        foreach ($param as $key => $value){
            $columns .= $key."=";
            $values .= "'".$value."', ";
            $property_string .= $columns.$values;
        }
        $property_string = rtrim($property_string, ", ");
        $this->where = " WHERE ".$property_string;
        return $this;
    }

    /**
     * @param $position integer
     * @param string $count
     * @return $this
     */

    public function limit($position, $count=""){
        $this->limit = "LIMIT ".$position;
        if($count != ""){
            $this->limit .= ", ".$count;
        }
        return $this;
    }

    /**
     * @return string
     */

    public function createQuery(){
        $query = $this->select.$this->insert.$this->delete.$this->update.$this->from.$this->where.$this->orderBy.$this->limit;
        $this->select = "";
        $this->insert = "";
        $this->delete = "";
        $this->update = "";
        $this->from = "";
        $this->where = "";
        $this->limit = "";
        return $query;
    }

}