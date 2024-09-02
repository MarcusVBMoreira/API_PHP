<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Cursos</title>
</head>
<body>
    <h1>Lista de Cursos</h1>
    <?php
    $url = 'http://localhost/api_php/api.php/cursos';
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if (isset($data['dados'])) {
        echo '<ul>';
        foreach ($data['dados'] as $curso) {
            echo '<li>' . $curso['nome_curso'] . '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>Nenhum curso encontrado.</p>';
    }
    ?>
</body>
</html>
