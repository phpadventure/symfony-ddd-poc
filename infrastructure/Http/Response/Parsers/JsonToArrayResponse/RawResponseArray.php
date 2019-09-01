<?php

namespace Infrastructure\Http\Response\JsonToArrayResponse;

class RawResponseArray extends ResponseArray
{
    public function getBody(): array
    {
        return [$this->getResponse()->getBody()->getContents()];
    }
}