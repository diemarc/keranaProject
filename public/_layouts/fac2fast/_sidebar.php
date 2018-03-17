<ul class="navbar-default navbar-nav navbar-sidenav"  style="" id="exampleAccordion">
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
        <a class="nav-link" href="<?php echo __URL__.'/fac2fast/f2f/index';?>">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Home</span>
        </a>
    </li>

    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
        <a class="nav-link" href="#">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Filtros</span>
        </a>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Configuraciones</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
                <a href="">Correo</a>
            </li>
            <li>
                <a href="">Usuarios</a>
            </li>
        </ul>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
        <a class="nav-link" href="#">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">Soporte</span>
        </a>
    </li>
</ul>
<ul class="navbar-nav sidenav-toggler">
    <li class="nav-item">
        <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
        </a>
    </li>
</ul>