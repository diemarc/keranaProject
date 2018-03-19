<div id="page-wrapper">
    <h2>base/estado/New record</h2>
    <form action="http://local.factufacil/base/estado/save" 
          id="formKerana" name="formKerana" method="POST" class="form-horizontal"
          accept-charset="utf-8">
                  <?php echo $kerana_token; ?>

        <header class="breadcrumb">
            <a href="http://local.factufacil/base/estado/index" 
               class="btn btn-warning">Cancel</a>
            <button type="submit" class="btn btn-success">Save</button>
        </header>

        <div class='form-group form-group-sm'> 
<label for='f_estado' class='col-sm-2 control-label'>Estado</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="text" id="f_estado" name="f_estado" class="form-control"  maxlength="45"   />
 </div> 
 </div> 
</div> 
<div class='form-group form-group-sm'> 
<label for='f_tipo' class='col-sm-2 control-label'>Tipo</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="text" id="f_tipo" name="f_tipo" class="form-control"  maxlength="45"   />
 </div> 
 </div> 
</div> 


    </form>
</div>