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
 * Determina si keranaPrject se esta ejecutando desde CLI
 * -----------------------------------------------------------------------------
 */
if (PHP_SAPI == 'cli') {
    define('__ISCLI__',1);
    // esta ejecutandose desde CLI
    define('__DOCUMENTROOT__', substr(str_replace(pathinfo(__FILE__, PATHINFO_BASENAME), '', __FILE__), 0, -1));
} else {
    // sobre apache
    define('__DOCUMENTROOT__', filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '');
}


/** @cons, url actual */

define('__URL__', 'http://'.filter_input(INPUT_SERVER, 'HTTP_HOST') . '');

/** @cons , nombre de la aplicacion */
define('__APPNAME__','keranaProject');
/*
 * ---------------------------------------------------------------
 * CORE DEL SISTEMA
 * ---------------------------------------------------------------

  /**
 * carpeta donde se encuentran los archivos del core
 * siempre poner slash inicial y final
 */
define('__COREFOLDER__', __DOCUMENTROOT__ . '/../kerana/');


/*
 * ---------------------------------------------------------------
 * CARPETA DE APPLICATION
 * ---------------------------------------------------------------
 *    
 * carpeta donde se encuentra Application,
 * la carpeta donde se aloja la aplicacion
 * siempre poner slash inicial y final
 */
define('__APPFOLDER__', __DOCUMENTROOT__ . '/../application/');
/*
 * carpeta donde se encuentra los modulos de la aplicacion
 * HMVC
 */
define('__MODULEFOLDER__', __APPFOLDER__ . 'modules');


/*
 *---------------------------------------------------------------
 * ENTORNO DE LA APLICACION
 *---------------------------------------------------------------
/**
 * Reporte de errores
 * por defecto esta en modo desarrollo
 * posibles valores (desarrollo,produccion,testing)
 */
define('_ENTORNO_', 'desarrollo');

if (defined('_ENTORNO_')) {
    switch (_ENTORNO_) {
        case 'desarrollo':
            ini_set('display_errors', 1);
            error_reporting(-1);
            error_reporting(E_ALL);
            break;

        case 'testing':
        case 'produccion':
            error_reporting(0);
            break;

        default:
            exit('La aplicacion no tiene definido un entorno valido');
    }
}

/**
 * ------------------------------------------------------------------------------
 * Iniciamos el sistema
 * ------------------------------------------------------------------------------
 */
require __DOCUMENTROOT__.'/../vendor/autoload.php';
New System();
