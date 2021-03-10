<?php

namespace kosuha606\VirtualModelHelppack\Test;

class TestService
{
    /**
     * @var int
     */
    public static $counter = 0;

    /**
     * @var static
     */
    public static $instance;

    /**
     * @var string
     */
    public $name = 'hello';

    /**
     * @var string
     */
    public $fromWhere = '';

    /**
     * TestService constructor.
     */
    private function __construct()
    {
        self::$counter++;
    }

    /**
     * @return TestService
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            $className = static::class;
            self::$instance = new $className();
        }

        return self::$instance;
    }

    /**
     * @return string
     */
    public function getFromWhere(): string
    {
        return $this->fromWhere;
    }

    /**
     * @param string $fromWhere
     * @return TestService
     */
    public function setFromWhere(string $fromWhere)
    {
        $this->fromWhere = $fromWhere;

        return $this;
    }
}
