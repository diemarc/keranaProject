<div id="page-wrapper">
    <h2>base/taxa/New record</h2>
    <form action="http://local.factufacil/base/taxa/save" 
          id="formKerana" name="formKerana" method="POST" class="form-horizontal"
          accept-charset="utf-8">
                  <?php echo $kerana_token; ?>

        <header class="breadcrumb">
            <a href="http://local.factufacil/base/taxa/index" 
               class="btn btn-warning">Cancel</a>
            <button type="submit" class="btn btn-success">Save</button>
        </header>

        <div class='form-group form-group-sm'> 
<label for='f_tasa' class='col-sm-2 control-label'>Tasa</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="text" id="f_tasa" name="f_tasa" class="form-control"  maxlength="45"   />
 </div> 
 </div> 
</div> 
<div class='form-group form-group-sm'> 
<label for='f_porcentaje' class='col-sm-2 control-label'>Porcentaje</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="number" step="0.01" id="f_porcentaje" name="f_porcentaje" class="form-control"  maxlength="10,2" required  />
 </div> 
 </div> 
</div> 


    </form>
</div>