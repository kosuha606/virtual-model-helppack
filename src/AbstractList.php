<?php

namespace kosuha606\VirtualModelHelppack;

use kosuha606\VirtualModel\VirtualModelEntity;

/**
 * Абстрактный список для виртуальных моделей
 */
abstract class AbstractList
{
    protected static AbstractList $instance;
    protected array $items;

    /**
     * @param array $items
     */
    private function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @param array $items
     * @return AbstractList
     */
    public static function getInstance(array $items): AbstractList
    {
        $className = static::class;
        self::$instance[$className] = new $className($items);

        return self::$instance[$className];
    }

    /**
     * @return array
     */
    public function asArray(): array
    {
        return VirtualModelEntity::allToArray($this->items);
    }

    /**
     * @return false|string
     */
    public function asJson()
    {
        return json_encode($this->asArray(), JSON_UNESCAPED_UNICODE);
    }

    /**
     * @return array
     */
    public function asObjects(): array
    {
        return $this->items;
    }
}
