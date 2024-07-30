<?php 
    $host = 'localhost';
    $banco = 'etecmcm';
    $usuario = 'root';
    $senha = '';

    $conexao = new mysqli($host, $usuario, $senha, $banco);

    if($conexao->connect_error){
        die('falha de conexão: ' . $conexao->connect_error);
    }/* else{
        echo "conectado com sucesso";
    } */

?>