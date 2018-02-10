<div id="page-wrapper">
    <h2>system/index</h2>
    <header class="breadcrumb">
        <a href="http://local.keranaproject/system/action/add" 
           class="btn btn-success">Add new</a>
    </header>
    <section id='results' class='table-responsive'>
      <table class="table table-bordered table-condensed table-hover">
        <thead class='bg-warning'>
            <tr>
                <th>id_action</th> 
<th>action_name</th> 
<th>sw_system_action</th> 
<th>Options</th> 

            </tr>
        </thead>
        <tbody>
            <?php foreach($rsActions AS $action):?>
<tr> 
<td><?php echo $action->id_action; ?></td> 
<td><?php echo $action->action_name; ?></td> 
<td><?php echo $action->sw_system_action; ?></td> 
<td> 
 <a href='/system/action/edit/<?php echo $action->id_action; ?>' 
 class='btn btn-default btn-xs' title='Edit'>
<i class='fa fa-edit'></i>
</a> 
<a href='/system/action/delete/<?php echo $action->id_action; ?>' 
 class='btn btn-danger btn-xs' title='Delete'>
<i class='fa fa-trash'></i></a> 
 </td> 
</tr> 
<?php endforeach;?>
        </tbody>
      </table>
    </section>
</div>