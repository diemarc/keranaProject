<?php

namespace application\modules\system\model;

defined('__APPFOLDER__') OR exit('Direct access to this file is forbidden, siya');
/*
  |-----------------------------------------------------------------------------
  | Class ActionModel
  |-----------------------------------------------------------------------------
  |
  |
  | @author kerana,
  | @date 10-02-2018 05:28:22,
  |
 */

class ActionModel extends \kerana\Ada
{

    public
    /** @var int(11), id_action  */
            $id_action,
            /** @var varchar(45), action_name  */
            $action_name,
            /** @var tinyint(1), sw_system_action  */
            $sw_system_action;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'sys_action';
        $this->table_id = 'id_action';
    }

}
