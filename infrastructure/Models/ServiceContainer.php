<?php
namespace Infrastructure\Models;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

abstract class ServiceContainer extends ContainerBuilder
{
    /**
     * @var ContainerBuilder
     */
    private $applicationContainer;

    /**
     * ServiceContainer constructor.
     * @param Container $applicationContainer
     * @param ParameterBagInterface|null $parameterBag
     */
    public function __construct(Container $applicationContainer, ParameterBagInterface $parameterBag = null)
    {
        parent::__construct($parameterBag);
        $this->applicationContainer = $applicationContainer;
    }

    public function register($id, $class = null, $public = true)
    {
        return parent::register($id, $class)->setPublic($public);
    }

    public function getApplicationContainer(): Container
    {
        return $this->applicationContainer;
    }

    abstract public function init() : ServiceContainer;
}
