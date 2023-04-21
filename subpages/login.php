<?php
    session_start();
    include_once "../server/config.php";
    if(isset($_SESSION["uniqueID"])){ //Redireciona a página de usuários caso já haja uma sessão ativa
        header("location: users.php");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Chat da ESTA - Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
    <div class="wrapper">
        <section class="form login">
            <header>Chat da ESTA</header>
            <form action="#">
                <span class="error-txt"></span>
                <div class="field input">
                    <label>Email</label>
                    <input type="text" name="email" placeholder="Digite seu email" required>
                </div>
                <div class="field input">
                    <label>Senha</label>
                    <input type="password" name="password" placeholder="Digite sua senha" required>
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field button">
                    <input type="submit" name="submit" value="Continuar para o chat">
                </div>
            </form>
            <div class="link">Ainda não tem conta? <a href="../index.php">Registre-se aqui!</a></div>
        </section>
    </div>
    <script src="../js/hidePass.js"></script>
    <script src="../js/login.js"></script>
</body>

</html>