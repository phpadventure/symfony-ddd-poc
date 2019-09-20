<?php
namespace Contexts\Order\Modules\Time\Factories;

use Contexts\Order\Modules\Time\Models\Time;
use Infrastructure\Factories\BaseFactory;
use Infrastructure\Models\ArraySerializable;

class TimeFactory extends BaseFactory
{
    public function create(array $objectData): ArraySerializable
    {
        return new Time(
            $this->setDefaultIfNotExists(Time::UTC_DATETIME, '', $objectData),
            $this->setDefaultIfNotExists(Time::UTC_OFFSET, '', $objectData),
            $this->setDefaultIfNotExists(Time::UNIXTIME, 0, $objectData)
        );
    }
}
