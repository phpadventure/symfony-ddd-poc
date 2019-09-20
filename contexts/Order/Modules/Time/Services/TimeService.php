<?php
namespace Contexts\Order\Modules\Time\Services;

use Contexts\Order\Modules\Time\Mappers\TimeHttpMapper;
use Contexts\Order\Modules\Time\Models\Time;
use Infrastructure\BaseService;

class TimeService extends BaseService
{
    public function getTime() : Time
    {
        return $this->getTimeHttpMapper()->getTime(TimeHttpMapper::EUROPE_KIEV_ZONE);
    }
    private function getTimeHttpMapper() : TimeHttpMapper
    {
        return $this->getContainer()->get('timeHttpMapper');
    }
}
