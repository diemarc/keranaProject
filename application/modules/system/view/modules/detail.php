<div id="page-wrapper">
    <h2><?php echo filter_var($rsModulo->module,FILTER_SANITIZE_STRING); ?></h2>
    <div class="col-sm-6">
        
        
    </div>
    <div class="col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <a href='/system/controller/nuevoController/<?php echo $rsModulo->id_module;?>' class='btn btn-default btn-xs'>
                    <i class='fa fa-plus'></i>
                </a>
                Controladores del modulo
            </div>
            <div class="panel-body">

            </div>
        </div>
    </div>
</div>