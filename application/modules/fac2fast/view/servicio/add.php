<div id="page-wrapper">
    <h2>fac2fast/servicio/New record</h2>
    <form action="http://local.factufacil/fac2fast/servicio/save" 
          id="formKerana" name="formKerana" method="POST" class="form-horizontal"
          accept-charset="utf-8">
                  <?php echo $kerana_token; ?>

        <header class="breadcrumb">
            <a href="http://local.factufacil/fac2fast/servicio/index" 
               class="btn btn-warning">Cancel</a>
            <button type="submit" class="btn btn-success">Save</button>
        </header>

        <div class='form-group form-group-sm'> 
<label for='f_id_subclase' class='col-sm-2 control-label'>Id_subclase</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<select class="form-control" name="f_id_subclase" id="f_id_subclase" required> 
 <option value="">--Select a option --</option><?php foreach($rsSubclases AS $subclase): ?>  
  <option value="<?php echo $subclase->id_subclase;?>"> <?php echo $subclase->subclase; ?></option> 
<?php endforeach;?>  
</select> 

 </div> 
 </div> 
</div> 
<div class='form-group form-group-sm'> 
<label for='f_servicio' class='col-sm-2 control-label'>Servicio</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="text" id="f_servicio" name="f_servicio" class="form-control"  maxlength="45"   />
 </div> 
 </div> 
</div> 
<div class='form-group form-group-sm'> 
<label for='f_descripcion' class='col-sm-2 control-label'>Descripcion</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<textarea id="f_descripcion" name="f_descripcion" class="form-control"></textarea>
 </div> 
 </div> 
</div> 
<div class='form-group form-group-sm'> 
<label for='f_precio' class='col-sm-2 control-label'>Precio</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="number" step="0.01" id="f_precio" name="f_precio" class="form-control"  maxlength="10,2" required  />
 </div> 
 </div> 
</div> 


    </form>
</div>