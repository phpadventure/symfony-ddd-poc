<?php


namespace Infrastructure\Http\Response;


use Psr\Http\Message\ResponseInterface;

interface ResponseParser
{
    public function parse(ResponseInterface $response) ;
}