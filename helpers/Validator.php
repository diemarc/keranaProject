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

    public static

    /** @var string the param name to validatre */
            $param_name,
            /** @var mixed, the param value to validate */
            $param_value,
            /** @var mixed, value to check, can be (param_value,_post,_get) */
            $param_to_validate;

    /**
     * -------------------------------------------------------------------------
     * Initializite the validator params
     * -------------------------------------------------------------------------
     * @param string $param_name , the name of the param to check/validate
     * @param mixed $param_value , the param_value to check/validate
     * @param boolean $required , if true, check the param is not empty
     */
    public static function initValidator($param_name, $param_value = '', $required = false)
    {
        self::$param_name = filter_var($param_name, FILTER_SANITIZE_SPECIAL_CHARS);
        self::$param_value = filter_var($param_value, FILTER_SANITIZE_SPECIAL_CHARS);

        // if param_value is empty then ask to RequestHelper
        // to try to catch the param via _post or _get
        if (empty($param_value)) {
            \helpers\Request::init();
            self::$param_to_validate = \helpers\Request::$request[$param_name];
        } else {
            self::$param_to_validate = self::$param_value;
        }

        // if is required, check if not empty
        if ($required) {
            try {
                self::isRequired(self::$param_name, self::$param_to_validate);
            } catch (\Exception $ex) {
                \kerana\Exceptions::ShowException('VALIDATOR::' . self::$param_name . ' is a required field but its empty', New \Exception($ex));
            }
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Validate int
     * -------------------------------------------------------------------------
     * @param string $param_name
     * @param int $param_value
     * @param boolean $required
     * @ereturn int
     */
    public static function valInt($param_name, $param_value = '', $required = true)
    {
        self::initValidator($param_name, $param_value, $required);

        // now validate 
        if ($required AND filter_var(self::$param_to_validate, FILTER_VALIDATE_INT) == FALSE) {
            \kerana\Exceptions::showError('integerVALIDATOR::', ' param_name=<strong>' .
                    self::$param_name . '</strong><br> param_value=<strong>'
                    . '' . self::$param_to_validate . '</strong> <br> WTF??... is not a valid INTEGER');
        } else {
            return trim(self::$param_to_validate);
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Validate a string
     * -------------------------------------------------------------------------
     * @param string $param_name
     * @param string $param_value
     * @param boolean $required
     * @return string
     */
    public static function valVarchar($param_name, $param_value = '', $required = false)
    {
        self::initValidator($param_name, $param_value, $required);

        $is_email = strpos($param_name, 'email');
        $value_type = ($is_email) ? 'Email' : 'String';
        
        $process = ($is_email AND $required) ? filter_var(self::$param_to_validate, FILTER_VALIDATE_EMAIL) : TRUE;

        if ($process == FALSE) {
            \kerana\Exceptions::showError('stringVALIDATOR::'.$value_type, ' param_name=<strong>' .
                    self::$param_name . '</strong><br> param_value=<strong>'
                    . '' . self::$param_to_validate . '</strong> <br> WTF??... is not a valid '.$value_type);
        } else {
            return trim(self::$param_to_validate);
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Evaluate a textdata is to same of valString
     * -------------------------------------------------------------------------
     * @param type $param_name
     * @param type $param_value
     * @param type $required
     * @return type
     */
    public static function valText($param_name, $param_value = '', $required = false){
       return self::valVarchar($param_name, $param_value, $required);   
    }
    
    /**
     * -------------------------------------------------------------------------
     * 
     * -------------------------------------------------------------------------
     * @param type $param_name
     * @param type $param_value
     * @param type $required
     * @return type
     */
    public static function valTime($param_name, $param_value = '', $required = false){
        self::initValidator($param_name,$param_value,$required);
        return trim($param_value);
    }
    
    

    /*
      |--------------------------------------------------------------------------
      | OLD METHODS,
      |--------------------------------------------------------------------------
      |
      | @TODO: refactor this
      |
     */

    /**
     * -------------------------------------------------------------------------
     * 
     * -------------------------------------------------------------------------
     * @param type $field
     */
    public static function required($field)
    {
        (empty($field)) ? \kerana\Exceptions::showError('VALIDATOR::', $field . ' is a required field but its empty') : '';
    }

    /**
     * -------------------------------------------------------------------------
     * check if a param is not empty
     * -------------------------------------------------------------------------
     * @param type $name
     * @param type $value
     * @throws \Exception
     */
    public static function isRequired($name, $value)
    {
        if (empty($value)) {
            throw new \Exception("$name is empty!!");
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Validate email
     * -------------------------------------------------------------------------
     * @param mixed $email
     * @return type
     */
    public static function email($email, $required = false)
    {
        ($required) ? self::required($email) : '';
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
            \kerana\Exceptions::showError('VALIDATOR::', $email . ' is not a valid email');
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
    public static function int($var, $required = false)
    {
        ($required) ? self::required($var) : '';
        if (filter_var($var, FILTER_SANITIZE_NUMBER_INT) == FALSE) {
            \kerana\Exceptions::showError('VALIDATOR::', $var . ' is not a valid INTEGER');
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
    public static function varchar($var, $required = false)
    {
        ($required) ? self::required($var) : '';
        if (filter_var($var, FILTER_SANITIZE_STRING) == FALSE) {
            \kerana\Exceptions::showError('VALIDATOR::', $var . ' is not a valid string');
        } else {
            return trim($var);
        }
    }

}
