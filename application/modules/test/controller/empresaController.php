<?php

namespace application\modules\test\controller;
defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');
/*
  |-----------------------------------------------------------------------------
  | Class EmpresaController
  |-----------------------------------------------------------------------------
  |
  | Controller created automatically  from model
  | @author kerana,
  | @date 27-02-2018 05:49:24,
  |
 */

class EmpresaController extends \kerana\Kerana implements \kerana\KeranaInterface {

    
    protected $_empresa;

     public function __construct()
    {
        parent::__construct();
         $this->_empresa= New \application\modules\test\model\EmpresaModel();
        
    }

    /**
     * -------------------------------------------------------------------------
     * Show all 
     * -------------------------------------------------------------------------
     */
    public function index(){
        
        // only necesary for a view creator, remove it  after index files is
        // created
        \kerana\View::$model = $this->_empresa;
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
        
        $this->_empresa->set_razon_social();
        $this->_empresa->set_nombre_comercial();
        $this->_empresa->set_telefono();
        $this->_empresa->set_email();
        $this->_empresa->set_observaciones();
        
        ($this->_empresa->insert()) ? \helpers\Redirect::to('/test/empresa/index') : '';
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
        ($this->_empresa->save()) ? \helpers\Redirect::to('/test/empresa/index') : '';
    }
    
    /**
     * -------------------------------------------------------------------------
     * Delete one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function delete($id){
        $this->_empresa->_setIdTableValue($id);
        ($this->_empresa->delete()) ? \helpers\Redirect::to('/test/empresa/index') : '';
    }

}