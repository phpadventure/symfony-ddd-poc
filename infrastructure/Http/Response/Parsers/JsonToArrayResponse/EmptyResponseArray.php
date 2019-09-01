<?php

namespace Infrastructure\Models\Http\Response;


class EmptyResponseArray extends ArrayParsedResponse
{
    /**
     * @return array
     */
    public function getParsedBody(): array
    {
        return [];
    }
}