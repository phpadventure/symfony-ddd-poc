<?php


namespace Contexts\Order;


use Contexts\Order\Modules\Item\Models\Item;
use Contexts\Order\Modules\Time\Models\Time;
use Infrastructure\Models\Collection;

interface OrderServiceInterface
{
    public function test() : string;

    public function time() : Time;

    public function loadItems() : Collection;

    public function createItem(array $data) : Item;

    public function updateItem(int $id, array $data) : Item;

    public function getByItemId(int $id) : Item;

    public function delete(int $id) : void;
}