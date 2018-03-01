<?php

namespace application\modules\welcome\controller;

(!defined('__APPFOLDER__')) ? exit('No esta permitido el acceso directo a este archivo') : "";

/**
 * Description of index_c
 *
 * @author diemarc
 */
class WelcomeController extends \kerana\Kerana
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        \kerana\View::showView('welcome', 'welcome',false);
    }

}
