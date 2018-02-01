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
  | SESSIONHANDLER CLASSS
  |--------------------------------------------------------------------------
  | Will stored the session values in a mysql-table, this is the implentation
  | of the session-handler
  |
 */

class SessionHandler
{

    private
    /** @object , model object for session */
            $_model_session;

    public function __construct()
    {
        // use only http cookies, otherwise kerana die
        if (ini_set('session.use_only_cookies', 1) === FALSE) {
            \kerana\Exceptions::showError('Sesiones', 'No se puede iniciar sesion segura');
        }

        /** @object, crear a model_session object */
        $this->_model_session = new \kerana\SessionStore();

        // Register the methods to handle the sessions
        session_set_save_handler
                (
                [$this, '_open'], [$this, '_close'], [$this, '_read'], [$this, '_write'], [$this, '_destroy'], [$this, '_gc']
        );
    }

    /**
     * -------------------------------------------------------------------------
     * Start secure Session
     * -------------------------------------------------------------------------
     */
    public function startSession()
    {
        $config = Configuration::singleton();

        // cookies propagation only via cookies, not url
        ini_set('session.use_only_cookies', 1);

        // entropy file to generate sessions 
        ini_set('session.entropy_file', '/dev/urandom');

        // get cookies parameters
        $cookie_params = session_get_cookie_params();
        session_set_cookie_params(
                $cookie_params['lifetime'], $cookie_params['path'], $cookie_params['domain'], $config->get('_session_https_'), $config->get('_session_http_only_')
        );

        // encrypt the sessions if is seted in keranaConf
        if (in_array($config->get('_session_hash_'), hash_algos())) {
            ini_set('session.hash_function', $config->get('_session_hash_'));
        }

        // start the secure session, and regenerate for each petition.
        session_name($config->get('_session_name_'));
        session_start();
        session_regenerate_id(true);
    }

    /**
     * -------------------------------------------------------------------------
     * Purge all sessions vars
     * -------------------------------------------------------------------------
     */
    public function cleanSession()
    {

        $_SESSION = [];
        $params = session_get_cookie_params();

        // delete current cookie
        setcookie(
                session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']
        );
        // destruye la sesion
        session_destroy();
    }

    /*
      |--------------------------------------------------------------------------
      | HANDLER FOR SESSIONS IN A DB-TABLE
      |--------------------------------------------------------------------------
      |
     */

    /**
     * -------------------------------------------------------------------------
     * Check if model_session is created
     * -------------------------------------------------------------------------
     */
    public function _open()
    {

        if ($this->_model_session) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * -------------------------------------------------------------------------
     * Destroy the model_session object
     * -------------------------------------------------------------------------
     */
    public function _close()
    {
        $this->_model_session = null;
    }

    /**
     * -------------------------------------------------------------------------
     * Get a session var
     * -------------------------------------------------------------------------
     * @param string $id
     * @return @rs session data
     */
    public function _read($id)
    {
        $this->_model_session->_setIdTableValue($id, false);
        $rsData = $this->_model_session->getRecord(false);
        return ($rsData) ? $rsData->data : '';
    }

    /**
     * -------------------------------------------------------------------------
     * Store a session value
     * -------------------------------------------------------------------------
     * @param string $id
     * @param string $data
     * @return boolean
     */
    public function _write($id, $data)
    {

        return $this->_model_session->insert(
                        [
                            'id_session' => $id,
                            'access' => time(),
                            'data' => $data
                        ]
        );
    }

    /**
     * -------------------------------------------------------------------------
     * Destroy a session
     * -------------------------------------------------------------------------
     * @param string $id
     */
    public function _destroy($id)
    {

        $this->_model_session->_setIdTableValue($id, false);
        return $this->_model_session->delete();
    }

    /**
     * -------------------------------------------------------------------------
     * Garbage Collector
     * -------------------------------------------------------------------------
     * @TODO : this methods it seems not executed, needs to do tests!!!
     */
    public function _gc($max)
    {
        $old = time() - $max;
        return $this->_model_session->deleteOldSession($old);
    }

}
