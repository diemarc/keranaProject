<div id="page-wrapper">
    <h2>base/poblacion/New record</h2>
    <form action="http://local.factufacil/base/poblacion/save" 
          id="formKerana" name="formKerana" method="POST" class="form-horizontal"
          accept-charset="utf-8">
                  <?php echo $kerana_token; ?>

        <header class="breadcrumb">
            <a href="http://local.factufacil/base/poblacion/index" 
               class="btn btn-warning">Cancel</a>
            <button type="submit" class="btn btn-success">Save</button>
        </header>

        <div class='form-group form-group-sm'> 
<label for='f_poblacion' class='col-sm-2 control-label'>Poblacion</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="text" id="f_poblacion" name="f_poblacion" class="form-control"  maxlength="45"   />
 </div> 
 </div> 
</div> 
<div class='form-group form-group-sm'> 
<label for='f_provincia' class='col-sm-2 control-label'>Provincia</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="text" id="f_provincia" name="f_provincia" class="form-control"  maxlength="45"   />
 </div> 
 </div> 
</div> 
<div class='form-group form-group-sm'> 
<label for='f_ccaa' class='col-sm-2 control-label'>Ccaa</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="text" id="f_ccaa" name="f_ccaa" class="form-control"  maxlength="45"   />
 </div> 
 </div> 
</div> 
<div class='form-group form-group-sm'> 
<label for='f_cod_provincia' class='col-sm-2 control-label'>Cod_provincia</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="number" id="f_cod_provincia" name="f_cod_provincia" class="form-control" maxlength="2" required />
 </div> 
 </div> 
</div> 
<div class='form-group form-group-sm'> 
<label for='f_cod_ccaa' class='col-sm-2 control-label'>Cod_ccaa</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="number" id="f_cod_ccaa" name="f_cod_ccaa" class="form-control" maxlength="2" required />
 </div> 
 </div> 
</div> 
<div class='form-group form-group-sm'> 
<label for='f_cod_poblacion' class='col-sm-2 control-label'>Cod_poblacion</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="number" id="f_cod_poblacion" name="f_cod_poblacion" class="form-control" maxlength="6" required />
 </div> 
 </div> 
</div> 


    </form>
</div>