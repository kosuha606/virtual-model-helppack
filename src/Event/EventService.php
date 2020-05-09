<?php

namespace kosuha606\VirtualModelHelppack\Event;

class EventService
{
    protected static $listeners = [];

    /**
     * @param Event $event
     */
    public function trigger($event)
    {
        if (isset(self::$listeners[$event->getName()])) {
            $listeners = self::$listeners[$event->getName()];
            foreach ($listeners as $listener) {
                call_user_func($listener[2], $event);
            }
        }
    }

    /**
     * @param $eventName
     * @param callable $callable
     * @param int $priority
     */
    public function on($eventName, callable $callable, $priority = 100)
    {
        if (!isset(self::$listeners[$eventName])) {
            self::$listeners[$eventName] = [];
        }

        self::$listeners[$eventName][] = [$priority, get_called_class(), $callable];
        uasort(
            self::$listeners[$eventName],
            function ($a, $b) {
                if ($a[0] == $b[0]) {
                    return 0;
                }

                return $a[0] < $b[0] ? -1 : 1;
            }
        );
    }

    /**
     * @return array
     */
    public function getListeners()
    {
        return self::$listeners;
    }

    /**
     * @param array $listeners
     */
    public function setListeners(array $listeners)
    {
        self::$listeners = $listeners;
    }

}
