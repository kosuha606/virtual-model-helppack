<?php

namespace kosuha606\VirtualModelHelppack\Test;

class TestServiceSecond
{
    /**
     * @var int
     */
    public static $counter = 0;

    /**
     * @var string
     */
    public $name = '123';

    /**
     * TestServiceSecond constructor.
     */
    public function __construct()
    {
        self::$counter++;
    }
}
