<div id="page-wrapper">
    <h2>base/estado/index</h2>
    <header class="breadcrumb">
        <a href="http://local.factufacil/base/estado/add" 
           class="btn btn-success">Add new</a>
    </header>
    <section id='results' class='table-responsive'>
      <table class="table table-bordered table-condensed table-hover">
        <thead class='bg-warning'>
            <tr>
                <th>id_estado</th> 
<th>estado</th> 
<th>Options</th> 

            </tr>
        </thead>
        <tbody>
            <?php foreach($rsEstados AS $estado):?>
<tr> 
<td><?php echo $estado->id_estado; ?></td> 
<td><?php echo $estado->estado; ?></td> 
<td> 
 <a href='/base/estado/edit/<?php echo $estado->id_estado; ?>' 
 class='btn btn-default btn-xs' title='Edit'>
<i class='fa fa-edit'></i>
</a> 
<a href='/base/estado/delete/<?php echo $estado->id_estado; ?>' 
 class='btn btn-danger btn-xs' title='Delete'>
<i class='fa fa-trash'></i></a> 
 </td> 
</tr> 
<?php endforeach;?>
        </tbody>
      </table>
    </section>
</div>