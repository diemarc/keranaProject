<div class="navbar-default sidebar" style="" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">

            <li>
                <a href="#"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-user-md fa-fw"></i>System<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo __URL__; ?>/system/user/index">Users</a>
                    </li>
                    <li>
                        <a href="<?php echo __URL__; ?>/system/group/index">Groups</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <?php if (__ENVIRONMENT__ == 'development') { ?>
                <li>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i>Development<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo __URL__; ?>/system/module/index">Modules</a>
                        </li>
                        <li>
                            <a href="<?php echo __URL__; ?>/system/model/index">Models</a>
                        </li>
                        <li>
                            <a href="<?php echo __URL__; ?>/system/controller/index">Controllers</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            <?php } ?>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>