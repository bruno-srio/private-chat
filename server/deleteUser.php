<?php
    session_start();
    if(isset($_SESSION['uniqueID'])){
        include_once "config.php";
        $logoutID = mysqli_real_escape_string($conn, $_GET['logoutID']);
        if(isset($logoutID)){
            $deleteUserQuery = mysqli_query($conn, "DELETE FROM users WHERE uniqueID={$_GET['logoutID']}");
            if($deleteUserQuery){
                session_unset();
                session_destroy();
                header("location: ../index.php");
            }
        }else{
            header("location: ../subpages/users.php");
        }
    }else{  
        header("location: ../subpages/login.php");
    }
?>