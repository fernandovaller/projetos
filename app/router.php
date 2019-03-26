<?php
use System\Router;
use System\Page;
use System\Config;
use System\Login;

//DEFINIR AS ROTAS
//O sistema trabalha exibindo sempre a index

//Config::setDefaultRouter('app');
//Adicionando o caminho ate a aplicao para
//nao interferir nas rotas - url[0]
//Router::setPrefix(['pasta_antes_do_sistemas']);

Router::post('login', function (){
	Page::load('login/login-action');
});

Router::get('sair', function(){
	Login::sair();
	redirect(URL);
});

//Verificar se usuario logado
if(!Login::verificar()){
	Page::load('login/login');
	exit();
}

//GRUPO DE ROTAS DEFAULT (SITE)
//****************************************
//Requisições ao arquivos modulo-actions
Router::any('pages', function(){
	//Page::loads(Router::getURL(1), Config::getDefaultRouter());
	//var_dump(Router::getURL(1));
	Page::loads(Router::getURL(1));
	exit();
});

Router::any('gcrud2', function(){
	//Page::loads(Router::getURL(1), Config::getDefaultRouter());
	//var_dump(Router::getURL(1));
	include __DIR__ . '/../gcrud2/index.php';
	exit();
});



//requisicoes ajax
// Router::any('ajax', function(){
// 	Page::loads(Router::getURL(1));
// 	exit();	
// });

// Router::any('relatorios', function(){
// 	Page::load('relatorios/index');
// 	exit();	
// });

// Router::any('print', function(){	
// 	Page::loads(Router::getURL(1));
// 	exit();
// });
