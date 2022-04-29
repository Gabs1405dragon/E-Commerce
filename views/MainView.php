<?php 
namespace Views;

class MainView{
	
    public function render($arr = [],$fileName,$header = 'pages/templates/header.php',$footer = 'pages/templates/footer.php'){
	include($header);	
	include('pages/'.$fileName.'.php');
	include($footer);
	}
}

?>