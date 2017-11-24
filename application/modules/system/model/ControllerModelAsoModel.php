<?php

namespace application\modules\system\model;

/**
 * -----------------------------------------------------------------------------
 * ControllerModelAsoModel
 * ------------------------------------------------------------------------------
 * @author diemarc
 */
class ControllerModelAsoModel extends \kerana\Ada
{

    public
    /** @var int */
            $id_model,
            /** @var int */
            $id_module,
            /** @var int */
            $id_controller;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'sys_controller_model';
    }

    /**
     * -------------------------------------------------------------------------
     * Save link table controller,model,module
     * -------------------------------------------------------------------------
     * @return boolean
     */
    public function saveControllerModel()
    {

        $data = [
            'id_model' => $this->id_model,
            'id_module' => $this->id_module,
            'id_controller' => $this->id_controller
        ];

        return $this->insert($data);
    }

}
