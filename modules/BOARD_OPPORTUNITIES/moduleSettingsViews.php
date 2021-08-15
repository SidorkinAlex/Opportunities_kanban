<?php
global $current_user;
require_once "modules/BOARD_OPPORTUNITIES/views/view.moduleSettings.php";
$view = new ModuleSettings($current_user);
$view->display();