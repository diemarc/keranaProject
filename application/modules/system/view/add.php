<div id="page-wrapper">
    <h2>system/New record</h2>
        <form action="http://local.keranaproject/system/user/save" 
              id="formKerana" name="formKerana" method="POST" class="form-horizontal"
              accept-charset="utf-8">
                  <?php echo $kerana_token; ?>

            <header class="breadcrumb">
                <a href="http://local.keranaproject/system/user/index" 
                   class="btn btn-warning">Cancel</a>
                <button type="submit" class="btn btn-success">Save</button>
            </header>

            <div class='form-group form-group-sm'> 
<label for='f_username' class='col-sm-2 control-label'>username</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="text" id="f_username" name="f_username" class="form-control" maxlength="20" required />
 </div> 
 </div> 
</div> 
<div class='form-group form-group-sm'> 
<label for='f_password' class='col-sm-2 control-label'>password</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="text" id="f_password" name="f_password" class="form-control" maxlength="255" required />
 </div> 
 </div> 
</div> 
<div class='form-group form-group-sm'> 
<label for='f_salt' class='col-sm-2 control-label'>salt</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="text" id="f_salt" name="f_salt" class="form-control" maxlength="32" required />
 </div> 
 </div> 
</div> 
<div class='form-group form-group-sm'> 
<label for='f_email' class='col-sm-2 control-label'>email</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="text" id="f_email" name="f_email" class="form-control" maxlength="200"  />
 </div> 
 </div> 
</div> 
<div class='form-group form-group-sm'> 
<label for='f_nombres' class='col-sm-2 control-label'>nombres</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="text" id="f_nombres" name="f_nombres" class="form-control" maxlength="150"  />
 </div> 
 </div> 
</div> 
<div class='form-group form-group-sm'> 
<label for='f_apellidos' class='col-sm-2 control-label'>apellidos</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="text" id="f_apellidos" name="f_apellidos" class="form-control" maxlength="150"  />
 </div> 
 </div> 
</div> 
<div class='form-group form-group-sm'> 
<label for='f_sw_activo' class='col-sm-2 control-label'>sw_activo</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 

 </div> 
 </div> 
</div> 


        </form>
</div>