<?php
class Autoloader{
	
	//charge les classes dont elle reçoit le nom en paramètre
	public static function autoload($class){
		require_once $class . ".php";
	}
	
	//lie toutes les classes chargées au projet
	public static function register(){
		spl_autoload_register(array(__CLASS__, "autoload"));
	}
}
