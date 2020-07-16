<?php

namespace kosuha606\VirtualModelHelppack;

use kosuha606\VirtualModel\VirtualModelEntity;

/**
 * Абстрактный список для виртуальных моделей
 */

abstract class AbstractList
{
    protected static $instance;

    protected $items;

    private function __construct($items)
    {
        $this->items = $items;
    }

    /**
     * @param $items
     * @return AbstractList
     */
    public static function getInstance($items)
    {
        self::$instance[static::class] = new static($items);
        return self::$instance[static::class];
    }

    public function asArray()
    {
        $result = VirtualModelEntity::allToArray($this->items);

        return $result;
    }

    public function asJson()
    {
        return json_encode($this->asArray(), JSON_UNESCAPED_UNICODE);
    }

    public function asObjects()
    {
        return $this->items;
    }
}
