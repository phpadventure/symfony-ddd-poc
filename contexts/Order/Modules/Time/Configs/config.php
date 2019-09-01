<?php

use Contexts\Order\Modules\Time\Mappers\TimeHttpMapper;
use Infrastructure\Mappers\HttpJsonMapper;

return [
    'timeHttpMapper' => [
        HttpJsonMapper::ENDPOINTS => [
            TimeHttpMapper::GET_TIMEZONE => 'http://worldtimeapi.org/api/timezone/:zone'
        ],
        HttpJsonMapper::DEFAULT_HEADERS => [
            'x-custom-header' => 'time-request'
        ]
    ]
];
