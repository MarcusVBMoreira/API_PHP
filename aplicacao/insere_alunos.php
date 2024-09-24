<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Insere Aluno</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="Codedthemes" />
    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <!-- waves.css -->
    <link rel="stylesheet" href="assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
    <!-- waves.css -->
    <link rel="stylesheet" href="assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- themify icon -->
    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
    <!-- font-awesome-n -->
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome-n.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <!-- scrollbar.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body>
    
<?php
    include 'menu_principal.php';
?>

                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <div class="row">
                                            <!-- Project statustic start -->
                                            <div class="col-xl-12">
                                                <div class="row">
                                                    <div class="col-xl-8 col-md-10 m-auto">
                                                        <h2>Insere novo aluno</h2>
                                                        <form action="cadastra_aluno.php" method="POST">
                                                            <div class="mb-3">
                                                                <label for="nome" class="form-label">Nome do aluno</label>
                                                                <input type="text" id="nome"name="nome" class="form-control">                                                                
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Email do aluno</label>
                                                                <input type="text" name="email" class="form-control">                                                                
                                                            </div>
                                                                             
                                                            <div class="mb-3">
                                                                <label class="form-label">ID curso</label> 
                                                                <?php
                                                                $url = 'http://localhost/api_php/api.php/cursos';
                                                                $response = file_get_contents($url);
                                                                $data = json_decode($response, true);

                                                                if (isset($data['dados'])) {
                                                                    echo '<select class="form-select" id="cursos-dropdown" name="curso" required>';
                                                                    echo '<option value="" disabled selected>Selecione um curso</option>';
                                                                    foreach ($data['dados'] as $curso) {
                                                                        echo '<option value="' . $curso['id_curso'] .'">' . htmlspecialchars($curso['nome_curso']) . '</option>';
                                                                    }
                                                                    echo '</select>';
                                                                } else {
                                                                    echo '<p>Nenhum curso  encontrado!</p>';
                                                                }
                                                                ?>                                                              
                                                            </div>
                                                            
                                                            <div  class="mb-3">
                                                                
                                                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                                                            
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Project statustic end -->
                                        </div>
                                    </div>
                                    <!-- Page-body end -->
                                </div>
                                <div id="styleSelector"> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <!-- Required Jquery -->
    <script type="text/javascript" src="assets/js/jquery/jquery.min.js "></script>
    <script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js "></script>
    <script type="text/javascript" src="assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js "></script>
    <!-- waves js -->
    <script src="assets/pages/waves/js/waves.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- slimscroll js -->
    <script src="assets/js/jquery.mCustomScrollbar.concat.min.js "></script>

    <!-- menu js -->
    <script src="assets/js/pcoded.min.js"></script>
    <script src="assets/js/vertical/vertical-layout.min.js "></script>

    <script type="text/javascript" src="assets/js/script.js "></script>
</body>

</html>
