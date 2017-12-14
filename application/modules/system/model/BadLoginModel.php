<?php

namespace application\modules\system\model;

(!defined('__APPFOLDER__')) ? exit('No esta permitido el acceso directo a este archivo') : '';

/**
 * -----------------------------------------------------------------------------
 * class badLoginModel, gestion de logins incorrectos
 * -----------------------------------------------------------------------------
 *
 * @author diemarc
 */
class BadLoginModel extends \Kerana\Ada
{

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'sys_bad_login';
        $this->table_id = 'id_bad_login';
    }

    
    /**
     * -------------------------------------------------------------------------
     * Comprueba si un usuario fallo mas de 4 veces en un inicio de sesion
     * si es asi lo bloquea
     * -------------------------------------------------------------------------
     * @param type $id_usuario
     */
    public function checkBadLogin($id_usuario){
        
        // obtenemos los badlogins de un usuario
        $rsBadLoginsUser = $this->getBadLoginForUser($id_usuario);
        $n_bl = count($rsBadLoginsUser);
        
        // si tiene mas de 4 intentos bloqueamos al usuario
        if($n_bl > 4){
            // bloqueamos al usuario
            $objUser = new \application\modules\system\model\UserModel();
            $objUser->blockUserAccount($id_usuario);
            
            \kerana\Exceptions::showError('Error de inicio de sesion', 
                    'Superaste el maximo de intentos de login(4)');
            
        }
   
    }
    
    
    
    /**
     * -------------------------------------------------------------------------
     * Obtiene los intentos erroneos de sesion de un usuario
     * -------------------------------------------------------------------------
     * @param type $id_usuario
     * @return type
     */
    public function getBadLoginForUser($id_usuario)
    {

        return $this->find('time', [
                    'id_usuario' => filter_var($id_usuario, FILTER_SANITIZE_NUMBER_INT)
                        ],'all'
        );
    }

    /**
     * -------------------------------------------------------------------------
     * Se registra un intento erroneo de logeo de un usuario/ip
     * -------------------------------------------------------------------------
     * @param string $string , descripcion del error
     * @param int $id_usuario
     * @return type
     */
    public function registerBadLogin($string, $id_usuario = 0)
    {
        
        $this->_query = ' INSERT INTO ' . $this->table_name
                . '(id_usuario,remote_address,time,string_attempt)'
                . ' VALUES '
                . ' (:id_usuario,INET_ATON(:ip),:time,:string_attemp)';

        // seteamos los bins
        $this->_binds = [
            ':id_usuario' => filter_var($id_usuario, FILTER_SANITIZE_NUMBER_INT),
            ':ip' => filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP),
            ':time' => time(),
            ':string_attemp' => filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS)
        ];

        return $this->runQuery();
    }

}
