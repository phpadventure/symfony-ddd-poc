<?php
namespace Infrastructure\Services;

use Infrastructure\Exceptions\BaseHttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ErrorHandler implements ErrorHandlerInterface
{
    public function handle(BaseHttpException $exception): Response
    {
        throw $exception;
    }
}
