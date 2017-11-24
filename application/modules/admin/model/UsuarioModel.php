<?php
namespace application\modules\admin\model;
defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');
/*
  |-----------------------------------------------------------------------------
  | Class UsuarioModel
  |-----------------------------------------------------------------------------
  |
  | 
  | @author kerana,
  | @date 08-11-2017 07:43:46,
  |
 */

class UsuarioModel extends \kerana\Ada {


     public function __construct()
    {
        parent::__construct();
        $this->table_name = 'sys_usuario';
        $this->table_id = 'id_usuario';
    }


}