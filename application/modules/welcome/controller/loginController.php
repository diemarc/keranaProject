<?php

namespace application\modules\welcome\controller;

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');
/*
  |--------------------------------------------------------------------------
  | Class loginController
  |--------------------------------------------------------------------------
  |
 */

class LoginController  // minu\may
{

    private
    /** @var object, login model */
            $_login;

    public function __construct()
    {
        $this->_login = New \application\modules\system\model\LoginModel();
    }

    /**
     * -------------------------------------------------------------------------
     * Show the login form
     * -------------------------------------------------------------------------
     */
    public function introduceMySelf()
    {
        \kerana\View::showLoginPage();
    }

    /*
     * -------------------------------------------------------------------------
     * Process the login
     * -------------------------------------------------------------------------
     * 
     */

    public function go()
    {
        $this->_login->doLogin();
    }
    
    /**
     * -------------------------------------------------------------------------
     * Close a session
     * -------------------------------------------------------------------------
     */
    public function closeSession(){
        $this->_login->closeSession();
        \helpers\Redirect::to('/welcome/login/introduceMySelf');
    }

}
