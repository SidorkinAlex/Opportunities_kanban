<?php


namespace SuiteCRM\Modules\BOARD;


class BOARD_CONFIG
{
    public function getModulesList():array{
        $configTables = new ConfigTables();
        return $configTables->getValue('BOARD','moduleList');
    }

    public function getActionFromAddJsMenu():array{
        return ['DetailView','index','EditView'];
    }

}