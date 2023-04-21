<?php
    session_start();
    include_once "config.php";

    $sendingID = $_SESSION['uniqueID'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    $searchUserQuery = "SELECT * FROM users WHERE NOT uniqueID = {$sendingID} AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%') ";
    $userListOutput = "";
    $userResult = mysqli_query($conn, $searchUserQuery);
    if(mysqli_num_rows($userResult) > 0){
        include_once "data.php";
    }else{
        $userListOutput .= 'Nenhum usuário encontrado.';
    }
    echo $userListOutput;
?>