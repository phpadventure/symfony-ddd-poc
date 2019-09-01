<?php

namespace Infrastructure\Models\Http\Response;


class JsonResponseArray extends ArrayParsedResponse
{
    /**
     * @return array
     */
    public function getParsedBody(): array
    {
        return json_decode($this->getBody()->getContents(), true);
    }
}