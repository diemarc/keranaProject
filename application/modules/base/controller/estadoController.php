<?php

namespace application\modules\base\controller;
defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');
/*
  |-----------------------------------------------------------------------------
  | Class EstadoController
  |-----------------------------------------------------------------------------
  |
  | Controller created automatically  from model
  | @author kerana,
  | @date 09-03-2018 06:03:06,
  |
 */

class EstadoController extends \kerana\Kerana implements \kerana\KeranaInterface {

    
    protected $_estado;

     public function __construct()
    {
        parent::__construct();
         $this->_estado= New \application\modules\base\model\EstadoModel();
        
    }

    /**
     * -------------------------------------------------------------------------
     * Show all 
     * -------------------------------------------------------------------------
     */
    public function index(){
        
        // only necesary for a view creator, remove it  after index files is
        // created
        \kerana\View::$model = $this->_estado;
        \kerana\View::showView($this->_current_module, 'estado/index', 
                ['rsEstados' => $this->_estado->getAll()]);
    }
    
    /**
     * -------------------------------------------------------------------------
     * Add new
     * -------------------------------------------------------------------------
     */
    
    public function add(){
         \kerana\View::$model = $this->_estado;
        $params = [];
        \kerana\View::showForm($this->_current_module,'estado/add',$params,$this->_estado);
    }
    
     /**
     * -------------------------------------------------------------------------
     * Save new record
     * -------------------------------------------------------------------------
     */
    
    public function save(){
        ($this->_estado->savePost()) ? \helpers\Redirect::to('/base/estado/index') : '';
    }
    
    /**
     * -------------------------------------------------------------------------
     * Show one record detail
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function detail($id){
        
        $this->_estado->_setIdTableValue($id);
        $params['rsEstado'] = $this->_estado->getRecord();
        \kerana\View::showView($this->_current_module,'estado/detail',$params);
        
    }
    
    /**
     * -------------------------------------------------------------------------
     * Edit one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function edit($id){
        $this->_estado->_setIdTableValue($id);
         \kerana\View::$model = $this->_estado;
        $params['rs'] = $this->_estado->getRecord();
        \kerana\View::showForm($this->_current_module,'estado/edit',$params);
    }
    
    /**
     * -------------------------------------------------------------------------
     * Update one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function update($id){
        $this->_estado->_setIdTableValue($id);
        ($this->_estado->savePost()) ? \helpers\Redirect::to('/base/estado/index') : '';
    }
    
    /**
     * -------------------------------------------------------------------------
     * Delete one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function delete($id){
        $this->_estado->_setIdTableValue($id);
        ($this->_estado->delete()) ? \helpers\Redirect::to('/base/estado/index') : '';
    }

}