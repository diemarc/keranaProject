<div id="page-wrapper">
    <h2>base/clase/index</h2>
    <header class="breadcrumb">
        <a href="http://local.factufacil/base/clase/add" 
           class="btn btn-success">Add new</a>
    </header>
    <section id='results' class='table-responsive'>
      <table class="table table-bordered table-condensed table-hover">
        <thead class='bg-warning'>
            <tr>
                <th>id_clases</th> 
<th>clase</th> 
<th>Options</th> 

            </tr>
        </thead>
        <tbody>
            <?php foreach($rsClases AS $clase):?>
<tr> 
<td><?php echo $clase->id_clases; ?></td> 
<td><?php echo $clase->clase; ?></td> 
<td> 
 <a href='/base/clase/edit/<?php echo $clase->id_clases; ?>' 
 class='btn btn-default btn-xs' title='Edit'>
<i class='fa fa-edit'></i>
</a> 
<a href='/base/clase/delete/<?php echo $clase->id_clases; ?>' 
 class='btn btn-danger btn-xs' title='Delete'>
<i class='fa fa-trash'></i></a> 
 </td> 
</tr> 
<?php endforeach;?>
        </tbody>
      </table>
    </section>
</div>