<?php
namespace Kerana;


(!defined('__APPFOLDER__')) ? exit('No esta permitido el acceso directo a este archivo') : "";

/*
  |--------------------------------------------------------------------------
  | ACL Helper
  |--------------------------------------------------------------------------
  |
  | Verifica que que cada peticion (modulo/controlador/metodo) este autorizado
  | por el usuario en sesion
  |
 */

class Acl
{

    private $_model_acl,
            $_auth,
            $_user_id;

    public function __construct()
    {
        $this->_auth = load::Helper('auth');
        $this->_model_acl = load::Model('sistema', 'permiso_usuario');
        Auth::checkAuthentication();
    }

    /**
     * -------------------------------------------------------------------------
     * Verifica si el usuario puede ejecutar el controlador que desea ejecutar
     * -------------------------------------------------------------------------
     * @param type $controller
     */
    public function checkUserRequestControllerAccess($controller)
    {
        if(!$this->_model_acl->selectUserPermissionRequest(Session::get('user_id'),$controller)){
            $descripcion = Session::get('user_name').
                    " , <strong>NO</strong> tienes permiso suficiente para ejecutar esta petici&oacute;n.";
            Exceptions::showError('Error de permiso de controlador', $descripcion);
        }
    }

}
