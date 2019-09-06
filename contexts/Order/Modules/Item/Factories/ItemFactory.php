<?php


namespace Contexts\Order\Modules\Item\Factories;


use Contexts\Order\Modules\Item\Models\Item;
use Infrastructure\Factories\BaseFactory;
use Infrastructure\Models\ArraySerializable;

class ItemFactory extends BaseFactory
{
    public function create(array $objectData): ArraySerializable
    {
        return new Item(
            $this->setDefaultIfNotExists(Item::ID, null, $objectData),
            $this->setDefaultIfNotExists(Item::NAME, '', $objectData),
            $this->setDefaultIfNotExists(Item::PRICE, 0, $objectData),
            $this->setDefaultIfNotExists(Item::DESCRIPTION, '', $objectData)
        );
    }
}