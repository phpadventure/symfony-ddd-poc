<?php

namespace Infrastructure\Models\Http\Response;

use Infrastructure\Http\Response\ResponseParser;
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