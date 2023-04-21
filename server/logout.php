<?php
    session_start();
    if(isset($_SESSION['uniqueID'])){
        include_once "config.php";
        $logoutID = mysqli_real_escape_string($conn, $_GET['logoutID']);
        if(isset($logoutID)){
            $userStatus = "offline";
            $statusUpdateQuery = mysqli_query($conn, "UPDATE users SET status = '{$userStatus}' WHERE uniqueID={$_GET['logoutID']}");
            if($statusUpdateQuery){
                session_unset();
                session_destroy();
                header("location: ../subpages/login.php");
            }
        }else{
            header("location: ../subpages/users.php");
        }
    }else{  
        header("location: ../subpages/login.php");
    }
?>