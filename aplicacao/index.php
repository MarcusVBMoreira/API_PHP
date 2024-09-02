<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Controle de Alunos e Cursos</title>
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
                                                <div class="card proj-progress-card">
                                                    <div class="card-block">
                                                        <div class="row">
                                                            <div class="col-xl-6 col-md-6">
                                                            <?php
                                                                $url = 'http://localhost/api_php/api.php/totais';
                                                                $response = file_get_contents($url);
                                                                $data = json_decode($response, true);

                                                                // echo "Alunos ==> ". $data['alunos'];
                                                                // echo "Cursos ==> ". $data['cursos'];

                                                                $perc_alunos = $data['alunos']/50 * 100;
                                                                $perc_cursos = $data['cursos']/20 * 100;
                                                                //echo $perc_alunos;
                                                                
                                                            ?>
                                                                <h6>Alunos Cadastrados</h6>
                                                                <h5 class="m-b-30 f-w-700"><?php echo $data['alunos']; ?>
                                                                    <span class="text-c-green m-l-10"><?php echo $perc_alunos;?>% de um total de 50</span>
                                                                </h5>
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-c-green" style="width:<?php echo $perc_alunos;?>%"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-6 col-md-6">
                                                                <h6>Cursos Operantes</h6>
                                                                <h5 class="m-b-30 f-w-700"><?php echo $data['cursos']; ?>
                                                                    <span class="text-c-green m-l-10"><?php echo $perc_cursos;?>% de um total de 20</span></h5>
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-c-yellow" style="width:<?php echo $perc_cursos;?>%"></div>
                                                                </div>
                                                            </div>
                                                        </div>    
                                                    </div>    
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-12 col-md-12">
                                                        <h2>Sobre o Exercício</h2>
                                                        <p>Exercício prático para a demonstração de consumo de uma API RestFull criada em PHP</p>
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
