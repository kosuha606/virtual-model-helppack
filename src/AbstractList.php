<?php

namespace kosuha606\VirtualModelHelppack;

use kosuha606\VirtualModel\VirtualModelEntity;

/**
 * Абстрактный список для виртуальных моделей
 */
abstract class AbstractList
{
    protected static $instance;

    /** @var array */
    protected $items;

    /**
     * @param array $items
     */
    private function __construct($items)
    {
        $this->items = $items;
    }

    /**
     * @param array $items
     * @return AbstractList
     */
    public static function getInstance($items)
    {
        $className = static::class;
        self::$instance[$className] = new $className($items);

        return self::$instance[$className];
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
