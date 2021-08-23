<?php


namespace SuiteCRM\Modules\BOARD_OPPORTUNITIES;


class BOARD_USER_CONFIG
{
    public array $ModuleConfig;
    public function __construct(\User $user)
    {
        $this->ModuleConfig = $user->getPreference('bordConfUser');
    }


    public function getConfigFromModule(string $moduleKey):ModuleConfig
    {
        if(!empty($this->ModuleConfig[$moduleKey])
            && $this->ModuleConfig[$moduleKey] instanceof ModuleConfig){
            return $this->ModuleConfig[$moduleKey];
        }
        return new ModuleConfig;
    }

}