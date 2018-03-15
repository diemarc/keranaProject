<div id="page-wrapper">
    <h2>base/poblacion/index</h2>
    <header class="breadcrumb">
        <a href="http://local.factufacil/base/poblacion/add" 
           class="btn btn-success">Add new</a>
    </header>
    <section id='results' class='table-responsive'>
      <table class="table table-bordered table-condensed table-hover">
        <thead class='bg-warning'>
            <tr>
                <th>id_poblacion</th> 
<th>poblacion</th> 
<th>provincia</th> 
<th>ccaa</th> 
<th>cod_provincia</th> 
<th>cod_ccaa</th> 
<th>Options</th> 

            </tr>
        </thead>
        <tbody>
            <?php foreach($rsPoblacions AS $poblacion):?>
<tr> 
<td><?php echo $poblacion->id_poblacion; ?></td> 
<td><?php echo $poblacion->poblacion; ?></td> 
<td><?php echo $poblacion->provincia; ?></td> 
<td><?php echo $poblacion->ccaa; ?></td> 
<td><?php echo $poblacion->cod_provincia; ?></td> 
<td><?php echo $poblacion->cod_ccaa; ?></td> 
<td> 
 <a href='/base/poblacion/edit/<?php echo $poblacion->id_poblacion; ?>' 
 class='btn btn-default btn-xs' title='Edit'>
<i class='fa fa-edit'></i>
</a> 
<a href='/base/poblacion/delete/<?php echo $poblacion->id_poblacion; ?>' 
 class='btn btn-danger btn-xs' title='Delete'>
<i class='fa fa-trash'></i></a> 
 </td> 
</tr> 
<?php endforeach;?>
        </tbody>
      </table>
    </section>
</div>