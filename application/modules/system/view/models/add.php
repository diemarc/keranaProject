<div id="page-wrapper">

    <h2> New model</h2>
    <form action="<?php __URL__; ?>/system/model/save" 
          id="formKerana" name="formKerana" method="POST" class="form-horizontal"
          accept-charset="utf-8">
              <?php echo $kerana_token; ?>

        <div class="form-group">
            <label for="f_model">Model name</label>
            <input type="text" class="form-control" id="f_model" 
                   name="f_model" placeholder="model name">
        </div>
        <div class="form-group">
            <label for="f_table_reference">Table referenced</label>
            <select name="f_table_reference" id="f_table_reference">
                <option value=''>None</option>
                <?php foreach ($rsTables AS $table): ?>

                    <option value="<?php echo $table->table_name; ?>"><?php echo $table->table_name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="f_id_module">Module</label>
            <select name="f_id_module" id="f_id_module">
                <?php foreach ($rsModules AS $module): ?>

                    <option value="<?php echo $module->id_module; ?>"><?php echo $module->module; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="f_model_description">Desc</label>
            <textarea name="f_model_description" id="f_model_description"></textarea> 


        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>

</div>