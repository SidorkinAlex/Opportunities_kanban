<?php

/**
 * Created by PhpStorm.
 * User: seedteam
 * Date: 14.10.20
 * Time: 18:49
 */
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
        $seedBORD = new BOARD_OPPORTUNITIES();
        $seedOpportunity = BeanFactory::newBean('Opportunities');
        $config = $seedBORD->getConfig();
        $list=$app_list_strings[$seedOpportunity->field_name_map['sales_stage']['options']];
        foreach ($config['stages'] as $row => $val_arr ){
            if(isset($list[$val_arr['name']])) {
                $config['stages'][$row]['lbl'] = $app_list_strings[$seedOpportunity->field_name_map['sales_stage']['options']][$val_arr['name']];
                unset($list[$val_arr['name']]);
            } else {
                unset($config['stages'][$row]);
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
            $option_fields[$field_arr['name']] = $module_strings[$field_arr['vname']];
        }
        $this->ss->assign('optionFilds', $option_fields);
        $this->ss->assign('config', $config);
        $this->ss->assign('fieldNameMap', $fields);

        $html = $this->ss->fetch('modules/BOARD_OPPORTUNITIES/tpl/SettingsPage.tpl');
        echo $html;
    }
}