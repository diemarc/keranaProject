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

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');


/*
  |--------------------------------------------------------------------------
  | DevelopmentConfiguration for Kerana
  |--------------------------------------------------------------------------
  |
 */


$config = Configuration::singleton();


/*
  |--------------------------------------------------------------------------
  | BASICS
  |--------------------------------------------------------------------------
  |
  |
 */

/*
 * ---------------------------------------------------------------
 * DOCUMENT_ROOT 
 * ---------------------------------------------------------------
  /**
 * Setting the site, possibles CONS
 * 1 __DOCUMENTROOT__ ; si existe un virtual host que apunte directamente a 
 * la carpeta application, dejar vacio, en el caso de que es un subdirectorio
 * dentro del virtualhost, hay que especificarlo.
 * 2 __COREFOLDER__;3 __APPFOLDER__
 */


define('_CONTROLLER_SUFIX_', 'Controller');
define('_MODEL_SUFIX_', 'Model');


/*
 * ---------------------------------------------------------------
 * DEFAULT CONTROLLER , MODULE ACTION
 * ---------------------------------------------------------------
 * 
 */

define('_DEFAULT_MODULE_', 'welcome');
define('_DEFAULT_CONTROLLER_', 'login');
define('_DEFAULT_ACTION_', 'introduceMySelf');


//url position for each url-component
$config->set('position_module', 0);
$config->set('position_controller', 1);
$config->set('position_action', 2);


/*
  |--------------------------------------------------------------------------
  | SECURITY
  |--------------------------------------------------------------------------
  |
 */

/**
 * -----------------------------------------------------------------------------
 * Public modules, this list dont need autentification
 * -----------------------------------------------------------------------------
 */
$config->set('_public_modules_', [
    'web',
    'welcome'
]);

/** determine if ACL module will be run in each http-petition */
$config->set('_acl_active_',false);


/*
 * ---------------------------------------------------------------
 * AES Key
 * ---------------------------------------------------------------
 */

$config->set('_aeskey_', 'vnaT497*_N');

/**
 * -----------------------------------------------------------------------------
 * Sessions
 * -----------------------------------------------------------------------------
 */
/** @var mixed , session name */
$config->set('_session_name_', '_keRsess_');

/** @var boolean, if overt https set to true */
$config->set('_session_https_', false);

/** @var boolean, only url no js mode, */
$config->set('_session_http_only_', true);

/** @var mixed, algoritmo hash para encriptar las sesiones
 *  usar (hash_algos() para ver los disponibles) */
$config->set('_session_hash_', 'sha512');




/*
 * ---------------------------------------------------------------
 * FORMATO DE FECHAS 
 * ---------------------------------------------------------------
 * 
 */

define('_FECHAHOY_', 'strftime("%Y-%m-%d-%H-%M-%S",time())');
define('_DATE_FORMAT_', 'DD-MM-YYYY');
define('_NUMBER_FORMAT_', '2|,|.');


/*
 * ---------------------------------------------------------------
 * PROFILER 
 * ---------------------------------------------------------------
 * Muestra uso de memorias y CPU que usa el script php
 */

define('_ENABLE_PROFILER_', true);



/*
 * ---------------------------------------------------------------
 * DB
 * ---------------------------------------------------------------
 * 
 */

//$config->set('_dbhost_', 'localhost');
//$config->set('_dbname_', 'factufacil');
//$config->set('_dbuser_', 'factu_oper');
//$config->set('_dbpass_', 'EDjXKe5YjV40');
//$config->set('_dbport_', '3306');
$config->set('_dbhost_', '172.26.0.41');
$config->set('_dbname_', 'factufacil');
$config->set('_dbuser_', 'factu_oper');
$config->set('_dbpass_', 'EDjXKe5YjV40');
$config->set('_dbport_', '3306');


