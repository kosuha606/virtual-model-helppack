<?php

namespace kosuha606\VirtualModelHelppack\Test;

class TestServiceSecond
{
    public static $counter = 0;

    public $name = '123';

    public function __construct()
    {
        self::$counter++;
    }
}