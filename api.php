<?php
    header('Content-Type:application/json');
    include 'conexao.php';

    $metodo = $_SERVER['REQUEST_METHOD'];
    $url = $_SERVER['REQUEST_URI'];

    $path = parse_url($url, PHP_URL_PATH);
    $path = trim($path,'/');
    $pathparts = explode('/',$path);

    //CRIANDO AS VARIAVEIS PARA CADA PARTE DA URL

    $primeira = isset($pathparts[0]) ? $pathparts[0] : ''; 
    $segunda = isset($pathparts[1]) ? $pathparts[1] : '';
    $terceira = isset($pathparts[2]) ? $pathparts[2] : '';
    $quarta = isset($pathparts[3]) ? $pathparts[3] : '';

    //MONTANDO A RESPOSTA DA API EM JSON

    $response = [
        'metodo' => $metodo,
        'primeiraParte' => $primeira,
        'segundaParte' => $segunda,
        'terceiraParte' => $terceira,
        'quartaParte' => $quarta
    ];

    //SELEÇÃO DO MÉTODO

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
            break;
        case 'PUT':
            //lógica para PUT
            break;
        case 'DELETE':
            //lógica para o DELETE
            break;
        default:
            echo json_encode(
                [
                    'mensagem' => 'Método não permitido!'
                ]
            );
            break;
    }


    //LISTA ALUNOS
    function lista_alunos(){
        global $conexao;
        $resultado = $conexao->query("SELECT * FROM alunos");
        $alunos = $resultado->fetch_all(MYSQLI_ASSOC);
        echo json_encode(
            [
                'mensagem' => 'LISTA TODOS OS ALUNOS!',
                'dados' => $alunos
            ]
        );
    }
    //LISTA UM ALUNO
    function lista_um_aluno($quarta){
        global $conexao;
        $stmt = $conexao->prepare("SELECT * FROM alunos WHERE id = ?");
        $stmt->bind_param('i',$quarta);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $aluno = $resultado->fetch_assoc();

        if($aluno == ''){
            echo json_encode(
                [
                    'mensagem' => 'NÃO FOI ENCONTRADO O ALUNO ACIMA!'
                ]
            );
        }else{
            echo json_encode(
                [
                    'mensagem' => 'LISTA DE UM ALUNO!',
                    'dados_aluno' => $aluno
                ]
            );
        }
    }


    //LISTA CURSOS
    function lista_cursos(){
        global $conexao;
        $resultado = $conexao->query("SELECT * FROM cursos");
        $cursos = $resultado->fetch_all(MYSQLI_ASSOC);
        echo json_encode(
            [
                'mensagem' => 'LISTA TODOS OS cursos!',
                'dados' => $cursos
            ]
        );
    }
    //LISTA UM CURSO
    function lista_um_curso($quarta){
        global $conexao;
        $stmt = $conexao->prepare("SELECT * FROM cursos WHERE id_curso = ?");
        $stmt->bind_param('i',$quarta);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $curso = $resultado->fetch_assoc();

        if($curso == ''){
            echo json_encode(
                [
                    'mensagem' => 'NÃO FOI ENCONTRADO O CURSO ACIMA!'
                ]
            );
        }else{
            echo json_encode(
                [
                    'mensagem' => 'LISTA DE UM CURSO!',
                    'dados_aluno' => $curso
                ]
            );
        }
    }


?>