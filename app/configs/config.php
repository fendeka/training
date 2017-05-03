<?php

return
    $settings = array(
        'database' => array(
            'driver' => 'app\core\MySQLDriver',
            'host' => 'localhost',
            'user' => 'root',
            'password' => '1515',
            'dbname' => 'task',
            'type' => 'mysql'
        ),
        'router' => array(
            'defaultController' => 'task',
            'defaultAction' => 'index',
            'defaultErrorAction' => 'error',
        ),
        'session' => array(
            'user_id' => 'id'
        ),
        'pagination' => array(
            'per_page' => 3
        ),
        'image' => array(
            'path' => 'uploads/',
            'width' => 320,
            'height' => 240
        ),
        'base_path' => 'http://task.loc/'
);

