<div id="page-wrapper" style="">
    <h4 class='text-primary'> 
        <i class="fa fa-database fa-2x"></i>
        <span class='text-muted'>apps</span><a href="<?php echo __URL__; ?>/system/model/index" 
                                               >Models</a> -><?php echo $rsModel->model; ?>
    </h4>

    <div class="col-sm-4" style="padding-left:2px;">

        <div class="panel panel-info">
            <div class="panel-body">
                <h4>
                    <strong>ModelDetail</strong>
                </h4>
                <div class="breadcrumb">
                    <a href='<?php echo __URL__; ?>/system/model/delete/<?php echo $rsModel->id_model; ?>' class="btn btn-danger btn-sm">
                        DeleteModel
                    </a>
                </div>
                <?php
                echo (empty($Status->Auto_increment)) ?
                        '<div class="alert alert-danger text-danger">'
                . '<strong>hummm..no AI detected, FIX IT!!!</strong></div>' : '';
                ?>
                <table class="table table-condensed table-bordered">
                    <thead class="small">
                        <tr>
                            <td class="well well-sm">UMID</td>
                            <td><?php echo $rsModel->id_model; ?></td>
                        </tr>
                        <tr>
                            <td class="well well-sm">Model</td>
                            <td><?php echo $rsModel->model; ?></td>
                        </tr>
                        <tr>
                            <td class="well well-sm">TableReferenced</td>
                            <td><?php echo $rsModel->table_reference; ?></td>
                        </tr>
                        <tr>
                            <td class="well well-sm">Description</td>
                            <td><?php echo $rsModel->model_description; ?></td>
                        </tr>
                        <tr>
                            <td class="well well-sm">SystemModel</td>
                            <td><?php echo $rsModel->is_system_model; ?></td>
                        </tr>
                        <tr>
                            <td class="well well-sm">Controllers</td>
                            <td>
                                <ul class="list list-group">
                                    <?php foreach ($rsControllers AS $controller_mod): ?>
                                        <li clasS="list-group list-group-item">
                                            <a href="<?php echo __URL__ . '/' .
                                    $controller_mod->module . '/' . $controller_mod->controller . '/index';
                                        ?>" target="_blank">
                                                <strong><?php echo $controller_mod->controller; ?></strong>
                                                <span class="btn btn-circle btn-primary">Run!</span>
                                            </a>
                                        </li>
<?php endforeach; ?>
                                </ul>


                            </td>
                        </tr>
                        <tr>
                            <td class="well well-sm">MasterQuery</td>
                            <td>
                                <a href='javascript:loadResource("<?php echo __URL__ . '/system/model/viewQuery/' . $rsModel->id_model; ?>","div_aux2");' 
                                   class='btn btn-success btn-xs' title='viewQuery'>
                                    <i class='fa fa-code'></i>View master query
                                </a> 

                            </td>
                        </tr>
                    </thead>
                </table>
            </div>

            <div class="panel-body">
                <h5>
                    <strong>TableStadistics</strong>
                </h5>
                <table class="table table-condensed table-bordered">
                    <thead class="small">
                        <tr>
                            <td class="well well-sm">Rows</td>
                            <td>
                                <span class="badge">
<?php echo $Status->Rows; ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="well well-sm">Fields</td>
                            <td><?php echo count($rsTableDesc); ?></td>
                        </tr>
                        <tr>
                            <td class="well well-sm">Engine</td>
                            <td><?php echo $Status->Engine; ?></td>
                        </tr>
                        <tr>
                            <td class="well well-sm">Collation</td>
                            <td><?php echo $Status->Collation; ?></td>
                        </tr>
                        <tr>
                            <td class="well well-sm">Comment</td>
                            <td><?php echo $Status->Comment; ?></td>
                        </tr>
                        <tr>
                            <td class="well well-sm">AutoIncrement</td>
                            <td><?php
                                echo (empty($Status->Auto_increment)) ?
                                        '<span class="bg-danger text-danger"><strong>hummm..no AI detected!!!</strong></span>' : $Status->Auto_increment;
                                ?></td>
                        </tr>
                        <tr>
                            <td class="well well-sm">Created_at</td>
                            <td><?php echo $Status->Create_time; ?></td>
                        </tr>
                        <tr>
                            <td class="well well-sm">Update_at</td>
                            <td><?php echo $Status->Update_time; ?></td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>
    <div class="col-sm-8">

        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>TableInformation</strong>
            </div>
            <div class="panel-body">
                <div class="">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#tab_groups" aria-controls="Groups" role="tab" data-toggle="tab">
                                <span class="text-muted">Fields</span>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#tab_privileges" aria-controls="Privileges" role="tab" data-toggle="tab">
                                <span class="text-success">INDEX</span>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#tab_dependencys" aria-controls="BadLogin" role="tab" data-toggle="tab">
                                <span class="text-primary">Dependencys</span>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#tab_badlogins" aria-controls="BadLogin" role="tab" data-toggle="tab">
                                <span class="text-danger">References</span>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#tab_settings" aria-controls="settings" role="tab" data-toggle="tab">
                                @Maintance
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="tab_groups">
                            <div class="panel panel-green">
                                <div class="panel-body">
                                    <h5>
                                        <strong>Fields</strong>
                                    </h5>
                                    <div class="table-responsive">
                                        <table class="table table-condensed table-bordered">
                                            <thead class="bg-primary">
                                                <tr>
                                                    <th>Field</th>
                                                    <th>Type</th>
                                                    <th>Null</th>
                                                    <th>Key</th>
                                                    <th>Default</th>
                                                    <th>Extra</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($rsTableDesc AS $desc):
                                                    $icon_pk = ($desc->Key == 'PRI') ? 'fa fa-key' : '';
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <strong>
                                                                <i class="text-success <?php echo $icon_pk; ?>"></i>
                                                            </strong>
    <?php echo $desc->Field; ?></td>
                                                        <td><?php echo $desc->Type; ?></td>
                                                        <td><?php echo $desc->Null; ?></td>
                                                        <td><?php echo $desc->Key; ?></td>
                                                        <td><?php echo $desc->Default; ?></td>
                                                        <td><?php echo $desc->Extra; ?></td>
                                                    </tr>

