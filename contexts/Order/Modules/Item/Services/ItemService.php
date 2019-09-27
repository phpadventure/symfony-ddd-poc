<?php

namespace Contexts\Order\Modules\Item\Services;

use Contexts\Order\Modules\Item\Models\Item;
use Contexts\Order\Modules\Item\Repositories\ItemRepositoryInterface;
use Infrastructure\BaseService;
use Infrastructure\Models\Collection;

class ItemService extends BaseService
{
    public function sayHi(): string
    {
        return "Item service say hi";
    }

    public function create(array $data): Item
    {
        return $this->getItemRepository()->create($data);
    }

    public function update($id, array $data): Item
    {
        return $this->getItemRepository()->update([Item::ID => $id], array_merge($data, [Item::ID => $id]));
    }

    public function delete($id): void
    {
        $this->getItemRepository()->deleteBy([Item::ID => $id]);
    }

    public function getById($id): Item
    {
        return $this->getItemRepository()->findOneBy([Item::ID => $id]);
    }

    public function load(): Collection
    {
        return $this->getItemRepository()->load();
    }

    private function getItemRepository(): ItemRepositoryInterface
    {
        return $this->getContainer()->get('itemRepository');
    }
}
