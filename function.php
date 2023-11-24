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
			$query = "SELECT * FROM cliente WHERE email = '$email' AND senha = '$senha' ";
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
				echo "E-mail ou senha não encontrados";
			}
		}else{
			echo "E-mail ou senha incorretos!";
		}
	}
}






?>