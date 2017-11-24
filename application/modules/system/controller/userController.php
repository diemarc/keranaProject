<?php
namespace application\modules\system\controller;
(!defined('__APPFOLDER__')) ? exit('No esta permitido el acceso directo a este archivo') : '';

/*
  |--------------------------------------------------------------------------
  | CONTROLADOR PARA USUARIOS
  |--------------------------------------------------------------------------
  |
 */

class UserController extends \kerana\Kerana
{

    protected
    /** @var object , modelo de usuarios */
            $_user;

    public function __construct()
    {
        parent::__construct();
        $this->_user = new \application\modules\system\model\UserModel();
    }
    
    public function index(){
        
        
        $this->nuevo();
        
    }
    
    /**
     * -------------------------------------------------------------------------
     * Carga el formulario de nuevo usuario
     * -------------------------------------------------------------------------
     */
    public function nuevo(){
        

        $form_helper = new \helpers\KeranaForm($this->_user);
        
        
        
    }

}
