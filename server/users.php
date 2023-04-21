<?php
    session_start();
    include_once "config.php";
    $sendingID = $_SESSION['uniqueID'];
    $userQuery = "SELECT * FROM users WHERE NOT uniqueID = {$sendingID} ORDER BY uniqueID DESC";
    $userResult = mysqli_query($conn, $userQuery);
    $userListOutput = "";
    
    if(mysqli_num_rows($userResult) == 0){
        $userListOutput .= "Sem usuários disponíveis :(";
    }elseif(mysqli_num_rows($userResult) > 0){
        include_once "data.php";
    }
    echo $userListOutput;
?>