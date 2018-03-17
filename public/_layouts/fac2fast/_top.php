<ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php
            if (isset($_SESSION['f2f_id_contratante'])) {
                echo '<strong>' . $_SESSION['f2f_contratante'] . '</strong>';
            } else {
                ?>

                <span class="alert alert-danger">
                    <i class="fa fa-exclamation"></i>Seleccione una empresa
                </span>

            <?php } ?>
        </a>
        <?php if (isset($_SESSION['f2f_contratantes_array']) AND ! empty($_SESSION['f2f_contratantes_array'])) { ?>
            <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">Selecciona una empresa:</h6>

                <?php foreach ($_SESSION['f2f_contratantes_array'] AS $contra): ?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo __URL__ . '/fac2fast/f2f/changeCompany/' . $contra['id_contratante']; ?>">
                        <strong><?php echo $contra['contratante']; ?></strong>
                        <span class="small float-right text-muted"><?php echo $contra['cif']; ?></span>
                        <div class="dropdown-message small">
                            <?php echo $contra['nombre_contra']; ?>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php } ?>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Alerts
                <span class="badge badge-pill badge-warning">6 New</span>
            </span>
            <span class="indicator text-warning d-none d-lg-block">
                <i class="fa fa-fw fa-circle"></i>
            </span>
        </a>
        <div class="dropdown-menu" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">New Alerts:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
                <span class="text-success">
                    <strong>
                        <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
                </span>
                <span class="small float-right text-muted">11:21 AM</span>
                <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
                <span class="text-danger">
                    <strong>
                        <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
                </span>
                <span class="small float-right text-muted">11:21 AM</span>
                <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
                <span class="text-success">
                    <strong>
                        <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
                </span>
                <span class="small float-right text-muted">11:21 AM</span>
                <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all alerts</a>
        </div>
    </li>
    <li class="nav-item">
        <form class="form-inline my-2 my-lg-0 mr-lg-2">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Buscas algo?, encuentralo">
                <span class="input-group-append">
                    <button class="btn btn-primary" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-user-circle"></i><?php echo $_SESSION['username']; ?>
            <span class="d-lg-none"><?php echo $_SESSION['username']; ?>
                <span class="badge badge-pill badge-warning">6 New</span>
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
            <a class="dropdown-item" href="#">
                Editar mis datos
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
                Cambiar mi contrase&ntilde;a
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-fw fa-sign-out"></i>Salir</a>
        </div>
    </li>
</ul>