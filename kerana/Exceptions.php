<?php
/*
 * This file is part of keranaProject
 * Copyright (C) 2017-2018  diemarc  diemarc@protonmail.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace kerana;
use Exception;

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');

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
