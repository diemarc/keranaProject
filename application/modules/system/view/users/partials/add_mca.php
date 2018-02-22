<script>

    /**
     * -------------------------------------------------------------------------
     * Assign rol to user form and submit form
     * -------------------------------------------------------------------------
     * @param {int} id_action
     * @param {int} id_controller
     * @param {int} id_module
     * @returns {avoid}
     */
    function assignRolToUser(id_action, id_controller, id_module) {

        $('#id_module').val(id_module);
        $('#id_controller').val(id_controller);
        $('#id_action').val(id_action);
        return submitAjaxForm();

    }

</script>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header bg-default">
            <span class='text-success'>
                <i class="fa fa-search fa-2x"></i>     
                <strong>AddMca <?php echo $id_user; ?></strong>
            </span>
            <button type="button" class="close" onclick="hideDiv('div_aux2')">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div id="res_up"></div>
            <form action="<?php echo __URL__ . "/system/userAction/save"; ?>" 
                  id="formKerana" name="formKerana" method="POST"
                  class="form-horizontal" accept-charset="utf-8">
                <input type='hidden' name='id_user' value='<?php echo $id_user; ?>'/>
                <input type='hidden' name='id_module' id="id_module" value=''/>
                <input type='hidden' name='id_controller' id="id_controller" value=''/>
                <input type='hidden' name='id_action' id="id_action" value=''/>
                <?php echo $kerana_token; ?>      
                <header class="breadcrumb">
                    <a href="javascript:hideDiv('div_aux2')" 
                       class="btn btn-warning">Cancel</a>
                    <button type="submit" class="btn btn-success">Save</button>
                </header>
                <div class='table-responsive'>
                    <table class="table table-bordered table-condensed 
                           table-hover table-striped">
                        <thead>
                            <tr class="bg-info">
                                <th>Module</th>
                                <th>Controller</th>
                                <th>Action</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="small" id="">
                            <?php
                            foreach ($rsActions AS $action):
                                $params_asign = $action->id_action . ',' . $action->id_controller . ',' . $action->id_module;
                                ?>
                                <tr>
                                    <td><?php echo $action->module; ?></td>
                                    <td><?php echo $action->controller; ?></td>
                                    <td><?php echo $action->action_name; ?></td>
                                    <td>
                                        <button class="btn btn-circle btn-success"
                                                type="button" onclick="assignRolToUser(<?php echo $params_asign; ?>)"
                                                >

                                            <i class="fa fa-check"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>