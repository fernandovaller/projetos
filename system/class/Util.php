<?php 
namespace System;

class Util {

	public static function bootAlert($msg, $tipo = NULL, $title = NULL){
		$title_ = isset($title) ? "<strong>{$title}</strong>" : '';
		$tipo_ = isset($tipo) ? "alert-{$tipo}" : 'alert-success';
		$msg_ = isset($msg) ? $msg : '';
		$btn_close = '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';		
		return '<div class="alert '.$tipo_.'">'.$btn_close . $title_ . $msg_.'</div>';
	}	

	public static function getMessage($cat = 'msg'){  
		if(isset($_SESSION[$cat])){
			$msg = $_SESSION[$cat];
			unset($_SESSION[$cat]);
		}     
		return $msg;
	}

	public static function setMessage($msg, $cat = 'msg'){  
		$_SESSION[$cat] = $msg; 
	}    
	
	public static function formatCode($codigo, $qtd = '4', $caracter = '0'){  
		return str_pad($codigo, $qtd, "$caracter", STR_PAD_LEFT);
	}    

	public static function tooltip($title, $icon = true){
		$tool = 'data-toggle="tooltip" data-html="true" data-placement="top" title="'.$title.'"';		
		if($icon) return ' <i class="fa fa-info-circle fa-fw" '.$tool.'></i>';
		return $tool;
	}		

	public static function progressbar($valor, $min = 0, $max = 100){  
		if($valor >= 100) $c = 'progress-bar-success';
		if($valor >= 51 && $valor <= 99) $c = 'progress-bar-info';
		if($valor <= 50) $c = 'progress-bar-danger';
		return '<div class="progress m0"><div class="progress-bar '.$c.'" role="progressbar" aria-valuenow="'.$valor.'" aria-valuemin="'.$min.'" aria-valuemax="'.$max.'" style="width: '.$valor.'%;">'.$valor.'%</div></div>';
	}    	
}