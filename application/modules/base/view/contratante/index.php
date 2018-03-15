<div id="page-wrapper">
    <h2>base/contratante/index</h2>
    <header class="breadcrumb">
        <a href="http://local.factufacil/base/contratante/add" 
           class="btn btn-success">Add new</a>
    </header>
    <section id='results' class='table-responsive'>
      <table class="table table-bordered table-condensed table-hover">
        <thead class='bg-warning'>
            <tr>
                <th>id_contratante</th> 
<th>contratante</th> 
<th>cif</th> 
<th>razon_social</th> 
<th>id_poblacion</th> 
<th>direccion</th> 
<th>telefono</th> 
<th>email</th> 
<th>contacto</th> 
<th>cta_bancaria</th> 
<th>path_logo</th> 
<th>observacion</th> 
<th>created_at</th> 
<th>created_by</th> 
<th>aux_estados_id_estado</th> 
<th>estado</th> 
<th>poblacion</th> 
<th>provincia</th> 
<th>ccaa</th> 
<th>cod_provincia</th> 
<th>cod_ccaa</th> 
<th>cod_poblacion</th> 
<th>Options</th> 

            </tr>
        </thead>
        <tbody>
            <?php foreach($rsContratantes AS $contratante):?>
<tr> 
<td><?php echo $contratante->id_contratante; ?></td> 
<td><?php echo $contratante->contratante; ?></td> 
<td><?php echo $contratante->cif; ?></td> 
<td><?php echo $contratante->razon_social; ?></td> 
<td><?php echo $contratante->id_poblacion; ?></td> 
<td><?php echo $contratante->direccion; ?></td> 
<td><?php echo $contratante->telefono; ?></td> 
<td><?php echo $contratante->email; ?></td> 
<td><?php echo $contratante->contacto; ?></td> 
<td><?php echo $contratante->cta_bancaria; ?></td> 
<td><?php echo $contratante->path_logo; ?></td> 
<td><?php echo $contratante->observacion; ?></td> 
<td><?php echo $contratante->created_at; ?></td> 
<td><?php echo $contratante->created_by; ?></td> 
<td><?php echo $contratante->aux_estados_id_estado; ?></td> 
<td><?php echo $contratante->estado; ?></td> 
<td><?php echo $contratante->poblacion; ?></td> 
<td><?php echo $contratante->provincia; ?></td> 
<td><?php echo $contratante->ccaa; ?></td> 
<td><?php echo $contratante->cod_provincia; ?></td> 
<td><?php echo $contratante->cod_ccaa; ?></td> 
<td><?php echo $contratante->cod_poblacion; ?></td> 
<td> 
 <a href='/base/contratante/edit/<?php echo $contratante->id_contratante; ?>' 
 class='btn btn-default btn-xs' title='Edit'>
<i class='fa fa-edit'></i>
</a> 
<a href='/base/contratante/delete/<?php echo $contratante->id_contratante; ?>' 
 class='btn btn-danger btn-xs' title='Delete'>
<i class='fa fa-trash'></i></a> 
 </td> 
</tr> 
<?php endforeach;?>
        </tbody>
      </table>
    </section>
</div>