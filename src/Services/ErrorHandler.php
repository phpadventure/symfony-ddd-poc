<?php

namespace App\Services;

use Infrastructure\Exceptions\BaseHttpException;
use Infrastructure\Services\ErrorHandlerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ErrorHandler implements ErrorHandlerInterface
{
    public function handle(BaseHttpException $exception) : Response
    {
        return new JsonResponse(
            [
                'message' => $exception->getMessage(),
                'errorCode' => $exception->getErrorCode(),
                'errors' => $exception->getBody()
            ],
            $exception->getStatusCode(),
            $exception->getHeaders()
        );
    }
}
