<?php

namespace application\modules\base\controller;
defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');
/*
  |-----------------------------------------------------------------------------
  | Class TaxaController
  |-----------------------------------------------------------------------------
  |
  | Controller created automatically  from model
  | @author kerana,
  | @date 16-03-2018 06:12:46,
  |
 */

class TaxaController extends \kerana\Kerana implements \kerana\KeranaInterface {

    
    protected $_taxa;

     public function __construct()
    {
        parent::__construct();
         $this->_taxa= New \application\modules\base\model\TaxaModel();
        
    }

    /**
     * -------------------------------------------------------------------------
     * Show all 
     * -------------------------------------------------------------------------
     */
    public function index(){
        
        // only necesary for a view creator, remove it  after index files is
        // created
        \kerana\View::$model = $this->_taxa;
        \kerana\View::showView($this->_current_module, 'taxa/index', 
                ['rsTaxas' => $this->_taxa->getAll()]);
    }
    
    /**
     * -------------------------------------------------------------------------
     * Add new
     * -------------------------------------------------------------------------
     */
    
    public function add(){
         \kerana\View::$model = $this->_taxa;
        $params = [];
        \kerana\View::showForm($this->_current_module,'taxa/add',$params,$this->_taxa);
    }
    
     /**
     * -------------------------------------------------------------------------
     * Save new record
     * -------------------------------------------------------------------------
     */
    
    public function save(){
        ($this->_taxa->savePost()) ? \helpers\Redirect::to('/base/taxa/index') : '';
    }
    
    /**
     * -------------------------------------------------------------------------
     * Show one record detail
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function detail($id){
        
        $this->_taxa->_setIdTableValue($id);
        $params['rsTaxa'] = $this->_taxa->getRecord();
        \kerana\View::showView($this->_current_module,'taxa/detail',$params);
        
    }
    
    /**
     * -------------------------------------------------------------------------
     * Edit one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function edit($id){
        $this->_taxa->_setIdTableValue($id);
         \kerana\View::$model = $this->_taxa;
        $params['rs'] = $this->_taxa->getRecord();
        \kerana\View::showForm($this->_current_module,'taxa/edit',$params);
    }
    
    /**
     * -------------------------------------------------------------------------
     * Update one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function update($id){
        $this->_taxa->_setIdTableValue($id);
        ($this->_taxa->savePost()) ? \helpers\Redirect::to('/base/taxa/index') : '';
    }
    
    /**
     * -------------------------------------------------------------------------
     * Delete one record
     * -------------------------------------------------------------------------
     * @param int $id
     */
    
    public function delete($id){
        $this->_taxa->_setIdTableValue($id);
        ($this->_taxa->delete()) ? \helpers\Redirect::to('/base/taxa/index') : '';
    }

}