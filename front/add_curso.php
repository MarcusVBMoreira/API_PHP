<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Curso</title>
</head>
<body>
    <h1>Adicionar Curso</h1>
    <form action="add_curso.php" method="POST">
        <label for="nome_curso">Nome do Curso:</label><br>
        <input type="text" id="nome_curso" name="nome_curso"><br><br>
        <input type="submit" value="Adicionar">
    </form>

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

        if ($result === FALSE) {
            echo "<p>Erro ao adicionar curso.</p>";
        } else {
            echo "<p>Curso adicionado com sucesso!</p>";
        }
    }
    ?>
</body>
</html>
