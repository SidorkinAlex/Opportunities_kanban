<?php
$admin_option_defs = array(
    'Administration' => array(
        'kanban_board' => array(
            'Administration',
            'LBL_KANBAN_SETTINGS',
            'LBL_KANBAN_SETTINGS_DESCRIPTION',
            'index.php?module=BOARD&action=moduleSettingsViews',
            'kanban-board'
        ),
    ),
);

$admin_group_header[] = array('LBL_KANBAN_TITLE', '', false, $admin_option_defs, 'LBL_KANBAN_DESC');