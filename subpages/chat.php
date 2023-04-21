 <?php
    session_start();
    // include_once "../server/config.php";
    if(!isset($_SESSION["uniqueID"])){
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
    <title>Chat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <?php
                    // Obtém o userID a partir da URL e recupera os dados do usuário do banco de dados
                    include_once "../server/config.php";
                    // Verificar se o userID foi passado via GET
                    if (isset($_GET['userID'])){
                        // Escapar o userID para prevenir ataques de injeção SQL
                        $userID = mysqli_real_escape_string($conn, $_GET['userID']);
                            // Recupera os dados do usuário do banco de dados
                            $userDataQuery = mysqli_query($conn, "SELECT * FROM users WHERE uniqueID = '{$userID}'");
                             // Se os dados do usuário existem, armazena na variável $userData se não redireciona para users.php
                            if(mysqli_num_rows($userDataQuery) > 0){
                                $userData = mysqli_fetch_assoc($userDataQuery);
                            }else{
                                header("location: users.php");
                            }
                        }
                ?>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <!-- === user info === -->
                <img src="../img/<?php echo $userData['img']; ?>" alt="foto de perfil">
                <div class="details">
                    <span><?php echo $userData['fname']. " " . $userData['lname'] ?></span>
                    <p><?php echo $userData['status']; ?></p>
                </div>
                <!-- === ========= === -->
            </header>
            <div class="chat-box">
                           
            </div>
            <form action="#" class="typing-area" autocomplete="off">
                <input type="text" name="userID" value="<?php echo $_SESSION["uniqueID"]; ?>" hidden>
                <input type="text" name="receivingID" value="<?php echo $userID; ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Digite uma mensagem..." maxlength="255">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>
    <script src="../js/chat.js"></script>
</body>

</html>