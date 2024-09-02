<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_curso = $_GET['id'];
        $nome_curso_novo = $_POST['nome_novo_curso'];

        $data = array("id_curso" => $id_curso, "nome_curso_novo" => $nome_curso_novo);
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'PUT',
                'content' => json_encode($data),
            ),
        );

        $context  = stream_context_create($options);
        $url = 'http://localhost/api_php/api.php/cursos';
        $result = file_get_contents($url, false, $context);

        if ($result === FALSE) {
            echo "<p>Erro ao atualizar curso.</p>";
        } else { ?>
            <script>
                // Exibe o alerta
                alert('Operação concluída com sucesso!');

                // Após o usuário clicar em "OK", redireciona para outra página
                window.location.href = 'lista_cursos.php'; // Altere para a página de destino
            </script>
        <?php    
        }
    }
    ?>