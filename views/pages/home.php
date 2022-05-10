<?php use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\PHPException; ?>
<section class="search" >
	<div class="center">
		<div class="busca__wrap" >
			<form method="post" >
				<input type="text" placeholder="Faça uma busca sobre o nome do produto que você quer encontrar!!!" name="search" >
				<input type="submit" value="buscar" name="buscar" >
			</form>
		</div>
	</div>
</section>
<section class="produtos" >
<div class="center" >
<div class="title__produto" >
	<h2>Todos os Produtos</h2>
	<p>Aqui em baixo tem todos os produtos da loja atualmente!!!</p>
</div>
<?php 
           $query = '';
           if(isset($_POST['buscar']) && $_POST['buscar']  == 'buscar'){
                $nome = $_POST['search'];
                $query = "WHERE (nome LIKE '%$nome%' OR descricao LIKE '%$nome%')";
           }
           if($query == ''){
            $query2 = "WHERE quantidade > 0";
           }else{
               $query2 = "AND quantidade > 0";
           }
           $produto = \MySql::connect()->prepare("SELECT * FROM `estoque` $query $query2 ORDER BY id DESC LIMIT 8");
           $produto->execute();
           $produtos = $produto->fetchAll();
           if($query != ''){
            echo '<div><p>Foram encontrados <b>'.count($produtos).'</b> resultado(s)</p><div>';
           }
           
           foreach($produtos as $key => $produto){
                if($produto['quantidade'] == '0'){
            continue;
           }
               $imagemSingle = \MySql::connect()->prepare("SELECT * FROM `estoque_imagem` WHERE produto_id = '$produto[id]'");
               $imagemSingle->execute();
               @$imagem = $imagemSingle->fetch();
               ?>
<?php 



?>

<div class="produto__wrap" >
	<div class="produto__single" >
		<div class="produto__img" >
		<img src="<?php echo PATH_FULL ?>/uploads/<?php echo $imagem['imagem']; ?>" >
		</div>
		<div class="produto__content" >

		<h2><?php echo $produto['nome'] ?></h2>
		<h3><?php echo $produto['descricao'] ?></h3>
		<p>R$<?php echo \Models\UsersModel::covertMoney( $produto['preco']) ?></p>
		<a href="home?addCar=<?php echo $produto['id']; ?>" >Adicionar no carrinho</a>
		</div>
	</div>
</div>
<?php } ?>
<div class="clear" ></div>
</div>
</section>

<section class="produtos" >
<div class="center" >
<div class="title__produto" >
	<h2>Produtos recentes da loja</h2>
	<p>Produtos recentes que acabaram de chegar na loja!!</p>
</div>
<?php 
$produtos = \Models\UsersModel::pegarProdutosASC();
foreach($produtos as $produto){
$imagem = \MySql::connect()->prepare("SELECT * FROM estoque_imagem WHERE produto_id = ? ");
$imagem->execute(array($produto['id']));
@$imagem = $imagem->fetch()['imagem'];
?>

<div class="produto__wrap" >
	<div class="produto__single" >
		<div class="produto__img" >
		<img src="<?php echo PATH_FULL ?>/uploads/<?php echo $imagem; ?>" >
		</div>
		<div class="produto__content" >

		<h2><?php echo $produto['nome'] ?></h2>
		<h3><?php echo $produto['descricao'] ?></h3>
		<p>R$<?php echo \Models\UsersModel::covertMoney( $produto['preco']) ?></p>
		<a href="home?addCar=<?php echo $produto['id']; ?>" >Adicionar no carrinho</a>
		</div>
	</div>
</div>
<?php } ?>
<div class="clear" ></div>
</div>
</section>

<section class="banner" >
	<div class="title__produto" >
		<h2>e tem muito mais!!</h2>
		<p>Navegue no site porque tem muitos produtos em feita condição!!</p>
	</div>
<div class="background" >

</div>
</section>

<section class="contato" >
    <div class="center" >
	<div class="title__produto" >
		<h2>entre em Contato</h2>
		<p>Você pode entrar em contato atraveis desse formulário em baixo!!</p>
		<?php 
		function validarTelefone($telefone){
		$expressao = '/^[0-9]{4}\-[0-9]{4}$/';
		return preg_match($expressao,$telefone);
		};


		if(isset($_POST['enviar'])){
		
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$telefone = $_POST['telefone'];
		$mensagem = $_POST['mensagem'];
			if(empty($nome) || empty($email) || empty($telefone) || empty($mensagem)){
				echo '<div class="erro" >Preencha todos os campos!!!</div>';
			}else{
				if(validarTelefone($telefone)){
					$mail = new PHPMailer(true);
                try{
                    
                    $mail->SMTPDebug = 0;
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'email';
                    $mail->Password = 'senha';
                    $mail->Port = 587;
                
                    $mail->isHTML(true);
                    $mail->CharSet = 'UTF-8';
                    $mail->setFrom('email','Gabs');
                    $mail->addAddress($email, $nome);
                
                    //$email->isHTML(true);
                    $mail->Subject = 'ola';
                    $informacoes =  $mensagem;
                    $mail->Body =  $informacoes;
                    $mail->AltBody = $informacoes;
                
                    if($mail->send()){
                        echo 'email enviado com sucesso!';
						echo '<script>location.href="home"</script>';
                    }else{
                        echo 'email não enviado';
                    }
                    
                }catch(Exception $e){
                    echo "Erro ao enviar o email: {$mail->ErrorInfo}";
                }

				}else{
					echo 'telefone inválido';
				}
			}
		}
		?>
	</div>
		<div class="form__wrap" >
			<form method="post" >
				<div class="form__group w50 right">
					<input type="text" value="<?php echo @\models\UsersModel::pegarPost('nome'); ?>" name="nome" placeholder="Seu nome!!!" />
				</div>
				<div class="form__group w50">
					<input type="email" value="<?php echo @\models\UsersModel::pegarPost('email'); ?>" name="email" placeholder="Seu email!!!" />
				</div>
				<div class="clear" ></div>
				<div class="form__group">
					<input type="text" value="<?php echo @\models\UsersModel::pegarPost('telefone'); ?>" name="telefone" placeholder="999-9999..." />
				</div>
				<div class="form__group">
					<textarea name="mensagem" placeholder="Uma mensagem!!!" ><?php echo @\models\UsersModel::pegarPost('mensagem'); ?></textarea>
				</div>
				<div class="form__group">
					<input type="submit" name="enviar" value="Enviar" />
				</div>
			</form>
		</div>
	</div>
</section>

<footer>
	<div class="center">
		<div class="w33">
			<h2>Todas as categorias!!</h2>
			<?php for($i = 0;$i <= 10;$i++){ ?>
			<p>Roupas</p>
			<hr/>
			<?php }  ?>
		</div>
		<div class="w33">
			<h2>Meios de contatos</h2>
			<p>Intagram: </p>
			<p>Email: </p>

		</div>
		<div class="w33">
			<h2>Sobre a loja!!</h2>
			<p>Essa loja é uma loja unica e totalmente original!!</p>
		</div>
		<div class="clear" ></div>
	</div>
</footer>

<div class="footer" style="text-align:center;padding:20px;" ><p>Todos os direitos reservados sobre <b>"Gabriel.H Assis de souza"</b></p></div>
