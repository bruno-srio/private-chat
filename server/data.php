<?php
    //Enquanto houver usuários disponíveis, faz uma query para buscar a última mensagem enviada e executa o restante do código
    while($userData = mysqli_fetch_assoc($userResult)){
        $lastMessageQuery = "SELECT * FROM messages WHERE (receivingMsgID = {$userData['uniqueID']}
                OR sendingMsgID = {$userData['uniqueID']}) AND (sendingMsgID = {$sendingID} 
                OR receivingMsgID = {$sendingID}) ORDER BY msgID DESC LIMIT 1";

        $lastMessageResult = mysqli_query($conn, $lastMessageQuery);
        $lastMessageData = mysqli_fetch_assoc($lastMessageResult);

        //Utilizando operadores ternários verifica se há mensagens e se forem muito grandes reduz seu tamanho
        (mysqli_num_rows($lastMessageResult) > 0) ? $lastMessage = $lastMessageData['message'] : $lastMessage ="";
        (strlen($lastMessage) > 28) ? $shortMessage =  substr($lastMessage, 0, 28) . '...' : $shortMessage = $lastMessage;
        
        if(isset($lastMessageData['sendingMsgID'])){
            ($sendingID == $lastMessageData['sendingMsgID']) ? $senderLabel = "Você: " : $senderLabel = "";
        }else{
            $senderLabel = "";
        }

        ($userData['status'] == "offline") ? $statusIndicator = "offline" : $statusIndicator = "";
        ($sendingID == $userData['uniqueID']) ? $hideIndicator = "hide" : $hideIndicator = "";

        // Guarda o HTML necessário para mostrar os usuários na lista
        $userListOutput .= '<a href="chat.php?userID='. $userData['uniqueID'] .'">
                            <div class="content">
                            <img src="../img/'. $userData['img'] .'" alt="">
                            <div class="details">
                                <span>'. $userData['fname']. " " . $userData['lname'] .'</span>
                                <p>'. $senderLabel . $shortMessage .'</p>
                            </div>
                            </div>
                            <div class="status-dot '. $statusIndicator .'"><i class="fas fa-circle"></i></div>
                            </a>';
    }
?>