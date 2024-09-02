<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Aluno</title>
</head>
<body>
    <h1>Adicionar Aluno</h1>
    <form action="add_aluno.php" method="POST">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="curso">ID do Curso:</label><br>
        <input type="text" id="curso" name="curso"><br><br>
        <input type="submit" value="Adicionar">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $curso = $_POST['curso'];

        $data = array("nome" => $nome, "email" => $email, "fk_cursos_id_curso" => $curso);
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
            ),
        );

        $context  = stream_context_create($options);
        $url = 'http://localhost/api_php/api.php/alunos';
        $result = file_get_contents($url, false, $context);

        if ($result === FALSE) {
            echo "<p>Erro ao adicionar aluno.</p>";
        } else {
            echo "<p>Aluno adicionado com sucesso!</p>";
        }
    }
    ?>
</body>
</html>
