<?php
    $url = 'localhost/exercicio/api.php/alunos';
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    var_dump($data);


?>