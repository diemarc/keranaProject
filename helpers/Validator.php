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
//use \NumberFormatter;

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
            $param_to_validate,
            /** @var boolean, if the param to check is a required param */
            $is_required;

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
        self::$param_name = trim(filter_var($param_name, FILTER_SANITIZE_SPECIAL_CHARS));
        self::$param_value = trim(filter_var($param_value, FILTER_SANITIZE_SPECIAL_CHARS));
        self::$is_required = trim(filter_var($required), FILTER_VALIDATE_BOOLEAN);

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
         
        /** -------------------------------------------------------------------------
         * Check varchar param tittle 
         * if the title contains some string like "email" then validate as a email
         * -------------------------------------------------------------------------
         */
        if (strpos(self::$param_name, 'email')) {
            $email_value = filter_var(self::$param_to_validate, FILTER_VALIDATE_EMAIL);
            if ($email_value != false) {
                return self::$param_to_validate = $email_value;
            } else {
                \kerana\Exceptions::showError('stringVALIDATOR::Email', ' param_name=<strong>' .
                        self::$param_name . '</strong><br> param_value=<strong>'
                        . '' . self::$param_to_validate . '</strong> <br> WTF??... is not a valid email');
            }
        }
        // check is user type
        if (strpos(self::$param_name, 'created_by')) {
            return $user_id = $_SESSION['id_user'];
            //self::$param_to_validate = $user_id;
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
    public static function valText($param_name, $param_value = '', $required = false)
    {
        return self::valVarchar($param_name, $param_value, $required);
    }

    /**
     * -------------------------------------------------------------------------
     * Validate timestamp
     * -------------------------------------------------------------------------
     * @param string $param_name
     * @param value $param_value if is empty returns current timestamp
     * @param boolean $required
     * @return datetime
     */
    public static function valTime($param_name, $param_value = '', $required = false)
    {
        self::initValidator($param_name, $param_value, $required);
        return (empty(self::$param_to_validate)) ? date('Y-m-d h:i:s') : trim($param_value);
    }

    /**
     * -------------------------------------------------------------------------
     * Validate if  param_values is a valid number
     * -------------------------------------------------------------------------
     * @param string $param_name
     * @param mixed $param_value
     * @param boolean $required
     * @return number
     */
    public static function valDecimal($param_name, $param_value = '', $required = false)
    {
        self::initValidator($param_name, $param_value, $required);

        // if is not a float and is not numerico, try to formated 
        if (!filter_var(self::$param_to_validate, FILTER_VALIDATE_FLOAT) AND ( is_numeric(self::$param_to_validate + 1))) {

            $fmt = new \NumberFormatter('de_DE', \NumberFormatter::DECIMAL);
            $num_formatted = $fmt->parse(self::$param_to_validate);

            // if parsing return empty value, show error
            return ($num_formatted) ? $num_formatted :
                    \kerana\Exceptions::showError('floatVALIDATOR::' . $param_name, ' (' . self::$param_to_validate . ') '
                            . 'IS NOT A NUMBER');
            // sif not a number
        } else if (!is_numeric(self::$param_to_validate)) {
            \kerana\Exceptions::showError('floatVALIDATOR::' . $param_name, ' (' . self::$param_to_validate . ') '
                    . 'IS NOT A NUMBER');
        } else {

            // if the value format is like to 9.8 return this value 
            return self::$param_to_validate;
        }
    }

}
