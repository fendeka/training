<?php

namespace core;

use inter_face\DatabaseInterface;

class MySQLDriver implements DatabaseInterface
{
    private $host;
    private $user;
    private $password;
    private $name;
    private $type;
    protected $dbconnection;

    /**
     * MySQLDriver constructor.
     */

    public function __construct()
    {
        $this->setConfigs(Application::getConfig()['database']);
        $this->connect();
    }

    /**
     * @param $settings array
     */

    public function setConfigs($settings){
        $this->host = $settings['host'];
        $this->user = $settings['user'];
        $this->password = $settings['password'];
        $this->name = $settings['name'];
        $this->type = $settings['type'];
    }

    /**
     * @return \PDO
     */

    public function connect()
    {
        if(!$this->dbconnection){
            $this->dbconnection = new \PDO($this->type . ":dbname=" . $this->name . ";host=" . $this->host, $this->user, $this->password);
        }
        return $this->dbconnection;
    }

    /**
     * @param $sql string
     * @param array $params
     * @return mixed
     */

    public function executeQuery($sql, $params = array())
    {
        $response = $this->dbconnection->prepare($sql);
        $response->execute();
        return $response;
    }

    /**
     * @return \PDO
     */

    public function disconnect()
    {
        return $this->dbconnection = new \PDO();
    }


}