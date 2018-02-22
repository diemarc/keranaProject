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
                   class='btn btn-info btn-xs' title='Edit'>
                    <i class='fa fa-edit'></i>
                </a> 
                <a href='/system/user/edit/<?php echo $rsUser->id_user; ?>' 
                   class='btn btn-info btn-xs' title='BlockUser'>
                    <i class='fa fa-exclamation-circle'></i>
                </a> 
            </div>
            <div class="panel-body">
                <table class="table table-condensed table-bordered">
                    <thead class="small">
                        <tr>
                            <td class="well well-sm">UID</td>
                            <td><?php echo $rsUser->id_user; ?></td>
                        </tr>
                        <tr>
                            <td class="well well-sm">Username</td>
                            <td><?php echo $rsUser->username; ?></td>
                        </tr>
                        <tr>
                            <td class="well well-sm">Password</td>
                            <td>
                                <button class="btn btn-default btn-sm" 
                                        type="button" onclick="testUser()">
                                    Change
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="well well-sm">Name</td>
                            <td><?php echo $rsUser->name; ?></td>
                        </tr>
                        <tr>
                            <td class="well well-sm">Lastname</td>
                            <td><?php echo $rsUser->lastname; ?></td>
                        </tr>
                        <tr>
                            <td class="well well-sm">Email</td>
                            <td><?php echo $rsUser->email; ?></td>
                        </tr>
                        <tr>
                            <td class="well well-sm">Active?</td>
                            <td><?php echo $rsUser->sw_active; ?></td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>
    <div class="col-sm-8">
        <div class="">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#tab_groups" aria-controls="Groups" role="tab" data-toggle="tab">
                        <span class="text-muted">Groups</span>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#tab_privileges" aria-controls="Privileges" role="tab" data-toggle="tab">
                        <span class="text-success">Privileges (MCA)</span>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#tab_badlogins" aria-controls="BadLogin" role="tab" data-toggle="tab">
                        <span class="text-danger">BadLogin</span>
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
                <div role="tabpanel" class="tab-pane active" id="tab_groups">
                   
                </div>
                <div role="tabpanel" class="tab-pane" id="tab_privileges">
                    <div class="panel panel-green">
                        <div class="panel-body">
                            <div class="breadcrumb">
                                
                                <a href='javascript:loadResource("<?php echo __URL__.'/system/userAction/add/'.$rsUser->id_user;?>","div_aux2");' 
                                   class='btn btn-success btn-xs' title='AddMca'>
                                    <i class='fa fa-plus'></i>
                                </a> 
                            </div>
                            <div class="table-responsive">
                                <table class="table table-condensed table-bordered">
                                    <thead class="bg-success">
                                        <tr>
                                            <th>Module</th>
                                            <th>Controller</th>
                                            <th>Action</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="tab_badlogins">

                </div>
                <div role="tabpanel" class="tab-pane" id="tab_settings">

                </div>
            </div>
        </div>
    </div>
</div>
