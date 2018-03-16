<?php

namespace application\modules\base\controller;
defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');
/*
  |-----------------------------------------------------------------------------
  | Class ClaseController
  |-----------------------------------------------------------------------------
  |
  | Controller created automatically  from model
  | @author kerana,
  | @date 16-03-2018 06:20:18,
  |
 */

class ClaseController extends \kerana\Kerana implements \kerana\KeranaInterface {

    
    protected $_clase;

     public function __construct()
    {
        parent::__construct();
         $this->_clase= New \application\modules\base\model\ClaseModel();
        
    }

    /**
     * -------------------------------------------------------------------------
     * Show all 
     * -------------------------------------------------------------------------
     */
    public function index(){
        
        // only necesary for a view creator, remove it  after index files is
        // created
        \kerana\View::$model = $this->_clase;
        \kerana\View::showView($this->_current_module, 'clase/index', 
                ['rsClases' => $this->_clase->getAll()]);
    }
    
    /**
     * -------------------------------------------------------------------------
     * Add new
     * -------------------------------------------------------------------------
     */
    
    public function add(){
         \kerana\View::$model = $this->_clase;
        $params = [];
        \kerana\View::showForm($this->_current_module,'clase/add',$params,$this->_clase);
    }
    
     /**
     * -------------------------------------------------------------------------
     * Save new record
     * -------------------------------------------------------------------------
     */
    
    public function save(){
        ($this->_clase->savePost()) ? \helpers\Redirect::to('/base/clase/index') : '';
    }
    
    /**
     * -------------------------------------------------------------------------
     * Show one record detail
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function detail($id){
        
        $this->_clase->_setIdTableValue($id);
        $params['rsClase'] = $this->_clase->getRecord();
        \kerana\View::showView($this->_current_module,'clase/detail',$params);
        
    }
    
    /**
     * -------------------------------------------------------------------------
     * Edit one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function edit($id){
        $this->_clase->_setIdTableValue($id);
         \kerana\View::$model = $this->_clase;
        $params['rs'] = $this->_clase->getRecord();
        \kerana\View::showForm($this->_current_module,'clase/edit',$params);
    }
    
    /**
     * -------------------------------------------------------------------------
     * Update one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function update($id){
        $this->_clase->_setIdTableValue($id);
        ($this->_clase->savePost()) ? \helpers\Redirect::to('/base/clase/index') : '';
    }
    
    /**
     * -------------------------------------------------------------------------
     * Delete one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function delete($id){
        $this->_clase->_setIdTableValue($id);
        ($this->_clase->delete()) ? \helpers\Redirect::to('/base/clase/index') : '';
    }

}