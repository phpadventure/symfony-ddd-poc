<?php
namespace Infrastructure\Models;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

abstract class ServiceContainer extends ContainerBuilder
{
    /**
     * @var ContainerBuilder
     */
    private $applicationContainer;

    /**
     * Based as mediator pattern, application container will know about all other context service
     * and give ability to communicate through DI between service contexts
     * ServiceContainer constructor.
     * @param ContainerBuilder $applicationContainer
     * @param ParameterBagInterface|null $parameterBag
     */
    public function __construct(ContainerBuilder $applicationContainer, ParameterBagInterface $parameterBag = null)
    {
        parent::__construct($parameterBag);
        $this->applicationContainer = $applicationContainer;
    }

    public function register($id, $class = null, $public = true)
    {
        return parent::register($id, $class)->setPublic($public);
    }

    public function getApplicationContainer(): ContainerBuilder
    {
        return $this->applicationContainer;
    }

    abstract public function init() : void;
}