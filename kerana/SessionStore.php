<?php

namespace kerana;

/*
  |--------------------------------------------------------------------------
  | Modelo donde se guarda las sesiones de kerana
  |--------------------------------------------------------------------------
  |
 */

class SessionStore extends \kerana\Ada
{


    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'sys_session';
        $this->table_id = 'id_session';
    }

    
    /**
     * -------------------------------------------------------------------------
     * Elimina las sesiones consideradas obsoletas, utilizada por el GB
     * -------------------------------------------------------------------------
     */
    public function deleteOldSession($old){
        
        $this->_setQuery(
                ' DELETE FROM '.$this->table_name.' WHERE access = :old'
                );
        
        $this->_binds = [
            ':old' => $old
        ];
        
        return $this->_runQuery();
        
    }
    
    
    
    
   
}
