<?php require_once "function.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="layout/styleLogin.css">
    <title>Login</title>
</head>
<body>
    <main>
    
    <div class="divLogin">
        <h1>Mais Academia</h1>
        <form method="POST">
            <input type="email" name="email" placeholder="E-mail">
            <input type="password" name="senha" placeholder="Senha">
            <input type="submit" name="logar" value="Login">
        </form>
        <?php login($connect)?>
    </div>
    </main>
</body>
</html>