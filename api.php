<?php
    header('Content-Type:application/json');
    include 'conexao.php';

    $metodo = $_SERVER['REQUEST_METHOD'];
    $url = $_SERVER['REQUEST_URI'];
    $path = parse_url($url, PHP_URL_PATH);
    $path = trim($path,'/');
    $pathparts = explode('/',$path);

    $primeira = isset($pathparts[0]) ? $pathparts[0] : ''; 
    $segunda = isset($pathparts[1]) ? $pathparts[1] : '';
    $terceira = isset($pathparts[2]) ? $pathparts[2] : '';
    $quarta = isset($pathparts[3]) ? $pathparts[3] : '';

    $response = [
        'metodo' => $metodo,
        'primeiraParte' => $primeira,
        'segundaParte' => $segunda,
        'terceiraParte' => $terceira,
        'quartaParte' => $quarta
    ];

    switch($metodo){
        case 'GET':
            // lógica para GET
            if($terceira == 'alunos' && $quarta == ''){
                lista_alunos();
            }
            elseif($terceira == 'alunos' && $quarta != ''){
                lista_um_aluno($quarta);
            }
            elseif($terceira == 'cursos' && $quarta == ''){
                lista_cursos();
            }
            elseif($terceira == 'cursos' && $quarta !=''){
                lista_um_curso($quarta);
            }
            break;
        case 'POST':
            //lógica para POST
            if ($terceira == 'alunos'){
                insere_aluno();
            }
            elseif ($terceira == 'cursos'){
                insere_curso();
            }
            break;
        case 'PUT':
            //lógica para PUT
            if ($terceira == 'alunos'){
                atualiza_aluno();
            }
            elseif ($terceira == 'cursos'){
                atualiza_curso();
            }
            break;
        case 'DELETE':
            //lógica para o DELETE
            if ($terceira == 'alunos'){
                remove_aluno();
            }
            elseif ($terceira == 'cursos'){
                remove_curso();
            }
            break;
        default:
            echo json_encode([
                    'mensagem' => 'Método não permitido!'
            ]);
            break;
    }
  
    function lista_alunos(){
        global $conexao;
        $resultado = $conexao->query("SELECT * FROM alunos");
        $alunos = $resultado->fetch_all(MYSQLI_ASSOC);
        echo json_encode([
                'mensagem' => 'LISTA TODOS OS ALUNOS!',
                'dados' => $alunos
        ]);
    }
    //LISTA UM ALUNO
    function lista_um_aluno($quarta){
        global $conexao;
        $stmt = $conexao->prepare("SELECT * FROM alunos WHERE id = ?");
        $stmt->bind_param('i',$quarta);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $aluno = $resultado->fetch_assoc();

        echo json_encode([
                'mensagem' => 'LISTA DE UM ALUNO!',
                'dados_aluno' => $aluno
        ]);
    }
    //LISTA CURSOS
    function lista_cursos(){
        global $conexao;
        $resultado = $conexao->query("SELECT * FROM cursos");
        $cursos = $resultado->fetch_all(MYSQLI_ASSOC);
        echo json_encode([
                'mensagem' => 'LISTA TODOS OS cursos!',
                'dados' => $cursos
        ]);
    }
    //LISTA UM CURSO
    function lista_um_curso($quarta){
        global $conexao;
        $stmt = $conexao->prepare("SELECT * FROM cursos WHERE id_curso = ?");
        $stmt->bind_param('i',$quarta);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $curso = $resultado->fetch_assoc();

        echo json_encode([
            'mensagem' => 'LISTA DE UM CURSO!',
            'dados_aluno' => $curso
        ]);
    }
    //INSERE CURSO
    function insere_curso(){
        global $conexao;
        //Opcao 1 com jason
        //$input = json_decode(file_get_contents('php://input'), true);
        //$nome_curso = $input['nome_curso'];

        //Opcao com 2 parametros
        $nome_curso = $_GET['nome_curso'];

        $sql = "INSERT INTO cursos (nome_curso) VALUES ('$nome_curso')";

        if($conexao->query($sql) == TRUE){
            echo json_encode([
                'mensagem' => 'CURSO CADASTRADO COM SUCESSO'
            ]);
        }
        else {
            echo json_encode([
                'mensagem' => 'ERRO NO CADASTRO DO CURSO'
            ]);
        }
    }

    function insere_aluno(){
        global $conexao;
        //Para inserir um aluno é obrigatório que haja um curso desejado já cadastrado
        //Neste exemplo vamos passar os parametros via JSON
        $input = json_decode(file_get_contents('php://input'), true);
        $id_curso = $input['fk_cursos_id_curso'];
        $nome = $input['nome'];
        $email = $input['email'];

        $sql = "INSERT INTO alunos (nome,email,fk_cursos_id_curso) VALUE ('$nome', '$email', '$id_curso')";

        if($conexao->query($sql) == TRUE){
            echo json_encode([
                'mensagem' => 'ALUNOS CADASTRADO COM SUCESSO'
            ]);
        }
        else{
            echo json_encode([
                'mensagem' => 'ERRO NO CADASTRO DO ALUNO'
            ]);
        }

    }
    //ATUALIZA ALUNO
    function atualiza_aluno(){
        global $conexao;
        //Para atualizar um aluno é obrigatório envio do ID do aluno
        //Precisa enviar todos os dados que serem autalizados (nome, email, curso etc)
        //Aqui pode ser pensada vários tipos de lógica, como por exemplo se somente um destes campos virem preenchidos
        //Neste exemplo o único campo que não iremos alterar será o curso.

        $input = json_decode(file_get_contents('php://input'), true);
        $id = $input['id'];
        $nome_novo = $input['nome_novo'];
        $email_novo = $input['email_novo'];

        $sql = "UPDATE alunos SET nome = '$nome_novo', email = '$email_novo' WHERE id = '$id'";

        if($conexao->query($sql) == TRUE){
            echo json_encode([
                'mensagem' => 'ALUNO ATUALIZADO COM SUCESSO'
            ]);
        }
        else{
            echo json_encode([
                'mensagem' => 'ERRO ATUALIZÇÃO DO ALUNO'
            ]);
        }
    }
    //ATUALIZA CURSO
    function atualiza_curso(){
        global $conexao;
        //Para atualizar um curso é obrigatório envio do ID do curso
        //Precisa enviar todos os dados que serem autalizados (nome_curso,  etc)
        //Aqui pode ser pensada vários tipos de lógica, como por exemplo se somente um destes campos virem preenchidos. Para este exemplo vamos pensar que todos os campos serão preenchidos, com ou sem alterações
        
        $input = json_decode(file_get_contents('php://input'), true);
        $id_curso = $input['id_curso'];
        $nome_curso_novo = $input['nome_curso_novo'];

        $sql = "UPDATE cursos SET nome_curso = '$nome_curso_novo' WHERE id_curso = '$id_curso'";

        if($conexao->query($sql) == TRUE){
            echo json_encode([
                'mensagem' => 'CURSO ATUALIZADO COM SUCESSO'
            ]);
        }
        else{
            echo json_encode([
                'mensagem' => 'ERRO ATUALIZAÇÃO CURSO'
            ]);
        }
    }
    //REMOVE ALUNO
    function remove_aluno(){
        //ógica idem, atualiza, mas aqui precisamos somente do id
        global $conexao;
        $input = json_decode(file_get_contents('php://input'), true);
        $id = $input['id'];
        $sql = "DELETE FROM alunos WHERE id = '$id'";
        if($conexao->query($sql) == TRUE){
            echo json_encode([
                'mensagem' => 'ALUNO REMOVIDO COM SUCESSO'
            ]);
        }
        else{
            echo json_encode([
                'mensagem' => 'ERRO NA REMOÇÃO DO ALUNOS'
            ]);
        }
    }
    //REMOVE curso
    function remove_curso(){
        //ógica idem, atualiza, mas aqui precisamos somente do id
        global $conexao;
        $input = json_decode(file_get_contents('php://input'), true);
        $id_curso = $input['id_curso'];
        $sql = "DELETE FROM cursos WHERE id_curso = '$id_curso'";
        if($conexao->query($sql) == TRUE){
            echo json_encode([
                'mensagem' => 'CURSO REMOVIDO COM SUCESSO'
            ]);
        }
        else{
            echo json_encode([
                'mensagem' => 'ERRO NA REMOÇÃO DO CURSO'
            ]);
        }
    }

?>