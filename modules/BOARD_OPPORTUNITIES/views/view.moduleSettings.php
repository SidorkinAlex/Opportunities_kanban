<?php

use SuiteCRM\Modules\BOARD_OPPORTUNITIES\ConfigTables;

//require_once 'modules/BOARD_OPPORTUNITIES/ConfigTables.php';
class ModuleSettings {
    public $ss;
    public $seedUser;

    /**
     * moduleSettingsViews constructor.
     * @param User $seedUser
     */
    public function __construct( User $seedUser)
    {
        $this->ss = new Sugar_Smarty();
        $this->seedUser = $seedUser;
    }
    public function display(){
    global $app_list_strings;
        $ConfigTable = new ConfigTables();
        $moduleList = get_select_options($app_list_strings['moduleList'],$ConfigTable->retrieve('BOARD_OPPORTUNITIES'));
        $this->ss->assign('moduleList', $moduleList);
        $html = $this->ss->fetch('modules/BOARD_OPPORTUNITIES/tpl/moduleSettingsViews.tpl');
        echo $html;
    }

}