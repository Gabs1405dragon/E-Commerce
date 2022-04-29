<?php  
define('INCLUDE_PATH','http://localhost/E-commerce/views/pages/');
define('INCLUDE_PATH2','http://localhost/E-commerce/');
define("PATH_FULL","http://localhost/teste/git/Mvc/Views/pages");
session_start();
class Aplication{
	public static function run(){
		$url = (isset($_GET['url']) ? explode('/',$_GET['url'])[0] : 'Home' );
		$url = ucfirst($url);
		$url.= 'controller';
		if(file_exists('controllers/'.$url.'.php')){
		$novoClass = 'controllers\\'.$url;
		$method =  new $novoClass;
		$method->index();
		}else{
			die('Essa pagina não existe...');
		}
	}
}