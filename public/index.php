<?php  
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
ini_set("display_errors", 1);
//header('Content-Type: text/html; charset=utf-8');

define('ROOT_PATH', realpath(__DIR__.'/../').DIRECTORY_SEPARATOR);
define('APP_PATH', realpath(__DIR__.'/../app/').DIRECTORY_SEPARATOR);
define('PUBLIC_PATH', realpath(__DIR__.'/../public/').DIRECTORY_SEPARATOR);
define('LIB_PATH', realpath(__DIR__.'/../public/libs/').DIRECTORY_SEPARATOR);
define('SYSTEM_PATH', realpath(__DIR__.'/../system/').DIRECTORY_SEPARATOR);
define('VENDOR_PATH', realpath(__DIR__.'/../vendor/').DIRECTORY_SEPARATOR);

include SYSTEM_PATH . 'core/bootstrap.php';

//Definir rotas
include APP_PATH . 'router.php';

//Definir as config do app
if(file_exists(APP_PATH . System\Config::getDefaultRouter() . 'config.php'))
	include APP_PATH . System\Config::getDefaultRouter() . 'config.php';

//Definir o layout padrao
if(file_exists(APP_PATH . System\Config::getDefaultRouter() . 'index.phtml'))
	include APP_PATH . System\Config::getDefaultRouter() . 'index.phtml';


//Debug
//var_dump(APP_PATH . System\Config::getDefaultRouter() . 'index.phtml', System\Config::getDefaultRouter(), $page);