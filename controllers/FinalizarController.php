<?php 
namespace Controllers;

class FinalizarController{
	private $view;

	public function __construct(){
		$this->view = new \Views\MainView();
	}

	public function index(){
		$this->view->render(['titulo'=>'finalizar a sua compra!!'],'finalizar');
	}
}