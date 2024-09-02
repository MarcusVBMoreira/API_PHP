<?php
    
    $id_curso = $_GET['id'];

    $data = array("id_curso" => $id_curso);
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'DELETE',
            'content' => json_encode($data),
        ),
    );

    $context  = stream_context_create($options);
    $url = 'http://localhost/api_php/api.php/cursos';
    $result = file_get_contents($url, false, $context);

    if ($result === FALSE) {
        echo "<p>Erro ao remover curso.</p>";
    } else { ?>
        <script>
            // Exibe o alerta
            alert('Operação concluída com sucesso!');

            // Após o usuário clicar em "OK", redireciona para outra página
            window.location.href = 'lista_cursos.php'; // Altere para a página de destino
        </script>
    <?php    
    }
    
?>