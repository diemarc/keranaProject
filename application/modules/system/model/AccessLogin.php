<?php

namespace application\modules\system\model;

(!defined('__APPFOLDER__')) ? exit('No esta permitido el acceso directo a este archivo') : '';

/**
 * Description of AccessLogin
 *
 * @author diemarc
 */
class AccessLogin extends \Kerana\Ada
{
   
    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'sys_access_log';
        $this->table_id = 'id_access_log';
    }
    
    /**
     * -------------------------------------------------------------------------
     * Regisrta una nueva session, acceso al sistema
     * -------------------------------------------------------------------------
     * @param type $id_usuario
     */
    public function registerAccessUser($id_usuario){
        
        $this->_query = ' INSERT INTO '.$this->table_name.' '
                . ' (id_usuario,remote_address_access,time_access)'
                . ' VALUES'
                . ' (:id_usuario,INET_ATON(:ip),:time) ';
        
        $this->_binds = [
            ':id_usuario' => filter_var($id_usuario,FILTER_SANITIZE_NUMBER_INT),
            ':ip' => filter_input(INPUT_SERVER,'REMOTE_ADDR',FILTER_VALIDATE_IP),
            ':time' => time()
        ];
        
        return $this->runQuery();
        
    }
    
    
}
