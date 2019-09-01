<?php


namespace Contexts\Order;

use Contexts\Order\Modules\ItemService;
use Infrastructure\Models\ServiceContainer;

class OrderContainer  extends ServiceContainer
{
    public function init() : void
    {
        $this->register(
            'ItemService', ItemService::class
        );
    }
}