<div id="page-wrapper">
    <h2>base/subclase/New record</h2>
    <form action="http://local.factufacil/base/subclase/save" 
          id="formKerana" name="formKerana" method="POST" class="form-horizontal"
          accept-charset="utf-8">
                  <?php echo $kerana_token; ?>

        <header class="breadcrumb">
            <a href="http://local.factufacil/base/subclase/index" 
               class="btn btn-warning">Cancel</a>
            <button type="submit" class="btn btn-success">Save</button>
        </header>

        <div class='form-group form-group-sm'> 
<label for='f_id_clases' class='col-sm-2 control-label'>Id_clases</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<select class="form-control" name="f_id_clases" id="f_id_clases" required> 
 <option value="">--Select a option --</option><?php foreach($rsClases AS $clase): ?>  
  <option value="<?php echo $clase->id_clases;?>"> <?php echo $clase->clase; ?></option> 
<?php endforeach;?>  
</select> 

 </div> 
 </div> 
</div> 
<div class='form-group form-group-sm'> 
<label for='f_subclase' class='col-sm-2 control-label'>Subclase</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="text" id="f_subclase" name="f_subclase" class="form-control"  maxlength="45"   />
 </div> 
 </div> 
</div> 


    </form>
</div>