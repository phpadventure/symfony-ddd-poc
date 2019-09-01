<?php

namespace Infrastructure\Http\Response\JsonToArrayResponse;

class EmptyResponseArray extends ResponseArray
{
    public function getBody(): array
    {
        return [];
    }
}