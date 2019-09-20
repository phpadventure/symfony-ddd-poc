<?php


namespace Infrastructure\Http\Models\Response;

use Psr\Http\Message\ResponseInterface;

interface ResponseParser
{
    public function parse(ResponseInterface $response);
}
