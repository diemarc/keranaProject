<div id="page-wrapper">
    <h2>base/taxa/index</h2>
    <header class="breadcrumb">
        <a href="http://local.factufacil/base/taxa/add" 
           class="btn btn-success">Add new</a>
    </header>
    <section id='results' class='table-responsive'>
      <table class="table table-bordered table-condensed table-hover">
        <thead class='bg-warning'>
            <tr>
                <th>id_tasa</th> 
<th>tasa</th> 
<th>porcentaje</th> 
<th>Options</th> 

            </tr>
        </thead>
        <tbody>
            <?php foreach($rsTaxas AS $taxa):?>
<tr> 
<td><?php echo $taxa->id_tasa; ?></td> 
<td><?php echo $taxa->tasa; ?></td> 
<td><?php echo $taxa->porcentaje; ?></td> 
<td> 
 <a href='/base/taxa/edit/<?php echo $taxa->id_tasa; ?>' 
 class='btn btn-default btn-xs' title='Edit'>
<i class='fa fa-edit'></i>
</a> 
<a href='/base/taxa/delete/<?php echo $taxa->id_tasa; ?>' 
 class='btn btn-danger btn-xs' title='Delete'>
<i class='fa fa-trash'></i></a> 
 </td> 
</tr> 
<?php endforeach;?>
        </tbody>
      </table>
    </section>
</div>