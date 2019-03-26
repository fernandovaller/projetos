<?php 
namespace System;

class Router {

    private static $prefix;

    public static function getRequestHeaders() {
        $headers = array();
        // If getallheaders() is available, use that
        if (function_exists('getallheaders')) {
            $headers = getallheaders();
            // getallheaders() can return false if something went wrong
            if ($headers !== false) {
                return $headers;
            }
        }
        // Method getallheaders() not available or went wrong: manually extract 'm
        foreach ($_SERVER as $name => $value) {
            if ((substr($name, 0, 5) == 'HTTP_') || ($name == 'CONTENT_TYPE') || ($name == 'CONTENT_LENGTH')) {
                $headers[str_replace(array(' ', 'Http'), array('-', 'HTTP'), ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }   

    private static function method(){
        
        $method = $_SERVER['REQUEST_METHOD'];
        // If it's a HEAD request override it to being GET and prevent any output, as per HTTP Specification
        // @url http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html#sec9.4
        if ($_SERVER['REQUEST_METHOD'] == 'HEAD') {
            ob_start();
            $method = 'GET';
        } // If it's a POST request, check for a method override header
        elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $headers = self::getRequestHeaders();
            if (isset($headers['X-HTTP-Method-Override']) && in_array($headers['X-HTTP-Method-Override'], array('PUT', 'DELETE', 'PATCH'))) {
                $method = $headers['X-HTTP-Method-Override'];
            }
        }
        return $method;     
    }   

    public static function URL(){
        $URI = urldecode(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
        );

        if(empty($URI) || $URI == null) 
            return false;

        $_url = explode('/', filter_var( rtrim(urldecode($URI), '/') , FILTER_SANITIZE_URL));  
        $_url = array_filter(array_map('anti_injection', $_url));    
        //if($remove_zero) array_shift($_url);

        //verifica se existe prefixo definido
        if(!empty(self::$prefix)) 
            $_url = array_diff($_url, self::$prefix);

        $_url = array_values($_url);        

        return $_url;  
    }

    //retorno o valor da url no indice passado. 
    //Ex: url[1] / url[2] ....
    public static function getURL($index, $default = ''){        
        $url_ = self::URL(true);        
        return !empty($url_[$index]) ? $url_[$index] : $default;
    }

    public static function URLString($remove_zero = true){
        $url_ = self::URL($remove_zero);
        return implode("/", $url_);
    }

    public static function get($url, $callback = ''){
        if(self::method() === 'GET'){
            $_url = self::URL();            
            if($url === $_url[0]){
                if($callback) call_user_func($callback);
            }
        }
    }

    public static function post($url, $callback = ''){
        if(self::method() === 'POST'){
            $_url = self::URL();
            //$_url = implode('/', self::URL());
            if($url === $_url[0]){
                if($callback) call_user_func($callback);
            }
        }
    }   

    //Rota para qualquer metodo GET|POST
    public static function any($url, $callback = ''){
        if(self::method() === 'POST' || self::method() === 'GET'){
            $_url = self::URL();
            //$_url = implode('/', self::URL());
            if($url === $_url[0]){
                if($callback) call_user_func($callback);
            }
        }
    }   

    //Rota de grupo
    public static function group($url, $callback = ''){
        $_url = self::URL(false);        
        if($url === $_url[0]){
            if($callback) call_user_func($callback);
        }
    }

    public static function postURL($url, $callback = ''){
        if(self::method() === 'POST'){
            //$_url = self::URL();
            $_url = implode('/', self::URL());
            if($url === $_url){
                if($callback) call_user_func($callback);
            }
        }
    }

    public static function params(){
        return $_SERVER['QUERY_STRING'];
    }    

    public static function pGET($name, $default = ''){
        $value = filter_input(INPUT_GET, "{$name}", FILTER_SANITIZE_STRING);
        return !empty($value) ? $value : $default; 
    }      

    public static function pURL($index, $default = ''){
        //$value = filter_input(INPUT_GET, "{$name}", FILTER_SANITIZE_STRING);
        $value = strtok(self::getURL($index), '?');
        return !empty($value) ? $value : $default; 
    }    

    //define a pagina
    public static function page($url_index, $default = ''){
        $value = self::getURL($url_index);        
        return !empty($value) ? $value : $default; 
    }

    //adidione caminho ate o seu sistema
    public static function setPrefix($path = array()){        
        if(is_array($path) && !empty($path)){
            self::$prefix = $path;            
        }
    }

}