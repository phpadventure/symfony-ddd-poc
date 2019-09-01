<?php
namespace Contexts\Order\Modules\Time\Models;

use Infrastructure\Models\ArraySerializable;

class Time implements ArraySerializable
{
    const UTC_DATETIME = 'utc_datetime';
    const UTC_OFFSET = 'utc_offset';
    const UNIXTIME = 'unixtime';

    private $utcDatetime;
    private $utcOffset;
    private $unixtime;

    public function __construct(string $utcDatetime, string $utcOffset, int $unixtime)
    {
        $this->utcOffset = $utcOffset;
        $this->utcDatetime = $utcDatetime;
        $this->unixtime = $unixtime;
    }

    public function toArray(): array
    {
        return [
            self::UNIXTIME => $this->unixtime,
            self::UTC_OFFSET => $this->utcOffset,
            self::UTC_DATETIME => $this->utcDatetime,
        ];
    }
}