<div id="page-wrapper">
    <h2>base/formapago/index</h2>
    <header class="breadcrumb">
        <a href="http://local.factufacil/base/formapago/add" 
           class="btn btn-success">Add new</a>
    </header>
    <section id='results' class='table-responsive'>
      <table class="table table-bordered table-condensed table-hover">
        <thead class='bg-warning'>
            <tr>
                <th>id_pago</th> 
<th>formapago</th> 
<th>Options</th> 

            </tr>
        </thead>
        <tbody>
            <?php foreach($rsFormapagos AS $formapago):?>
<tr> 
<td><?php echo $formapago->id_pago; ?></td> 
<td><?php echo $formapago->formapago; ?></td> 
<td> 
 <a href='/base/formapago/edit/<?php echo $formapago->id_pago; ?>' 
 class='btn btn-default btn-xs' title='Edit'>
<i class='fa fa-edit'></i>
</a> 
<a href='/base/formapago/delete/<?php echo $formapago->id_pago; ?>' 
 class='btn btn-danger btn-xs' title='Delete'>
<i class='fa fa-trash'></i></a> 
 </td> 
</tr> 
<?php endforeach;?>
        </tbody>
      </table>
    </section>
</div>