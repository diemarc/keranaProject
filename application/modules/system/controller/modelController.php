<?php

namespace application\modules\system\controller;

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');

/**
 * -----------------------------------------------------------------------------
 * ModelController
 * ------------------------------------------------------------------------------
 * @author diemarc
 */
class ModelController extends moduleController implements \kerana\KeranaInterface
{

    protected
    /** @object , model object of table models */
            $_model;

    public function __construct()
    {
        parent::__construct();
        $this->_model = new \application\modules\system\model\DataModel();
    }

    /**
     * -------------------------------------------------------------------------
     * Show all models
     * -------------------------------------------------------------------------
     */
    public function index()
    {
        $params['rsModelos'] = $this->_model->getAllModel();
        \kerana\View::showView($this->_current_module, 'models/index',$params);
    }

    /**
     * -------------------------------------------------------------------------
     * Load new model form
     * -------------------------------------------------------------------------
     */
    public function add()
    {
        $params = [
            'rsTables' => $this->_model->getTablesDB(),
            'rsModules' => $this->_module->getAll()
        ];
        
        \kerana\View::showForm($this->_current_module, 'models/add', $params);
    }

    /**
     * -------------------------------------------------------------------------
     * Save a model
     * -------------------------------------------------------------------------
     */
    public function save()
    {
        ($this->_model->createModel())?\helpers\Redirect::to('/system/model/index'):'';
    }

    /**
     * -------------------------------------------------------------------------
     * Show a model detail
     * -------------------------------------------------------------------------
     * @param int $id
     */
    public function detail($id)
    {

        $this->_model->_setIdTableValue($id);
        $params['rsModel'] = $this->_model->getRecord();
        \kerana\View::showView($this->_current_module, 'models/detail', $params);
    }

    /**
     * -------------------------------------------------------------------------
     * Show a edit form for a model
     * -------------------------------------------------------------------------
     * @param type $id
     */
    public function edit($id){
        
        $this->_model->_setIdTableValue($id);
        $params['rsModel'] = $this->_model->getRecord();
        \kerana\View::showView($this->_current_module, 'models/edit', $params);
        
    }
    /**
     * -------------------------------------------------------------------------
     * Update a model
     * -------------------------------------------------------------------------
     * @param int $id
     */
    public function update($id)
    {
        $this->_model->_setIdTableValue($id);
        ($this->_model->save()) ? \helpers\Redirect::to('/system/model/index') : '';
        
    }
    /**
     * -------------------------------------------------------------------------
     * Delete a model
     * -------------------------------------------------------------------------
     * @param int $id
     */
    public function delete($id)
    {
        $this->_model->_setIdTableValue($id);
        ($this->_model->delete()) ? \helpers\Redirect::to('/system/model/index') : '';
        
    }
    

}
