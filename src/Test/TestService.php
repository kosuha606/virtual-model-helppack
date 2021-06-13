<?php

namespace kosuha606\VirtualModelHelppack\Test;

class TestService
{
    public static int $counter = 0;
    public static TestService $instance;
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
     */
    public function getFromWhere(): string
    {
        return $this->fromWhere;
    }

    /**
     * @param string $fromWhere
     * @return TestService
     */
    public function setFromWhere(string $fromWhere): TestService
    {
        $this->fromWhere = $fromWhere;

        return $this;
    }
}
