<?php

namespace core;


class Config
{
    public static $config = [];

    /**
     * @param $config array
     */

    public static function set($config){
        self::$config = $config;
    }

    /**
     * @return mixed
     */
    public static function get($config_title){
        if(isset(self::$config[$config_title])){
            return self::$config[$config_title];
        }
    }


}