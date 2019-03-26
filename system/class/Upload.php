<?php
namespace System;
/***************************************************
Class para upload de arquivos
fernandovaller@gmail.com

Exemplo de uso:
  $upload = new Upload('../uploads/contratos/');        

  //validações
  $upload->set_file_max_size(10); //tamanho maximo do arquivo em MB   
  $upload->set_file_type('application/pdf'); //tipos de arquivos permitidos

  $upload->file($_FILES['arquivo']);         

  $results = $upload->save( get_contrato($id_contrato) );        

  if(is_array($results)){
     //exibindo os erros            
     print_r($results); 
     exit(); 
  }
****************************************************/

class Upload {

	private $caminho;
	private $file;
	private $file_name;
	private $file_tmp_name;	
	private $file_max_size;
	private $file_types = array();
	private $errors = array();
	private $file_new;		
	
	public function __construct($destino = '') {

		if(!$destino){
			$this->set_error('Favor informar um destinho. Ex: ../uploads/');
		}

		$this->caminho = $destino;					
	}

	//seta o arquivo enviado 
	public function file($file) {
		if(!$file)
			$this->set_error('Arquivo não enviado');
		$this->file = $file;
		$this->file_name = $file['name'];
		$this->file_tmp_name = $file['tmp_name'];		
	}
	
	//faz o upload do arquivo, caso passe nas validações
	public function save($nome_arquivo = 'file'){

		if(!$this->create_dir()){
			$this->set_error('Erro ao criar diretorio.');
		}

		// Gera um nome único para a imagem
		$this->file_new = strtolower($nome_arquivo) .'-'. md5(uniqid(time())) . '.' . strtolower($this->get_ext());   

		if($this->check()){		
			if(move_uploaded_file($this->file_tmp_name, $this->caminho . $this->file_new)){
				return $this->file_new;																								
			} else { $this->set_error('Erro, nao foi possivel copiar o arquivo para a pasta de destino.'); }			
		}

		return $this->get_errors(); 
	}

	//cria o diretorio caso nao exista
	protected function create_dir(){
		if (!file_exists($this->caminho)) {
			$r = mkdir($this->caminho, 0777, true);
			@chmod($this->caminho, 0777);
			return $r;
		}
		return true;
	}

	//retorna o tipo de arquivo
	protected function get_file_type(){
		return $this->file['type'];
	}

	//retorno o tamanho do arquivo
	protected function get_file_size(){
		return $this->file['size'];
	}

	//define o tamanho maximo permitido
	public function set_file_max_size($size) {
		$this->file_max_size = $size;		
	}	

	//converte para MB
	protected function bytes_to_mb($bytes) {
		return round(($bytes / 1048576), 2);
	}

	//verifica o tamanho do arquivo
	protected function check_file_size() {
		if (!empty($this->file_max_size)) {

			$file_size_in_mb = $this->bytes_to_mb($this->file['size']);

			if ($this->file_max_size <= $file_size_in_mb) {

				$this->set_error('Tamanho do arquivo nao permitido! Max.: '.$this->file_max_size.' MB');

			}
		}
	}	

	//seta os erros encontrados
	public function set_error($message) {
		$this->errors[] = $message;		
	}

	//verificar as validações
	public function check() {

		//tamanho do arquivo
		$this->check_file_size();		

		//tipo do arquivo
		$this->check_file_type();

		//verifica se tem algum erro		
		if( empty($this->get_errors()) ){
			return true;				
		} 

		return false;				
	}

	//retorno o array com os errors
	public function get_errors() {		
		return $this->errors; 
	}	

	//define o tamanho maximo permitido
	public function set_file_type($type) {
		if(count($type) > 0)
			foreach ($type as $key => $value) {
				$this->file_types[] = $value;					
			}		
	}	

	//verifica se o tipo de arquivo enviado está entre os arquivos permitidos	
	protected function check_file_type() {		
		if (!empty($this->file_types)) {
			if (!in_array($this->file['type'], $this->file_types)) {
				$this->set_error('Tipo de arquivo nao permitido. Type:' . $this->get_file_info());
			}
		}
	}

	//pega extensão do arquivo
	protected function get_ext(){
		return pathinfo($this->file['name'], PATHINFO_EXTENSION);
	}

	//pegar informações do arquivo
	protected function get_file_info(){				
		foreach ($this->file as $key => $value) {
			$aux .= $key.':"'.$value.'";';
		}
		return $aux;
	}

}