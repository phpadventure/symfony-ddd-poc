<?php


namespace Infrastructure;


use Infrastructure\Models\ServiceContainer;

abstract class BaseService
{
    private $container;

    public function __construct(ServiceContainer $container)
    {
        $this->container = $container;
    }

    public function getContainer() : ServiceContainer {
        return $this->container;
    }
}