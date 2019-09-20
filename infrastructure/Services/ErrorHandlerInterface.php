<?php
namespace Infrastructure\Services;

use Infrastructure\Exceptions\BaseHttpException;
use Symfony\Component\HttpFoundation\Response;

interface ErrorHandlerInterface
{
    public function handle(BaseHttpException $exception) : Response;
}
