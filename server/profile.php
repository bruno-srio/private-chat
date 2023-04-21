<?php
    session_start();
    include "config.php";

    if(!isset($_SESSION['uniqueID'])){
        echo "You are not logged in";
        exit;
    }

    // Obtém ID do usuário atual
    $uniqueID = $_SESSION['uniqueID'];

    // Prepara a variável setClause para a query
    $setClause = "";

    // Verifica se cada campo está preenchido e adiciona a setClause
    if (!empty($_POST['fname'])) {
        $userFName = mysqli_real_escape_string($conn, $_POST['fname']);
        $setClause .= "fname = '$userFName',";
    }

    if (!empty($_POST['lname'])) {
        $userLName = mysqli_real_escape_string($conn, $_POST['lname']);
        $setClause .= "lname = '$userLName',";
    }

    if (!empty($_POST['email'])) {
        $emailAddress = mysqli_real_escape_string($conn, $_POST['email']);
        if(filter_var($emailAddress, FILTER_VALIDATE_EMAIL)){
            $emailCheckQuery = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$emailAddress}'");
            if(mysqli_num_rows($emailCheckQuery) > 0){
                echo "Esse email já existe!";
                exit;
            }else{
                $setClause .= "email = '$emailAddress',";
            }
        }else{
            echo "Email inválido!";
            exit;
        }
    }

    // Verifica se o usuário enviou uma nova senha
    if (!empty($_POST['password'])) {
        $passwordInput = mysqli_real_escape_string($conn, $_POST['password']);
        $hashOptions = [ 
            'cost' => 12,
        ];
        $hashedPassword = password_hash($passwordInput, PASSWORD_BCRYPT, $hashOptions);
        $setClause .= "password = '$hashedPassword',";
    }

    // Verifica se o usuário enviou uma nova imagem
    if (isset($_FILES["img"])) {
        $imgName = $_FILES["img"]["name"];
        $tempImgName = $_FILES["img"]["tmp_name"];
        $imgNameArray = explode('.', $imgName);
        $imgExtension = end($imgNameArray);
        $allowedExtensions = ["jpeg", "jpg", "png", "gif"];

        // Verifica se a extensão da imagem é permitida
        if (in_array($imgExtension, $allowedExtensions) === true) {
            $time = time();
            $renamedImgName = $time . $imgName;
            if (move_uploaded_file($tempImgName, "../img/" . $renamedImgName)) {
                $setClause .= "img = '$renamedImgName',";
            } else {
                echo "Error uploading image";
                exit;
            }
        }
    }

    // Se não houver nada para atualizar, sai do script
    if (empty($setClause)) {
        echo "Nenhum dado foi alterado!";
        exit;
    }

    // Remove a ',' da setClause
    $setClause = rtrim($setClause, ',');

    // Atualiza as informações
    $query = "UPDATE users SET $setClause WHERE uniqueID = $uniqueID";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Informações atualizadas com sucesso";
    } else {
        echo "Error updating user information: " . mysqli_error($conn);
    }
