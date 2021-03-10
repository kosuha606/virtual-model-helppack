<?php

namespace kosuha606\VirtualModelHelppack;

use Psr\Container\ContainerInterface;
use DI\Container;
use DI\ContainerBuilder;

class ServiceManager implements ContainerInterface
{
    private static $instance;

    /** @var \DI\Container */
    private $container;

    public static function getInstance()
    {
        if (!self::$instance) {
            $className = static::class;
            self::$instance = new $className();
        }

        return self::$instance;
    }

    /**
     * @param string $id
     * @return mixed|string
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function get($id)
    {
        return $this->getContainer()->get($id);
    }

    /**
     * @param string $id
     * @return bool
     * @throws \Exception
     */
    public function has($id)
    {
        return $this->getContainer()->has($id);
    }

    /**
     * @throws \Exception
     * @return Container
     */
    public function getContainer()
    {
        if (!$this->container) {
            $this->setDefinitions([]);
        }

        return $this->container;
    }

    /**
     * @param array $definitions
     * @throws \Exception
     */
    public function setDefinitions(array $definitions)
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions($definitions);
        $this->container = $builder->build();
    }
}