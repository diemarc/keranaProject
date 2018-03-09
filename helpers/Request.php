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
use helpers\Validator AS Validator;

/**
 * -----------------------------------------------------------------------------
 * ClassRequest
 * ------------------------------------------------------------------------------
 * Access an validate var type, from post or get request
 * @author diemarc
 */
class Request
{

    public static

    /** @var string, the current method request */
            $request_method,
            /** @array, super globar $_REQUEST rewrite */
            $request;

    /**
     * -------------------------------------------------------------------------
     * Start the request method, an sanitize all values for a request
     * -------------------------------------------------------------------------
     */
    public static function init()
    {
        self::$request_method = (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') ? INPUT_POST : INPUT_GET;
        self::$request = filter_input_array(self::$request_method, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    /**
     * -------------------------------------------------------------------------
     * Validate email
     * -------------------------------------------------------------------------
     * @param mixed $field , email field value, default 'f_email'
     * @return type
     */
    public static function email($field = 'f_email')
    {
        self::init();
        return Validator::valVarchar($field,self::$request[$field],true);
    }

    /**
     * -------------------------------------------------------------------------
     * Validate int
     * -------------------------------------------------------------------------
     * @param int $field
     * @param boolean $require
     * @return type
     */
    public static function int($field,$require = true)
    {
        self::init();
        return Validator::valInt($field,self::$request[$field],$require);
    }
    /**
     * -------------------------------------------------------------------------
     * Validate string
     * -------------------------------------------------------------------------
     * @param type $field
     * @param type $require
     * @return type
     */
    public static function varchar($field,$require = false)
    {
        self::init();
        return Validator::valVarchar($field,self::$request[$field],$require);
    }

}
