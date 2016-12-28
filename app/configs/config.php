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
    ),
    'router' => array(
        'defaultController' => 'post',
        'defaultAction' => 'index',
        'defaultErrorAction' => 'error',
    )
);

app\core\Config::set($settings);

