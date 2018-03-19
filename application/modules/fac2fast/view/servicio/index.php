<div id="page-wrapper">
    <h2>fac2fast/servicio/index</h2>
    <header class="breadcrumb">
        <a href="http://local.factufacil/fac2fast/servicio/add" 
           class="btn btn-success">Add new</a>
    </header>
    <section id='results' class='table-responsive'>
      <table class="table table-bordered table-condensed table-hover">
        <thead class='bg-warning'>
            <tr>
                <th>id_servicio</th> 
<th>id_subclase</th> 
<th>servicio</th> 
<th>descripcion</th> 
<th>precio</th> 
<th>created_at</th> 
<th>created_by</th> 
<th>subclase</th> 
<th>clase</th> 
<th>Options</th> 

            </tr>
        </thead>
        <tbody>
            <?php foreach($rsServicios AS $servicio):?>
<tr> 
<td><?php echo $servicio->id_servicio; ?></td> 
<td><?php echo $servicio->id_subclase; ?></td> 
<td><?php echo $servicio->servicio; ?></td> 
<td><?php echo $servicio->descripcion; ?></td> 
<td><?php echo $servicio->precio; ?></td> 
<td><?php echo $servicio->created_at; ?></td> 
<td><?php echo $servicio->created_by; ?></td> 
<td><?php echo $servicio->subclase; ?></td> 
<td><?php echo $servicio->clase; ?></td> 
<td> 
 <a href='/fac2fast/servicio/edit/<?php echo $servicio->id_servicio; ?>' 
 class='btn btn-default btn-xs' title='Edit'>
<i class='fa fa-edit'></i>
</a> 
<a href='/fac2fast/servicio/delete/<?php echo $servicio->id_servicio; ?>' 
 class='btn btn-danger btn-xs' title='Delete'>
<i class='fa fa-trash'></i></a> 
 </td> 
</tr> 
<?php endforeach;?>
        </tbody>
      </table>
    </section>
</div>