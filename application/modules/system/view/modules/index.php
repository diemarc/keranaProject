<div id="page-wrapper">
    <h4 class='text-primary'> 
        <i class="fa fa-list-alt fa-2x"></i>
        <span class='text-muted'>apps</span>Modules
    </h4>
    <header class="breadcrumb">
        <a href="<?php echo __URL__; ?>/system/module/add" 
           class="btn btn-success btn-sm">
            <i class='fa fa-plus'></i> add
        </a>
    </header>
    <section id='section_modulos' class='table-responsive'>
        <table class='table table-condensed table-bordered table-hover'>
            <thead class='bg-info'>
                <tr>
                    <th>ID</th>
                    <th>Module</th>
                    <th>Active</th>
                    <th>Restricted</th>
                    <th class="bg-primary">Tools</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rsModules AS $module) : ?>
                    <tr>
                        <td><?php echo $module->id_module; ?></td>
                        <td><?php echo $module->module; ?></td>
                        <td><?php echo $module->sw_active_module; ?></td>
                        <td><?php echo $module->sw_restricted; ?></td>
                        <td class="well">
                            <?php if (!$module->is_system_module) : ?>
                                <a href='<?php echo __URL__; ?>/system/module/detail/<?php echo $module->id_module; ?>' 
                                   class='btn btn-default btn-xs'>
                                    <i class='fa fa-eye'></i>
                                </a>
                                <a href='' class='btn btn-info btn-xs'>
                                    <i class='fa fa-pencil'></i>
                                </a>
                                <a href='<?php echo __URL__; ?>/system/module/delete/<?php echo $module->id_module; ?>' 
                                   class='btn btn-danger btn-xs'>
                                    <i class='fa fa-trash-o'></i>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</div>