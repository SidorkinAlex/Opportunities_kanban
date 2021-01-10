<?php
$manifest = array (
    0 =>
        array (
            'acceptable_sugar_versions' =>
                array (
                    0 => '',
                ),
        ),
    1 =>
        array (
            'acceptable_sugar_flavors' =>
                array (
                    0 => 'CE',
                    1 => 'PRO',
                    2 => 'ENT',
                    3 => 'CORP',
                    4 => 'ULT',
                ),
        ),
    'readme' => '',
    'key' => 'BOARD',
    'author' => 'Alex Sidorkin',
    'description' => 'displaying opportunities in the kanban board',
    'icon' => '',
    'is_uninstallable' => true,
    'name' => 'Opportunities Board',
    'published_date' => '2020-08-216 09:10:55',
    'type' => 'module',
    'version' => '1.0.3',
    'remove_tables' => 'prompt',
);

$installdefs = array (
    'id' => 'BOARD',
    'beans' =>
        array (
            0 =>
                array (
                    'module' => 'BOARD_OPPORTUNITIES',
                    'class' => 'BOARD_OPPORTUNITIES',
                    'path' => 'modules/BOARD_OPPORTUNITIES/BOARD_OPPORTUNITIES.php',
                    'tab' => true,
                ),
        ),
    'layoutdefs' =>
        array (
        ),
    'relationships' =>
        array (
        ),
    'image_dir' => '<basepath>/icons',
    'copy' =>
        array (
            0 =>
                array (
                    'from' => '<basepath>/SugarModules/custom',
                    'to' => 'custom',
                ),
            1 =>
                array (
                    'from' => '<basepath>/SugarModules/modules/BOARD_OPPORTUNITIES',
                    'to' => 'modules/BOARD_OPPORTUNITIES',
                ),
        ),
    'language' =>
        array (
            0 =>
                array (
                    'from' => '<basepath>/SugarModules/language/application/en_us.lang.php',
                    'to_module' => 'application',
                    'language' => 'en_us',
                ),
        ),

);