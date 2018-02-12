<?php

namespace application\modules\system\model;

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');
/*
  |-----------------------------------------------------------------------------
  | Class ModuleControllerModel
  |-----------------------------------------------------------------------------
  |
  | association model,controller and module
  | @author kerana,
  | @date 12-02-2018 06:37:33,
  |
 */

class ModuleControllerModel extends \kerana\Ada
{

    public
    /** @var int(11), id_model  */
            $id_model,
            /** @var int(11), id_controller  */
            $id_controller,
            /** @var int(11), id_module  */
            $id_module;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'sys_models_controllers';
        $this->table_id = 'id_model';
    }

    
    /**
     * -------------------------------------------------------------------------
     * Save the association between model,controller and module
     * -------------------------------------------------------------------------
     * @return type
     */
    public function createModelControllerModule()
    {

        return $this->insert([
                    'id_model' => $this->id_model,
                    'id_controller' => $this->id_controller,
                    'id_module' => $this->id_module
        ]);
    }

}
