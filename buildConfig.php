<?php
/**
 * Created by PhpStorm.
 * User: seedteam
 * Date: 06.01.21
 * Time: 19:56
 */
$path_arr_for_build = array(
    1 => array(
        'from' => 'modules/BOARD_OPPORTUNITIES/',
        'to' => 'SugarModules/modules/BOARD_OPPORTUNITIES/',
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
);

return $path_arr_for_build;
