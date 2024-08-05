<?php
    header('Content-Type:application/json');
    include 'conexao.php';

    $metodo = $_SERVER['REQUEST_METHOD'];
    $url = $_SERVER['REQUEST_URI'];

    $path = parse_url($url, PHP_URL_PATH);
    $path = trim($path,'/');
    $pathparts = explode('/', $path);

    //CRIANDO AS VARIAVEIS PARA CADA PARTE DA URL
    $primeira = isset($pathparts[0]) ? $pathparts[0] : '';
    $segunda = isset($pathparts[1]) ? $pathparts[1] : '';
    $terceira = isset($pathparts[2]) ? $pathparts[2] : '';
    $quarta = isset($pathparts[3]) ? $pathparts[3] : '';

    //MONTANDO A RESPOSTA DA API EM JSON
    $response = [
        'metodo' => $metodo,
        'primeira parte' => $primeira,
        'segunda parte' => $segunda,
        'terceira parte' => $terceira,
        'quarta parte' => $quarta
    ];

    //MONTANO A RESPOSTA
    //echo json_encode($response);

    //SELEÇAO DO MÉTODO
    switch($metodo){
        case 'GET':
            //Lógica para GET
            break;
        
        case 'POST':
            //Lógica para POST
            break;

        case 'PUT':
            //Lógica para PUT
            break;

        case 'DELETE':
            //Lógica para DELETE
            break;
        
        default:
            echo json_encode([
                'mensagem0' => 'Método não permitido!'
            ]);
        
    }

?>