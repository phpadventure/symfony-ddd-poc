<?php
/** @var $container ContainerBuilder */

use Infrastructure\Http\HttpClient;
use Symfony\Component\DependencyInjection\ContainerBuilder;

$container->register('httpClient', HttpClient::class)->setPublic(true)->setAutowired(true);
$container->setAlias(HttpClient::class, 'httpClient');