<?php
namespace kerana;
use Exception;

class Exceptions extends Exception {

    /**
     * -------------------------------------------------------------------------
     * Show a error page
     * -------------------------------------------------------------------------
     * @param type $titulo
     * @param type $descripcion
     */
    static function showError($titulo , $descripcion) {

        include __DOCUMENTROOT__. '/../templates/error/error_page.php';
        die();
    }

    
    /**
     * -------------------------------------------------------------------------
     * Show a exception page
     * -------------------------------------------------------------------------
     * @param type $title
     * @param type $exception
     * @param type $query
     * @param type $binds
     */
    static function ShowException($title,$exception,$query = '',$binds = ''){
        include __DOCUMENTROOT__. '/../templates/error/exception_page.php';
        die();
    }
}
