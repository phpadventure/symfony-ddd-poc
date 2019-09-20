<?php

namespace Infrastructure\Http;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;

class GuzzleRequestFactory implements RequestFactoryInterface
{
    /**
     * @param $method
     * @param $uri
     * @param array $headers
     * @param null $body
     * @return RequestInterface
     */
    public function create($method, $uri, array $headers = [], $body = null): RequestInterface
    {
        return new Request($method, $uri, $headers, $body);
    }
}
