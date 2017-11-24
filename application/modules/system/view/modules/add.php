<div id="page-wrapper">

    <h2> New module</h2>
    <form action="<?php echo __URL__;?>/system/module/save" id="formKerana" name="formKerana" method="POST" class="form-horizontal"
          accept-charset="utf-8">
        <?php echo $kerana_token;?>

        <div class="form-group">
            <label for="f_module">Module</label>
            <input type="text" class="form-control" id="f_module" 
                   name="f_module" placeholder="nombre del modulo">
        </div>
        <div class="form-group">
            <label for="f_sw_restricted">Access type</label>
            <select name="f_sw_restricted" id="f_sw_restricted">
                <option value='0'>Public</option>
                <option value='1'>Only for authorized users</option>
            </select>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>

</div>