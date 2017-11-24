<div id="page-wrapper">
    <h2>Application Modules</h2>
    <header class="breadcrumb">
        <a href="<?php echo __URL__;?>/system/module/add" class="btn btn-success">Add new</a>
    </header>
    <section id='section_modulos' class='table-responsive'>
        <table class='table table-condensed table-bordered table-hover'>
            <thead class='bg-primary'>
                <tr>
                    <th>ID</th>
                    <th>Module</th>
                    <th>Active</th>
                    <th>Restricted</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rsModules AS $module) : ?>
                    <tr>
                        <td><?php echo $module->id_module;?></td>
                        <td><?php echo $module->module;?></td>
                        <td><?php echo $module->sw_active_modulo;?></td>
                        <td><?php echo $module->sw_restricted;?></td>
                        <td>
                            <a href='<?php echo __URL__;?>/system/module/detail/<?php echo $module->id_module; ?>' 
                               class='btn btn-default btn-xs'>
                                <i class='fa fa-eye'></i>
                            </a>
                            <a href='' class='btn btn-info btn-xs'>
                                <i class='fa fa-pencil'></i>
                            </a>
                            <a href='<?php echo __URL__;?>/system/module/delete/<?php echo $module->id_module;?>' 
                               class='btn btn-danger btn-xs'>
                                <i class='fa fa-trash-o'></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</div>