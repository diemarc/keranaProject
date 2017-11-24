<div id="page-wrapper">
    <h2>comercial/New record</h2>
    <form action="http://local.keranaproject/comercial/empresa/save" 
          id="formKerana" name="formKerana" method="POST" class="form-horizontal"
          accept-charset="utf-8">
              <?php echo $kerana_token; ?>

        <header class="breadcrumb">
            <a href="http://local.keranaproject/comercial/empresa/index" 
               class="btn btn-warning">Cancel</a>
            <button type="submit" class="btn btn-success">Save</button>
        </header>

        <div class='form-group form-group-sm'> 
            <label for='f_razon_social' class='col-sm-2 control-label'>razon_social</label> 
            <div class='col-sm-6'> 
                <div class='input-group col-sm-8'> 
                    <input type="text" id="f_razon_social" name="f_razon_social" class="form-control" maxlength="45" required />
                </div> 
            </div> 
        </div> 
        <div class='form-group form-group-sm'> 
            <label for='f_nombre_comercial' class='col-sm-2 control-label'>nombre_comercial</label> 
            <div class='col-sm-6'> 
                <div class='input-group col-sm-8'> 
                    <input type="text" id="f_nombre_comercial" name="f_nombre_comercial" class="form-control" maxlength="45" required />
                </div> 
            </div> 
        </div> 
        <div class='form-group form-group-sm'> 
            <label for='f_telefono' class='col-sm-2 control-label'>telefono</label> 
            <div class='col-sm-6'> 
                <div class='input-group col-sm-8'> 
                    <input type="number" id="f_telefono" name="f_telefono" class="form-control" maxlength="9"  />
                </div> 
            </div> 
        </div> 
        <div class='form-group form-group-sm'> 
            <label for='f_email' class='col-sm-2 control-label'>email</label> 
            <div class='col-sm-6'> 
                <div class='input-group col-sm-8'> 
                    <input type="text" id="f_email" name="f_email" class="form-control" maxlength="100"  />
                </div> 
            </div> 
        </div> 
        <div class='form-group form-group-sm'> 
            <label for='f_observaciones' class='col-sm-2 control-label'>observaciones</label> 
            <div class='col-sm-6'> 
                <div class='input-group col-sm-8'> 
                    <textarea id="f_observaciones" name="f_observaciones" class="form-control"></textarea>
                </div> 
            </div> 
        </div> 


    </form>
</div>