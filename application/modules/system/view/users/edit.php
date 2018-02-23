<div id="page-wrapper">
    <h4 class='text-primary'> 
        <i class="fa fa-user fa-2x"></i>
        <span class='text-muted'>system</span>Users->
        <span class="text-success">EditUser</span>-><?php echo $rs->username; ?>
    </h4>
    <form action="<?php echo __URL__."/system/user/update/$rs->id_user";?>" 
          id="formKerana" name="formKerana" method="POST" class="form-horizontal"
          accept-charset="utf-8">
              <?php echo $kerana_token; ?>

        <header class="breadcrumb">
            <a href="<?php echo __URL__."/system/user/index";?>" 
               class="btn btn-warning">Cancel</a>
            <button type="submit" class="btn btn-success">Save</button>
        </header>

        <div class='form-group form-group-sm'> 
            <label for='f_username' class='col-sm-2 control-label'>Username</label> 
            <div class='col-sm-4'> 
                <div class='input-group col-sm-4'> 
                    <input type="text" id="f_username" name="f_username" 
                           class="form-control"  maxlength="20" required value="<?php echo $rs->username; ?>"  />
                </div> 
            </div> 
        </div> 
        <div class='form-group form-group-sm'> 
            <label for='f_password' class='col-sm-2 control-label'>Password</label> 
            <div class='col-sm-6'> 
                <div class='input-group col-sm-4'> 
                    <input type="password" id="f_password" name="f_password" 
                           class="form-control"  maxlength="255" required value="<?php echo $rs->password; ?>"  />
                </div> 
            </div> 
        </div> 
        <div class='form-group form-group-sm'> 
            <label for='f_email' class='col-sm-2 control-label'>Email</label> 
            <div class='col-sm-6'> 
                <div class='input-group col-sm-8'> 
                    <input type="email" id="f_email" name="f_email" class="form-control" 
                           maxlength="200"  value="<?php echo $rs->email; ?>"  />
                </div> 
            </div> 
        </div> 
        <div class='form-group form-group-sm'> 
            <label for='f_name' class='col-sm-2 control-label'>Name</label> 
            <div class='col-sm-6'> 
                <div class='input-group col-sm-8'> 
                    <input type="text" id="f_name" name="f_name" 
                           class="form-control"  maxlength="150"  value="<?php echo $rs->name; ?>"  />
                </div> 
            </div> 
        </div> 
        <div class='form-group form-group-sm'> 
            <label for='f_lastname' class='col-sm-2 control-label'>Lastname</label> 
            <div class='col-sm-6'> 
                <div class='input-group col-sm-8'> 
                    <input type="text" id="f_lastname" name="f_lastname" 
                           class="form-control"  maxlength="150"  value="<?php echo $rs->lastname; ?>"  />
                </div> 
            </div> 
        </div> 
        <div class='form-group form-group-sm'> 
            <label for='f_sw_active' class='col-sm-2 control-label'>Is active?</label> 
            <div class='col-sm-6'> 
                <div class='input-group col-sm-8'> 
                    <input type="radio" id="f_sw_active_1" name="f_sw_active" 
                           class="radio_inline" value="1">Si 
                    <input type="radio" id="f_sw_active_0" name="f_sw_active"
                           class="radio_inline" value="0">No
                </div> 
            </div> 
        </div> 


    </form>
</div>