<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Aluno</title>
</head>
<body>
    <h1>Atualizar Aluno</h1>
    <form action="update_aluno.php" method="POST">
        <label for="id">ID do Aluno:</label><br>
        <input type="text" id="id" name="id"><br>
        <label for="nome_novo">Novo Nome:</label><br>
        <input type="text" id="nome_novo" name="nome_novo"><br>
        <label for="email_novo">Novo Email:</label><br>
        <input type="email" id="email_novo" name="email_novo"><br><br>
        <input type="submit" value="Atualizar">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $nome_novo = $_POST['nome_novo'];
        $email_novo = $_POST['email_novo'];

        $data = array("id" => $id, "nome_novo" => $nome_novo, "email_novo" => $email_novo);
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
        } else {
            echo "<p>Aluno atualizado com sucesso!</p>";
        }
    }
    ?>
</body>
</html>
