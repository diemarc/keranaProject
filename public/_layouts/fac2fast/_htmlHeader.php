<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo __APPNAME__ ?></title>

        <!-- Bootstrap Core CSS -->
        <link href="/_layouts/fac2fast/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="/_layouts/fac2fast/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="/_layouts/fac2fast/css/sb-admin.css" rel="stylesheet" type="text/css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body class="fixed-nav" id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-dark fixed-top" id="mainNav">
            <a class="navbar-brand text-info" href="<?php echo __URL__.'/fac2fast/f2f/index';?>">
                <?php
                if (isset($_SESSION['f2f_id_contratante'])) {
                    echo '<strong>' . $_SESSION['f2f_contratante'] . '</strong>';
                }
                ?>
                <span class="text-muted small"><span class="small"><strong>by f2F</strong></span></span>
            </a>

            <button class="navbar-toggler navbar-toggler-right" 
                    type="button" data-toggle="collapse" 
                    data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- menus, laterales y top -->
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <?php
                // sidebar
                include(__DOCUMENTROOT__ . '/_layouts/fac2fast/_sidebar.php');
                include(__DOCUMENTROOT__ . '/_layouts/fac2fast/_top.php');
                ?>

            </div>
        </nav>
        <div class="content-wrapper">

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fa fa-angle-up"></i>
            </a>
            <!-- Logout Modal-->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Listo para desconectarse?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Seleccione "He terminado", si quieres desconectarte.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                            <a class="btn btn-primary" href="<?php echo __URL__; ?>/welcome/login/closeSession">He terminado</a>
                        </div>
                    </div>
                </div>
            </div>

