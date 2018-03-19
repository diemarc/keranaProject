<?php

namespace application\modules\base\controller;
defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');
/*
  |-----------------------------------------------------------------------------
  | Class FormapagoController
  |-----------------------------------------------------------------------------
  |
  | Controller created automatically  from model
  | @author kerana,
  | @date 16-03-2018 06:14:36,
  |
 */

class FormapagoController extends \kerana\Kerana implements \kerana\KeranaInterface {

    
    protected $_formapago;

     public function __construct()
    {
        parent::__construct();
         $this->_formapago= New \application\modules\base\model\FormaPagoModel();
        
    }

    /**
     * -------------------------------------------------------------------------
     * Show all 
     * -------------------------------------------------------------------------
     */
    public function index(){
        
        // only necesary for a view creator, remove it  after index files is
        // created
        \kerana\View::$model = $this->_formapago;
        \kerana\View::showView($this->_current_module, 'formapago/index', 
                ['rsFormapagos' => $this->_formapago->getAll()]);
    }
    
    /**
     * -------------------------------------------------------------------------
     * Add new
     * -------------------------------------------------------------------------
     */
    
    public function add(){
         \kerana\View::$model = $this->_formapago;
        $params = [];
        \kerana\View::showForm($this->_current_module,'formapago/add',$params,$this->_formapago);
    }
    
     /**
     * -------------------------------------------------------------------------
     * Save new record
     * -------------------------------------------------------------------------
     */
    
    public function save(){
        ($this->_formapago->savePost()) ? \helpers\Redirect::to('/base/formapago/index') : '';
    }
    
    /**
     * -------------------------------------------------------------------------
     * Show one record detail
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function detail($id){
        
        $this->_formapago->_setIdTableValue($id);
        $params['rsFormapago'] = $this->_formapago->getRecord();
        \kerana\View::showView($this->_current_module,'formapago/detail',$params);
        
    }
    
    /**
     * -------------------------------------------------------------------------
     * Edit one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function edit($id){
        $this->_formapago->_setIdTableValue($id);
         \kerana\View::$model = $this->_formapago;
        $params['rs'] = $this->_formapago->getRecord();
        \kerana\View::showForm($this->_current_module,'formapago/edit',$params);
    }
    
    /**
     * -------------------------------------------------------------------------
     * Update one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function update($id){
        $this->_formapago->_setIdTableValue($id);
        ($this->_formapago->savePost()) ? \helpers\Redirect::to('/base/formapago/index') : '';
    }
    
    /**
     * -------------------------------------------------------------------------
     * Delete one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function delete($id){
        $this->_formapago->_setIdTableValue($id);
        ($this->_formapago->delete()) ? \helpers\Redirect::to('/base/formapago/index') : '';
    }

}