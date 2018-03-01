<div id="page-wrapper">
    <h2>repo/poblacion/index</h2>
    <header class="breadcrumb">
        <a href="http://local.keranaproject/repo/poblacion/add" 
           class="btn btn-success">Add new</a>
    </header>
    <section id='results' class='table-responsive'>
        <table class="table table-bordered table-condensed table-hover">
            <thead class='bg-warning'>
                <tr>
                    <th>id_poblacion</th> 
                    <th>localidad</th> 
                    <th>provincia</th> 
                    <th>ccaa</th> 
                    <th>Options &ntilde;o</th> 

                </tr>
            </thead>
            <tbody>
                <?php foreach ($rsPoblacions AS $poblacion): ?>
                    <tr> 
                        <td><?php echo $poblacion->id_poblacion; ?></td> 
                        <td><?php echo $poblacion->localidad; ?></td> 
                        <td><?php echo $poblacion->provincia; ?></td> 
                        <td><?php echo $poblacion->ccaa; ?></td> 
                        <td> 
                            <a href='/repo/poblacion/edit/<?php echo $poblacion->id_poblacion; ?>' 
                               class='btn btn-default btn-xs' title='Edit'>
                                <i class='fa fa-edit'></i>
                            </a> 
                            <a href='/repo/poblacion/delete/<?php echo $poblacion->id_poblacion; ?>' 
                               class='btn btn-danger btn-xs' title='Delete'>
                                <i class='fa fa-trash'></i></a> 
                        </td> 
                    </tr> 
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</div>