<?php


namespace Contexts\Order;


use Contexts\Order\Modules\ItemService;
use Infrastructure\BaseService;

class OrderService extends BaseService implements OrderServiceInterface
{
    public function test(): string
    {
        return  $this->getItemService()->sayHi();
    }

    private function getItemService() : ItemService
    {
        return $this->getContainer()->get('ItemService');
    }

}