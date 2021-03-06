<?php


namespace Contexts\Order\Configs;

use Contexts\Order\Modules\Item\Configs\ItemServiceContainer;
use Contexts\Order\Modules\Item\Services\ItemService;
use Contexts\Order\Modules\Time\Configs\TimeServiceContainer;
use Contexts\Order\Modules\Time\Services\TimeService;
use Infrastructure\Models\Config;
use Infrastructure\Models\ServiceContainer;

class OrderContainer extends ServiceContainer
{
    public function init() : ServiceContainer
    {
        $this->register('config', Config::class)->addArgument(include_once 'config.php');
        $this->register('itemService', ItemService::class)->addArgument(
            (new ItemServiceContainer($this->getApplicationContainer()))->init()
        );
        $this->register('timeService', TimeService::class)->addArgument(
            (new TimeServiceContainer($this->getApplicationContainer()))->init()
        );

        return $this;
    }
}
