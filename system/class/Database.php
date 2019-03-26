<?php
namespace System;

//Class para auxiliar na manipulação do banco de dados
// Processo:
// 1. Execute uma exportação da nova estrutura
// 2. Execute uma Exportação dos dados
// 3. Execute a importação da nova estrutura
// 4. Execute a importação dos dados
class Database {

	private static $file_name = APP_PATH.'/database/'.DB_NAME;
	private static $count_name = APP_PATH.'/database/count.aux';
	private static $count = 0;

	//pegar o numero atual
	private static function getVersao(){
		self::fileVersionCheck();
		self::$count = (int) file_get_contents(self::$count_name);		
		return self::$count;
	}	

	//incremento o numero 
	private static function setVersao(){		
		self::$count++;		
		file_put_contents(self::$count_name, self::$count);
	}

	//verifica se o arquivo existe
	private static function fileVersionCheck(){
		if(!file_exists(self::$count_name)){			
			file_put_contents(self::$count_name, 0);
		}		
	}
	

	private static function getFileName(){
		return self::$file_name;
	}

	//localhost
	//Exporta a estrutura atual do banco
	public static function exportStructure(){
		self::getVersao();
		self::setVersao();
		//remove o autoincremento
		//exec("mysqldump --no-data -u root -proot2017 ".DB_NAME." | sed 's/ AUTO_INCREMENT=[0-9]*//g' > ".APP_PATH."/database/".DB_NAME.".sql");
		//exec("mysqldump --no-data -u ".DB_USER." -p".DB_PWD." ".DB_NAME." > ".APP_PATH."/database/".DB_NAME.".sql");
		exec("mysqldump --no-data -u ".DB_USER." -p".DB_PWD." ".DB_NAME." > " . self::getFileName() .'_v'. self::getVersao() . "Structure.sql");	
		echo 'Versão exportada: '.self::getVersao();
	}

	//Importa a estrutura nova do banco
	public static function importStructure(){		
		exec("mysql -u ".DB_USER." -p".DB_PWD." ".DB_NAME." < " . self::getFileName() .'_v'. self::getVersao() . "Structure.sql");
	}	
	
	//Exporta dados de teste
	public static function exportFakeData(){
		exec("mysqldump -u ".DB_USER." -p".DB_PWD." ".DB_NAME." --no-create-info > ".self::getFileName() .'_v'. self::getVersao()."FakeData.sql");
	}

	//Importar dados de teste
	public static function importFakeData(){
		exec("mysql -u ".DB_USER." -p".DB_PWD." ".DB_NAME." < ".self::getFileName() .'_v'. self::getVersao()."FakeData.sql");
	}		


	//Exporta dados online
	//O parametro -t faz a inclusao dos nomes das colunas	
	public static function exportData(){
		//exec("mysqldump -u ".DB_USER." -p".DB_PWD." ".DB_NAME." --no-create-info > ".self::getFileName() .'_v'. self::getVersao()."Data.sql");
		exec("mysqldump -u ".DB_USER." -p".DB_PWD." ".DB_NAME." -c -t > ".self::getFileName() .'_v'. self::getVersao()."Data.sql");
	}	

	//Importar dados Online
	public static function importData(){
		exec("mysql -u ".DB_USER." -p".DB_PWD." ".DB_NAME." < ".self::getFileName() .'_v'. self::getVersao() ."Data.sql");
	}	

	//Gerar bkp da base autal
	public static function bkp(){		
		$date = date("dmYGis");
		exec("mysqldump -u ".DB_USER." -p".DB_PWD." ".DB_NAME." > " . self::getFileName() .'_v'. self::getVersao() ."BKP_{$date}.sql");
	}

}