<?php

namespace application\modules\system\model;

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');
/*
  |-----------------------------------------------------------------------------
  | Class GroupModel
  |-----------------------------------------------------------------------------
  |
  |
  | @author kerana,
  | @date 07-02-2018 05:40:57,
  |
 */

class GroupModel extends \kerana\Ada
{

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'sys_group';
        $this->table_id = 'id_group';
    }

}
