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

namespace Kerana;

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');

/*
  |--------------------------------------------------------------------------
  | VIEW CLASS
  |--------------------------------------------------------------------------
  | load views, simply
  |
 */

class View
{

    private static
    /** @boolean is_ajax request? */
            $_is_ajax;
    public static
            $model;

    /**
     * -------------------------------------------------------------------------
     * Show a view template
     * -------------------------------------------------------------------------
     * @param string $module , module template
     * @param string $template , html template
     * @param array $params , parameters to pass to a view
     * @param boolean $save , if you want to sotre the rendered view in a variable
     */
    public static function showView($module, $template, $params = '', $save = false)
    {

        self::_checkAjaxPetition();

        $template_path = $module . '/view/' . $template . '.php';
        $full_path_template = __MODULEFOLDER__ . '/' . $template_path;

        // check if template path exists
        // if not exists, pass the template to a viewMaker to try to create it
        (!file_exists($full_path_template)) ? \helpers\ViewMaker::makeView($template, $params, self::$model) : '';

        // processs the parameters is available in the template view
        if (is_array($params)) {
            foreach ($params as $key => $valor) {
                $$key = $valor;
            }
        }

        // if $save is true, create a buffer and store tne entire template rendered
        // in a variable, & return this variable
        if ($save) {
            ob_start();
            include($full_path_template );
            $var_view = ob_get_contents();
            ob_end_clean();
            return $var_view;
        }

        // if want to load the html header
        (!self::$_is_ajax AND $module != 'welcome') ? require_once(__DOCUMENTROOT__ . '/_layouts/'.$_SESSION['layout'].'/_htmlHeader.php') : '';

        // include the template file
        include($full_path_template);

        // if want to load the footer
        (!self::$_is_ajax AND $module != 'welcome') ? require_once(__DOCUMENTROOT__ . '/_layouts/'.$_SESSION['layout'].'/_htmlFooter.php') : '';
    }

    /**
     * -------------------------------------------------------------------------
     * Show the loign page
     * -------------------------------------------------------------------------
     */
    public static function showLoginPage()
    {
        include(__APPFOLDER__.'/templates/login.php');
    }

    /**
     * -------------------------------------------------------------------------
     * Load form with CSRF token security
     * -------------------------------------------------------------------------
     * @param mixed $module
     * @param mixed $template
     * @param array $params
     * @param object $model , object of model to create a html form
     */
    public static function showForm($module, $template, $params = '', $model = false)
    {

        //$token_string = \kerana\Security::csrfGetTokenId();
        $token_value = \helpers\Security::csrfGetTokenValue();
        ($model != false) ? self::$model = $model : '';

        $params['kerana_token'] = '<input type="hidden" name="_kerana_token_" value="' . $token_value . '">';

        self::showView($module, $template, $params, false);
    }

    /**
     * -------------------------------------------------------------------------
     * Check if is a jax petition
     * -------------------------------------------------------------------------
     */
    private static function _checkAjaxPetition()
    {

        $server_request = FILTER_INPUT(INPUT_SERVER, "HTTP_X_REQUESTED_WITH");
        self::$_is_ajax = (isset($server_request) AND $server_request === 'XMLHttpRequest') ? true : false;
    }

}
