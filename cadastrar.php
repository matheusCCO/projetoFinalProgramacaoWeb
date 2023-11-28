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
    <h2><?php //insertUser($connect); ?></h2>
    <div>
        <?php if(isset($_SESSION['ativa'])){ ?>
            <form method="post">
                <input type="text" name="nome" placeholder="Seu nome">

                <input type="email" name="email" placeholder="Seu E-mail">
                <input type="phone" name="telefone" placeholder="telefone">
                
                <input type="submit" name="cadastrar" value="Cadastro">
            </form>
    </div>
        <?php }else{
            echo "<p>Voce não tem acesso a essa pagina</p>";
        } ?>
</body>
</html>