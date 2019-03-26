<?php 
namespace System;

class Page {

	private static $modulos = [];

	//Registra os modulos do sistema
	public static function setModulos(array $modulo) {
		self::$modulos = array_filter($modulo);
	}

	public static function load($path, $app_folder = '') {
		$file = APP_PATH .  $app_folder . $path . '.php';
		//var_dump($file);
		if(file_exists($file)){
			include $file;
		}else {
			var_dump($file);
		}
	}	

	//page format page-name-folder/page-name
	public static function loads($path, $app_folder = '') {
		$page_base = explode('-', $path);
		$page_folder = $page_base[0];
		$page_modulo = "{$page_base[0]}-{$page_base[1]}";

		//caminho padrao 
		$page_folder_default = $page_folder;

		//verificar se é um modulo
		//Se for definido como modulo muda para a pasta do modulo
		if(in_array($page_modulo, self::$modulos)){
			$page_folder_default = $page_modulo;
		}

		//caminho padrao
		$file = APP_PATH . $app_folder . $page_folder_default . DIRECTORY_SEPARATOR . $path . '.php';		

		if(file_exists($file)){
			include $file;
		} else{			
			include APP_PATH . $app_folder . '404.phtml';
		}
	}

	
	//all pages in folder
	public static function loadin($path, $path_base, $app_folder = '') {		
		$file = APP_PATH . $app_folder . $path_base . DIRECTORY_SEPARATOR . $path . '.php';
		//var_dump($file);
		if(file_exists($file)){
			include $file;
		}
	}
    
}