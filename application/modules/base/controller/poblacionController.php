<?php

namespace application\modules\base\controller;
defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');
/*
  |-----------------------------------------------------------------------------
  | Class PoblacionController
  |-----------------------------------------------------------------------------
  |
  | Controller created automatically  from model
  | @author kerana,
  | @date 09-03-2018 06:03:24,
  |
 */

class PoblacionController extends \kerana\Kerana implements \kerana\KeranaInterface {

    
    protected $_poblacion;

     public function __construct()
    {
        parent::__construct();
         $this->_poblacion= New \application\modules\base\model\PoblacionModel();
        
    }

    /**
     * -------------------------------------------------------------------------
     * Show all 
     * -------------------------------------------------------------------------
     */
    public function index(){
        
        // only necesary for a view creator, remove it  after index files is
        // created
        \kerana\View::$model = $this->_poblacion;
        \kerana\View::showView($this->_current_module, 'poblacion/index', 
                ['rsPoblacions' => $this->_poblacion->getAll()]);
    }
    
    /**
     * -------------------------------------------------------------------------
     * Add new
     * -------------------------------------------------------------------------
     */
    
    public function add(){
         \kerana\View::$model = $this->_poblacion;
        $params = [];
        \kerana\View::showForm($this->_current_module,'poblacion/add',$params,$this->_poblacion);
    }
    
     /**
     * -------------------------------------------------------------------------
     * Save new record
     * -------------------------------------------------------------------------
     */
    
    public function save(){
        ($this->_poblacion->savePost()) ? \helpers\Redirect::to('/base/poblacion/index') : '';
    }
    
    /**
     * -------------------------------------------------------------------------
     * Show one record detail
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function detail($id){
        
        $this->_poblacion->_setIdTableValue($id);
        $params['rsPoblacion'] = $this->_poblacion->getRecord();
        \kerana\View::showView($this->_current_module,'poblacion/detail',$params);
        
    }
    
    /**
     * -------------------------------------------------------------------------
     * Edit one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function edit($id){
        $this->_poblacion->_setIdTableValue($id);
         \kerana\View::$model = $this->_poblacion;
        $params['rs'] = $this->_poblacion->getRecord();
        \kerana\View::showForm($this->_current_module,'poblacion/edit',$params);
    }
    
    /**
     * -------------------------------------------------------------------------
     * Update one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function update($id){
        $this->_poblacion->_setIdTableValue($id);
        ($this->_poblacion->savePost()) ? \helpers\Redirect::to('/base/poblacion/index') : '';
    }
    
    /**
     * -------------------------------------------------------------------------
     * Delete one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function delete($id){
        $this->_poblacion->_setIdTableValue($id);
        ($this->_poblacion->delete()) ? \helpers\Redirect::to('/base/poblacion/index') : '';
    }

}