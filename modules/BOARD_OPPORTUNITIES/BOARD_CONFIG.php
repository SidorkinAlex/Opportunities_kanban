<?php


namespace SuiteCRM\Modules\BOARD_OPPORTUNITIES;


class BOARD_CONFIG
{
    public function getModulesList():array{
        $configTables = new ConfigTables();
        return $configTables->getValue('BOARD_OPPORTUNITIES','moduleList');
    }

    public function getActionFromAddJsMenu():array{
        return ['DetailView','index','EditView'];
    }

}