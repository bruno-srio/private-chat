<?php
session_start();
if (isset($_SESSION['uniqueID'])) {
    include_once "config.php";
    $sendingID = mysqli_real_escape_string($conn, $_SESSION['uniqueID']);
    $receivingID = mysqli_real_escape_string($conn, $_POST['userID']);
    $chatOutput = "";

    $sql = "SELECT * FROM messages
                LEFT JOIN users ON users.uniqueID = messages.sendingMsgID 
                WHERE (sendingMsgID = {$sendingID} AND receivingMsgID = {$receivingID})
                OR (sendingMsgID = {$receivingID} AND receivingMsgID = {$sendingID}) ORDER BY msgID";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($userData = mysqli_fetch_assoc($query)) {
            if ($userData['sendingMsgID'] === $sendingID) { //Determina se o usuário é quem está enviando a mensagem
                $chatOutput .= '<div class="chat sending">
                                        <div class="details">
                                            <p>' . $userData['message'] . '</p>
                                        </div>
                                    </div>';
            } else { //Caso contrário ele (o usuário) é quem recebe a mensagem
                $chatOutput .= '<div class="chat receiving">
                                        <img src="../img/' . $userData['img'] . '" alt="">
                                        <div class="details">
                                            <p>' . $userData['message'] . '</p>
                                        </div>
                                    </div>';
            }
        }
        echo $chatOutput;
    } else {
        echo $chatOutput .= '<span id="nomsg">Sem mensagens disponíveis</span>';
    }
} else {
    header("location: ../subpages/login.php");
}

?>