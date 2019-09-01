<?php


namespace Infrastructure\Http\Response;


use Infrastructure\Models\Http\Response\ArrayParsedResponse;
use Infrastructure\Models\Http\Response\EmptyResponseArray;
use Infrastructure\Models\Http\Response\JsonResponseArray;
use Infrastructure\Models\Http\Response\RawResponseArray;
use Infrastructure\Models\Http\Response\ResponseContentTypeException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class JsonToArrayResponseParser implements ResponseParser
{
    public function parse(ResponseInterface $response) : array
    {
    }


    /**
     * @param PsrResponseInterface $response
     * @return ArrayParsedResponse
     */
    public function createFromResponse(PsrResponseInterface $response): ArrayParsedResponse
    {
        $contentType = $response->getHeader('Content-Type')[0] ?? '';

        if ($response->getStatusCode() == Response::HTTP_NO_CONTENT) {
            return new EmptyResponseArray($response);
        }

        foreach ($this->getContentTypeResponseMap($response) as $allowedContentType => $creatorResponse) {
            if ($this->isAllowedContentType($contentType, $allowedContentType)) {
                return $creatorResponse($response);
            }
        }

        return new RawResponseArray($response);
    }

    /**
     * @param PsrResponseInterface $response
     * @return array
     */
    private function getContentTypeResponseMap(PsrResponseInterface $response)
    {
        return [
            ResponseInterface::CONTENT_TYPE_JSON => function() use($response) {
                return $this->createJsonResponse($response);
            },
            ResponseInterface::CONTENT_TYPE_XML => function() use($response) {
                return $this->createXmlResponse($response);
            },
        ];
    }

    private function isAllowedContentType(string $contentType, $allowedContentType): bool
    {
        return stripos($contentType, $allowedContentType) !== false;
    }

    /**
     * @param PsrResponseInterface $response
     * @return JsonResponseArray
     */
    private function createJsonResponse(PsrResponseInterface $response): JsonResponseArray
    {
        return new JsonResponseArray($response);
    }

    /**
     * @param PsrResponseInterface $response
     * @throws ResponseContentTypeException
     */
    private function createXmlResponse(PsrResponseInterface $response)
    {
        throw new ResponseContentTypeException(ResponseInterface::CONTENT_TYPE_XML);
    }
}