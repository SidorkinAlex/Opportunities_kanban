<?php

/**
 * Created by PhpStorm.
 * User: seedteam
 * Date: 14.10.20
 * Time: 18:49
 */
require_once 'modules/BOARD/BOARD_USER_CONFIG.php';

class boardSettingsView
{
    public $ss;
    public $seedUser;

    public function __construct($seedUser)
    {
        $this->ss = new Sugar_Smarty();
        $this->seedUser = $seedUser;

    }

    public function initions()
    {

    }

    public function display()
    {
        global $app_list_strings;
        global $current_language;
        global $current_user;
        /* начало нужно переработать */
        $seedBORD = new BOARD();
        $seedOpportunity = BeanFactory::newBean('Opportunities');
        $config = $seedBORD->getConfig();
        $list=$app_list_strings[$seedOpportunity->field_name_map['sales_stage']['options']];
        if(!empty($config['stages'])) {
            foreach ($config['stages'] as $row => $val_arr) {
                if (isset($list[$val_arr['name']])) {
                    $config['stages'][$row]['lbl'] = $app_list_strings[$seedOpportunity->field_name_map['sales_stage']['options']][$val_arr['name']];
                    unset($list[$val_arr['name']]);
                } else {
                    unset($config['stages'][$row]);
                }
            }
        }
        foreach ($list as $name => $val){
            $config['stages'][] = array(
                'lbl' => $val,
                'name' => $name,
            );
        }
        $fields =[];
        $option_fields=[];
        $module_strings = return_module_language($current_language, 'Opportunities');
        foreach ($seedOpportunity->field_name_map as $field_name => $field_arr){
            if(key_exists($field_arr['type'],['link',''])){
                continue;
            }
            $fields[]=$field_arr['name'];
            $option_fields[$field_arr['name']] = isset($module_strings[$field_arr['vname']]) ? $module_strings[$field_arr['vname']] : '';
        }
        /* конец нужно переработать */
        //start in work
        $BOARD_USER_CONFIG = new \SuiteCRM\Modules\BOARD\BOARD_USER_CONFIG($current_user);
        $BOARD_CONFIG = new \SuiteCRM\Modules\BOARD\BOARD_CONFIG();
        $moduleListKanban = $BOARD_CONFIG->getModulesList();
        $fieldListFromStages=[];
        $listFieldsBen = [];
        $orderByFields = [];
        foreach ($moduleListKanban as $modulename){
            $beanModule = BeanFactory::newBean($modulename);
            $module_labels = return_module_language($current_language, $beanModule->module_dir);
            foreach ($beanModule->field_defs as $field) {
                $listFieldsBen[$modulename][$field['name']] = isset($module_labels[$field['vname']]) ? $module_labels[$field['vname']] : '';
                if(
                    (!isset($field['source']) ||
                        (isset($field['source']) &&
                            $field['source'] != 'non-db')
                    )
                    && !empty($module_labels[$field['vname']])) {
                    $orderByFields[$modulename][$field['name']] = $module_labels[$field['vname']];
                }
                if($field['type'] == 'enum') {
                    $field_lbl = isset($module_labels[$field['vname']]) ? $module_labels[$field['vname']] : "";
                    $fieldListFromStages[$modulename][$field['name']] = ['name' => $field['name'], 'LBL' => $field_lbl, 'option' =>$field['options']];
                }
            }
        }
        $recipient_module = isset($_REQUEST['recipient_module'])? $_REQUEST['recipient_module'] : '';
        $this->ss->assign('orderByFields', $orderByFields);
        $this->ss->assign('listFieldsBen', $listFieldsBen);
        $this->ss->assign('moduleListKanban', $moduleListKanban);
        $this->ss->assign('moduleListKanbanHasConfig', array_keys($BOARD_USER_CONFIG->moduleConfigCollection));
        $this->ss->assign('moduleConfigCollection', $BOARD_USER_CONFIG->moduleConfigCollection);
        $this->ss->assign('activeModule', $recipient_module);
        $this->ss->assign('fieldListFromStages', $fieldListFromStages);
        $this->ss->assign('optionFields', $option_fields);
        //end in work
        $this->ss->assign('config', $config);
        $this->ss->assign('fieldNameMap', $fields);

        $html = $this->ss->fetch('modules/BOARD/tpl/SettingsPage.tpl');
        echo $html;
    }
}