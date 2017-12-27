<div id="page-wrapper">
     <h4 class='text-primary'> 
        <i class="fa fa-database fa-2x"></i>
        <span class='text-muted'>apps</span>Models
    </h4>
    <header class="breadcrumb">
        <a href="<?php echo __URL__;?>/system/model/add" 
           class="btn btn-success">
        <i class='fa fa-plus'></i> add
        </a>
    </header>
    <section id='section_modelos' class='table-responsive'>
        <table class='table table-condensed table-bordered table-hover'>
            <thead class='bg-info'>
                <tr>
                    <th>ID</th>
                    <th>Model</th>
                    <th>Table</th>
                    <th>Module</th>
                    <th>Description</th>
                    <th class="bg-primary">Tools</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rsModelos AS $modelo) : ?>
                    <tr>
                        <td><?php echo $modelo->id_model;?></td>
                        <td><?php echo $modelo->model;?></td>
                        <td><?php echo $modelo->table_reference;?></td>
                        <td><?php echo strtoupper($modelo->module);?></td>
                        <td><?php echo $modelo->model_description;?></td>
                        <td class="well">
                            <a href='<?php echo __URL__;?>/system/model/detail/<?php echo $modelo->id_model; ?>' 
                               class='btn btn-default btn-xs'>
                                <i class='fa fa-eye'></i>
                            </a>
                            <a href='' class='btn btn-info btn-xs'>
                                <i class='fa fa-pencil'></i>
                            </a>
                            <a href='<?php echo __URL__;?>/system/model/delete/<?php echo $modelo->id_model;?>' 
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