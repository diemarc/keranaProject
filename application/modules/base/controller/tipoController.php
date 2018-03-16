<?php

namespace application\modules\base\controller;
defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');
/*
  |-----------------------------------------------------------------------------
  | Class TipoController
  |-----------------------------------------------------------------------------
  |
  | Controller created automatically  from model
  | @author kerana,
  | @date 16-03-2018 06:28:16,
  |
 */

class TipoController extends \kerana\Kerana implements \kerana\KeranaInterface {

    
    protected $_tipo;

     public function __construct()
    {
        parent::__construct();
         $this->_tipo= New \application\modules\base\model\TipoModel();
        
    }

    /**
     * -------------------------------------------------------------------------
     * Show all 
     * -------------------------------------------------------------------------
     */
    public function index(){
        
        // only necesary for a view creator, remove it  after index files is
        // created
        \kerana\View::$model = $this->_tipo;
        \kerana\View::showView($this->_current_module, 'tipo/index', 
                ['rsTipos' => $this->_tipo->getAll()]);
    }
    
    /**
     * -------------------------------------------------------------------------
     * Add new
     * -------------------------------------------------------------------------
     */
    
    public function add(){
         \kerana\View::$model = $this->_tipo;
        $params = [];
        \kerana\View::showForm($this->_current_module,'tipo/add',$params,$this->_tipo);
    }
    
     /**
     * -------------------------------------------------------------------------
     * Save new record
     * -------------------------------------------------------------------------
     */
    
    public function save(){
        ($this->_tipo->savePost()) ? \helpers\Redirect::to('/base/tipo/index') : '';
    }
    
    /**
     * -------------------------------------------------------------------------
     * Show one record detail
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function detail($id){
        
        $this->_tipo->_setIdTableValue($id);
        $params['rsTipo'] = $this->_tipo->getRecord();
        \kerana\View::showView($this->_current_module,'tipo/detail',$params);
        
    }
    
    /**
     * -------------------------------------------------------------------------
     * Edit one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function edit($id){
        $this->_tipo->_setIdTableValue($id);
         \kerana\View::$model = $this->_tipo;
        $params['rs'] = $this->_tipo->getRecord();
        \kerana\View::showForm($this->_current_module,'tipo/edit',$params);
    }
    
    /**
     * -------------------------------------------------------------------------
     * Update one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function update($id){
        $this->_tipo->_setIdTableValue($id);
        ($this->_tipo->savePost()) ? \helpers\Redirect::to('/base/tipo/index') : '';
    }
    
    /**
     * -------------------------------------------------------------------------
     * Delete one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function delete($id){
        $this->_tipo->_setIdTableValue($id);
        ($this->_tipo->delete()) ? \helpers\Redirect::to('/base/tipo/index') : '';
    }

}