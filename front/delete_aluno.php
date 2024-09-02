<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Aluno</title>
</head>
<body>
    <h1>Deletar Aluno</h1>
    <form action="delete_aluno.php" method="POST">
        <label for="id">ID do Aluno:</label><br>
        <input type="text" id="id" name="id"><br><br>
        <input type="submit" value="Deletar">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];

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
            echo "<p>Erro ao deletar aluno.</p>";
        } else {
            echo "<p>Aluno deletado com sucesso!</p>";
        }
    }
    ?>
</body>
</html>
