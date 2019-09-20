<?php
namespace Infrastructure\Mappers;

use Infrastructure\Exceptions\BaseHttpException;
use Infrastructure\Exceptions\InfrastructureException;
use Infrastructure\Factories\BaseFactory;
use Infrastructure\Http\Exceptions\IllegalHeaderValueException;
use Infrastructure\Http\Models\Headers;
use Infrastructure\Http\Models\UrlRender;
use Infrastructure\Http\RequestFactoryInterface;
use Infrastructure\Models\ArraySerializable;
use Infrastructure\Models\Collection;
use Infrastructure\Http\HttpClient;
use Infrastructure\Http\Models\Response\ArrayParsedResponse;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class HttpJsonMapper extends BaseMapper
{
    public const GET = 'GET';
    public const POST = 'POST';
    public const PUT = 'PUT';
    public const PATCH = 'PATCH';
    public const DELETE = 'DELETE';

    public const DEFAULT_HEADERS = 'defaultHeaders';
    public const ENDPOINTS = 'endpoints';


    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var BaseFactory
     */
    private $factory;

    /**
     * @var Headers
     */
    private $defaultHeaders;

    /**
     * @var RequestFactoryInterface
     */
    private $requestFactory;

    /**
     * @var array
     */
    private $config;

    /**
     * @var ArrayParsedResponse
     */
    private $parsedResponse;

    /**
     * @var UrlRender
     */
    private $urlRender;


    /**
     * HttpJsonMapper constructor.
     * @param array $httpMapperConfig
     * @param HttpClient $httpClient
     * @param RequestFactoryInterface $requestFactory
     * @param ArrayParsedResponse $parsedResponse
     * @param BaseFactory $factory
     * @throws IllegalHeaderValueException
     */
    public function __construct(
        array $httpMapperConfig,
        HttpClient $httpClient,
        RequestFactoryInterface $requestFactory,
        ArrayParsedResponse $parsedResponse,
        BaseFactory $factory
    ) {
        $this->httpClient = $httpClient;
        $this->requestFactory = $requestFactory;
        $this->factory = $factory;
        $this->parsedResponse = $parsedResponse;
        $this->config = $httpMapperConfig;
        $this->defaultHeaders = new Headers(
            array_merge(
                ['Content-type' => 'application/json'],
                $httpMapperConfig[self::DEFAULT_HEADERS] ?? []
            )
        );
        $this->urlRender = new UrlRender($httpMapperConfig[self::ENDPOINTS]);
    }

    /**
     * @param array $objectData
     * @return ArraySerializable
     */
    protected function buildObject(array $objectData) : ArraySerializable
    {
        return $this->factory()->create($objectData);
    }

    /**
     * @param $method
     * @param $uri
     * @param array $headers
     * @param array $body
     * @return RequestInterface
     */
    protected function createRequest(string $method, string $uri, array $headers = [], array $body = [])
    {
        return $this->requestFactory()->create(
            $method,
            $uri,
            $headers,
            (count($body) ? json_encode($body) : null)
        );
    }

    /**
     * @param RequestInterface $request
     * @return RequestInterface
     * @throws IllegalHeaderValueException
     */
    protected function mergeDefaultData(RequestInterface $request)
    {
        return $this->createRequest(
            $request->getMethod(),
            $request->getUri(),
            $this->defaultHeaders()->merge(new Headers($request->getHeaders()))->toArray(),
            (($body = json_decode($request->getBody()->getContents(), true)) ? $body : [])
        );
    }

    /**
     * @return ArrayParsedResponse
     */
    protected function parsedResponse(): ArrayParsedResponse
    {
        return $this->parsedResponse;
    }

    /**
     * @param $urlIdentifier
     * @param array $urlParams
     * @param array $query
     * @param array $headers
     * @return ArraySerializable
     * @throws InfrastructureException
     * @throws BaseHttpException
     */
    public function get($urlIdentifier, array $urlParams, array $query = [], array $headers = [])
    {
        return $this->sendRequestForEntity(
            $this->createRequest(self::GET, $this->urlRender()->build($urlIdentifier, $urlParams, $query), $headers)
        );
    }

    /**
     * @param $urlIdentifier
     * @param array $urlParams
     * @param array $query
     * @param array $headers
     * @return Collection
     * @throws InfrastructureException
     * @throws BaseHttpException
     */
    public function load($urlIdentifier, array $urlParams, array $query = [], array $headers = []): Collection
    {
        return $this->sendRequestForCollection(
            $this->createRequest(
                self::GET,
                $this->urlRender()->build($urlIdentifier, $urlParams, $query),
                $headers
            )
        );
    }

    /**
     * @param $urlIdentifier
     * @param array $urlParams
     * @param array $objectData
     * @param array $headers
     * @return ArraySerializable
     * @throws InfrastructureException
     * @throws BaseHttpException
     */
    public function post($urlIdentifier, array $urlParams, array $objectData, array $headers = [])
    {
        return $this->sendRequestForEntity(
            $this->createRequest(self::POST, $this->urlRender()->build($urlIdentifier, $urlParams), $headers, $objectData)
        );
    }

    /**
     * @param $urlIdentifier
     * @param array $urlParams
     * @param array $objectData
     * @param array $headers
     * @return ArraySerializable
     * @throws InfrastructureException
     * @throws BaseHttpException
     * @throws \Infrastructure\Models\Http\IllegalHeaderValueException
     */
    public function put($urlIdentifier, array $urlParams, array $objectData, array $headers = [])
    {
        return $this->sendRequestForEntity(
            $this->createRequest(self::PUT, $this->urlRender()->build($urlIdentifier, $urlParams), $headers, $objectData)
        );
    }

    /**
     * @param $urlIdentifier
     * @param array $urlParams
     * @param array $objectData
     * @param array $headers
     * @return ArraySerializable
     * @throws InfrastructureException
     * @throws BaseHttpException
     */
    public function patch($urlIdentifier, array $urlParams, array $objectData, array $headers = [])
    {
        return $this->sendRequestForEntity(
            $this->createRequest(self::PATCH, $this->urlRender()->build($urlIdentifier, $urlParams), $headers, $objectData)
        );
    }

    /**
     * @param $urlIdentifier
     * @param array $urlParams
     * @param array $query
     * @param array $headers
     * @return bool
     * @throws InfrastructureException
     * @throws BaseHttpException
     */
    public function delete($urlIdentifier, array $urlParams, array $query = [], array $headers = []): bool
    {
        $this->sendRequest($this->createRequest(
            self::DELETE,
            $this->urlRender()->build($urlIdentifier, $urlParams, $query),
            $headers
        ));

        return true;
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws InfrastructureException
     * @throws BaseHttpException
     * @throws IllegalHeaderValueException
     */
    protected function sendRequest(RequestInterface $request) : ResponseInterface
    {
        return $this->httpClient()->send($this->mergeDefaultData($request));
    }

    /**
     * @param RequestInterface $request
     * @return ArraySerializable
     * @throws InfrastructureException
     * @throws BaseHttpException
     * @throws IllegalHeaderValueException
     */
    protected function sendRequestForEntity(RequestInterface $request): ArraySerializable
    {
        return $this->buildObject(
            $this->parsedResponse()->getParsedBody(
                $this->sendRequest($request)
            )
        );
    }

    /**
     * @param RequestInterface $request
     * @return Collection
     * @throws InfrastructureException
     * @throws BaseHttpException
     * @throws IllegalHeaderValueException
     */
    protected function sendRequestForCollection(RequestInterface $request): Collection
    {
        return $this->buildCollection(
            $this->parsedResponse()->getParsedBody($this->sendRequest($request))
        );
    }

    protected function urlRender()
    {
        return $this->urlRender;
    }

    /**
     * @return HttpClient
     */
    protected function httpClient()
    {
        return $this->httpClient;
    }

    /**
     * @return array
     */
    protected function config()
    {
        return $this->config;
    }

    /**
     * @return BaseFactory
     */
    protected function factory(): BaseFactory
    {
        return $this->factory;
    }

    /**
     * @return Headers
     */
    protected function defaultHeaders(): Headers
    {
        return $this->defaultHeaders;
    }

    /**
     * @return RequestFactoryInterface
     */
    protected function requestFactory(): RequestFactoryInterface
    {
        return $this->requestFactory;
    }
}
