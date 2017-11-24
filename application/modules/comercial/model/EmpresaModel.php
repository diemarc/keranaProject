<?php
namespace application\modules\comercial\model;
defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');
/*
  |-----------------------------------------------------------------------------
  | Class EmpresaModel
  |-----------------------------------------------------------------------------
  | @author kerana,
  | @date 08-11-2017 09:41:27,
  |
 */

class EmpresaModel extends \kerana\Ada {


     public function __construct()
    {
        parent::__construct();
        $this->table_name = 'com_empresa';
        $this->table_id = 'id_empresa';
    }


}