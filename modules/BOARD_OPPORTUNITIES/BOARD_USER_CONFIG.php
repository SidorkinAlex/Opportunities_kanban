<?php


namespace SuiteCRM\Modules\BOARD_OPPORTUNITIES;


class BOARD_USER_CONFIG
{
    public array $moduleConfigCollection = [];
    public \User $user;
    public function __construct(\User $user)
    {
        $config = unserialize($user->getPreference('bordConfUser'));

        if(!empty($config) && is_array($config) ){
            $this->moduleConfigCollection = $config;
        }
        $this->user = $user;
    }


    public function getConfigFromModule(string $moduleKey):ModuleConfig
    {
        if(!empty($this->moduleConfigCollection[$moduleKey])
            && $this->moduleConfigCollection[$moduleKey] instanceof ModuleConfig){
            return $this->moduleConfigCollection[$moduleKey];
        }
        return new ModuleConfig;
    }

    public function setConfigFromModule(string $moduleKey,ModuleConfig $moduleConfig){
        $this->moduleConfigCollection[$moduleKey]=$moduleConfig;
        $this->saveConfig();
    }

    private function saveConfig()
    {
        $this->user->setPreference('bordConfUser',serialize($this->moduleConfigCollection));
    }

}