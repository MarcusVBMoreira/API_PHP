<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome_curso = $_POST['nome_curso'];

        $data = array("nome_curso" => $nome_curso);
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
            ),
        );

        $context  = stream_context_create($options);
        $url = 'http://localhost/api_php/api.php/cursos';
        $result = file_get_contents($url, false, $context);

        // if ($result === FALSE) {
        //     echo "<p>Erro ao adicionar curso.</p>";
        // } else {
        //     echo "<p>Curso adicionado com sucesso!</p>";
        // }

        if ($result === FALSE) {
            echo "<p>Erro ao adicionar curso.</p>";
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