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
        <main>
        <h2><?php insertUser($connect); ?></h2>
        
        <div class="cadastro">
            <h1>Cadastro</h1>
            <?php if(isset($_SESSION['ativa'])){ ?>
                <form method="post" enctype="multipart/form-data">
                
                    <input type="text" name="nome" placeholder="Nome">

                    <input type="email" name="email" placeholder="E-mail">

                    <input type="phone" name="telefone" placeholder="Telefone">
                    <input type="file" name="imagem">
                    
                    <input type="submit" name="cadastrar" value="Cadastro">
                </form>
                <a href="admin.php"></a>
        </div>
            <?php }else{
                echo "<p>Voce não tem acesso a essa pagina</p>";
            } ?>
        </main>
</body>
</html>