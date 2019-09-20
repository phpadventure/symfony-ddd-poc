<?php
namespace Contexts\Order\Modules\Time\Mappers;

use Contexts\Order\Modules\Time\Models\Time;
use Infrastructure\Mappers\HttpJsonMapper;

class TimeHttpMapper extends HttpJsonMapper
{
    public const GET_TIMEZONE = 'getTimeZoneUrl';
    public const EUROPE_KIEV_ZONE = 'Europe/Kiev';

    public function getTime($zone) : Time
    {
        return $this->get(self::GET_TIMEZONE, ['zone' => $zone]);
    }
}
