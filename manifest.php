<?php
$manifest = array (
  0 => 
  array (
    'acceptable_sugar_versions' => 
    array (
      'exact_matches' => 
      array (
      ),
      'regex_matches' => 
      array (
        0 => '6\\.5\\.*',
        1 => '6\\.6\\.*',
        2 => '6\\.7\\.*',
        3 => '6\\.8\\.*',
      ),
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
  'version' => '1.0.0',
  'remove_tables' => 'prompt',
  'copy_files' => 
  array (
  ),
);

$installdefs = array (
  'id' => 'BOARD',
  'beans' => 
  array (
      'module' => 'BOARD_OPPORTUNITIES',
      'class' => 'BOARD_OPPORTUNITIES',
      'path' => 'modules/BOARD_OPPORTUNITIES/BOARD_OPPORTUNITIES.php',
      'tab' => true,
  ),
  'copy' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/custom',
      'to' => 'custom',
    ),
 1 => 
    array (
      'from' => '<basepath>/modules',
      'to' => 'modules',
    ),
  ),
  'language' => 
  array (
  ),
  'logic_hooks' => 
  array (
  ),
);
