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
	//Retorna apenas o 1º valor da tabela
	//$results = mysqli_fetch_assoc($action);
	//MYSQLI_BOTH - MYSQLI_NUM - MYSQLI_ASSOC
	$results = mysqli_fetch_all($action, MYSQLI_ASSOC);
	return $results;
}



?>