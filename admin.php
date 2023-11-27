<?php require_once "function.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="layout/style.css">
	<title>Inserindo dados no Banco</title>
	<style type="text/css">
		input, textarea{
			display: block;
			margin-top: 10px;
		}
	</style>
</head>
<body>


	<?php 
		$resultados = getUsers($connect);
		if (isset($_GET['id'])) {
			echo "Ter certeza que deseja excluir o usuários de id ". $_GET['id'] . "?"; 
			$idUser = $_GET['id'];
			?>
			<form method="post">
				<input value="<?php echo $idUser; ?>" type="hidden" name="id" >
				<button name="deletar">Excluir</button>
			</form>
		<?php } ?>
		<?php
			if (isset($_POST['deletar'])) {
				delete($connect, $_POST['id']);
			}
		 ?>
	 <table border="1">
	 	<tr>
	 		<th>Nome</th>
	 		<th>E-mail</th>
	 		<th>Telefone</th>
            <th>Ação</th>
	 	</tr>
	 	<?php foreach ($resultados as $resultado) { 
	 		$id = $resultado['id'];
	 	?>
	 		<tr>
	 			<td><?php echo $resultado['nome']; ?></td>
	 			<td><?php echo $resultado['email']; ?></td>
                 <td><?php echo $resultado['telefone']; ?></td>

	 			<td>
	 				<a href="insert.php?id=<?php echo $id;?>">
	 					Deletar
	 				</a>
	 			</td>
	 		</tr>
	 	<?php }	?>
	 </table>

     <div>
        <a href="cadastrar.php">Cadastrar novo Aluno</a>
     </div>


</body>
</html>