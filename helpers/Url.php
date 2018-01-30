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

namespace helpers;

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');

/**
 * -----------------------------------------------------------------------------
 * Class Url
 * ------------------------------------------------------------------------------
 * UrlHelper, manage url stuff, simply like that
 */
class Url
{

    public static
    /** @var mixed, current module */
            $current_module,
            /** @var mixed, current controller */
            $current_controller,
            /** @var mixed, current actin */
            $current_action,
            /** @var array, get parameters url */
            $url_parameters;

    /**
     * -------------------------------------------------------------------------
     * Store the diferent segment of a url
     * -------------------------------------------------------------------------
     */
    public static function setUrl()
    {
        $url_request = trim(filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL), '/');

        $config = \kerana\Configuration::singleton();

        if ($url_request) {
            $url = explode('/', $url_request);

            self::$current_module = isset($url[$config->get('position_module')]) ? $url[$config->get('position_module')] : false;
            self::$current_controller = isset($url[$config->get('position_controller')]) ? $url[$config->get('position_controller')] : false;
            self::$current_action = isset($url[$config->get('position_action')]) ? $url[$config->get('position_action')] : false;

            // remove from array the other parameters to store in diferent array
            unset($url[$config->get('position_module')], $url[$config->get('position_controller')], $url[$config->get('position_action')]);

            self::$url_parameters = array_values($url);
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Get current module 
     * -------------------------------------------------------------------------
     * @return type
     */
    public static function getModule()
    {
        self::setUrl();
        return self::$current_module;
    }

    /**
     * -------------------------------------------------------------------------
     * Get current controller 
     * -------------------------------------------------------------------------
     * @return string
     */
    public static function getController()
    {
        self::setUrl();
        return self::$current_controller;
    }

    /**
     * -------------------------------------------------------------------------
     * Get current action
     * -------------------------------------------------------------------------
     * @return string
     */
    public static function getAction()
    {
        self::setUrl();
        return self::$current_action;
    }

    /**
     * -------------------------------------------------------------------------
     * Get all parameters passes by url-string
     * -------------------------------------------------------------------------
     * @return array
     */
    public static function getParameters()
    {
        self::setUrl();
        return self::$url_parameters;
    }

}
