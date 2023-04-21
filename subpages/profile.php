<?php
session_start();
include_once "../server/config.php   ";
if (!isset($_SESSION["uniqueID"])) { //Impede o acesso a página de cadastro caso já haja uma sessão ativa
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Seu perfil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
    <div class="wrapper">
        <?php
        // Recupera da base de dados as informações do usuário que fez login
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE uniqueID = {$_SESSION["uniqueID"]}");
        if (mysqli_num_rows($sql) > 0) {
            $userData = mysqli_fetch_assoc($sql);
        }
        ?>
        <section id="profile" class="chat-area">
            <header>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <!-- === user info === -->
                <img src="../img/<?php echo $userData['img']; ?>" alt="">
                <div class="details">
                    <span>
                        <?php echo $userData['fname'] . " " . $userData['lname'] ?>
                    </span>
                </div>
                <!-- === ========= === -->
            </header>
        </section>
        <section class="form signup">
            <h1>Informações do perfil</h1>
            <form action="#" enctype="multipart/form-data">
                <span class="error-txt"></span>
                <div class="name-details">
                    <div class="field input">
                        <label>Nome</label>
                        <input type="text" name="fname" placeholder=<?php echo $userData['fname'] ?> maxlength="20">
                    </div>
                    <div class="field input">
                        <label>Sobrenome</label>
                        <input type="text" name="lname" placeholder=<?php echo $userData['lname'] ?> maxlength="35">
                    </div>
                </div>
                <div class="field input">
                    <label>Email</label>
                    <input type="text" name="email" placeholder="<?php echo $userData['email'] ?>">
                </div>
                <div class="field input">
                    <label>Senha</label>
                    <input type="password" name="password" placeholder="Digite sua nova senha">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field image">
                    <label>Selecione uma imagem</label>
                    <input type="file" name="img">
                </div>
                <div class="field button">
                    <input type="submit" value="Atualizar informações">
                </div>
            </form>
        </section>
    </div>
    <script src="../js/hidePass.js"></script>
    <script src="../js/profile.js"></script>
</body>

</html>