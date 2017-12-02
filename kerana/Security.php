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

(!defined('__APPFOLDER__')) ? exit('No esta permitido el acceso directo a este archivo') : "";

/**
 * -----------------------------------------------------------------------------
 * Clase para la seguridad de la aplicacion
 * -----------------------------------------------------------------------------
 * 
 * CSRF protection
 * 
 */
class Security
{

    /**
     * -------------------------------------------------------------------------
     * Devuelve una token_id que se usa para el atributo name
     * del valor del token, si no existe crea una nueva
     * -------------------------------------------------------------------------
     * @return string
     */
    static function csrfGetTokenId()
    {

        if (isset($_SESSION['token_id'])) {
            return $_SESSION['token_id'];
        } else {
            $token_id = self::random(10);
            $_SESSION['token_id'] = $token_id;
            return $token_id;
        }
    }

    /**
     * -------------------------------------------------------------------------
     *  Genera un token aleatorio
     * -------------------------------------------------------------------------
     * @return type
     */
    static function csrfGetTokenValue()
    {
        $token_value = hash('sha256', self::random(500));
        $_SESSION['token_value'] = $token_value;
        return $token_value;
    }

    /**
     * -------------------------------------------------------------------------
     * Comprueba si un token es valido
     * -------------------------------------------------------------------------
     * @param type $token
     * @return boolean
     */
    static function csrfCheckToken($token = '')
    {

        $token_to_check = (empty($token)) ? filter_input(INPUT_POST, '_kerana_token_', FILTER_SANITIZE_STRING) : $token;

        if (isset($_SESSION['token_value']) AND $token_to_check === $_SESSION['token_value']) {
            unset($_SESSION['token_value']);
            return true;
        }
        $error = 'Imposible procesar la solicitud,comprueba si esta seteado un token valido. ';
        \kerana\Exceptions::showError('KerAna Security',$error);
    }

    /**
     * -------------------------------------------------------------------------
     * Genera cadena aleatoria con una fuerte entropia
     * @link http://www.wikihow.com/Prevent-Cross-Site-Request-Forgery-(CSRF)-Attacks-in-PHP 
     * -------------------------------------------------------------------------
     * @param type $len
     * @return type
     */
    static function random($len)
    {
        if (function_exists('openssl_random_pseudo_bytes')) {
            $byteLen = intval(($len / 2) + 1);
            $return = substr(bin2hex(openssl_random_pseudo_bytes($byteLen)), 0, $len);
        } elseif (is_readable('/dev/urandom')) {
            $f = fopen('/dev/urandom', 'r');
            $urandom = fread($f, $len);
            fclose($f);
            $return = '';
        }

        if (empty($return)) {
            for ($i = 0; $i < $len; ++$i) {
                if (!isset($urandom)) {
                    if ($i % 2 == 0) {
                        mt_srand(time() % 2147 * 1000000 + (double) microtime() * 1000000);
                    }
                    $rand = 48 + mt_rand() % 64;
                } else {
                    $rand = 48 + ord($urandom[$i]) % 64;
                }

                if ($rand > 57)
                    $rand+=7;
                if ($rand > 90)
                    $rand+=6;

                if ($rand == 123)
                    $rand = 52;
                if ($rand == 124)
                    $rand = 53;
                $return.=chr($rand);
            }
        }

        return $return;
    }

}
