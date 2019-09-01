<?php


namespace Infrastructure\Http\Response\Parsers;


use Infrastructure\Http\Response\JsonToArrayResponse\EmptyResponseArray;
use Infrastructure\Http\Response\JsonToArrayResponse\JsonResponseArray;
use Infrastructure\Http\Response\JsonToArrayResponse\RawResponseArray;
use Infrastructure\Http\Response\JsonToArrayResponse\ResponseArray;
use Infrastructure\Http\Response\ResponseParser;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class JsonToArrayResponseParser implements ResponseParser
{
    public const CONTENT_TYPE_JSON =  'application/json';

    public function parse(ResponseInterface $response) : array
    {
        return $this->createResponseArray($response)->getBody();
    }

    private function createResponseArray(ResponseInterface $response) : ResponseArray
    {
        if ($response->getStatusCode() == Response::HTTP_NO_CONTENT) {
            return new EmptyResponseArray($response);
        }

        if ($this->isJsonMeta($response)) {
            return new JsonResponseArray($response);
        }

        return new RawResponseArray($response);
    }

    private function isJsonMeta(ResponseInterface $response): bool
    {
        $contentType = $response->getHeader('Content-Type')[0] ?? '';

        return stripos($contentType, self::CONTENT_TYPE_JSON) !== false;
    }
}