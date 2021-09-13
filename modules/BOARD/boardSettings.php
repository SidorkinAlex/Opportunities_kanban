<?php
/**
 * Created by PhpStorm.
 * User: seedteam
 * Date: 11.10.20
 * Time: 15:17
 */
require_once 'modules/BOARD/views/view.boardSettingsView.php';
global $current_user;

$seedOpp=new boardSettingsView($current_user);
$seedOpp->display();