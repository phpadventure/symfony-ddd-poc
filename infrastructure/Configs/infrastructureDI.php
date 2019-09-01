<?php
/** @var $container ContainerBuilder */

use Infrastructure\Http\HttpClient;
use Infrastructure\Http\GuzzleRequestFactory;
use Infrastructure\Http\RequestFactoryInterface;
use Infrastructure\Http\Models\Response\Parsers\JsonToArrayResponseParser;
use Infrastructure\Http\Models\Response\ArrayParsedResponse;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

$container->register('httpClient', HttpClient::class)->setPublic(true)->setAutowired(true);
$container->setAlias(HttpClient::class, 'httpClient');

$container->register('requestFactory', GuzzleRequestFactory::class)->setPublic(true)->setAutowired(true);
$container->setAlias(RequestFactoryInterface::class, 'requestFactory');

$container->register('JsonToArrayResponseParser', JsonToArrayResponseParser::class);

$container->register('jsonToArrayParsedResponse', ArrayParsedResponse::class)
    ->setArgument('$parserStrategy', new Reference('JsonToArrayResponseParser'))
    ->setPublic(true);
