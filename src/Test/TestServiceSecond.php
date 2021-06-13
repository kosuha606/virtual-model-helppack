<?php

namespace kosuha606\VirtualModelHelppack\Test;

class TestServiceSecond
{
    public static int $counter = 0;
    public string $name = '123';

    /**
     * TestServiceSecond constructor.
     */
    public function __construct()
    {
        self::$counter++;
    }
}
