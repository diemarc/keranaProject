<div id="page-wrapper">

    <h4 class='text-primary'> 
        <i class="fa fa-compass fa-2x"></i>
        <span class='text-muted'>apps</span>Controllers
        <span class="text-success">AddController</span>
    </h4>
    <div class="panel panel-default">

        <div class="panel-body">
            <form action="<?php __URL__; ?>/system/controller/save" 
                  id="formKerana" name="formKerana" method="POST" class="form-horizontal"
                  accept-charset="utf-8">
                      <?php echo $kerana_token; ?>

                <header class="breadcrumb">
                    <a href="<?php echo __URL__; ?>/system/controller/index" 
                       class="btn btn-warning">Cancel</a>
                    <button type="submit" class="btn btn-success">Save</button>
                </header>
                <div class='form-group form-group-sm'> 
                    <label for='f_controller' class='col-sm-2 control-label'>ControllerName</label> 
                    <div class='col-sm-4'> 
                        <div class='input-group col-sm-4'> 
                            <input type="text" id="f_controller" name="f_controller" 
                                   class="form-control"  maxlength="20" required  />
                        </div> 
                    </div> 
                </div> 
                <div class='form-group form-group-sm'> 
                    <label for='sw_module' class='col-sm-2 control-label'>Module</label> 
                    <div class='col-sm-4'> 
                        <div class='input-group col-sm-4'> 
                            <select name="id_module" id="sw_module"
                                    class="form-control">
                                        <?php foreach ($rsModules AS $module): ?>
                                    <option value="<?php echo $module->id_module; ?>">
                                        <?php echo $module->module; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div> 
                    </div> 
                </div> 
                <div class='form-group form-group-sm'> 
                    <label for='sw_id_model' class='col-sm-2 control-label'>Associate to model</label> 
                    <div class='col-sm-4'> 
                        <div class='input-group col-sm-4'> 
                            <select name="sw_id_model" id="sw_id_model"
                                    class="form-control">
                                <option value="0">No associate</option>
                                <?php foreach ($rsModels AS $model): ?>
                                    <option value="<?php echo $model->id_model; ?>">
                                        <?php echo $model->model; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div> 
                    </div> 
                </div> 
                <div class='form-group form-group-sm'> 
                    <label for='f_controller_description' class='col-sm-2 control-label'>Desc</label> 
                    <div class='col-sm-4'> 
                        <div class='input-group col-sm-4'> 
                            <textarea name="f_controller_description" 

                                  id="f_controller_description"></textarea>
                        </div> 
                    </div> 
                </div> 
            </form>
        </div>
    </div>
</div>