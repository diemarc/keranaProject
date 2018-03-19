<div id="page-wrapper">
    <h2>base/tipo/index</h2>
    <header class="breadcrumb">
        <a href="http://local.factufacil/base/tipo/add" 
           class="btn btn-success">Add new</a>
    </header>
    <section id='results' class='table-responsive'>
      <table class="table table-bordered table-condensed table-hover">
        <thead class='bg-warning'>
            <tr>
                <th>id_tipo</th> 
<th>tipo</th> 
<th>Options</th> 

            </tr>
        </thead>
        <tbody>
            <?php foreach($rsTipos AS $tipo):?>
<tr> 
<td><?php echo $tipo->id_tipo; ?></td> 
<td><?php echo $tipo->tipo; ?></td> 
<td> 
 <a href='/base/tipo/edit/<?php echo $tipo->id_tipo; ?>' 
 class='btn btn-default btn-xs' title='Edit'>
<i class='fa fa-edit'></i>
</a> 
<a href='/base/tipo/delete/<?php echo $tipo->id_tipo; ?>' 
 class='btn btn-danger btn-xs' title='Delete'>
<i class='fa fa-trash'></i></a> 
 </td> 
</tr> 
<?php endforeach;?>
        </tbody>
      </table>
    </section>
</div>