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
  'key' => 'CRST',
  'author' => 'Alex Sidorkin',
  'description' => 'Run reports on a schedule as a user and not as an administrator',
  'icon' => '',
  'is_uninstallable' => true,
  'name' => 'Custom Scheduled reports task',
  'published_date' => '2020-08-216 09:10:55',
  'type' => 'module',
  'version' => '1.0.0',
  'remove_tables' => 'prompt',
  'copy_files' => 
  array (
    'from_dir' => 'custom',
  ),
);

$installdefs = array (
  'id' => 'CRST',
  'beans' => 
  array (
  ),
  'copy' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/custom',
      'to' => 'custom',
    ),
  ),
  'language' => 
  array (
  ),
  'logic_hooks' => 
  array (
  ),
);
