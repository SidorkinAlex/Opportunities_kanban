<?php


namespace SuiteCRM\Modules\BOARD;


class ModuleConfig
{
    public array $stages;
    public string $stages_field;
    public string $order_by;
    public array $kanban;
    public array $mainFields;

    public function getValueArray() :array
    {
        return [
            'stages' => $this->stages,
            'stages_field' => $this->stages_field,
            'order_by' => $this->order_by,
            'kanban' => $this->kanban,
            'mainFields' => $this->mainFields,
        ];
    }

}