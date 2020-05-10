<?php

namespace kosuha606\VirtualModelHelppack\Test;

class TestService
{
    public static $counter = 0;

    public static $instance;

    public $name = 'hello';

    public $fromWhere = '';

    private function __construct()
    {
        self::$counter++;
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new static();
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