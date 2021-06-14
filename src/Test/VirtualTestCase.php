<?php

namespace kosuha606\VirtualModelHelpers\Test;

use Exception;
use kosuha606\VirtualModel\Example\MemoryModelProvider;
use kosuha606\VirtualModel\VirtualModelManager;
use PHPUnit\Framework\TestCase;

abstract class VirtualTestCase extends TestCase
{
    public MemoryModelProvider $provider;

    /**
     * @throws Exception
     */
    public function setUp()
    {
        $this->provider = new MemoryModelProvider();
        VirtualModelManager::getInstance()->setProvider($this->provider);
    }

    public function tearDown(): void
    {
        unset($this->provider);
    }
}
