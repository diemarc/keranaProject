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

/**
 * -----------------------------------------------------------------------------
 * is KeranaCli?
 * -----------------------------------------------------------------------------
 */
if (PHP_SAPI == 'cli') {
    define('__ISCLI__', 1);
    // cli is true
    define('__DOCUMENTROOT__', substr(str_replace(pathinfo(__FILE__, PATHINFO_BASENAME), '', __FILE__), 0, -1));
} else {
    // is http petition
    define('__DOCUMENTROOT__', filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '');
}


/**
 * -----------------------------------------------------------------------------
 * SITE URL
 * -----------------------------------------------------------------------------
 */
define('__URL__', 'http://' . filter_input(INPUT_SERVER, 'HTTP_HOST') . '');

/**
 * -----------------------------------------------------------------------------
 * kERANA pROJECT NAME
 * -----------------------------------------------------------------------------
 */
define('__APPNAME__', 'fac2Fast');
/*
 * ---------------------------------------------------------------
 * CORE SYSTEM DIRECTORY
 * ---------------------------------------------------------------
 */
define('__COREFOLDER__', __DOCUMENTROOT__ . '/../kerana/');


/*
 * ---------------------------------------------------------------
 * APPLICATION FOLDER
 * ---------------------------------------------------------------
 *    
 */
define('__APPFOLDER__', __DOCUMENTROOT__ . '/../application/');

/**
 * -----------------------------------------------------------------------------
 * MODULE FOLDER
 * -----------------------------------------------------------------------------
 */
define('__MODULEFOLDER__', __APPFOLDER__ . 'modules');


/*
 * ---------------------------------------------------------------
 * APP environment
 * ---------------------------------------------------------------
  /**
 * Set the general app environment.
 * if "development" is defined , all errors will show
 * values permited (desarrollo,produccion,testing)
 */
define('__ENVIRONMENT__', 'development');

if (defined('__ENVIRONMENT__')) {
    switch (__ENVIRONMENT__) {
        case 'development':
            ini_set('display_errors', 1);
            error_reporting(-1);
            error_reporting(E_ALL);
            break;

        case 'testing':
        case 'production':
            error_reporting(0);
            break;

        default:
            exit('Kerana dosnt have a valid environment, bye');
    }
}

/**
 * ------------------------------------------------------------------------------
 * Create a NEW System Object, AND run the application
 * ------------------------------------------------------------------------------
 */
require __DOCUMENTROOT__ . '/../vendor/autoload.php';
New System();
