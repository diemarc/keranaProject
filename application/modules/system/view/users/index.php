<div id="page-wrapper">
    <h4 class='text-primary'> 
        <i class="fa fa-users fa-2x"></i>
        <span class='text-muted'>system</span>Users
    </h4>
    <header class="breadcrumb">
        <a href="http://local.keranaproject/system/user/add" 
           class="btn btn-default btn-sm">
            <i class='fa fa-plus'></i>
        </a>
    </header>
    <section id='results' class='table-responsive'>
        <table class="table table-bordered table-condensed table-hover">
            <thead class='bg-info'>
                <tr>
                    <th>ID</th> 
                    <th>Username</th> 
                    <th>Email</th> 
                    <th>Name</th> 
                    <th>Is active?</th> 
                    <th class='bg-primary'>Options</th> 

                </tr>
            </thead>
            <tbody>
                <?php foreach ($rsUsers AS $user): ?>
                    <tr> 
                        <td><?php echo $user->id_usuario; ?></td> 
                        <td><?php echo $user->username; ?></td> 
                        <td><?php echo $user->email; ?></td> 
                        <td><?php echo $user->nombres . ' ' . $user->apellidos; ?></td> 
                        <td><?php echo $user->sw_activo; ?></td> 
                        <td class='well'> 
                            <a href='/system/user/edit/<?php echo $user->id_usuario; ?>' 
                               class='btn btn-default btn-xs' title='Edit'>
                                <i class='fa fa-edit'></i>
                            </a> 
                            <a href='/system/user/delete/<?php echo $user->id_usuario; ?>' 
                               class='btn btn-danger btn-xs' title='Delete'>
                                <i class='fa fa-trash'></i></a> 
                        </td> 
                    </tr> 
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</div>