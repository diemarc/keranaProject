<div id="page-wrapper">

    <h4 class='text-primary'> 
        <i class="fa fa-compass fa-2x"></i>
        <span class='text-muted'>apps</span>Controllers
    </h4>

    <header class="breadcrumb">
        <a href="<?php echo __URL__; ?>/system/controller/add" 
           class="btn btn-success">
            <i class='fa fa-plus'></i> add
        </a>
    </header>
    <section id='section_modelos' class='table-responsive'>
        <table class='table table-condensed table-bordered table-hover'>
            <thead class='bg-info'>
                <tr>
                    <th>ID</th>
                    <th>Controller</th>
                    <th>Module</th>
                    <th>Description</th>
                    <th class="bg-primary">Tools</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rsControllers AS $controller) : ?>
                    <tr>
                        <td><?php echo $controller->id_controller; ?></td>
                        <td><?php echo $controller->controller; ?></td>
                        <td><strong><?php echo $controller->module; ?></strong></td>
                        <td><?php echo $controller->controller_description; ?></td>
                        <td class="well">
                            <a href='<?php echo __URL__; ?>/system/controller/detail/<?php echo $controller->id_controller; ?>' 
                               class='btn btn-default btn-xs'>
                                <i class='fa fa-eye'></i>
                            </a>
                            <a href='' class='btn btn-info btn-xs'>
                                <i class='fa fa-pencil'></i>
                            </a>
                            <a href='<?php echo __URL__ . '/' . $controller->controller_module . '/' . $controller->controller . '/index'; ?>' 
                               target='_blank' class='btn btn-success btn-xs'>
                                <i class='fa fa-road'></i>
                            </a>
                            <a href='<?php echo __URL__; ?>/system/controller/delete/<?php echo $controller->id_controller; ?>' 
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