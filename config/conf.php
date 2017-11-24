<?php

namespace kerana;

(!defined('__APPFOLDER__')) ? exit('No esta permitido el acceso directo a este archivo') : "";


$config = Configuration::singleton();


/*
  |--------------------------------------------------------------------------
  | URL del proyecto
  |--------------------------------------------------------------------------
  |
 */

//$config->set('_URL_', filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '');


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
 * Configurar el sitio, hay que atender las 3 constantes
 * 1 __DOCUMENTROOT__ ; si existe un virtual host que apunte directamente a 
 * la carpeta application, dejar vacio, en el caso de que es un subdirectorio
 * dentro del virtualhost, hay que especificarlo.
 * 2 __COREFOLDER__;3 __APPFOLDER__
 */


define('_CONTROLLER_SUFIX_', 'Controller');
define('_MODEL_SUFIX_', 'Model');


/*
 * ---------------------------------------------------------------
 * CONTROLADOR , MODULO Y ACCION POR DEFECTO
 * ---------------------------------------------------------------
 * 
 */
// controlador por defecto

define('_DEFAULT_MODULE_', 'welcome');
define('_DEFAULT_CONTROLLER_', 'welcome');
define('_DEFAULT_ACTION_', 'index');


// segmentos de url, configuramos en que posicion de la url se encuentra
// informacion sobre el modulo/controller/action

$config->set('position_module',0);
$config->set('position_controller',1);
$config->set('position_action',2);


/*
  |--------------------------------------------------------------------------
  | SEGURIDAD
  |--------------------------------------------------------------------------
  |
 */

/**
 * -----------------------------------------------------------------------------
 * Modulos publicos que no necesitan autentificacion
 * -----------------------------------------------------------------------------
 */
$config->set('_public_modules_', [

    'web',
    'welcome'
]);


/*
 * ---------------------------------------------------------------
 * Llave AES
 * ---------------------------------------------------------------
 * Se utiliza para encryptar las constraseñas en mysql o en php
 */

$config->set('_aeskey_', 'vnaT497*_N');

/**
 * -----------------------------------------------------------------------------
 * Sesiones
 * -----------------------------------------------------------------------------
 */

/** @var mixed , nombre de la session a utilizar*/
$config->set('_session_name_', '_keRsess_');

/** @var boolean, si la app esta sobre https, activarlo true */
$config->set('_session_https_', false);

/** @var boolean, para que las cookies no sea accedido desde js, 
 *  nunca poner a false, a no ser que se sepa que se hace */
$config->set('_session_http_only_', true);

/** @var mixed, algoritmo hash para encriptar las sesiones
 *  usar (hash_algos() para ver los disponibles) */
$config->set('_session_hash_','sha512');




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
 * PLANTILLAS DE HTML 
 * ---------------------------------------------------------------
 * Se define dos plantillas, una de la parte privada/administracion
 * en private_layout
 * 
 * En public_layout la plantilla para la parte publica,
 * la www
 */



/*
 * ---------------------------------------------------------------
 * BASES DE DATOS
 * ---------------------------------------------------------------
 * 
 */

$config->set('_dbhost_', 'localhost');
$config->set('_dbname_', 'kerana');
$config->set('_dbuser_', 'oper_ker');
$config->set('_dbpass_', 'darksky');
$config->set('_dbport_', '3306');

