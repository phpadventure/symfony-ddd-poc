<?php

namespace Infrastructure\Http\Models\Response\Parsers\JsonToArrayResponse;

class EmptyResponseArray extends ResponseArray
{
    public function getBody(): array
    {
        return [];
    }
}
