<?php


namespace Infrastructure;


use Symfony\Component\DependencyInjection\ContainerBuilder;

abstract class ServiceContainer extends ContainerBuilder
{
    public function register($id, $class = null, $public = true)
    {
        return parent::register($id, $class)->setPublic($public);
    }

    abstract public function init() : void;
}