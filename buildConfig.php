<?php
/**
 * Created by PhpStorm.
 * User: seedteam
 * Date: 06.01.21
 * Time: 19:56
 */
$path_arr_for_build = array(
    1 => array(
        'from' => 'modules/BOARD/',
        'to' => 'SugarModules/modules/BOARD/',
    ),
    2 => array(
        'from' => 'custom/include/lib/jkanban/',
        'to' => 'SugarModules/custom/include/lib/jkanban/',
    ),
    3 => array(
        'from' => 'custom/Extension/application/Ext/Language/en_us.BORD.php',
        'to' => 'SugarModules/language/application/en_us.lang.php',
    ),
    4 => array(
        'from' => 'scripts/',
        'to' => 'scripts/',
    ),
    5 => array(
        'from' => 'custom/themes/default/images',
        'to' => 'icons/default/images/',
    ),
    6 => array(
        'from' => 'custom/themes/SuiteP/',
        'to' => 'SugarModules/custom/themes/SuiteP/',
    ),
    7 => array(
        'from' => 'LICENSE.txt',
        'to' => 'LICENSE.txt',
    ),
    8 => array(
        'from' => 'manifest.php',
        'to' => 'manifest.php',
    ),
    9 => array(
        'from' => 'custom/Extension/modules/Administration/Ext',
        'to' => 'SugarModules/custom/Extension/modules/Administration/Ext',
    ),
    10 => array(
        'from' => 'custom/include/lib/bootstrap_select',
        'to' => 'SugarModules/custom/include/lib/bootstrap_select/',
    ),
    11 => array(
        'from' => 'custom/Extension/application/Ext/LogicHooks/BOARD_Kanban_Board_JS_UI_HOOK.php',
        'to' => 'SugarModules/custom/Extension/application/Ext/LogicHooks/BOARD_Kanban_Board_JS_UI_HOOK.php',
    ),
    12 => array(
        'from' => 'custom/include/language/en_us.lang.php',
        'to' => 'SugarModules/custom/include/language/en_us.lang.php',
    ),
);

return $path_arr_for_build;
