<?php

namespace kerana;

(!defined('__APPFOLDER__')) ? exit('No esta permitido el acceso directo a este archivo') : "";
/*
  |--------------------------------------------------------------------------
  | SESSIONHANDLER CLASSS
  |--------------------------------------------------------------------------
  |
  | Sobreescribimos los metodos de sesiones para que se guarden una base de datos
  | y creamos sesiones seguras
  |
 */

class SessionHandler
{

    private
    /** @var mixed, instancia del modelo de sesiones */
            $_model_session;

    public function __construct()
    {
        // usamos solo http para las cookies, si no es posible, die
        if (ini_set('session.use_only_cookies', 1) === FALSE) {
            \kerana\Exceptions::showError('Sesiones', 'No se puede iniciar sesion segura');
        }

        // modelo donde se guardara las sesiones 
        $this->_model_session = new \kerana\SessionStore();

        // handler para la sobrescritura de sesiones
        session_set_save_handler
                (
                [$this, '_open'], [$this, '_close'], [$this, '_read'], [$this, '_write'], [$this, '_destroy'], [$this, '_gc']
        );
    }

    /**
     * -------------------------------------------------------------------------
     * Inicia una session segura
     * -------------------------------------------------------------------------
     */
    public function startSession()
    {
        $config = Configuration::singleton();

        // forzamos que las sesiones se gestionen solo por cookie y no que se 
        // propague por url.
        ini_set('session.use_only_cookies', 1);

        // archivo de entropia, para dar mas random a la generacion de SID
        ini_set('session.entropy_file', '/dev/urandom');

        // obtenemos parametros de las cookies y seteamos
        // algunos parametros de seguridad
        $cookie_params = session_get_cookie_params();
        session_set_cookie_params(
                $cookie_params['lifetime'], $cookie_params['path'], $cookie_params['domain'], $config->get('_session_https_'), $config->get('_session_http_only_')
        );

        // comprobamos que el hash seteado en el archivo de configuracion 
        // se pueda usar para encriptar las sesiones
        if (in_array($config->get('_session_hash_'), hash_algos())) {
            ini_set('session.hash_function', $config->get('_session_hash_'));
        }

        // start session y regeneramos id en cada peticion
        session_name($config->get('_session_name_'));
        session_start();
        session_regenerate_id(true);
    }

    /**
     * -------------------------------------------------------------------------
     * Elimina todas las variables de sesion
     * -------------------------------------------------------------------------
     */
    public function cleanSession()
    {

        // unset de todas las variables de sesion iniciadas
        $_SESSION = [];

        // parametros de sesion
        $params = session_get_cookie_params();

        // borra el cookie actual
        setcookie(
                session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']
        );
        // destruye la sesion
        session_destroy();
        
    }

    /*
      |--------------------------------------------------------------------------
      | HANDLER PARA GESTIONAR LAS SESIONES EN UNA TABLA MYSQL
      |--------------------------------------------------------------------------
      |
     */

    /**
     * -------------------------------------------------------------------------
     * Solo comprueba que el modelo de sesiones esta cargado
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
     * Cerramos la conexion a la db , estableciendo a null, 
     * PHP ya lo hace por nosotros, esto lo hacemos para cumplir
     * los requisitos de sobreescribir los metodos de gestion de sesiones
     * COmo usamos PDO para el acceso a la base de datos, destruyendo el
     * objeto , matamos la conexion.
     * -------------------------------------------------------------------------
     */
    public function _close()
    {
        $this->_model_session = null;
    }

    /**
     * -------------------------------------------------------------------------
     * Recupera una variable de sesion
     * -------------------------------------------------------------------------
     * @param type $id
     * @return type
     */
    public function _read($id)
    {
        $this->_model_session->_setIdTableValue($id, false);
        $rsData = $this->_model_session->getRecord(false);
        return ($rsData) ? $rsData->data : '';
    }

    /**
     * -------------------------------------------------------------------------
     * Guarda una sesion 
     * -------------------------------------------------------------------------
     * @param type $id
     * @param type $data
     * @return type
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
     * Destryue una sesion
     * -------------------------------------------------------------------------
     * @param type $id
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
     */
    public function _gc($max)
    {
        // lo que consideramos obsoleto
        $old = time() - $max;
        return $this->_model_session->deleteOldSession($old);
    }

}
