<?php


namespace Contexts\Order;

use Contexts\Order\Modules\ItemService;
use Infrastructure\ServiceContainer;
use Infrastructure\ServiceContainerBuilder;

class ContainerBuilder  extends ServiceContainer implements ServiceContainerBuilder
{
    public function build() : void
    {
        $this->register(
            'itemService', ItemService::class
        );
    }
}