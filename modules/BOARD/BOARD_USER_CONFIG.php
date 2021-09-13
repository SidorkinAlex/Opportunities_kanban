<?php


namespace SuiteCRM\Modules\BOARD;


class BOARD_USER_CONFIG
{
    public array $moduleConfigCollection = [];
    public \User $user;
    const USER_PREFERENCE_NAME = 'bordConfUser';
    public function __construct(\User $user)
    {
        $config = unserialize($user->getPreference(self::USER_PREFERENCE_NAME));

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

    public function saveBardConfigFromModule(string $config_module_name, ModuleConfig $BardConfigFromModule):void
    {
        $this->moduleConfigCollection[$config_module_name] = $BardConfigFromModule;
        $this->user->setPreference(self::USER_PREFERENCE_NAME,serialize($this->moduleConfigCollection));
    }

}