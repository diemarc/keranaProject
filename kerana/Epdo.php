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
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, // devuelve objetos
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // errores en modo de excepction
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'" // todo en utf8
        ];

        try {
            parent::__construct('mysql:host=' . $config->get('_dbhost_') .
                    ';port=' . $config->get('_dbport_') . ';dbname=' .
                    $config->get('_dbname_'), $config->get('_dbuser_'), $config->get('_dbpass_'), $options);
        } catch (\Exception $ex) {
             \kerana\Exceptions::ShowException('DataBaseConnectionFail', $ex);
        }
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
