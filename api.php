<?php
    header('Content-Type: application/json');
    include 'conexao.php';

    $metodo = $_SERVER['REQUEST_METHOD'];
    

    $url = $_SERVER['REQUEST_URI'];
    
    $path = parse_url($url, PHP_URL_PATH);
    $path = trim($path,'/');    

    $path_parts = explode('/',$path);
    

    $primeiraparte = isset($path_parts[0]) ? $path_parts[0] : '';
    $segundaparte = isset($path_parts[1]) ? $path_parts[1] : '';
    $terceiraparte = isset($path_parts[2]) ? $path_parts[2] : '';
    $quartaparte = isset($path_parts[3]) ? $path_parts[3] : '';

    $resposta = [
        'metodo' => $metodo,
        'primeiraparte' => $primeiraparte,
        'segundaparte' => $segundaparte,
        'terceiraparte' => $terceiraparte,
        'quartaparte' => $quartaparte,
    ];

    //echo json_encode($resposta);

    switch($metodo){
        case 'GET':
            //LOGICA PARA GET
            if ($terceiraparte == 'alunos' && $quartaparte == ''){
                lista_alunos();
            }
            elseif ($terceiraparte == 'alunos' && $quartaparte != ''){
                lista_um_aluno($quartaparte);
            }
            elseif ($terceiraparte == 'cursos' && $quartaparte == '') {
                lista_cursos();                
            }
            elseif ($terceiraparte == 'cursos' && $quartaparte != ''){
                lista_um_curso($quartaparte);
            }
            elseif ($terceiraparte == 'totais' && $quartaparte == ''){
                totais();
            }
            break;
        case 'POST':
            //LOGICA PARA POST
            if ($terceiraparte == 'alunos'){
                insere_aluno();
                // echo json_encode([
                //     'mensagem' => 'INSERE UM ALUNO NOVO'
                // ]); 
            }
            elseif ($terceiraparte == 'cursos') {
                insere_curso();
                // echo json_encode([
                //     'mensagem' => 'INSERE UM CURSO NOVO'
                // ]);
            }
            break;
        case 'PUT':
            //LOGICA PARA PUT
            if ($terceiraparte == 'alunos'){
                atualiza_aluno();                 
            }
            elseif ($terceiraparte == 'cursos') {
                atualiza_curso();                
            }
            break;
        case 'DELETE':
            //LOGICA PARA DELETE
            if ($terceiraparte == 'alunos'){
                remove_aluno();                 
            }
            elseif ($terceiraparte == 'cursos') {
                remove_curso();                
            }
            break;
        default:
            echo json_encode([
                'mensagem'=>'Método não permitido!'
            ]);
            break;
    }

    function totais(){
        global $conexao;
        $resultado_alunos = $conexao->query("SELECT * FROM alunos");
        $resultado_cursos = $conexao->query("SELECT * FROM cursos");
        
        $alunos = $resultado_alunos->fetch_all(MYSQLI_ASSOC);
        $cursos = $resultado_cursos->fetch_all(MYSQLI_ASSOC);
        
        $qtde_alunos = count($alunos);
        $qtde_cursos = count($cursos);
        echo json_encode([
            'mensagem' => 'TOTAL DE ALUNOS E CURSOS',
            'alunos' => $qtde_alunos,
            'cursos' => $qtde_cursos
        ]);
    }

    function lista_alunos(){
        global $conexao;
        $resultado = $conexao->query("SELECT * FROM alunos");
        $alunos = $resultado->fetch_all(MYSQLI_ASSOC);
        echo json_encode([
            'mensagem' => 'LISTA DE TODOS OS ALUNOS',
            'dados' => $alunos
        ]);
    }

    function lista_um_aluno($quartaparte){
        global $conexao;
        $stmt = $conexao->prepare("SELECT * FROM alunos WHERE id = ?");
        $stmt->bind_param('i',$quartaparte);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $aluno = $resultado->fetch_assoc();

        echo json_encode([
            'mensagem' => 'LISTA DE UM ALUNO',
            'dados' => $aluno
        ]);
    }

    function lista_cursos(){
        global $conexao;
        $resultado = $conexao->query("SELECT * FROM cursos");
        $cursos = $resultado->fetch_all(MYSQLI_ASSOC);
        echo json_encode([
            'mensagem' => 'LISTA DE TODOS OS CURSOS',
            'dados' => $cursos
        ]);
    }

    function lista_um_curso($quartaparte){
        global $conexao;
        $stmt = $conexao->prepare("SELECT * FROM cursos WHERE id_curso = ?");
        $stmt->bind_param('i',$quartaparte);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $curso = $resultado->fetch_assoc();

        echo json_encode([
            'mensagem' => 'LISTA DE UM CURSO',
            'dados' => $curso
        ]);
    }

    function insere_curso(){
        global $conexao;
        //OPCAO 1 COM JSON
        $input = json_decode(file_get_contents('php://input'), true);
        $nome_curso = $input['nome_curso'];

        //OPCAO 2 COM PARAMETROS
        //$nome_curso = $_GET['nome_curso'];

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
        //Para inserir um aluno é obrigatório que haja um curso desejado já cadastrado!
        //Neste exemplo vamos passar os parâmetros via JSON
        $input = json_decode(file_get_contents('php://input'), true);
        $id_curso = $input['fk_cursos_id_curso'];
        $nome = $input['nome'];
        $email = $input['email'];

        $sql = "INSERT INTO alunos (nome,email,fk_cursos_id_curso) VALUES ('$nome','$email','$id_curso')";

        if($conexao->query($sql) == TRUE){
            echo json_encode([
                'mensagem' => 'ALUNO CADASTRADO COM SUCESSO'
            ]);
        }
        else {
            echo json_encode([
                'mensagem' => 'ERRO NO CADASTRO DO ALUNO'
            ]);
        }

    }

    function atualiza_aluno(){
        global $conexao;
        //Para atualizar um aluno é obrigatório o envio do ID do aluno
        //Precisa enviar todos os dados que serem atualizados (nome, email, curso, etc)
        //Aqui pode ser pensada vários tipos de lógica, como por exemplo se somente um destes campos vierem preenchidos. Para este exemplo vamos pensar que todos os campos serão enviados preenchidos, com ou sem altereações.
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
        else {
            echo json_encode([
                'mensagem' => 'ERRO ATUALIZAÇÃO DO ALUNO'
            ]);
        }


    }

    function atualiza_curso(){
        global $conexao;
        //Para atualizar um aluno é obrigatório o envio do ID do curso
        //Precisa enviar todos os dados que serem atualizados (nome_curso, etc)
        //Aqui pode ser pensada vários tipos de lógica, como por exemplo se somente um destes campos vierem preenchidos. Para este exemplo vamos pensar que todos os campos serão enviados preenchidos, com ou sem altereações

        $input = json_decode(file_get_contents('php://input'), true);
        $id_curso = $input['id_curso'];
        $nome_curso_novo = $input['nome_curso_novo'];
        

        $sql = "UPDATE cursos SET nome_curso = '$nome_curso_novo' WHERE id_curso = '$id_curso'";

        if($conexao->query($sql) == TRUE){
            echo json_encode([
                'mensagem' => 'CURSO ATUALIZADO COM SUCESSO'
            ]);
        }
        else {
            echo json_encode([
                'mensagem' => 'ERRO ATUALIZAÇÃO DO CURSO'
            ]);
        }


    }

    function remove_aluno(){
        //Lógica idem atualiza, mas aqui precisamos somente do id
        global $conexao;
        $input = json_decode(file_get_contents('php://input'), true);
        $id = $input['id'];
        $sql = "DELETE FROM alunos WHERE id = '$id'";
        if($conexao->query($sql) == TRUE){
            echo json_encode([
                'mensagem' => 'ALUNO REMOVIDO COM SUCESSO'
            ]);
        }
        else {
            echo json_encode([
                'mensagem' => 'ERRO NA REMOÇÃO DO ALUNO'
            ]);
        }


    }

    function remove_curso(){
        //Lógica idem atualiza, mas aqui precisamos somente do id
        global $conexao;
        $input = json_decode(file_get_contents('php://input'), true);
        $id_curso = $input['id_curso'];
        $sql = "DELETE FROM cursos WHERE id_curso = '$id_curso'";
        if($conexao->query($sql) == TRUE){
            echo json_encode([
                'mensagem' => 'CURSO REMOVIDO COM SUCESSO'
            ]);
        }
        else {
            echo json_encode([
                'mensagem' => 'ERRO NA REMOÇÃO DO CURSO'
            ]);
        }

    }


?>