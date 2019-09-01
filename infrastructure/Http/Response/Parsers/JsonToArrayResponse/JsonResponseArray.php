<?php

namespace Infrastructure\Http\Response\JsonToArrayResponse;

class JsonResponseArray extends ResponseArray
{
    public function getBody(): array
    {
        return json_decode($this->getResponse()->getBody()->getContents(), true);
    }
}