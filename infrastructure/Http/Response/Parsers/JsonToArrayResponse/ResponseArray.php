<?php


namespace Infrastructure\Http\Response\Parsers\JsonToArrayResponse;


use Psr\Http\Message\ResponseInterface;

abstract class ResponseArray
{
    private $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    abstract public function getBody() : array ;

    protected function getResponse() : ResponseInterface
    {
        return $this->response;
    }
}