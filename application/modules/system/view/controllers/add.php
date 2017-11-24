<div id="page-wrapper">

    <h2> New controller</h2>
    <form action="<?php __URL__; ?>/system/controller/save" 
          id="formKerana" name="formKerana" method="POST" class="form-horizontal"
          accept-charset="utf-8">
              <?php echo  $kerana_token; ?>

        <div class="form-group">
            <label for="f_controller">Controller</label>
            <input type="text" class="form-control" id="f_module" 
                   name="f_controller" placeholder="name of controller">
        </div>
        <div class="form-group">
            <label for="sw_module">Module</label>
            <select name="sw_module" id="sw_module">
                <?php foreach ($rsModules AS $module):?>
                <option value="<?php echo $module->module;?>">
                    <?php echo $module->module;?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <label for="sw_id_model">CRUD for model?</label>
            <select name="sw_id_model" id="sw_id_model">
                <option value="0">No crud system</option>
                <?php foreach ($rsModels AS $model):?>
                <option value="<?php echo $model->id_model;?>">
                    <?php echo $model->model;?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <label for="f_controller_description">Desc</label>
            <textarea name="f_controller_description" id="f_controller_description"></textarea> 


        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>

</div>