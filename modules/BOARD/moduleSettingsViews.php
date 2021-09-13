<?php
global $current_user;
require_once "modules/BOARD/views/view.moduleSettings.php";
$view = new ModuleSettings($current_user,$_REQUEST);
$view->display();