<?php
$server = "localhost";
$userDb = "root";
$passDb = "";
$database = "maisacademia";

$connect = mysqli_connect($server, $userDb, $passDb, $database);

function login($connect){
	if ( isset($_POST['logar']) ) {
		$email = mysqli_real_escape_string( $connect, $_POST['email'] );
		$senha = mysqli_real_escape_string( $connect, $_POST['senha'] );
		if (!empty($email) and !empty($senha)) {
			//$senha = sha1($senha);
			$query = "SELECT * FROM adm WHERE email = '$email' AND senha = '$senha' ";
			$execute = mysqli_query($connect, $query);
			//retorna array associativo (apenas resultado)
			$result = mysqli_fetch_assoc($execute);
			//Verifica se encontrou um email e senha
			if ( !empty($result['email']) ) {
				//inicia session (loga)
				session_start();
				$_SESSION['nome'] = $result['nome'];
				$_SESSION['email'] = $result['email'];
				$_SESSION['ativa'] = true;
				//Redireciona para uma página
				header("location: admin.php");
			}else{
				echo "<p>E-mail ou senha não encontrados</p>";
			}
		}else{
			echo "<p>E-mail ou senha incorretos!</p>";
		}
	}
}

function getUsers($connect){
	$query = "SELECT * FROM cliente WHERE 1 ORDER BY nome";
	$action = mysqli_query( $connect, $query );
	$results = mysqli_fetch_all($action, MYSQLI_ASSOC);
	return $results;
}

function delete($connect, $id){
	$query = "DELETE FROM cliente WHERE id = $id";
	$action = mysqli_query( $connect, $query );
	if ($action) {
		echo "Registro deletado com sucesso";
		header("location: admin.php");
	}else{
		echo "Erro ao deletar";
	}
}


function insertUser($connect){
	if (isset($_POST['cadastrar'])) {
		$nome = mysqli_real_escape_string($connect, $_POST['nome']);
		$email = mysqli_real_escape_string($connect, $_POST['email']);
		$telefone = mysqli_real_escape_string($connect, $_POST['telefone']);
		if (!empty($nome) and !empty($email)) {
			$query = "INSERT INTO cliente (nome, email, telefone) VALUES ( '$nome', '$email', '$telefone') ";
			$execute = mysqli_query($connect, $query);
			if ($execute) {
				echo "Usuário inserido com sucesso.";
			}else{
				echo "Erro ao inserir.";
			}
		}
	}
}


function updateAluno($connect){
	if (isset($_POST['alterar'])) {
		$id=mysqli_real_escape_string($connect, $_POST['id']);
		$nome = mysqli_real_escape_string($connect, $_POST['nome']);
		$email = mysqli_real_escape_string($connect, $_POST['email']);
		$telefone = mysqli_real_escape_string($connect, $_POST['telefone']);
		if (!empty($nome) and !empty($email) and !empty($telefone)) {
			$query = "UPDATE cliente SET nome = '$nome', email = '$email', telefone = '$telefone' WHERE cliente.id = '$id'";
			$execute = mysqli_query($connect, $query);
			if ($execute) {
				echo "Informações alterados com sucesso.";
			}else{
				echo "Erro ao alterar.";
			}
		}
	}
}


?>