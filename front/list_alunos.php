<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Alunos</title>
</head>
<body>
    <h1>Lista de Alunos</h1>
    <?php
    $url = 'http://localhost/api_php/api.php/alunos';
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if (isset($data['dados'])) {
        echo '<ul>';
        foreach ($data['dados'] as $aluno) {
            echo '<li>' . $aluno['nome'] . ' - ' . $aluno['email'] . '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>Nenhum aluno encontrado.</p>';
    }
    ?>
</body>
</html>
