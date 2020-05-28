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
        self::handleObservers('many', null, 'before');
        $result = parent::many($config, $indexBy);
        self::handleObservers('many', null, 'after');

        return $result;
    }

    public function save($config = [])
    {
        self::handleObservers('save', $this, 'before');
        $result = parent::save($config);
        self::handleObservers('save', $this, 'after');

        return $result;
    }

    public function delete()
    {
        self::handleObservers('delete', $this, 'before');
        $result = parent::delete();
        self::handleObservers('delete', $this, 'after');

        return $result;
    }

    public function __call($name, $inputArgs = [])
    {
        self::handleObservers($name, $this, 'before');
        $result = parent::__call($name, $inputArgs);
        self::handleObservers($name, $this, 'after');

        return $result;
    }

    public static function __callStatic($name, $inputArgs = [])
    {
        self::handleObservers($name, null, 'before');
        $result = parent::__callStatic($name, $inputArgs);
        self::handleObservers($name, null, 'after');

        return $result;
    }

    public static function handleObservers($name, $model = null, $prefix = '')
    {
        if ($prefix) {
            $name = $prefix.ucfirst($name);
        }

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