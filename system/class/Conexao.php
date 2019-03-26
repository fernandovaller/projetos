<?php
namespace System;

class Conexao {

	protected static $db;
    
    //Conexao PDO
    public static function getConn(){

    	if(!isset(self::$db)){
	    	try {
	    		self::$db = new \PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PWD, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
	    		self::$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	    		self::$db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);        		
	    	} catch (Exception $e) {
	    		//echo $e->getMessage();
	    		var_dump($e->getMessage());
	    		if($e->getCode() == 1044) echo '[Error: 1] Infelizmente estamos tendo problemas de conexao no momento, tente novamente.'; //Usuario
	    		if($e->getCode() == 1045) echo '[Error: 2] Infelizmente estamos tendo problemas de conexao no momento, tente novamente.'; //Senha     
	    		if($e->getCode() == 1049) echo '[Error: 3] Infelizmente estamos tendo problemas de conexao no momento, tente novamente'; //Banco
	    		if($e->getCode() == 2002) echo '[Error: 4] Infelizmente estamos tendo problemas de conexao no momento, tente novamente.'; //Host
			}    		
    	}

    	return self::$db;
    }

    //Conexao mysqli
	public static function getConni(){  
	  $conexao = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);
	  mysqli_set_charset($conexao, 'utf8');
	  return $conexao;
	}

	//Conexao mysql
	public static function getCon(){
  		$conexao = mysql_connect(DB_HOST, DB_USER, DB_PWD);  
  		mysql_select_db(DB_NAME, $conexao);  
  		mysql_set_charset('UTF8', $conexao);  
  		return $conexao;
	}

}