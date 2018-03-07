<div id="page-wrapper">
    <h4 class='text-primary'> 
        <i class="fa fa-users fa-2x"></i>
        <span class='text-muted'>system</span>UserGroups-><span class="text-success">AddGroup</span>
    </h4>
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="<?php echo __URL__.'/system/group/save';?>" 
                  id="formKerana" name="formKerana" method="POST" class="form-horizontal"
                  accept-charset="utf-8">
                      <?php echo $kerana_token; ?>

                <header class="breadcrumb">
                    <a href="<?php echo __URL__;?>/system/group/index" 
                       class="btn btn-warning">Cancel</a>
                    <button type="submit" class="btn btn-success">Save</button>
                </header>

                <div class='form-group form-group-sm'> 
                    <label for='f_group' class='col-sm-2 control-label'>Group</label> 
                    <div class='col-sm-6'> 
                        <div class='input-group col-sm-8'> 
                            <input type="text" id="f_group_name" name="f_group_name" class="form-control"  maxlength="45"   />
                        </div> 
                    </div> 
                </div> 


            </form>
        </div>
    </div>
</div>