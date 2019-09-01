<?php

namespace Infrastructure\Http\Response\Parsers\JsonToArrayResponse;

class EmptyResponseArray extends ResponseArray
{
    public function getBody(): array
    {
        return [];
    }
}