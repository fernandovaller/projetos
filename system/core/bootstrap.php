<?php
//autoload do composer
require VENDOR_PATH . 'autoload.php';

//Carrega as variaveis de ambiente
//ATENÇÃO: nao versione o arquivo .env e nao coloque ele acessivel pelo navegador
if(file_exists(ROOT_PATH . '.env')) {
    $dotenv = new Dotenv\Dotenv(ROOT_PATH);
    $dotenv->load(); //para 1º carregamento
    //$dotenv->overload(); //sobreescreve as variaveis
} else {
	var_dump(ROOT_PATH . '.env');
	die('File config not found.');
}

//Configurações geral do sistema
require_once APP_PATH . 'config.php';
System\Config::init($CONFIG);

if(!defined('DB_HOST') ) 
	die('Hosting config not found.');

//Functions do sistema
require_once SYSTEM_PATH . 'core/functions.php';
require_once APP_PATH.'helper.php';

//Inicia a session
System\Login::sessionStart(SESSION_NAME);