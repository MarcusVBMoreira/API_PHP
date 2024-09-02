<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Curso</title>
</head>
<body>
    <h1>Atualizar Curso</h1>
    <form action="update_curso.php" method="POST">
        <label for="id_curso">ID do Curso:</label><br>
        <input type="text" id="id_curso" name="id_curso"><br>
        <label for="nome_curso_novo">Novo Nome do Curso:</label><br>
        <input type="text" id="nome_curso_novo" name="nome_curso_novo"><br><br>
        <input type="submit" value="Atualizar">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_curso = $_POST['id_curso'];
        $nome_curso_novo = $_POST['nome_curso_novo'];

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
        } else {
            echo "<p>Curso atualizado com sucesso!</p>";
        }
    }
    ?>
</body>
</html>
