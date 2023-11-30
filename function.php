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
		echo "<h2 class='msg'>Registro deletado com sucesso</h2>";
		header("location: admin.php");
	}else{
		echo "<h2 class='msg'>Erro ao deletar</h2>";
	}
}


function insertUser($connect){
	if (isset($_POST['cadastrar'])) {
		$nome = mysqli_real_escape_string($connect, $_POST['nome']);
		$email = mysqli_real_escape_string($connect, $_POST['email']);
		$telefone = mysqli_real_escape_string($connect, $_POST['telefone']);
		$imagem = !empty($_FILES['imagem']['name']) ? $_FILES['imagem']['name'] : "";
		if(!empty($imagem)){
			$caminho = "imagens/uploads/";
			$imagem = uploadImg($caminho);
		}

		if (!empty($nome) and !empty($email) and !empty($imagem) and !empty($telefone)) {
			$query = "INSERT INTO cliente (nome, email, telefone, imagem) VALUES ( '$nome', '$email', '$telefone', '$imagem')";
			$execute = mysqli_query($connect, $query);
			if ($execute) {
				echo "<h2 class='msg'>Usuário inserido com sucesso.</h2>";
			}else{
				echo "<h2 class='msg'>Erro ao inserir.</h2>";
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
				echo "<h2 class='msg'>Informações alterados com sucesso.</h2>";
			}else{
				echo "<h2 class='msg'>Erro ao alterar.</h2>";
			}
		}
	}
}

function uploadImg($caminho){
	if(isset($_POST['cadastrar'])){
		//print_r($_FILES);
		
		if(!empty($_FILES['imagem']['name'])){
			
			$nomeImagem= $_FILES['imagem']['name'];
			$tipo = $_FILES['imagem']['type'];
			$nomeTemporario = $_FILES['imagem']['tmp_name'];
			$tamanho = $_FILES['imagem']['size'];
			$erros = array();
			$tamanhoMaximo = 1024 * 1024 * 5;
			if ($tamanho > $tamanhoMaximo){
				$erros[]="<h2 class='msg'>Seu arquivo exede o tamanho maxino</h2>";

			}
			$arquivosPermitido = ["png","jpg","jpeg", "PNG","JPG","JPEG"];
			$extensao = pathinfo($nomeImagem, PATHINFO_EXTENSION);
			if(!in_array($extensao, $arquivosPermitido)){
				$erros[]="<h2 class='msg'>Arquivo não pernitido.</h2>";
			}
			$typePermitido = ["image/png","image/jpg","image/jpeg"];
			if(!in_array($tipo, $typePermitido)){
				$erros[]="<h2 class='msg'>Tipo Arquivo não pernitido</h2>";
			}
			if(!empty($erros)){
				foreach($erros as $erro){
					echo $erro;
				}
			} else{
				//$caminho = "upload/";
				$data = date("d-m-Y_h-i");
				$novoNome= $data."-".$nomeImagem;
				if(move_uploaded_file($nomeTemporario, $caminho.$novoNome)){
					return $novoNome;
					
				}else{
					return FALSE;
				}
			}
		}
	}

}


?>