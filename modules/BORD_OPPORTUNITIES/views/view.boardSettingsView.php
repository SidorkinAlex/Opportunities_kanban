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
        $seedBORD = new BORD_OPPORTUNITIES();
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
        $this->ss->assign('config', $config);

        $html = $this->ss->fetch('modules/BORD_OPPORTUNITIES/tpl/SettingsPage.tpl');
        echo $html;
    }
}