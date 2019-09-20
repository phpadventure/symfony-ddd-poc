<?php

namespace Infrastructure\Http\Models\Response;

use Infrastructure\Exceptions\InfrastructureException;

class ResponseContentTypeException extends InfrastructureException
{
    public function __construct(string $notAllowedContentType)
    {
        parent::__construct('Illegal Content-Type: ' . $notAllowedContentType);
    }
}
