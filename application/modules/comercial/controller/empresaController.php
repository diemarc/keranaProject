<?php

namespace application\modules\comercial\controller;
defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');
/*
  |-----------------------------------------------------------------------------
  | Class EmpresaController
  |-----------------------------------------------------------------------------
  |
  | 
  | @author kerana,
  | @date 08-11-2017 09:41:40,
  |
 */

class EmpresaController extends \kerana\Kerana implements \kerana\KeranaInterface {

    
    protected $_empresa;

     public function __construct()
    {
        parent::__construct();
         $this->_empresa= New \application\modules\comercial\model\EmpresaModel();
        
    }

    /**
     * -------------------------------------------------------------------------
     * Show all 
     * -------------------------------------------------------------------------
     */
    public function index(){
        
        \kerana\View::showView($this->_current_module, 'index', 
                ['rsEmpresas' => $this->_empresa->getAll()]);
    }
    
    /**
     * -------------------------------------------------------------------------
     * Add new
     * -------------------------------------------------------------------------
     */
    
    public function add(){
        
        $params = [];
        \kerana\View::showForm($this->_current_module,'add',$params,$this->_empresa);
    }
    
     /**
     * -------------------------------------------------------------------------
     * Save new record
     * -------------------------------------------------------------------------
     */
    
    public function save(){
        ($this->_empresa->save()) ? \helpers\Redirect::to('/comercial/empresa/index') : '';
    }
    
    /**
     * -------------------------------------------------------------------------
     * Show one record detail
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function detail($id){
        
        $this->_empresa->_setIdTableValue($id);
        $params['rsEmpresa'] = $this->_empresa->getRecord();
        \kerana\View::showView($this->_current_module,'detail',$params);
        
    }
    
    /**
     * -------------------------------------------------------------------------
     * Edit one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function edit($id){
        $this->_empresa->_setIdTableValue($id);
        $params['rsEmpresa'] = $this->_empresa->getRecord();
        \kerana\View::showForm($this->_current_module,'detail',$params);
    }
    
    /**
     * -------------------------------------------------------------------------
     * Update one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function update($id){
        $this->_empresa->_setIdTableValue($id);
        ($this->_empresa->save()) ? \helpers\Redirect::to('/comercial/empresa/index') : '';
    }
    
    /**
     * -------------------------------------------------------------------------
     * Delete one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function delete($id){
        $this->_empresa->_setIdTableValue($id);
        ($this->_empresa->delete()) ? \helpers\Redirect::to('/comercial/empresa/index') : '';
    }

}