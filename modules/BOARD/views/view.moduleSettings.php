<?php

use SuiteCRM\Modules\BOARD\ConfigTables;

//require_once 'modules/BOARD/ConfigTables.php';
class ModuleSettings {
    public $ss;
    public $seedUser;
    public $request;

    /**
     * moduleSettingsViews constructor.
     * @param User $seedUser
     */
    public function __construct( User $seedUser,$request)
    {
        $this->ss = new Sugar_Smarty();
        $this->seedUser = $seedUser;
        $this->request = $request;
    }
    public function display(){
    global $app_list_strings;
        $ConfigTable = new ConfigTables();
        $moduleList = get_select_options($app_list_strings['moduleList'],$ConfigTable->getValue('BOARD','moduleList'));
        $alert = "";
        if(!empty($this->request['message'])){
            $alert = $this->request['message'];
        }
        $this->ss->assign('alert', $alert);
        $this->ss->assign('moduleList', $moduleList);
        $html = $this->ss->fetch('modules/BOARD/tpl/moduleSettingsViews.tpl');
        echo $html;
    }

}