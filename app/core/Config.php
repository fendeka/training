<?php

namespace app\core;


class Config
{
    private static $config = [];
    private static $autoloader;

    private function __construct()
    {
    spl_autoload_register(function ($class){

        $namespace = explode("\\", $class);
        if(is_array($namespace)){
            $classRoute = implode("/", $namespace).".php";
        }
        if(file_exists($classRoute)){
            require_once $classRoute;
        }
    });
    }

    /**
     * @param $config array
     */

    public static function set($config){
        self::$config = $config;
        self::$autoloader = new Config();
    }

    /**
     * @return mixed
     */
    public static function get($path = null){
        if($path){
            if(strpos($path, '/')){
                $path = explode('/', $path);
                foreach ($path as $key => $value){
                    if(isset(self::$config[$value])){
                        $configuration = self::$config[$value];
                    }
                    if(isset($configuration[$value])){
                        return $configuration[$value];
                    }
                }
            }else{
                if(isset(self::$config[$path])){
                    return self::$config[$path];
                }
            }
        }else {
            return false;
        }
    }


}