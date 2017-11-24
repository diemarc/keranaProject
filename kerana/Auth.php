<?php

namespace kerana;

(!defined('__APPFOLDER__')) ? exit('No esta permitido el acceso directo a este archivo') : "";

/*
  |--------------------------------------------------------------------------
  | AUTH CLASS
  |--------------------------------------------------------------------------
  |
  | Controla las autentificaciones del usuario
  |
 */

class Auth
{

    public $ka_session;

    /**
     * -------------------------------------------------------------------------
     * Comprueba que el usuario este logado
     * -------------------------------------------------------------------------
     */
    public static function checkAuthentication()
    {
        // iniciliazamos las sesiones
        $ka_session = New \kerana\SessionHandler();
        $ka_session->startSession();
        
        // cargamos el modelo de login
        $login = New \application\modules\system\model\LoginModel();

        // comprobamos si existe un login valido
        if ($login->checkAccessUser() == false) {
            
            $ka_session->cleanSession();
            \helpers\Redirect::to('/welcome/login/introduceMySelf');
            exit();
        }
    }
    
    
    
    

}
