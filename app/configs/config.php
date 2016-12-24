<?php

require_once ('app/core/Config.php');

$settings = array(
    'database' => array(
        'driver' => 'app\core\MySQLDriver',
        'host' => 'localhost',
        'user' => 'root',
        'password' => '1515',
        'dbname' => 'training',
        'type' => 'mysql'
    )
);

app\core\Config::set($settings);






error_reporting(E_ALL);
ini_set('display_errors', 1);