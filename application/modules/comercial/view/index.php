<div id="page-wrapper">
    <h2>comercial/index</h2>
    <header class="breadcrumb">
        <a href="http://local.keranaproject/comercial/empresa/add" 
           class="btn btn-success">Add new</a>
    </header>
    <section id='results' class='table-responsive'>
      <table class="table table-bordered table-condensed table-hover">
        <thead class='bg-warning'>
            <tr>
                <th>id_empresa</th> 
<th>razon_social</th> 
<th>nombre_comercial</th> 
<th>telefono</th> 
<th>email</th> 
<th>observaciones</th> 
<th>Options</th> 

            </tr>
        </thead>
        <tbody>
            <?php foreach($rsEmpresas AS $empresa):?>
<tr> 
<td><?php echo $empresa->id_empresa; ?></td> 
<td><?php echo $empresa->razon_social; ?></td> 
<td><?php echo $empresa->nombre_comercial; ?></td> 
<td><?php echo $empresa->telefono; ?></td> 
<td><?php echo $empresa->email; ?></td> 
<td><?php echo $empresa->observaciones; ?></td> 
<td> </td> 
</tr> 
<?php endforeach;?>
        </tbody>
      </table>
    </section>
</div>