<?php

namespace application\modules\base\controller;
defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');
/*
  |-----------------------------------------------------------------------------
  | Class ContratanteController
  |-----------------------------------------------------------------------------
  |
  | Controller created automatically  from model
  | @author kerana,
  | @date 09-03-2018 06:15:46,
  |
 */

class ContratanteController extends \kerana\Kerana implements \kerana\KeranaInterface {

    
    protected $_contratante;

     public function __construct()
    {
        parent::__construct();
         $this->_contratante= New \application\modules\base\model\ContratanteModel();
        
    }

    /**
     * -------------------------------------------------------------------------
     * Show all 
     * -------------------------------------------------------------------------
     */
    public function index(){
        
        // only necesary for a view creator, remove it  after index files is
        // created
        \kerana\View::$model = $this->_contratante;
        \kerana\View::showView($this->_current_module, 'contratante/index', 
                ['rsContratantes' => $this->_contratante->getAll()]);
    }
    
    /**
     * -------------------------------------------------------------------------
     * Add new
     * -------------------------------------------------------------------------
     */
    
    public function add(){
         \kerana\View::$model = $this->_contratante;
        $params = [
 "rsPoblacions"=> $this->_contratante->objPoblacionModel->getAll(), 

 "rsEstados"=> $this->_contratante->objEstadoModel->getAll(), 
];
        \kerana\View::showForm($this->_current_module,'contratante/add',$params,$this->_contratante);
    }
    
     /**
     * -------------------------------------------------------------------------
     * Save new record
     * -------------------------------------------------------------------------
     */
    
    public function save(){
        ($this->_contratante->savePost()) ? \helpers\Redirect::to('/base/contratante/index') : '';
    }
    
    /**
     * -------------------------------------------------------------------------
     * Show one record detail
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function detail($id){
        
        $this->_contratante->_setIdTableValue($id);
        $params['rsContratante'] = $this->_contratante->getRecord();
        \kerana\View::showView($this->_current_module,'contratante/detail',$params);
        
    }
    
    /**
     * -------------------------------------------------------------------------
     * Edit one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function edit($id){
        $this->_contratante->_setIdTableValue($id);
         \kerana\View::$model = $this->_contratante;
        $params['rs'] = $this->_contratante->getRecord();
        \kerana\View::showForm($this->_current_module,'contratante/edit',$params);
    }
    
    /**
     * -------------------------------------------------------------------------
     * Update one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function update($id){
        $this->_contratante->_setIdTableValue($id);
        ($this->_contratante->savePost()) ? \helpers\Redirect::to('/base/contratante/index') : '';
    }
    
    /**
     * -------------------------------------------------------------------------
     * Delete one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function delete($id){
        $this->_contratante->_setIdTableValue($id);
        ($this->_contratante->delete()) ? \helpers\Redirect::to('/base/contratante/index') : '';
    }

}