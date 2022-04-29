<section class="finalizar" >
	<div class="center" >
		<div class="title__produto" >
			<h2 style="color:black;" >Carrinho</h2>
		</div>
		<div class="wrap__table" >
			<table>
				<thead>
					<tr>
						<td>Nome do produto</td>
						<td>Quantidade</td>
						<td>Valor</td>
					</tr>
				</thead>
				<tbody>
				<?php 
				if(isset($_SESSION['carrinho'])){
				$itemCarrinho = $_SESSION['carrinho'];
				$total = 0; 
				foreach($itemCarrinho as $key => $value){
				$idProduto = $key;
				$produto = \MySql::connect()->prepare("SELECT * FROM estoque WHERE id = $idProduto");
				$produto->execute();
				$produto = $produto->fetch();
				$valor = $value*$produto['preco'];
				$total+=$valor;
				
				?>
					<tr>
						<td><?php echo $produto['nome']; ?></td>
						<td><?php echo $value; ?> </td>
						<td>R$<?php echo \Models\UsersModel::covertMoney($valor)  ?></td>
					</tr>
					<?php } }?>
				</tbody>
			</table>
		</div>

		<div class="total">
			<h2>Total: <?php if(isset($_SESSION['carrinho'])){  echo 'R$'.\Models\UsersModel::covertMoney($total); }else{ echo 'Não tem nenhum produto no carrinho..';}?></h2>
			 <?php if(isset($_SESSION['carrinho'])){  echo '<a class="btn" href="" >Pagar Agora!!</a>'; }else{ echo '<a href="home" >Escolha um produto!!</a>';}?>
		</div>
		<div class="clear"></div>
	</div>
</section>