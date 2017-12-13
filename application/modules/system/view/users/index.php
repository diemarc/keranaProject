<div id="page-wrapper">
    <h2>system/index</h2>
    <header class="breadcrumb">
        <a href="http://local.keranaproject/system/user/add" 
           class="btn btn-success">Add new</a>
    </header>
    <section id='results' class='table-responsive'>
      <table class="table table-bordered table-condensed table-hover">
        <thead class='bg-warning'>
            <tr>
                <th>id_usuario</th> 
<th>username</th> 
<th>password</th> 
<th>salt</th> 
<th>email</th> 
<th>nombres</th> 
<th>apellidos</th> 
<th>sw_activo</th> 
<th>Options</th> 

            </tr>
        </thead>
        <tbody>
            <?php foreach($rsUsers AS $user):?>
<tr> 
<td><?php echo $user->id_usuario; ?></td> 
<td><?php echo $user->username; ?></td> 
<td><?php echo $user->password; ?></td> 
<td><?php echo $user->salt; ?></td> 
<td><?php echo $user->email; ?></td> 
<td><?php echo $user->nombres; ?></td> 
<td><?php echo $user->apellidos; ?></td> 
<td><?php echo $user->sw_activo; ?></td> 
<td> 
 <a href='/system/user/edit/<?php echo $user->id_usuario; ?>' 
 class='btn btn-default btn-xs' title='Edit'>
<i class='fa fa-edit'></i>
</a> 
<a href='/system/user/delete/<?php echo $user->id_usuario; ?>' 
 class='btn btn-danger btn-xs' title='Delete'>
<i class='fa fa-trash'></i></a> 
 </td> 
</tr> 
<?php endforeach;?>
        </tbody>
      </table>
    </section>
</div>