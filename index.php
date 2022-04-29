<?php 
include('vendor/autoload.php');
$autoload = function($class){
	if(file_exists($class.'.php')){
		include($class.'.php');
	}else{
		echo 'o Arquivo não existe!!';
	}
};

spl_autoload_register($autoload);

$aplication = new Aplication();
$aplication::run();