<div id="page-wrapper">
    <h2>base/clase/New record</h2>
    <form action="http://local.factufacil/base/clase/save" 
          id="formKerana" name="formKerana" method="POST" class="form-horizontal"
          accept-charset="utf-8">
                  <?php echo $kerana_token; ?>

        <header class="breadcrumb">
            <a href="http://local.factufacil/base/clase/index" 
               class="btn btn-warning">Cancel</a>
            <button type="submit" class="btn btn-success">Save</button>
        </header>

        <div class='form-group form-group-sm'> 
<label for='f_clase' class='col-sm-2 control-label'>Clase</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="text" id="f_clase" name="f_clase" class="form-control"  maxlength="45"   />
 </div> 
 </div> 
</div> 


    </form>
</div>