<?php

namespace core;

use interfaces\DatabaseInterface;
use PDO;
use PDOException;


class MySQLDriver implements DatabaseInterface
{

    protected $dbconnect;

    public function __construct()
    {
        $config = Config::getConfig('database');
        $type = $config['type'];
        $name = $config['name'];
        $host = $config['host'];
        $user = $config['user'];
        $password = $config['password'];
        $this->connect($type, $name, $host, $user, $password);
    }


    /**
     * @return \PDO
     */

    public function connect($type, $name, $host, $user, $password)
    {
        try {
            if (!$this->dbconnect) {
                $this->dbconnect = new \PDO($type . ":dbname=" . $name . ";host=" . $host, $user, $password);
                return $this->dbconnect;
            }
        }catch (PDOException $ex){
            echo "DB connection error occured!";
        }
    }

    /**
     * @param $sql string
     * @param array $params
     * @return mixed
     */

    public function executeQuery($sql, $params = array())
    {
        $pdo_statement = $this->dbconnect->prepare($sql);

        for ($i =0; $i <= count($params); $i++){
            $pdo_statement->bindValue($i+1, $params[$i]);
        }

        $pdo_statement->execute($params);
        $rows = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    /**
     * @return \PDO
     */

    public function disconnect()
    {
        return $this->dbconnect = null;
    }


}