<?php

namespace kosuha606\VirtualModelHelpers\Test;

class TestService
{
    public static int $counter = 0;
    public static ?TestService $instance = null;
    public string $name = 'hello';
    public string $fromWhere = '';

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
    public static function getInstance(): TestService
    {
        if (!self::$instance) {
            $className = static::class;
            self::$instance = new $className();
        }

        return self::$instance;
    }

    /**
     * @return string
     * @noinspection PhpUnused
     */
    public function getFromWhere(): string
    {
        return $this->fromWhere;
    }

    /**
     * @param string $fromWhere
     * @return TestService
     * @noinspection PhpUnused
     */
    public function setFromWhere(string $fromWhere): TestService
    {
        $this->fromWhere = $fromWhere;

        return $this;
    }
}
