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
  | Singleton implementation to get or set variables-data
  |--------------------------------------------------------------------------
  |
  | Descripcion del metodo
  |
 */

class Configuration
{

    private
    /** @array, associative array to contains the var data-value */
            $variables;
    private static
    /** @singleton instance of the object */
            $instance;

    private function __construct()
    {

        $this->variables = array();
    }

    /**
     * -------------------------------------------------------------------------
     * Set a variable value
     * -------------------------------------------------------------------------
     * @param string $name
     * @param string $value
     */
    public function set($name, $value)
    {

        if (!isset($this->variables[$name])) {
            $this->variables[$name] = $value;
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Get a name value
     * -------------------------------------------------------------------------
     * @param type $name
     * @return type
     */
    public function get($name)
    {

        if (isset($this->variables[$name])) {

            return $this->variables[$name];
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Singleton implementation
     * -------------------------------------------------------------------------
     * @return type
     */
    public static function singleton()
    {

        // if instance is not a object, lets create a new object
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }

        // always return the object instance of
        return self::$instance;
    }

}
