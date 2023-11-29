<?php require_once "function.php"; session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="layout/styleLogin.css">
    <title>Document</title>
</head>
<body>
    <a href="admin.php"><img src="layout/assets/icones/seta-esquerda.png" alt="Deletar 3" ></a>
    <?php 
    updateAluno($connect); 
    if(isset($_GET['id']) && isset($_GET['nome'])){
        $idUser= $_GET['id'];
        $nomeUser = $_GET['nome'];
        $emailUser = $_GET['email'];
        $telefoneUser = $_GET['telefone'];
    }
    ?>
    <div class="cadastro">
        
        <?php if(isset($_SESSION['ativa'])){ ?>
            <form method="post">
            <h1>Aleter Informações de um Aluno</h1>
                <input name="id" placeholder="Seu nome" value="<?php echo $idUser?>">

                <input type="text" name="nome" placeholder="Seu nome" value="<?php echo $nomeUser?>">

                <input type="email" name="email" placeholder="Seu E-mail" value="<?php echo $emailUser?>">

                <input type="phone" name="telefone" placeholder="telefone" value="<?php echo $telefoneUser?>">
                
                <input type="submit" name="alterar" value="Cadastro">
            </form>
            <a href="admin.php"></a>
    </div>
        <?php }else{
            echo "<p>Voce não tem acesso a essa pagina</p>";
        } ?>
</body>
</html>