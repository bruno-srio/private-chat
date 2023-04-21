<?php
    session_start();
    include_once "server/config.php   ";
    if(isset($_SESSION["uniqueID"])){ //Impede o acesso a página de cadastro caso já haja uma sessão ativa
        header("location: subpages/users.php");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Chat da ESTA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Chat da ESTA</header>
            <form action="#" enctype="multipart/form-data">
                <span class="error-txt"></span>
                <div class="name-details">
                    <div class="field input">
                        <label>Nome</label>
                        <input type="text" name="fname" placeholder="Digite seu nome" maxlength="20" required>
                    </div>
                    <div class="field input">
                        <label>Sobrenome</label>
                        <input type="text" name="lname" placeholder="Digite seu sobrenome" maxlength="35" required>
                    </div>
                </div>
                <div class="field input">
                    <label>Email</label>
                    <input type="text" name="email" placeholder="Digite seu email" required>
                </div>
                <div class="field input">
                    <label>Senha</label>
                    <input type="password" name="password" placeholder="Digite sua senha" required>
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field image">
                    <label>Selecione uma imagem</label>
                    <input type="file" name="img" required>
                </div>
                <div class="field button">
                    <input type="submit" value="Continuar para o chat">
                </div>
            </form>
            <div class="link">Já possuí uma conta? <a href="subpages/login.php">Fazer login</a></div>
        </section>
    </div>
    <script src="js/hidePass.js"></script>
    <script src="js/signup.js"></script>
</body>

</html>