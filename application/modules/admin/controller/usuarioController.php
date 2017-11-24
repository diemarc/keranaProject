<?php

namespace application\modules\admin\controller;
defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');
/*
  |-----------------------------------------------------------------------------
  | Class UsuarioController
  |-----------------------------------------------------------------------------
  |
  | 
  | @author kerana,
  | @date 08-11-2017 07:43:59,
  |
 */

class UsuarioController extends \kerana\Kerana implements \kerana\KeranaInterface {

    
    protected $_usuario;

     public function __construct()
    {
        parent::__construct();
         $this->_usuario= New \application\modules\admin\model\UsuarioModel();
        
    }

    /**
     * -------------------------------------------------------------------------
     * Show all 
     * -------------------------------------------------------------------------
     */
    public function index(){
        
      
        \kerana\View::showView($this->_current_module, 'index', 
                ['rsUsuarios' => $this->_usuario->getAll()]);
    }
    
    /**
     * -------------------------------------------------------------------------
     * Add new
     * -------------------------------------------------------------------------
     */
    
    public function add(){
        
        $params = [];
        \kerana\View::showForm($this->_current_module,'add',$params,$this->_usuario);
    }
    
     /**
     * -------------------------------------------------------------------------
     * Save new record
     * -------------------------------------------------------------------------
     */
    
    public function save(){
        
        ($this->_usuario->save()) ? \helpers\Redirect::to('/admin/usuario/index') : '';
    }
    
    /**
     * -------------------------------------------------------------------------
     * Show one record detail
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function detail($id){
        
        $this->_usuario->_setIdTableValue($id);
        $params['rsUsuario'] = $this->_usuario->getRecord();
        \kerana\View::showView($this->_current_module,'detail',$params);
        
    }
    
    /**
     * -------------------------------------------------------------------------
     * Edit one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function edit($id){
        $this->_usuario->_setIdTableValue($id);
        $params['rsUsuario'] = $this->_usuario->getRecord();
        \kerana\View::showForm($this->_current_module,'detail',$params);
    }
    
    /**
     * -------------------------------------------------------------------------
     * Update one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function update($id){
        $this->_usuario->_setIdTableValue($id);
        ($this->_usuario->save()) ? \helpers\Redirect::to('/admin/usuario/index') : '';
    }
    
    /**
     * -------------------------------------------------------------------------
     * Delete one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function delete($id){
        $this->_usuario->_setIdTableValue($id);
        ($this->_usuario->delete()) ? \helpers\Redirect::to('/admin/usuario/index') : '';
    }

}