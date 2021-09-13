<?php


namespace SuiteCRM\Modules\BOARD;


use mysql_xdevapi\Exception;

class ConfigTables
{
    public $category;
    public $name;
    private array $value=[];
    public string $tablename = 'config';

    public function getValue(string $category_name = '', string $name = ''):array
    {
        $this->value = (array)get_register_value($category_name,$name);
        if(empty($this->value)) {
            global $db;
            $sql = "
        SELECT `value`
        FROM `config`
        WHERE
        `category` = '{$category_name}'
        AND `name` = '{$name}'
        ";
            try {
                $this->value = (array)json_decode(base64_decode($db->getOne($sql, 1)), 1);
            } catch (\Exception $e) {
                throw new \SuiteCRM\Exception\Exception("non valide json in table config `category` = '{$category_name} and'name` = '{$name}'", 500);
            }
            set_register_value($category_name, $name, $this->value);
        }
        return $this->value;
    }

    public function setValue(string $category_name = '', string $name = '', array $value = [])
    {
        clear_register_value($category_name,$name);
        global $db;
        $this->value = $value;
        $set_value = base64_encode(json_encode($this->value));
        $sql = "
        DELETE
        FROM {$this->tablename}
        WHERE
        `category` = '{$category_name}'
        AND `name` = '{$name}'
        ";
        $db->query($sql);
        $sql = "INSERT {$this->tablename}
                    SET `value` = '{$set_value}',
                    `category` = '{$category_name}',
                    `name` = '{$name}'
                    ";
        $db->query($sql, 1);
    }
}