<div id="page-wrapper">
    <h2>Application Models</h2>
    <header class="breadcrumb">
        <a href="<?php echo __URL__;?>/system/model/add" 
           class="btn btn-success">Add New</a>
    </header>
    <section id='section_modelos' class='table-responsive'>
        <table class='table table-condensed table-bordered table-hover'>
            <thead class='bg-primary'>
                <tr>
                    <th>ID</th>
                    <th>Model</th>
                    <th>Table</th>
                    <th>Module</th>
                    <th>Description</th>
                    <th></th>
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
                        <td>
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