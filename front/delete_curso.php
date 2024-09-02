<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Curso</title>
</head>
<body>
    <h1>Deletar Curso</h1>
    <form action="delete_curso.php" method="POST">
        <label for="id_curso">ID do Curso:</label><br>
        <input type="text" id="id_curso" name="id_curso"><br><br>
        <input type="submit" value="Deletar">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_curso = $_POST['id_curso'];

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
            echo "<p>Erro ao deletar curso.</p>";
        } else {
            echo "<p>Curso deletado com sucesso!</p>";
        }
    }
    ?>
</body>
</html>
