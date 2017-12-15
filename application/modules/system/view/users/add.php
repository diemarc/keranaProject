<div id="page-wrapper">
    <h4 class='text-primary'> 
        <i class="fa fa-users fa-2x"></i>
        <span class='text-muted'>system</span>Users-><span class="text-success">AddUser</span>
    </h4>
    <form action="http://local.keranaproject/system/user/save" 
          id="formKerana" name="formKerana" method="POST" class="form-horizontal"
          accept-charset="utf-8">
              <?php echo $kerana_token; ?>

        <header class="breadcrumb">
            <button type="submit" class="btn btn-success">Save</button>
            <a href="http://local.keranaproject/system/user/index" 
               class="btn btn-warning">Cancel</a>
        </header>

        <div class='form-group form-group-sm'> 
            <label for='f_username' class='col-sm-2 control-label'>Username</label> 
            <div class='col-sm-6'> 
                <div class='input-group col-sm-8'> 
                    <input type="text" id="f_username" name="f_username" 
                           class="form-control"  maxlength="20" required  />
                </div> 
            </div> 
        </div> 
        <div class='form-group form-group-sm'> 
            <label for='f_password' class='col-sm-2 control-label'>Password</label> 
            <div class='col-sm-6'> 
                <div class='input-group col-sm-8'> 
                    <input type="password" id="f_password" name="f_password" 
                           class="form-control"  maxlength="255" required  />
                </div> 
            </div> 
        </div> 
        <div class='form-group form-group-sm'> 
            <label for='f_email' class='col-sm-2 control-label'>Email</label> 
            <div class='col-sm-6'> 
                <div class='input-group col-sm-8'> 
                    <input type="email" id="f_email" name="f_email" class="form-control"  
                           maxlength="200"   />
                </div> 
            </div> 
        </div> 
        <div class='form-group form-group-sm'> 
            <label for='f_nombres' class='col-sm-2 control-label'>Name</label> 
            <div class='col-sm-6'> 
                <div class='input-group col-sm-8'> 
                    <input type="text" id="f_nombres" name="f_nombres" 
                           class="form-control"  maxlength="150"   />
                </div> 
            </div> 
        </div> 
        <div class='form-group form-group-sm'> 
            <label for='f_apellidos' class='col-sm-2 control-label'>Lastname</label> 
            <div class='col-sm-6'> 
                <div class='input-group col-sm-8'> 
                    <input type="text" id="f_apellidos" name="f_apellidos" 
                           class="form-control"  maxlength="150"   />
                </div> 
            </div> 
        </div> 
        <div class='form-group form-group-sm'> 
            <label for='f_sw_activo' class='col-sm-2 control-label'>Is active?</label> 
            <div class='col-sm-6'> 
                <div class='input-group col-sm-8'> 
                    <input type="radio" id="f_sw_activo" name="f_sw_activo" 
                           class="radio_inline" value="1">Si 
                    <input type="radio" id="f_sw_activo" name="f_sw_activo" 
                           class="radio_inline" value="0">No
                </div> 
            </div> 
        </div> 
    </form>
</div>