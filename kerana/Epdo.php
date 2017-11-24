<?php

namespace kerana;

(!defined('__APPFOLDER__')) ? exit('No esta permitido el acceso directo a este archivo') : "";
/*
  |--------------------------------------------------------------------------
  | Implementacion de PDO
  |--------------------------------------------------------------------------
  |
  | Implementacion para PDO, con singleton, siempre devuelve la instancia
  |
 */

use PDO;

class Epdo extends PDO
{

    private static $instance = null;

    public function __construct()
    {
        $config = Configuration::singleton();

        /**
         * ---------------------------------------------------------------------
         * Opciones para PDO
         * ---------------------------------------------------------------------
         */
        $options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,// devuelve objetos
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // errores en modo de excepction
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'" // todo en utf8
        ];

        parent::__construct('mysql:host=' . $config->get('_dbhost_') .
                ';port=' . $config->get('_dbport_') . ';dbname=' .
                $config->get('_dbname_'), $config->get('_dbuser_'), $config->get('_dbpass_'), $options);
    }

    /**
     * -------------------------------------------------------------------------
     * Singleton
     * -------------------------------------------------------------------------
     * Si ya esta instanciada crea una nueva instancia caso contraria nos 
     * devuelve la clase instanciada
     * @return instancia
     */
    public static function singleton()
    {
        if (self::$instance == null) {

            self::$instance = new self();
        }

        return self::$instance;
    }

}
