<?php
namespace Infrastructure\Exceptions\Factories;

use Infrastructure\Exceptions\BaseHttpException;
use Infrastructure\Exceptions\InfrastructureException;
use Throwable;

class HttpExceptionFactory
{
    public function create(Throwable $exception) : BaseHttpException
    {
        if ($exception instanceof BaseHttpException) {
            return $exception;
        }

        return new InfrastructureException($exception->getMessage(), $exception);
    }
}
