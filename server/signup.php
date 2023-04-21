<?php
    //error_reporting(E_ALL); ini_set('display_errors', 1);
    session_start();
    include "config.php";
    $userFName = mysqli_real_escape_string($conn, $_POST['fname']);
    $userLName = mysqli_real_escape_string($conn, $_POST['lname']);
    $emailAddress = mysqli_real_escape_string($conn, $_POST['email']);
    $passwordInput = mysqli_real_escape_string($conn, $_POST['password']);


    //Verifica se os campos estão preenchidos
    if(!empty($userFName) && !empty($userLName) && !empty($emailAddress) && !empty($passwordInput)){

        //Verifica se o email é válido
        if(filter_var($emailAddress, FILTER_VALIDATE_EMAIL)){
            
            //Verifica se o email já existe
            $emailCheckQuery = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$emailAddress}'");
            if(mysqli_num_rows($emailCheckQuery) > 0){
                echo "Esse email já existe!";
            }else{
                //Verifica se a imagem foi enviada
                if(isset($_FILES["img"])){
                    $imgName = $_FILES["img"]["name"]; //Nome da imagem
                    $tempImgName = $_FILES["img"]["tmp_name"]; //Nome temporário do arquivo
                    
                    $imgNameArray = explode('.', $imgName); //Separa o nome da imagem e a extensão
                    $imgExtension = end($imgNameArray); //Guarda a extensão da imagem
                    $allowedExtensions = ["jpeg", "jpg", "png", "gif"]; //Extensões permitidas

                    //Verifica se a extensão da imagem é permitida
                    if(in_array($imgExtension, $allowedExtensions) === true){
                        $time = time(); //Guarda o tempo atual para ser usado no nome da imagem
                        $renamedImgName = $time.$imgName; //Nome da imagem que será salva no banco de dados e na pasta img

                        //Verifica se a imagem renomeada foi salva na pasta img
                        if(move_uploaded_file($tempImgName, "../img/".$renamedImgName)){
                            $hashOptions = [ 
                                'cost' => 12, //Custo computacional para criar um hash da senha.
                                //Um custo de 12 é um bom valor padrão que fornece um bom equilíbrio entre segurança e desempenho.
                            ];
                            $hashedPassword = password_hash($passwordInput, PASSWORD_BCRYPT, $hashOptions); //Encripta a senha
                            $userStatus = "online"; //Status após cadastro
                            $uniqueUserID = rand(time(), 100000000); //Gera um id aleatório para o novo usuário

                            //Insere os dados do usuário no banco de dados
                            $saveUserQuery = mysqli_query($conn, "INSERT INTO users (uniqueID, fname, lname, email, password, img, status)
                            VALUES ({$uniqueUserID}, '{$userFName}','{$userLName}', '{$emailAddress}', '{$hashedPassword}', '{$renamedImgName}', '{$userStatus}')");

                            //Verifica se os dados foram inseridos no banco de dados e inicia a sessão
                            if($saveUserQuery){
                                $userDataQuery = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$emailAddress}'"); 
                                if(mysqli_num_rows($userDataQuery) > 0){
                                    $userData = mysqli_fetch_assoc($userDataQuery);
                                    $_SESSION["uniqueID"] = $userData["uniqueID"];
                                        echo "Registro efetuado com sucesso!";
                                    }else{
                                        echo "Email inválido!";}
                                }else{
                                    echo "Algo deu errado. Por favor, tente novamente!";}
                            }
                        }else{
                            echo "Selecione uma imagem válida!";}
                }
            }
        }else{
            echo "Esse email não está conectado a uma conta";}
    }else{
        echo "Todos os campos devem ser preenchidos!";}
?>