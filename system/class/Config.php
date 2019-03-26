<?php
namespace System;

class Config {

    private static $default_router;	

    public static function init($config){
    	if(isset($config['default_router']))
        	self::$default_router = $config['default_router'];
    }

    public static function getDefaultRouter(){
        if(!empty(self::$default_router))
            return self::$default_router . DIRECTORY_SEPARATOR;        
        return '';
    }

    public static function setDefaultRouter($default_router){
        self::$default_router = $default_router;
    }
}