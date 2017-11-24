<?php

namespace application\modules\system\model;

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');

/*
  |-----------------------------------------------------------------------------
  | Module Model class
  |-----------------------------------------------------------------------------
  |
 */

class ModuleModel extends \Kerana\Ada
{

    private
    /** @var mixed, new module name */
            $_module_name,
            /** @var mixed, path where module will be create */
            $_module_path;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'sys_module';
        $this->table_id = 'id_module';
    }

    /**
     * -------------------------------------------------------------------------
     * Set the path and module name
     * -------------------------------------------------------------------------
     */
    private function _setPathAndModuleName()
    {
        $this->_module_name = filter_input(INPUT_POST, 'f_module', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->_module_path = __MODULEFOLDER__ . '/' . $this->_module_name;
    }

    /**
     * -------------------------------------------------------------------------
     * Create a new module
     * -------------------------------------------------------------------------
     */
    public function create()
    {

        $this->_setPathAndModuleName();

        // first at all, will check if not existe another module with the same name
        $rsFindModulo = $this->find('module', ['module' => $this->_module_name]
                , 'one');

        // if dont exists, then create a new module
        if (!$rsFindModulo) {

            // inserto to a database table
            $this->insert();

            // create a fodler module
            $this->_createModuleFolder();

            return true;
        } else {
            \kerana\Exceptions::showError('Creator', 'Module already exists');
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Make the module structura folder
     * -------------------------------------------------------------------------
     */
    protected function _createModuleFolder()
    {

        // first create a module folder in application/module path
        if (mkdir($this->_module_path, 0777, true)) {
            // controllers folder
            mkdir($this->_module_path . '/controller', 0777, true);
            // models folder
            mkdir($this->_module_path . '/model', 0777, true);

            // view folder
            mkdir($this->_module_path . '/view', 0777, true);
            // create a view files
//            fopen($this->_module_path . '/view/index.php', 'w');
//            fopen($this->_module_path . '/view/add.php', 'w');
//            fopen($this->_module_path . '/view/detail.php', 'w');
//            fopen($this->_module_path . '/view/edit.php', 'w');
        }
    }

}
