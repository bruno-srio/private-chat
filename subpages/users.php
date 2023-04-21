<?php
session_start();
include_once "../server/config.php";
if (!isset($_SESSION["uniqueID"])) {
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
    <title>Mensagens</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
    <div class="wrapper">
        <section class="users">
            <header>
                <div class="content">
                    <?php
                    // Recupera da base de dados as informações do usuário que fez login
                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE uniqueID = {$_SESSION["uniqueID"]}");
                    if (mysqli_num_rows($sql) > 0) {
                        $userData = mysqli_fetch_assoc($sql);
                    }
                    ?>
                    <!-- === user info === -->
                    <img src="../img/<?php echo $userData['img'] ?>" alt="">
                    <div class="details">
                        <span>
                            <?php echo $userData['fname'] . " " . $userData['lname'] ?>
                        </span>
                        <p><?php echo $userData['status'] ?></p>
                    </div>
                    <!-- === ========= === -->
                </div>
                <button><i class="fas fa-chevron-down"></i></button>
                <a href="../server/logout.php?logoutID=<?php echo $userData['uniqueID']; ?>" class="default">Logout</a>
            </header>
            <section class="hidden-op">
                <a href="profile.php" class="default">Configurações</a>
                <a href="../server/deleteUser.php?logoutID=<?php echo $userData['uniqueID']; ?>" class="delete">Excluir conta</a>
            </section>
            <div class="search">
                <span class="text">Selecione um usuário para conversar</span>
                <input type="text" placeholder="Digite o nome para pesquisar...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <section class="users-list">

            </section>
        </section>
    </div>
    <script src="../js/users.js"></script>
</body>

</html>