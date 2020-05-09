<?php

namespace kosuha606\VirtualModelHelppack;

use Psr\Container\ContainerInterface;
use DI\Container;

class ServiceManager implements ContainerInterface
{
    private static $instance;

    /** @var \DI\Container */
    private $container;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new static();
            self::$instance->container = new Container();
        }

        return self::$instance;
    }

    public function get($id)
    {
        return $this->container->get($id);
    }

    public function has($id)
    {
        return $this->container->has($id);
    }

}