<div id="page-wrapper">
    <h2>base/subclase/index</h2>
    <header class="breadcrumb">
        <a href="http://local.factufacil/base/subclase/add" 
           class="btn btn-success">Add new</a>
    </header>
    <section id='results' class='table-responsive'>
      <table class="table table-bordered table-condensed table-hover">
        <thead class='bg-warning'>
            <tr>
                <th>id_subclase</th> 
<th>id_clases</th> 
<th>subclase</th> 
<th>clase</th> 
<th>Options</th> 

            </tr>
        </thead>
        <tbody>
            <?php foreach($rsSubclases AS $subclase):?>
<tr> 
<td><?php echo $subclase->id_subclase; ?></td> 
<td><?php echo $subclase->id_clases; ?></td> 
<td><?php echo $subclase->subclase; ?></td> 
<td><?php echo $subclase->clase; ?></td> 
<td> 
 <a href='/base/subclase/edit/<?php echo $subclase->id_subclase; ?>' 
 class='btn btn-default btn-xs' title='Edit'>
<i class='fa fa-edit'></i>
</a> 
<a href='/base/subclase/delete/<?php echo $subclase->id_subclase; ?>' 
 class='btn btn-danger btn-xs' title='Delete'>
<i class='fa fa-trash'></i></a> 
 </td> 
</tr> 
<?php endforeach;?>
        </tbody>
      </table>
    </section>
</div>