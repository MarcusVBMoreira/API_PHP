<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_GET['id'];
        $nome_aluno_novo = $_POST['nome_novo_aluno'];
        $email_novo_aluno = $_POST['email_novo_aluno'];

        $data = array("id" => $id , "nome_novo" => $nome_aluno_novo, "email_novo" => $email_novo_aluno);
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'PUT',
                'content' => json_encode($data),
            ),
        );

        $context  = stream_context_create($options);
        $url = 'http://localhost/api_php/api.php/alunos';
        $result = file_get_contents($url, false, $context);

        if ($result === FALSE) {
            echo "<p>Erro ao atualizar aluno.</p>";
        } else { ?>
            <script>
                // Exibe o alerta
                alert('Operação concluída com sucesso!');

                // Após o usuário clicar em "OK", redireciona para outra página
                window.location.href = 'lista_alunos.php'; // Altere para a página de destino
            </script>
        <?php    
        }
    }
?>