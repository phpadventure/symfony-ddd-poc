<?php

namespace Infrastructure\Models\Http\Response;


class RawResponseArray extends ArrayParsedResponse
{
    /**
     * @return array
     */
    public function getParsedBody(): array
    {
        return [$this->getBody()->getContents()];
    }
}