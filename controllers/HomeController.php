<?php 
namespace controllers;

class HomeController{
	private $view;

	public function __construct(){
		$this->view = new \views\MainView();
	}

	public function index(){
		if(isset($_GET['addCar'])){
			$idProduto = (int)$_GET['addCar'];
			if(isset($_SESSION['carrinho']) == false){
				$_SESSION['carinho'] = array();
			}

			if(isset($_SESSION['carrinho'][$idProduto]) == false){
				$_SESSION['carrinho'][$idProduto] = 1;
			}else{
				$_SESSION['carrinho'][$idProduto]++;
			}
		\Models\UsersModel::redirect('home');
		}
		$this->view->render(['titulo'=>'Loja Virtual'],'home');
	}
}
?>