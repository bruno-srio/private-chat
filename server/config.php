<?php
    //Foram inseridos valores default do XAMPP para conexão a base de dados, altere se necessário.
    
    $conn = mysqli_connect("localhost", "root", "", "privatechat"); //Guarda as informações necessárias para conexão a base de dados
    header("Content-Type: text/html; charset=utf-8");
    //Se a conexão não for feita por algum motivo, encerra a execução e devolve uma mensagem junto do erro que causou a falha.
    if (!$conn) { 
        die("Falha ao conectar a base de dados: " . mysqli_connect_error());
    }
?>   