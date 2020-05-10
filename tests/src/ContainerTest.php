<?php

use kosuha606\VirtualModelHelppack\ServiceManager;
use kosuha606\VirtualModelHelppack\Test\TestService;
use kosuha606\VirtualModelHelppack\Test\TestServiceSecond;
use PHPUnit\Framework\TestCase;

class ContainerTest extends TestCase
{
    public function testContainer()
    {
        $testService1 = ServiceManager::getInstance()->get(TestService::class);
        $testService2 = ServiceManager::getInstance()->get(TestService::class);

        $this->assertEquals($testService1, $testService2);
        $this->assertEquals(1, TestService::$counter);
        $this->assertEquals('definitions', $testService2->getFromWhere());
    }

    /**
     * По умолчанию работает как синглтон
     */
    public function testDifferentObj()
    {
        $test1 = ServiceManager::getInstance()->get(TestServiceSecond::class);
        $test2 = ServiceManager::getInstance()->get(TestServiceSecond::class);
        $test3 = ServiceManager::getInstance()->get(TestServiceSecond::class);
        $test4 = ServiceManager::getInstance()->get(TestServiceSecond::class);
        $test5 = ServiceManager::getInstance()->get(TestServiceSecond::class);

        $this->assertEquals(1, TestServiceSecond::$counter);
    }
}