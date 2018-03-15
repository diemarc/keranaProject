<div id="page-wrapper">
    <h2>base/contratante/Edit record</h2>
    <form action="http://local.factufacil/base/contratante/update/<?php echo $rs->id_contratante; ?>" 
          id="formKerana" name="formKerana" method="POST" class="form-horizontal"
          accept-charset="utf-8">
                  <?php echo $kerana_token; ?>

        <header class="breadcrumb">
            <a href="http://local.factufacil/base/contratante/index" 
               class="btn btn-warning">Cancel</a>
            <button type="submit" class="btn btn-success">Save</button>
        </header>

        <div class='form-group form-group-sm'> 
<label for='f_contratante' class='col-sm-2 control-label'>Contratante</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="text" id="f_contratante" name="f_contratante" class="form-control"  maxlength="45" required value="<?php echo $rs->contratante;?>"  />
 </div> 
 </div> 
</div> 
<div class='form-group form-group-sm'> 
<label for='f_cif' class='col-sm-2 control-label'>Cif</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="text" id="f_cif" name="f_cif" class="form-control"  maxlength="10" required value="<?php echo $rs->cif;?>"  />
 </div> 
 </div> 
</div> 
<div class='form-group form-group-sm'> 
<label for='f_razon_social' class='col-sm-2 control-label'>Razon_social</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="text" id="f_razon_social" name="f_razon_social" class="form-control"  maxlength="250"  value="<?php echo $rs->razon_social;?>"  />
 </div> 
 </div> 
</div> 
<div class='form-group form-group-sm'> 
<label for='f_id_poblacion' class='col-sm-2 control-label'>Id_poblacion</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<select class="form-control" name="f_id_poblacion" id="f_id_poblacion" required> 
 <option value="">--Select a option --</option><?php foreach($rsPoblacions AS $poblacion): ?>  
  <option value="<?php echo $poblacion->id_poblacion;?>"> <?php echo $poblacion->poblacion; ?></option> 
<?php endforeach;?>  
</select> 

 </div> 
 </div> 
</div> 
<div class='form-group form-group-sm'> 
<label for='f_direccion' class='col-sm-2 control-label'>Direccion</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="text" id="f_direccion" name="f_direccion" class="form-control"  maxlength="45"  value="<?php echo $rs->direccion;?>"  />
 </div> 
 </div> 
</div> 
<div class='form-group form-group-sm'> 
<label for='f_telefono' class='col-sm-2 control-label'>Telefono</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="tel" id="f_telefono" name="f_telefono" class="form-control"  maxlength="15"  value="<?php echo $rs->telefono;?>"  />
 </div> 
 </div> 
</div> 
<div class='form-group form-group-sm'> 
<label for='f_email' class='col-sm-2 control-label'>Email</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="email" id="f_email" name="f_email" class="form-control"  maxlength="45"  value="<?php echo $rs->email;?>"  />
 </div> 
 </div> 
</div> 
<div class='form-group form-group-sm'> 
<label for='f_contacto' class='col-sm-2 control-label'>Contacto</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="text" id="f_contacto" name="f_contacto" class="form-control"  maxlength="45"  value="<?php echo $rs->contacto;?>"  />
 </div> 
 </div> 
</div> 
<div class='form-group form-group-sm'> 
<label for='f_cta_bancaria' class='col-sm-2 control-label'>Cta_bancaria</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="number" id="f_cta_bancaria" name="f_cta_bancaria" class="form-control" maxlength="20"  value="<?php echo $rs->cta_bancaria;?>" />
 </div> 
 </div> 
</div> 
<div class='form-group form-group-sm'> 
<label for='f_path_logo' class='col-sm-2 control-label'>Path_logo</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="text" id="f_path_logo" name="f_path_logo" class="form-control"  maxlength="45"  value="<?php echo $rs->path_logo;?>"  />
 </div> 
 </div> 
</div> 
<div class='form-group form-group-sm'> 
<label for='f_observacion' class='col-sm-2 control-label'>Observacion</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="text" id="f_observacion" name="f_observacion" class="form-control"  maxlength="250"  value="<?php echo $rs->observacion;?>"  />
 </div> 
 </div> 
</div> 
<div class='form-group form-group-sm'> 
<label for='f_aux_estados_id_estado' class='col-sm-2 control-label'>Aux_estados_id_estado</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<select class="form-control" name="f_aux_estados_id_estado" id="f_aux_estados_id_estado" required> 
 <option value="">--Select a option --</option><?php foreach($rsEstados AS $estado): ?>  
  <option value="<?php echo $estado->id_estado;?>"> <?php echo $estado->estado; ?></option> 
<?php endforeach;?>  
</select> 

 </div> 
 </div> 
</div> 


    </form>
</div>