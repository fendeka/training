<?php

namespace core;


class Application
{
    public static $config;

    /**
     * @param $config array
     */

    public static function initConfig($config){
        self::$config = $config;
    }

    /**
     * @return mixed
     */
    public static function getConfig(){
        return self::$config;
    }

}