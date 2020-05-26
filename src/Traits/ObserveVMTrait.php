<?php

namespace kosuha606\VirtualModelHelppack\Traits;

/**
 * Этот трейт необходим для привяки наблюдателей к моделям
 */
trait ObserveVMTrait
{
    private static $registeredObservers = [];

    abstract public static function observers();

    public static function one($config = [])
    {
        return parent::one($config);
    }

    public static function many($config = [], $indexBy = null)
    {
        self::handleObservers('many');
        return parent::many($config, $indexBy);
    }

    public function save($config = [])
    {
        self::handleObservers('save', $this);
        return parent::save($config);
    }

    public function delete()
    {
        self::handleObservers('delete', $this);
        parent::delete();
    }

    public function __call($name, $inputArgs = [])
    {
        self::handleObservers($name, $this);
        return parent::__call($name, $inputArgs);
    }

    public static function __callStatic($name, $inputArgs = [])
    {
        return parent::__callStatic($name, $inputArgs);
    }

    public static function handleObservers($name, $model = null)
    {
        $observers = self::observers();

        foreach ($observers as $observer) {
            if (!isset(self::$registeredObservers[parent::class][$observer])) {
                self::$registeredObservers[parent::class][$observer] = new $observer();
            }

            if (is_callable([self::$registeredObservers[parent::class][$observer], $name])) {
                self::$registeredObservers[parent::class][$observer]->$name($model);
            }
        }
    }

}