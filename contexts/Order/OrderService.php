<?php


namespace Contexts\Order;


use Contexts\Order\Modules\Item\Models\Item;
use Contexts\Order\Modules\Item\Services\ItemService;
use Contexts\Order\Modules\Time\Models\Time;
use Contexts\Order\Modules\Time\Services\TimeService;
use Infrastructure\BaseService;
use Infrastructure\Models\Collection;

class OrderService extends BaseService implements OrderServiceInterface
{
    public function test(): string
    {
        return  $this->getItemService()->sayHi();
    }

    public function createItem(array $data): Item
    {
        return $this->getItemService()->create($data);
    }

    public function updateItem(int $id, array $data) : Item
    {
        return $this->getItemService()->update($id, $data);
    }

    public function getByItemId(int $id) : Item
    {
        return $this->getItemService()->getById($id);
    }

    public function delete(int $id) : void
    {
        $this->getItemService()->delete($id);
    }

    public function loadItems() : Collection
    {
        return $this->getItemService()->load();
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