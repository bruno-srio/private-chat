<?php 
    session_start();
    if(isset($_SESSION["uniqueID"])){
        include_once "config.php";
        $sendingID = mysqli_real_escape_string($conn, $_POST['userID']); 
        $receivingID = mysqli_real_escape_string($conn, $_POST['receivingID']);
        $messageInput = mysqli_real_escape_string($conn, $_POST['message']);
        if(!empty($messageInput)){
            $sql = mysqli_query($conn, "INSERT INTO messages (sendingMsgID, receivingMsgID, message)
                                        VALUES ({$sendingID}, {$receivingID}, '{$messageInput}')") or die();
        }
    }else{
        header("location: ../subpages/login.php");
        echo "insertChat else foi ativado";
    }


    
?>