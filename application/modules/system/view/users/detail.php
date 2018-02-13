<div id="page-wrapper" style="">
    <div class="breadcrumb">
        <h4 class='text-primary'> 
            <i class="fa fa-user fa-2x"></i>
            <span class='text-muted'>system</span>
            <a href="/system/user/index">Users-></a>
            <span class="text-success">userDetail</span>-><?php echo $rsUser->username; ?>
        </h4>
    </div>
    <div class="col-sm-4" style="padding-left:2px;">

        <div class="panel panel-info">
            <div class="panel-heading">
                <a href='/system/user/edit/<?php echo $rsUser->id_user; ?>' 
                   class='btn btn-default btn-xs' title='Edit'>
                    <i class='fa fa-edit'></i>
                </a> 
                <span class="text-success">User details</span>
            </div>
            <div class="panel-body">
                <table class="table table-condensed table-bordered">
                    <thead class="small">
                        <tr>
                            <td>UID</td>
                            <td><?php echo $rsUser->id_user; ?></td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td><?php echo $rsUser->username; ?></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td>
                                <button class="btn btn-default btn-sm" type="button">
                                    Change
                                </button>

                            </td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td><?php echo $rsUser->name; ?></td>
                        </tr>
                        <tr>
                            <td>Lastname</td>
                            <td><?php echo $rsUser->lastname; ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $rsUser->email; ?></td>
                        </tr>
                        <tr>
                            <td>Active?</td>
                            <td><?php echo $rsUser->sw_active; ?></td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>
    <div class="col-sm-6">
        <div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#tab_groups" aria-controls="Groups" role="tab" data-toggle="tab">
                        Groups
                    </a>
                </li>
                <li role="presentation">
                    <a href="#tab_privileges" aria-controls="Privileges" role="tab" data-toggle="tab">
                        Privileges (MCA)
                    </a>
                </li>
                <li role="presentation">
                    <a href="#tab_badlogins" aria-controls="BadLogin" role="tab" data-toggle="tab">
                        BadLogin
                    </a>
                </li>
                <li role="presentation">
                    <a href="#tab_settings" aria-controls="settings" role="tab" data-toggle="tab">
                        @Settings
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="tab_groups">...</div>
                <div role="tabpanel" class="tab-pane" id="tab_privileges">Priveleges</div>
                <div role="tabpanel" class="tab-pane" id="tab_badlogins">BL</div>
                <div role="tabpanel" class="tab-pane" id="tab_settings">...</div>
            </div>

        </div>
    </div>
</div>