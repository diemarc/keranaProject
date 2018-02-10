<div id="page-wrapper">
    <h2>system/New record</h2>
    <form action="http://local.keranaproject/system/action/save" 
          id="formKerana" name="formKerana" method="POST" class="form-horizontal"
          accept-charset="utf-8">
                  <?php echo $kerana_token; ?>

        <header class="breadcrumb">
            <a href="http://local.keranaproject/system/action/index" 
               class="btn btn-warning">Cancel</a>
            <button type="submit" class="btn btn-success">Save</button>
        </header>

        <div class='form-group form-group-sm'> 
<label for='f_action_name' class='col-sm-2 control-label'>Action_name</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="text" id="f_action_name" name="f_action_name" class="form-control"  maxlength="45" required  />
 </div> 
 </div> 
</div> 
<div class='form-group form-group-sm'> 
<label for='f_sw_system_action' class='col-sm-2 control-label'>Sw_system_action</label> 
<div class='col-sm-6'> 
 <div class='input-group col-sm-8'> 
<input type="radio" id="f_sw_system_action" name="f_sw_system_action" class="radio_inline" value="1">Yes <input type="radio" id="f_sw_system_action" name="f_sw_system_action" class="radio_inline" value="0">No
 </div> 
 </div> 
</div> 


    </form>
</div>