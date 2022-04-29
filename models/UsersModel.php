<?php  
namespace Models;

class UsersModel{

	public static function pegarProdutos(){ 
		$produtos = \MySql::connect()->prepare("SELECT * FROM estoque ORDER BY id DESC LIMIT 8");
		$produtos->execute();
		$produtos = $produtos->fetchAll();
		return $produtos;
	}
	
	public static function pegarProdutosASC(){
		$produtos = \MySql::connect()->prepare("SELECT * FROM estoque ORDER BY id ASC LIMIT 4");
		$produtos->execute();
		$produtos = $produtos->fetchAll();
		return $produtos;
	}	

	public static function getCarrinho(){
		if(isset($_SESSION['carrinho'])){
		$amount = 0;
		foreach($_SESSION['carrinho'] as $carrinho){
		$amount+=$carrinho;
		}
		}else{
		return 0 ;
		}
		return $amount;
	}

	public static function redirect($redirect){
	echo '<script>location.href="'.$redirect.'"</script>';
	}

	public static function covertMoney($valor){
	return number_format($valor,2,',','.');
	}

	public static function pegarPost($post){
		if($_POST[$post]){
		echo $_POST[$post];
		}
	}

}