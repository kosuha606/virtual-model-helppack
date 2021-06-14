<?php

namespace kosuha606\VirtualModelHelpers;

use DI\DependencyException;
use DI\NotFoundException;
use Exception;
use Psr\Container\ContainerInterface;
use DI\Container;
use DI\ContainerBuilder;

class ServiceManager implements ContainerInterface
{
    private static ?ServiceManager $instance = null;
    private Container $container;

    /**
     * @return ServiceManager
     */
    public static function getInstance(): ServiceManager
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
     * @throws DependencyException
     * @throws NotFoundException
     * @throws Exception
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function get(string $id)
    {
        return $this->getContainer()->get($id);
    }

    /**
     * @param string $id
     * @return bool
     * @throws Exception
     */
    public function has(string $id): bool
    {
        return $this->getContainer()->has($id);
    }

    /**
     * @throws Exception
     * @return Container
     */
    public function getContainer(): Container
    {
        if (!$this->container) {
            $this->setDefinitions([]);
        }

        return $this->container;
    }

    /**
     * @param array $definitions
     * @throws Exception
     */
    public function setDefinitions(array $definitions)
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions($definitions);
        $this->container = $builder->build();
    }
}
