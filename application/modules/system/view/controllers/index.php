<div id="page-wrapper">
    <h2>Application Controllers</h2>
    <header class="breadcrumb">
        <a href="<?php echo __URL__;?>/system/controller/add" 
           class="btn btn-success">Add new</a>
    </header>
    <section id='section_modelos' class='table-responsive'>
        <table class='table table-condensed table-bordered table-hover'>
            <thead class='bg-primary'>
                <tr>
                    <th>ID</th>
                    <th>Module</th>
                    <th>Controller</th>
                    <th>Description</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rsControllers AS $controller) : ?>
                    <tr>
                        <td><?php echo $controller->id_controller;?></td>
                        <td><?php echo strtoupper($controller->controller_module);?></td>
                        <td><?php echo $controller->controller;?></td>
                        <td><?php echo $controller->controller_description;?></td>
                        <td>
                            <a href='<?php echo __URL__;?>/system/controller/detail/<?php echo $controller->id_controller; ?>' 
                               class='btn btn-default btn-xs'>
                                <i class='fa fa-eye'></i>
                            </a>
                            <a href='' class='btn btn-info btn-xs'>
                                <i class='fa fa-pencil'></i>
                            </a>
                            <a href='<?php echo __URL__;?>/system/controller/delete/<?php echo $controller->id_controller;?>' 
                               class='btn btn-danger btn-xs'>
                                <i class='fa fa-trash-o'></i>
                            </a>
                            <a href='<?php echo __URL__.'/'.$controller->controller_module.'/'.$controller->controller.'/index';?>' 
                               target='_blank' class='btn btn-primary btn-xs'>
                                <i class='fa fa-expeditedssl'></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</div>