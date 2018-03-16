<div id="page-wrapper">
    <h2>base/formapago/New record</h2>
    <form action="http://local.factufacil/base/formapago/save" 
          id="formKerana" name="formKerana" method="POST" class="form-horizontal"
          accept-charset="utf-8">
                  <?php echo $kerana_token; ?>

        <header class="breadcrumb">
            <a href="http://local.factufacil/base/formapago/index" 
               class="btn btn-warning">Cancel</a>
            <button type="submit" class="btn btn-success">Save</button>
        </header>

        <div class='form-group form-group-sm'> 
<label for='f_formapago' class='col-sm-2 control-label'>Formapago</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="text" id="f_formapago" name="f_formapago" class="form-control"  maxlength="150"   />
 </div> 
 </div> 
</div> 


    </form>
</div>