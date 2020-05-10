<?php

namespace kosuha606\VirtualModelHelppack\Test;

use kosuha606\VirtualModel\Example\MemoryModelProvider;
use kosuha606\VirtualModel\VirtualModelManager;
use PHPUnit\Framework\TestCase;

abstract class VirtualTestCase extends TestCase
{
    /** @var MemoryModelProvider */
    public $provider;

    public function setUp()
    {
        $this->provider = new MemoryModelProvider();
        VirtualModelManager::getInstance()->setProvider($this->provider);
    }

    public function tearDown()
    {
        unset($this->provider);
    }
}
