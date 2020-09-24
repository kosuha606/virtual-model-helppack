<?php

use kosuha606\VirtualModelHelppack\Event\Event;
use kosuha606\VirtualModelHelppack\Event\EventService;
use kosuha606\VirtualModelHelppack\ServiceManager;
use PHPUnit\Framework\TestCase;

class EventTest extends TestCase
{
    /**
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function testPriority()
    {
        $eventService = ServiceManager::getInstance()->get(EventService::class);
        $result = '';

        $eventService->on('test_event', function($event) use (&$result) {
            $result .= '2';
        }, 2);

        $eventService->on('test_event', function($event) use (&$result) {
            $result .= '1';
        }, 1);

        $eventService->trigger(new Event('test_event', $this, []));

        $this->assertEquals('12', $result);
    }
}