<?php

namespace application\modules\system\controller;

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');

/**
 * -----------------------------------------------------------------------------
 * systemController
 * ------------------------------------------------------------------------------
 * @author , all inherit controllers only will be executed if 'development' 
 * ENVIRONMENT is setted in index file. 
 */
class SystemController extends \kerana\Kerana
{

    public function __construct()
    {
        parent::__construct();

        if (__ENVIRONMENT__ != 'development') {
            http_response_code(403);
            die('Forbbiden');
        }
    }

}
