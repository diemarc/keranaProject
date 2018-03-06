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
     * Set master query for module-model-controller
     * -------------------------------------------------------------------------
     */
    private function _setMQModuleControllerModel()
    {

        $this->_query = ' SELECT A.id_model,A.id_controller,A.id_module ,'
                . ' B.model,C.controller,D.module'
                . ' FROM ' . $this->table_name . ' A '
                . ' INNER JOIN sys_models B ON (A.id_model = B.id_model)'
                . ' INNER JOIN sys_controllers C ON (A.id_controller = C.id_controller)'
                . ' INNER JOIN sys_modules D ON (A.id_module = D.id_module)'
                . ' WHERE A.id_model IS NOT NULL '
                . '';
    }

    /**
     * -------------------------------------------------------------------------
     * Get controller module for a model
     * -------------------------------------------------------------------------
     * @return type
     */
    public function getControllerForModel()
    {
        $this->_setMQModuleControllerModel();
        return $this->find('*',['id_model' => $this->id_model],'all');
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

    
        /*
      |--------------------------------------------------------------------------
      | Setters
      |--------------------------------------------------------------------------
      |
     */
    
    /**
     * ------------------------------------------------------------------------- 
     * Setter for id_model
     * ------------------------------------------------------------------------- 
     * @param int $value the id_model value 
     */
    public function set_id_model($value = "")
    {
        $this->id_model = \helpers\Validator::valInt('id_model', $value, TRUE);
    }

    /**
     * ------------------------------------------------------------------------- 
     * Setter for id_controller
     * ------------------------------------------------------------------------- 
     * @param int $value the id_controller value 
     */
    public function set_id_controller($value = "")
    {
        $this->id_controller = \helpers\Validator::valInt('id_controller', $value, TRUE);
    }

    /**
     * ------------------------------------------------------------------------- 
     * Setter for id_module
     * ------------------------------------------------------------------------- 
     * @param int $value the id_module value 
     */
    public function set_id_module($value = "")
    {
        $this->id_module = \helpers\Validator::valInt('id_module', $value, TRUE);
    }

}
