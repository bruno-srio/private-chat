<?php 
    session_start();
    include_once "config.php";
    $emailAddress = mysqli_real_escape_string($conn, $_POST['email']);
    $passwordInput = mysqli_real_escape_string($conn, $_POST['password']);
    
    //Verifica se os campos "email" e "senha" foram preenchidos
    if(!empty($emailAddress) && !empty($passwordInput)){ 
        $emailQuery = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$emailAddress}'");
        
        if(mysqli_num_rows($emailQuery) > 0){
            $userData = mysqli_fetch_assoc($emailQuery);
            $hashOptions = [ 
                'cost' => 12, //Custo computacional para criar um hash da senha.
            ];
            //Guarda a senha que foi encriptada na base de dados após o registro da conta
            $hashedPassword = $userData['password']; 

            //Compara a senha introduzida com o hash armazenado na variável $hashedPassword para validação
            if(password_verify($passwordInput, $hashedPassword)){ 
                $userStatus = "online";
                $statusUpdateQuery = mysqli_query($conn, "UPDATE users SET status = '{$userStatus}' WHERE uniqueID = {$userData['uniqueID']}"); //Atualiza o status para "online"

                if($statusUpdateQuery){ //Efetua o login
                    $_SESSION['uniqueID'] = $userData['uniqueID'];
                    echo "Login efetuado com sucesso!";

                }else{
                    echo "Algo deu errado. Por favor, tente novamente!";
                }
            }else{
                echo "E-mail ou senha incorretos!";
            }
        }else{
            echo "Esse e-mail não está conectado a uma conta";
        }
    }else{
        echo "Todos os campos devem ser preenchidos!";
    }
?>