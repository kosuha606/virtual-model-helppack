<?php

/** @noinspection PhpUndefinedClassInspection */

namespace kosuha606\VirtualModelHelpers\Traits;

trait ObserveVMTrait
{
    private static array $registeredObservers = [];

    /**
     * @return array
     */
    public static function observers(): array
    {
        return [];
    }

    /**
     * @param array $config
     * @return mixed
     */
    public static function one($config = [])
    {
        return parent::one($config);
    }

    /**
     * @param array $config
     * @param null $indexBy
     * @return mixed
     */
    public static function many($config = [], $indexBy = null)
    {
        self::handleObservers('many', null, 'before');
        $result = parent::many($config, $indexBy);
        self::handleObservers('many', null, 'after');

        return $result;
    }

    /**
     * @param array $config
     * @return mixed
     */
    public function save($config = [])
    {
        self::handleObservers('save', $this, 'before');
        $result = parent::save($config);
        self::handleObservers('save', $this, 'after');

        return $result;
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        self::handleObservers('delete', $this, 'before');
        $result = parent::delete();
        self::handleObservers('delete', $this, 'after');

        return $result;
    }

    /**
     * @param string $name
     * @param array $inputArgs
     * @return mixed
     */
    public function __call(string $name, array $inputArgs = [])
    {
        self::handleObservers($name, $this, 'before');
        $result = parent::__call($name, $inputArgs);
        self::handleObservers($name, $this, 'after');

        return $result;
    }

    /**
     * @param $name
     * @param array $inputArgs
     * @return mixed
     */
    public static function __callStatic(string $name, array $inputArgs = [])
    {
        self::handleObservers($name, null, 'before');
        $result = parent::__callStatic($name, $inputArgs);
        self::handleObservers($name, null, 'after');

        return $result;
    }

    /**
     * @param string $name
     * @param null $model
     * @param string $prefix
     */
    public static function handleObservers(string $name, $model = null, $prefix = '')
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
