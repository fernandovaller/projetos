<?php
namespace System;

class Login {    

	protected static $session_name = 'admin';

    public static function sessionStart($name = 'admin'){
        self::$session_name = $name;        
        session_name(self::$session_name);
		session_start();
    }
    
    public static function verificar(){    	  		
		if (!isset($_SESSION['usuario_login']) || !isset($_SESSION['usuario_senha']))
            return false;
        return true;
    }

    public static function sair(){    	
		unset($_SESSION);
		session_destroy();		
    }

     public static function debug(){    	
     	var_dump($_SESSION);
     }
}