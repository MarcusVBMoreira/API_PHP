<?php
    
    $id = $_GET['id'];

    $data = array("id" => $id);
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'DELETE',
            'content' => json_encode($data),
        ),
    );

    $context  = stream_context_create($options);
    $url = 'http://localhost/api_php/api.php/alunos';
    $result = file_get_contents($url, false, $context);

    if ($result === FALSE) {
        echo "<p>Erro ao remover alunos.</p>";
    } else { ?>
        <script>
            // Exibe o alerta
            alert('Operação concluída com sucesso!');

            // Após o usuário clicar em "OK", redireciona para outra página
            window.location.href = 'lista_alunos.php'; // Altere para a página de destino
        </script>
    <?php    
    }
    
?>