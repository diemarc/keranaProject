<?php

namespace application\modules\base\controller;
defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');
/*
  |-----------------------------------------------------------------------------
  | Class SubclaseController
  |-----------------------------------------------------------------------------
  |
  | Controller created automatically  from model
  | @author kerana,
  | @date 16-03-2018 06:21:31,
  |
 */

class SubclaseController extends \kerana\Kerana implements \kerana\KeranaInterface {

    
    protected $_subclase;

     public function __construct()
    {
        parent::__construct();
         $this->_subclase= New \application\modules\base\model\SubclaseModel();
        
    }

    /**
     * -------------------------------------------------------------------------
     * Show all 
     * -------------------------------------------------------------------------
     */
    public function index(){
        
        // only necesary for a view creator, remove it  after index files is
        // created
        \kerana\View::$model = $this->_subclase;
        \kerana\View::showView($this->_current_module, 'subclase/index', 
                ['rsSubclases' => $this->_subclase->getAll()]);
    }
    
    /**
     * -------------------------------------------------------------------------
     * Add new
     * -------------------------------------------------------------------------
     */
    
    public function add(){
         \kerana\View::$model = $this->_subclase;
        $params = [
 "rsClases"=> $this->_subclase->objClaseModel->getAll(), 
];
        \kerana\View::showForm($this->_current_module,'subclase/add',$params,$this->_subclase);
    }
    
     /**
     * -------------------------------------------------------------------------
     * Save new record
     * -------------------------------------------------------------------------
     */
    
    public function save(){
        ($this->_subclase->savePost()) ? \helpers\Redirect::to('/base/subclase/index') : '';
    }
    
    /**
     * -------------------------------------------------------------------------
     * Show one record detail
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function detail($id){
        
        $this->_subclase->_setIdTableValue($id);
        $params['rsSubclase'] = $this->_subclase->getRecord();
        \kerana\View::showView($this->_current_module,'subclase/detail',$params);
        
    }
    
    /**
     * -------------------------------------------------------------------------
     * Edit one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function edit($id){
        $this->_subclase->_setIdTableValue($id);
         \kerana\View::$model = $this->_subclase;
        $params['rs'] = $this->_subclase->getRecord();
        \kerana\View::showForm($this->_current_module,'subclase/edit',$params);
    }
    
    /**
     * -------------------------------------------------------------------------
     * Update one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function update($id){
        $this->_subclase->_setIdTableValue($id);
        ($this->_subclase->savePost()) ? \helpers\Redirect::to('/base/subclase/index') : '';
    }
    
    /**
     * -------------------------------------------------------------------------
     * Delete one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function delete($id){
        $this->_subclase->_setIdTableValue($id);
        ($this->_subclase->delete()) ? \helpers\Redirect::to('/base/subclase/index') : '';
    }

}