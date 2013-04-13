<?php
	
namespace php2js;
	
class Autoloader {
	public static function register() {
		spl_autoload_register(array(__CLASS__, 'autoload'));
	}
	
	public static function autoload($class) {
        if (0 !== strpos($class, __NAMESPACE__.'\\')) {
            return;
        }
		
		$class = ltrim($class,  __NAMESPACE__.'\\');
		
		require dirname(__FILE__) . '/' . str_replace('\\', '/', $class) . '.php';
	}
}