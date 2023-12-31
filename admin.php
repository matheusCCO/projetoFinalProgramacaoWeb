<?php require_once "function.php"; session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="layout/style.css">
	<title>Inserindo dados no Banco</title>
	<style type="text/css">
		
	</style>
</head>
<body>
	<main>
	<?php if(isset($_SESSION['ativa'])){ ?>

	<?php 
		$resultados = getUsers($connect);
		if (isset($_GET['id'])) {
			echo "<div class='excluir'><h3>Ter certeza que deseja excluir o usuários de id ". $_GET['id'] . "?</h3>"; 
			$idUser = $_GET['id'];
			?>
			<form  method="post">
				<input value="<?php echo $idUser; ?>" type="hidden" name="id" >
				<button name="deletar">Excluir</button>
				<button name="cancelar">Cancelar</button>
			</form>
			
		</div>
		<?php } ?>

		<?php
			if (isset($_POST['deletar'])) {
				delete($connect, $_POST['id']);
			}
			if(isset($_POST['cancelar'])){
				header("location: admin.php");
			}
		 ?>
		 
	<div class="divTabela">	 
		<table class="tabela">
			<tr>
				<th>Imagem</th>
				<th>Nome</th>
				<th>E-mail</th>
				<th>Telefone</th>
				<th>Ação</th>
			</tr>
			<?php foreach ($resultados as $resultado) { 
				$id = $resultado['id'];
				$nome = $resultado['nome'];
				$email = $resultado['email'];
				$telefone = $resultado['telefone'];
				$imagem = $resultado['imagem'];
				if(empty($imagem)){
					$imagem = "profile.png";
				}
			?>
				<tr>
					<td><img class="imagem" src="imagens/uploads/<?php echo $imagem;?>"></td>
					<td><?php echo $resultado['nome']; ?></td>
					<td><?php echo $resultado['email']; ?></td>
					<td><?php echo $resultado['telefone']; ?></td>
					<td>
						<a id="btn-editar" href="alteraCadastro.php?id=<?php echo $id;?>&nome=<?php echo $nome?>&email=<?php echo $email?>&telefone=<?php echo $telefone?>&imagem=<?php echo $imagem;?>"><img src="layout/assets/icones/editar.png" alt="Editar 3"></a>	
						<a href="admin.php?id=<?php echo $id;?>"> <img src="layout/assets/icones/deletar.png" alt="Deletar 3"></a>
					</td>
					
					
				</tr>
			<?php }	?>
		</table>
        <a id="btn-cadastro" href="cadastrar.php">Cadastrar novo Aluno</a>
     </div>
	 <?php }else{
    echo "<p>Voce não tem acesso a essa pagina</p>";

	} ?>
</main>
</body>
</html>