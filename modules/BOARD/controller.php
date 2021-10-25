<?php

/**
 * Created by PhpStorm.
 * User: seedteam
 * Date: 27.08.20
 * Time: 16:11
 */
class CustomBOARDController extends SugarController
{
    public function action_getData()
    {
        global $current_user;
        $kanbanBoard=new BOARD();
        $data=$kanbanBoard->getDataOpp($_REQUEST,null,null, $current_user);
        echo json_encode($data);
    }

    public function action_getCountOpp(){
        $seedOpp=new BOARD();
        echo $seedOpp->getCountOpp();
    }
    public function action_saveSattings(){
        require_once 'modules/BOARD/BOARD_USER_CONFIG.php';
        global $current_user;
        //getting dada settings from Selcted module
        $BoardUserConfig = new \SuiteCRM\Modules\BOARD\BOARD_USER_CONFIG($current_user);
        $BardConfigFromModule = $BoardUserConfig->getConfigFromModule($_REQUEST['config_module_name']);
        // ubdatting config data from selected module
        $BardConfigFromModule->stages = $_REQUEST['stage'];
        $BardConfigFromModule->stages_field =$_REQUEST['stages_field'];
        $stages = $_REQUEST['stage'];
        foreach($stages as $i => $field) {
            if (!isset($field['sortable'])){
                unset($stages[$i]);
            } else {
                unset($stages[$i]['sortable']);
            }
        }
        $BardConfigFromModule->stages = $stages;
        $mainFields = [];
        foreach($_REQUEST['mainFields'] as $i => $field) {
            if (isset($field['sort'])){
                $mainFields[]=$field['value'];
            }
        }
        $BardConfigFromModule->mainFields = $mainFields;
        $BardConfigFromModule->order_by = $_REQUEST['order_by_field'];
        $BardConfigFromModule->kanban = ['kanbandragHeight' => $_REQUEST['kanbandragHeight']];
        //Saving config

        $BoardUserConfig->saveBardConfigFromModule($_REQUEST['config_module_name'],$BardConfigFromModule);

        header("Location: index.php?module=BOARD&action=index&recipient_module={$_REQUEST['config_module_name']}");

    }

    public function action_getDataLimit(){
        $whereArr = $_REQUEST['where'];
        $limitIntervalMin = $_REQUEST['limitMin'];
        $limitIntervalMax = $_REQUEST['limitMax'];
        $seedOpp = new BOARD();
        $seedOpp->getDataOpp($whereArr,$limitIntervalMin,$limitIntervalMax);
    }

    public function action_saveModuleSettings()
    {
        global $mod_strings;
        require_once 'modules/BOARD/ConfigTables.php';
        $configTables = new \SuiteCRM\Modules\BOARD\ConfigTables();
        $moduleList=[];
        if(isset($_REQUEST['moduleList'])) {
            $moduleList =  $_REQUEST['moduleList'];
        }
            $configTables->setValue('BOARD', 'moduleList', $moduleList);
        header("Location: index.php?module=BOARD&action=moduleSettingsViews&message={$mod_strings['LBL_SAVE_SETTINGS']}");
    }

}