<?php


namespace Contexts\Order;


use Contexts\Order\Modules\ItemService;
use Contexts\Order\Modules\Time\Models\Time;
use Contexts\Order\Modules\Time\Services\TimeService;
use Infrastructure\BaseService;

class OrderService extends BaseService implements OrderServiceInterface
{
    public function test(): string
    {
        return  $this->getItemService()->sayHi();
    }

    public function time() : Time
    {
        return $this->getTimeService()->getTime();
    }

    private function getItemService() : ItemService
    {
        return $this->getContainer()->get('itemService');
    }

    private function getTimeService() : TimeService
    {
        return $this->getContainer()->get('timeService');
    }
}