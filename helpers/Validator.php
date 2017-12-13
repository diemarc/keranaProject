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

/**
 * -----------------------------------------------------------------------------
 * ValidatorClass
 * ------------------------------------------------------------------------------
 * Validate fields , simple
 * @author diemarc
 */
class Validator
{

    public static $field;

    /**
     * -------------------------------------------------------------------------
     * 
     * -------------------------------------------------------------------------
     * @param type $field
     */
    public static function required($field)
    {
        (empty($field))?\kerana\Exceptions::showError('VALIDATOR::', $field.' is a required field but its empty'):'';
    }

    /**
     * -------------------------------------------------------------------------
     * Validate email
     * -------------------------------------------------------------------------
     * @param mixed $email
     * @return type
     */
    public static function email($email,$required = false)
    {
        ($required) ? self::required($email):''; 
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
            \kerana\Exceptions::showError('VALIDATOR::', $email.' is not a valid email');
        } else {
            return trim($email);
        }
    }
    
    /**
     * -------------------------------------------------------------------------
     * Validate email
     * -------------------------------------------------------------------------
     * @param mixed $email
     * @return type
     */
    
    public static function int($var,$required = false)
    {
        ($required) ? self::required($var):''; 
        if (filter_var($var, FILTER_SANITIZE_NUMBER_INT) == FALSE) {
            \kerana\Exceptions::showError('VALIDATOR::', $var.' is not a valid INTEGER');
        } else {
            return trim($var);
        }
    }
    
    /**
     * -------------------------------------------------------------------------
     * Validate string
     * -------------------------------------------------------------------------
     * @param type $var
     * @param type $required
     * @return type
     */
    public static function varchar($var,$required = false)
    {
        ($required) ? self::required($var):''; 
        if (filter_var($var, FILTER_SANITIZE_STRING) == FALSE) {
            \kerana\Exceptions::showError('VALIDATOR::', $var.' is not a valid string');
        } else {
            return trim($var);
        }
    }
    
    

}
