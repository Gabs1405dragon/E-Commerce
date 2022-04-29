<html lang="pt-br" >
<head>
<meta http-equiv="X-UA-Compatible" content="IE-edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<meta name="keywords" content="E-Commerce,produto,loja,quantidade,preco,roupas,computadores" />
<meta name="description" content="Um E-Commerce Para vender os meus produtos!!" />
<meta name="author" content="Gabriel.H Assis de Souza" />
<meta charset="utf-8" />
<title><?php echo $arr['titulo']; ?></title>
<link rel="shortcut icon" href="<?php echo INCLUDE_PATH ?>img/Loja.ico" type="image-x/png">
<link rel="stylesheet" href="<?php echo INCLUDE_PATH ?>Style/ecommerce.css" />
</head>
<body>
<?php  
if(isset($_GET['limpa'])){
	session_destroy();
	echo '<script>location.href="home"</script>';
}
?>
<header>
	<div class="center" >
		<div class="logo" ><a href="<?php echo INCLUDE_PATH2 ?>home" >Loja Virtual</a></div>
		<nav class="menu_desktop" >
			<ul>
				<li><a href="" >Carrinho(<?php echo \Models\UsersModel::getCarrinho(); ?>)</a></li>
				<li><a href="<?php echo INCLUDE_PATH2 ?>home?limpa" >Limpa Carrinho</a></li>
				<li><a href="<?php echo INCLUDE_PATH2 ?>finalizar" >Finalizar Pedido</a></li>
			</ul>
		</nav>
		<div class="clear"></div>
	</div>
</header>

<div class="barra" >
	<?php $url = explode('/',@$_GET['url'])[0];
	if($url == 'finalizar'){
	?>
	<h3>Feche o seu pedido</h3>
	<?php }else{?>
	<h3>Escolher os seus produtos e compre agora!</h3>
	<?php }?>
</div>
