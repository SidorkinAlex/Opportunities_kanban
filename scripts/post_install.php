<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.11.20
 * Time: 18:37
 */
$cfg = new Configurator();
$cfg->config['addAjaxBannedModules'][] = 'BOARD_OPPORTUNITIES';
$cfg->saveConfig();