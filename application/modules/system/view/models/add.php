<div id="page-wrapper">
    <h4 class='text-primary'> 
        <i class="fa fa-database fa-2x"></i>
        <span class='text-muted'>apps</span>Models->
        <span class="text-success">AddModel</span>
    </h4>
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="<?php __URL__; ?>/system/model/save" 
                  id="formKerana" name="formKerana" method="POST" class="form-horizontal"
                  accept-charset="utf-8">
                      <?php echo $kerana_token; ?>

                <header class="breadcrumb">
                    <a href="<?php echo __URL__; ?>/system/model/index" 
                       class="btn btn-warning">Cancel</a>
                    <button type="submit" class="btn btn-success">Save</button>
                </header>

                <div class='form-group form-group-sm'> 
                    <label for='f_model' class='col-sm-2 control-label'>ModelName</label> 
                    <div class='col-sm-4'> 
                        <div class='input-group col-sm-4'> 
                            <input type="text" id="f_model" name="f_model" 
                                   class="form-control"  maxlength="20" required  />
                        </div> 
                    </div> 
                </div> 
                <div class='form-group form-group-sm'> 
                    <label for='f_table_reference' class='col-sm-2 control-label'>TableReference</label> 
                    <div class='col-sm-4'> 
                        <div class='input-group col-sm-4'> 
                            <select name="f_table_reference" id="f_table_reference"
                                    class="form-control">
                                <option value=''>None</option>
                                <?php foreach ($rsTables AS $table): ?>

                                    <option value="<?php echo $table->table_name; ?>"><?php echo $table->table_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div> 
                    </div> 
                </div>
                <div class='form-group form-group-sm'> 
                    <label for='f_sw_controller' class='col-sm-2 control-label'>Need controller?</label> 
                    <div class='col-sm-6'> 
                        <div class='input-group col-sm-8'> 
                            <input type="radio" id="f_sw_controller" name="f_sw_controller" 
                                   class="radio_inline" value="1">Yes 
                            <input type="radio" id="f_sw_controller" name="f_sw_controller" 
                                   class="radio_inline" value="0">No
                        </div> 
                    </div> 
                </div> 
                <div class='form-group form-group-sm'> 
                    <label for='f_id_module' class='col-sm-2 control-label'>Module</label> 
                    <div class='col-sm-4'> 
                        <div class='input-group col-sm-4'> 
                            <select name="f_id_module" id="f_id_module"
                                    class="form-control">
                                        <?php foreach ($rsModules AS $module): ?>

                                    <option value="<?php echo $module->id_module; ?>"><?php echo $module->module; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div> 
                    </div> 
                </div> 
                <div class='form-group form-group-sm'> 
                    <label for='f_model_description' class='col-sm-2 control-label'>Desc</label> 
                    <div class='col-sm-4'> 
                        <textarea name="f_model_description" id="f_model_description"></textarea> 
                    </div> 
                </div> 
            </form>
        </div>
    </div>
</div>