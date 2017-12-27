<div id="page-wrapper">

    <h4 class='text-primary'> 
        <i class="fa fa-list-alt fa-2x"></i>
        <span class='text-muted'>apps</span>Modules->
        <span class="text-success">AddModule</span>
    </h4>
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="<?php echo __URL__; ?>/system/module/save" 
                  id="formKerana" name="formKerana" method="POST" class="form-horizontal"
                  accept-charset="utf-8">
                      <?php echo $kerana_token; ?>

                <header class="breadcrumb">
                    <a href="<?php echo __URL__; ?>/system/module/index" 
                       class="btn btn-warning">Cancel</a>
                    <button type="submit" class="btn btn-success">Save</button>
                </header>

                <div class='form-group form-group-sm'> 
                    <label for='f_module' class='col-sm-2 control-label'>ModuleName</label> 
                    <div class='col-sm-4'> 
                        <div class='input-group col-sm-4'> 
                            <input type="text" id="f_module" name="f_module" 
                                   class="form-control"  maxlength="20" required  />
                        </div> 
                    </div> 
                </div> 
                <div class='form-group form-group-sm'> 
                    <label for='f_sw_restricted' class='col-sm-2 control-label'>AccessType</label> 
                    <div class='col-sm-4'> 
                        <div class='input-group col-sm-4'> 
                            <select name="f_sw_restricted" class="form-control" 
                                    id="f_sw_restricted">
                                <option value='0'>Public</option>
                                <option value='1'>Restricted</option>
                            </select>
                        </div> 
                    </div> 
                </div> 
            </form>
        </div>
    </div>
</div>