<?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab_privileges">
                            <div class="panel panel-green">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-condensed table-bordered">
                                            <thead class="bg-primary">
                                                <tr>
                                                    <th>NU</th>
                                                    <th>Key_name</th>
                                                    <th>SII</th>
                                                    <th>Field</th>
                                                    <th>Coll.</th>
                                                    <th>Cardinality</th>
                                                    <th>Type</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php foreach ($rsKeys AS $key): ?>
                                                    <tr>
                                                        <td><?php echo $key->Non_unique; ?></td>
                                                        <td><?php echo $key->Key_name; ?></td>
                                                        <td><?php echo $key->Seq_in_index; ?></td>
                                                        <td><?php echo $key->Column_name; ?></td>
                                                        <td><?php echo $key->Collation; ?></td>
                                                        <td><?php echo $key->Cardinality; ?></td>
                                                        <td><?php echo $key->Index_type; ?></td>
                                                    </tr>

<?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab_badlogins">
                            <div class="panel panel-green">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-condensed table-bordered">
                                            <thead class="bg-success">
                                                <tr>
                                                    <th class="bg-primary">Local_field</th>
                                                    <th>Parent_table</th>
                                                    <th>Parent_Field</th>
                                                    <th>Constraint</th>

                                                </tr>
                                            </thead>
                                            <tbody>
<?php foreach ($rsReferences AS $ref): ?>
                                                    <tr>
                                                        <td><?php echo $ref->referenced_column_name; ?></td>
                                                        <td><?php echo $ref->table_name; ?></td>
                                                        <td><?php echo $ref->column_name; ?></td>
                                                        <td><?php echo $ref->constraint_name; ?></td>
                                                    </tr>

<?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab_dependencys">
                            <div class="panel panel-green">
                                <div class="panel-body">
<?php if ($rsDependencys) { ?>
                                        <div class="table-responsive">
                                            <table class="table table-condensed table-bordered">
                                                <thead class="bg-success">
                                                    <tr>
                                                        <th>Model</th>
                                                        <th>Dependency_table</th>
                                                        <th>Dependency_table_field</th>
                                                        <th class="bg-primary">Local_field_name</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
    <?php foreach ($rsDependencys AS $dep): ?>
                                                        <tr>
                                                            <td>
                                                                <a href="<?php echo __URL__ . '/system/model/detail/' . $dep->id_model; ?>">
        <?php echo $dep->module . '/' . $dep->model; ?>
                                                                </a>
                                                            </td>
                                                            <td><?php echo $dep->referenced_table_name; ?></td>
                                                            <td><?php echo $dep->referenced_column_name; ?></td>
                                                            <td><?php echo $dep->column_name; ?></td>
                                                        </tr>

    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
<?php } else { ?>
                                        <div class="alert alert-link">
                                            Not dependencys found!
                                        </div>

<?php } ?>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab_settings">
                            <div class="panel panel-warning">
                                <div class="panel-heading">
                                    TableMaintance
                                </div>
                                <div class="panel-body">
                                    <table class="table table-condensed table-bordered">
                                        <thead class="small">
                                            <tr>
                                                <td class="well well-sm">Row_format</td>
                                                <td>
<?php echo $Status->Row_format; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="well well-sm">AVG_row</td>
                                                <td><?php echo $Status->Avg_row_length; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="well well-sm">Data_lenght</td>
                                                <td><?php echo $Status->Data_length; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="well well-sm">Max_data_lenght</td>
                                                <td><?php echo $Status->Max_data_length; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="well well-sm">Index_lenght</td>
                                                <td><?php echo $Status->Index_length; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="well well-sm">Datea_free
                                                <td><?php echo $Status->Data_free; ?></td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
