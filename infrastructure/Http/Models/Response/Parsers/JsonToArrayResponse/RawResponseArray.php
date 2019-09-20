<?php

namespace Infrastructure\Http\Models\Response\Parsers\JsonToArrayResponse;

class RawResponseArray extends ResponseArray
{
    public function getBody(): array
    {
        return [$this->getResponse()->getBody()->getContents()];
    }
}
