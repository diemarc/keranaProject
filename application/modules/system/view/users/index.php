<div id="page-wrapper">
    <h2>
        <i class='fa fa-users'></i> System/Users</h2>
    <header class="breadcrumb">
        <a href="<?php echo __URL__;?>/system/user/add" 
           class="btn btn-success">Add new</a>
    </header>
    <?php echo \helpers\Url::getModule();?>
    <section id='results' class='table-responsive'>
        <table class="table table-bordered table-condensed table-hover">
            <thead class='bg-warning'>
                <tr>
                    <th>id_usuario</th> 
                    <th>username</th> 
                    <th>email</th> 
                    <th>nombres</th> 
                    <th>apellidos</th> 
                    <th>sw_activo</th> 
                    <th>Options</th> 

                </tr>
            </thead>
            <tbody>
                <?php foreach ($rsUsuarios AS $usuario): ?>
                    <tr> 
                        <td><?php echo $usuario->id_usuario; ?></td> 
                        <td><?php echo $usuario->username; ?></td> 
                        <td><?php echo $usuario->email; ?></td> 
                        <td><?php echo $usuario->nombres; ?></td> 
                        <td><?php echo $usuario->apellidos; ?></td> 
                        <td><?php echo $usuario->sw_activo; ?></td> 
                        <td> 
                            <a href="<?php echo __URL__;?>/system/user/edit/<?php echo $usuario->id_usuario;?>">Editar</a>
                        </td> 
                    </tr> 
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</div>