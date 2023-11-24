<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="admin.css">
    <title>Bem-vindo ao admin</title>
</head>
<body>
    <?php if(isset($_SESSION['ativa'])){ ?>

    
    <div class = "admin">
        <h1>Bem vindo ao painel Administrativo do site</h1>
        <p>Ola <?php echo $_SESSION["email"]; ?>, aqui voce tem acesso as ferramentas para administrar seu sistema</p>
    </div>
    <a href="deslogar.php" class="sair">Sair</a>
<?php }else{
    echo "<p>Voce não tem acesso a essa pagina</p>";
    } ?>
</body>
</html>