<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo __URL__.'/fac2fast/f2f/index';?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>f</b>2F</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b><?php echo $_SESSION['f2f_contratante']; ?></b>
            <span class="text-aqua small" > by f2F</span>
                
        </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php
                        if (isset($_SESSION['f2f_id_contratante'])) {
                            echo '<strong>' . $_SESSION['f2f_contratante'] . '</strong>';
                        } else {
                            ?>

                            <span class="alert alert-danger">
                                <i class="fa fa-exclamation"></i>Seleccione una empresa
                            </span>

                        <?php } ?>
                        <span class="label label-success"><?php echo count($_SESSION['f2f_contratantes_array']); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Tienes <?php echo count($_SESSION['f2f_contratantes_array']); ?> empresas asignadas </li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">

                                <?php foreach ($_SESSION['f2f_contratantes_array'] AS $contra): ?>
                                    <li>
                                        <a href="<?php echo __URL__ . '/fac2fast/f2f/changeCompany/' . $contra['id_contratante']; ?>">
                                            <h4>
                                                <strong><?php echo $contra['contratante']; ?></strong>
                                                <small><i class="fa fa-clock-o"></i> <?php echo $contra['cif']; ?></small>
                                            </h4>
                                            <p><?php echo $contra['nombre_contra']; ?></p>
                                        </a>
                                    </li>
                                <?php endforeach; ?>


                            </ul>
                        </li>
                    </ul>
                </li>
               
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user-circle"></i>
                        <span class="hidden-xs"><?php echo $_SESSION['username']; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <i class="fa fa-user fa-3x"></i>
                            <p>
                                <?php echo $_SESSION['username']; ?>
                                <small></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Editar mis datos</a>
                            </div>
                            <div class="pull-right">
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-info">
                                    Salir
                                </button>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div class="modal modal-warning fade" id="modal-info">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Salir de f2F</h4>
            </div>
            <div class="modal-body">
                <p>Estas listo para desconectarte?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">No</button>
                <a href="<?php echo __URL__; ?>/welcome/login/closeSession" class="btn btn-outline">SI</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->