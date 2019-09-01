<?php

namespace Infrastructure\Http\Response;

use \Psr\Http\Message\ResponseInterface;

class ArrayParsedResponse
{
    private $parserStrategy;

    public function __construct(ResponseParser $parserStrategy)
    {
        $this->parserStrategy = $parserStrategy;
    }

    public function getParsedBody(ResponseInterface $response) : array
    {
        return $this->parserStrategy->parse($response);
    }
}