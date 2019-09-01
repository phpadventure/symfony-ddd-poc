<?php
namespace Infrastructure\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Infrastructure\Exceptions\BaseHttpException;
use Infrastructure\Exceptions\InfrastructureException;
use Infrastructure\Models\ErrorData;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class HttpClient
{
    /**
     * @var Client
     */
    private $guzzleHttpClient;

    public function __construct()
    {
        $this->guzzleHttpClient = new Client();
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws BaseHttpException
     * @throws InfrastructureException
     */
    public function send(RequestInterface $request): ResponseInterface
    {
        try {
            return $this->guzzleHttpClient->send($request);
        } catch (RequestException $exception) {
            $response = $exception->getResponse();

            throw new BaseHttpException(
                $exception->getMessage(),
                BaseHttpException::DEFAULT_ERROR_CODE,
                (new ErrorData())->add('content', $response->getBody()->getContents()),
                $response->getStatusCode(),
                (new ErrorData())->addAll($this->getResponseHeadersFormatted($request->getHeaders())),
                $exception,
                $exception->getCode()
            );
        } catch (GuzzleException $exception) {
            throw new InfrastructureException('Guzzle Exception', $exception);
        }
    }

    /**
     * @param array $headers
     * @return array
     */
    private function getResponseHeadersFormatted(array $headers): array
    {
        $headersFormatted = [];
        foreach ($headers as $name => $values) {
            $headersFormatted[$name] = implode(", ", $values);
        }

        return $headersFormatted;
    }
}