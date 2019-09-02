<?php


namespace Contexts\Order\Modules\Item\Services;


use Contexts\Order\Modules\Item\Repositories\ItemRepositoryInterface;
use Infrastructure\BaseService;
use Infrastructure\Models\Collection;

class ItemService extends BaseService
{
    public function sayHi() : string
    {
        return "Item service say hi";
    }

    public function load() : Collection
    {
        return $this->getItemRepository()->load();
    }

    private function getItemRepository() : ItemRepositoryInterface
    {
        return $this->getContainer()->get('itemRepository');
    }
}