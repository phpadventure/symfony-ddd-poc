<?php

namespace Infrastructure\Models\Http\Response;

use \Psr\Http\Message\ResponseInterface;

abstract class ParsedResponse
{
    private $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public abstract function getParsedBody();
}