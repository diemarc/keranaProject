<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="">
            <span class="pull-left text-success">
                <?php echo __APPNAME__; ?>
            </span>
            <span class="small">
                <span class="small"><?php echo __ENVIRONMENT__; ?></span>
            </span>

        </a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" href="<?php echo __URL__; ?>/welcome/login/closeSession">
                <?php echo $_SESSION['username']; ?> <i class="glyphicon glyphicon-log-out"></i>
            </a>
            <!-- /.dropdown-tasks -->
        </li>
        <!-- /.dropdown -->
        <!-- /.dropdown -->
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->
    <?php include(__DOCUMENTROOT__ . '/_layouts/default/_sidebar.php'); ?>

    <!-- /.navbar-static-side -->
</nav>